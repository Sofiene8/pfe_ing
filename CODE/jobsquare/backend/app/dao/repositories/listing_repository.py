"""app/dao/repositories/listing_repository.py — CRUD MongoDB pour Listing"""

from typing import Optional, List, Dict, Any
from datetime import datetime
import logging
import os
from bson import ObjectId
import httpx

from app.core.database import get_db

logger = logging.getLogger(__name__)

RECO_SERVICE_URL = os.getenv("RECO_SERVICE_URL", "http://reco:8001")

LISTING_TYPE_MAP = {
    "job_offer":  6,
    "internship": 7,
    "training":   8,
}

# ── Mapping legacy IDs → labels ───────────────────────────────────────────────
#
# IDs réels confirmés par diagnostic MongoDB :
#   EmploymentType distinct : '695','76','76,695','76,695,77','77,696,921'
#   id_Job_Experience distinct : '986','987','988','989','993','994','995','996'
#
# ⚠️  EmploymentType peut contenir :
#   - Un seul ID          ex: "76"
#   - Plusieurs IDs       ex: "76,695" ou "76,695,77"
#   - Du texte complet    ex: "Entreprise recherche un(e)..." (offres auto-générées)
#
# Le filtre doit matcher n'importe quel document dont EmploymentType CONTIENT l'ID cible.

EMPLOYMENT_TYPE_MAP = {
    "CDI":                     [76],
    "CDD":                     [695],
    "Temps plein":             [77],
    "Temps partiel":           [696],
    "Freelance":               [78],
    "Freelance / Indépendant": [78],
    "Intérim":                 [697],
    "Saisonnier":              [79],
    "Stage":                   [921],
    "SIVP":                    [921],
    "Contrat al Karama":       [698],
    "Autre":                   [1047],
}

# IDs réels confirmés : 986=Débutant, 987=0-1an, 988=1-3ans, 989=3-5ans
# 993-996 semblent aussi utilisés dans certains documents legacy
EXPERIENCE_MAP = {
    "Debutant":    [986],
    "Débutant":   [986],
    "0 a 1 an":    [987],
    "1 a 3 ans":   [988],
    "1-2 ans":     [987, 988],
    "2-5 ans":     [988, 989],
    "3 a 5 ans":   [989],
    "5 a 10 ans":  [990],
    "5-10 ans":    [990],
    "plus 10 ans": [991],
    "+10 ans":     [991],
    "Autre":       [1045],
}

# IDs study_level confirmés par STUDY_LEVEL_MAP backend
STUDY_LEVEL_MAP = {
    "Bac":                      [998, 993],
    "Bac+2":                    [1001],
    "Bac 2":                    [1001],
    "Bac+3":                    [997],
    "Bac 3":                    [997],
    "Bac+4":                    [1002],
    "Bac 4":                    [1002],
    "Bac+5":                    [1003],
    "Bac 5":                    [1003],
    "Master":                   [1003],
    "Ingénieur":                [996],
    "Ingenieur":                [996],
    "Doctorat":                 [995],
    "Formation professionnelle":[993, 998],
    "Autre":                    [1048],
}


def _norm_key(s):
    import unicodedata, re as _re
    s = unicodedata.normalize("NFD", s.lower())
    s = "".join(c for c in s if unicodedata.category(c) != "Mn")
    s = _re.sub(r"[^a-z0-9\s]", " ", s)
    return _re.sub(r"\s+", " ", s).strip()


def _ids_for(mapping: dict, label: str):
    """Match exact ou normalise uniquement — PAS de matching partiel."""
    import unicodedata, re as _re
    def nk(s):
        s = unicodedata.normalize("NFD", s.lower())
        s = "".join(x for x in s if unicodedata.category(x) != "Mn")
        s = _re.sub(r"[^a-z0-9]", "", s)
        return s
    if label in mapping:
        return mapping[label]
    nl = nk(label)
    for k, v in mapping.items():
        if nk(k) == nl:
            return v
    return []


# ---------------------------------------------------------------------------
# MAPPING SLUG FRONTEND → IDs JobCategory stockés dans MongoDB
# ---------------------------------------------------------------------------
CATEGORY_SLUG_TO_IDS: Dict[str, List[Any]] = {
    "IT":         ["2021", "2022", "2023", "2024", "2025", 2021, 2022, 2023, 2024, 2025],
    "Finance":    ["2031", "2032", "2033", 2031, 2032, 2033],
    "Marketing":  ["2041", "2042", "2043", 2041, 2042, 2043],
    "RH":         ["2051", "2052", 2051, 2052],
    "Commercial": ["2061", "2062", "2063", 2061, 2062, 2063],
    "Juridique":  ["2071", "2072", 2071, 2072],
    "Ingenierie": ["2081", "2082", "2083", "2084", 2081, 2082, 2083, 2084],
    "Sante":      ["2091", "2092", 2091, 2092],
    "Education":  ["2101", "2102", 2101, 2102],
    "BTP":        ["2111", "2112", "2113", 2111, 2112, 2113],
    "Transport":  ["2121", "2122", 2121, 2122],
    "Tourisme":   ["2131", "2132", 2131, 2132],
    "Agriculture":["2141", "2142", 2141, 2142],
    "Design":     ["2151", "2152", 2151, 2152],
    "Admin":      ["2161", "2162", 2161, 2162],
}

CATEGORY_FULLNAME_TO_SLUG = {
    "Informatique & Technologies":   "IT",
    "Finance & Comptabilité":        "Finance",
    "Marketing & Communication":     "Marketing",
    "Ressources Humaines":           "RH",
    "Commercial & Ventes":           "Commercial",
    "Juridique & Droit":             "Juridique",
    "Ingénierie & Industrie":        "Ingenierie",
    "Santé & Médical":               "Sante",
    "Éducation & Formation":         "Education",
    "Architecture & BTP":            "BTP",
    "Transport & Logistique":        "Transport",
    "Tourisme & Hôtellerie":         "Tourisme",
    "Agriculture & Agroalimentaire": "Agriculture",
    "Arts & Design":                 "Design",
    "Administration & Secrétariat":  "Admin",
}


class ListingRepository:

    @property
    def col(self):
        return get_db().listings

    def _serialize(self, doc: dict) -> dict:
        if not doc:
            return None
        doc["_id"] = str(doc["_id"])

        if not doc.get("title") and doc.get("Title"):
            raw_title = doc["Title"]
            try:
                int(raw_title)
            except (ValueError, TypeError):
                doc["title"] = raw_title

        if not doc.get("job"):
            job = {}
            if doc.get("JobDescription"):
                job["description"] = doc["JobDescription"]
            if doc.get("JobRequirements"):
                job["requirements"] = doc["JobRequirements"]
            if doc.get("Location_State") or doc.get("Location_City") or doc.get("Location_Country"):
                job["location"] = {
                    "state":   doc.get("Location_State"),
                    "city":    doc.get("Location_City"),
                    "country": doc.get("Location_Country"),
                }
            # FIX: séparer experience et study_level dans _serialize
            # pour éviter que le même champ alimente les deux badges
            exp = doc.get("id_Job_Experience") or doc.get("Experience")
            if exp:
                job["experience"] = exp

            # FIX: lire study_level depuis id_Job_Niveaudtude (pas id_Job_Experience)
            study = doc.get("id_Job_Niveaudtude") or doc.get("Study") or doc.get("StudyLevel")
            if study:
                job["study_level"] = study

            if job:
                doc["job"] = job

        if not doc.get("employer_snapshot"):
            doc["employer_snapshot"] = {
                "company_name": None,
                "logo": None,
            }

        return doc

    def _build_id_filter(self, listing_id) -> Optional[dict]:
        filters = []
        try:
            filters.append({"_id": ObjectId(str(listing_id))})
        except Exception:
            pass
        try:
            sid = int(listing_id)
            filters.append({"_id": sid})
            filters.append({"sid": sid})
        except (ValueError, TypeError):
            pass
        if not filters:
            return None
        return {"$or": filters} if len(filters) > 1 else filters[0]

    def _build_category_filter(self, category: str) -> Optional[dict]:
        ids = CATEGORY_SLUG_TO_IDS.get(category, [])
        values = [category] + ids
        if values:
            return {"$or": [
                {"JobCategory":  {"$in": values}},
                {"job.category": {"$in": values}},
            ]}
        if category.isdigit():
            return {"$or": [
                {"JobCategory":  {"$in": [category, int(category)]}},
                {"job.category": {"$in": [category, int(category)]}},
            ]}
        return {"$or": [
            {"JobCategory":  {"$regex": category, "$options": "i"}},
            {"job.category": {"$regex": category, "$options": "i"}},
        ]}

    def _build_employment_filter(self, employment_type: str) -> dict:
        """
        FIX: EmploymentType stocke parfois plusieurs IDs séparés par virgule
        ex: "76,695" ou "76,695,77".
        On utilise $regex pour matcher l'ID n'importe où dans la chaîne,
        ce qui évite de rater les documents multi-valeurs.
        """
        ids = _ids_for(EMPLOYMENT_TYPE_MAP, employment_type)
        if not ids:
            # Pas d'IDs trouvés → match direct sur le label
            return {"$or": [
                {"EmploymentType":    employment_type},
                {"job.employment_type": employment_type},
            ]}

        # Construire des conditions regex pour chaque ID (ex: r"\b76\b")
        # ET des conditions exactes pour job.employment_type (qui stocke le label)
        regex_conditions = []
        for id_val in ids:
            # Regex qui matche l'ID seul ou en début/milieu/fin d'une liste CSV
            pattern = r"(^|,)\s*" + str(id_val) + r"\s*($|,)"
            regex_conditions.append({"EmploymentType": {"$regex": pattern}})
            # Match exact aussi (pour docs qui stockent l'ID seul)
            regex_conditions.append({"EmploymentType": str(id_val)})
            regex_conditions.append({"EmploymentType": id_val})

        # job.employment_type stocke le label lisible (ex: "CDD")
        regex_conditions.append({"job.employment_type": employment_type})
        # aussi par ID au cas où
        regex_conditions += [{"job.employment_type": str(i)} for i in ids]

        return {"$or": regex_conditions}

    def _build_experience_filter(self, experience: str) -> dict:
        """
        FIX: id_Job_Experience stocke des IDs numériques en STRING.
        Valeurs réelles : '986','987','988','989','993','994','995','996'.
        """
        ids = _ids_for(EXPERIENCE_MAP, experience)
        values_str = [str(i) for i in ids]
        values_int = [int(i) for i in ids]
        return {"$or": [
            {"id_Job_Experience": {"$in": values_str + values_int}},
            {"Experience":        {"$in": values_str + values_int}},
            {"job.experience":    {"$in": values_str + values_int + [experience]}},
        ]}

    def _build_study_filter(self, study_level: str) -> dict:
        """Filtre study_level via id_Job_Niveaudtude."""
        ids = _ids_for(STUDY_LEVEL_MAP, study_level)
        values_str = [str(i) for i in ids]
        values_int = [int(i) for i in ids]
        return {"$or": [
            {"id_Job_Niveaudtude": {"$in": values_str + values_int}},
            {"Study":              {"$in": values_str + values_int}},
            {"StudyLevel":         {"$in": values_str + values_int}},
            {"job.study_level":    {"$in": values_str + values_int + [study_level]}},
        ]}

    async def _refresh_reco_cache(self) -> None:
        try:
            async with httpx.AsyncClient(timeout=5.0) as client:
                r = await client.post(f"{RECO_SERVICE_URL}/cache/refresh")
                logger.info("Reco cache refreshed — %d listings indexed", r.json().get("refreshed", "?"))
        except Exception as exc:
            logger.warning("Reco cache refresh failed (non-blocking): %s", exc)

    async def find_by_id(self, listing_id) -> Optional[dict]:
        filter_ = self._build_id_filter(listing_id)
        if not filter_:
            return None
        doc = await self.col.find_one(filter_)
        return self._serialize(doc)

    async def create(self, data: dict) -> dict:
        data["created_at"] = datetime.utcnow()
        data["updated_at"] = datetime.utcnow()
        result = await self.col.insert_one(data)
        doc = await self.col.find_one({"_id": result.inserted_id})
        await self._refresh_reco_cache()
        return self._serialize(doc)

    async def update(self, listing_id: str, data: dict) -> Optional[dict]:
        filter_ = self._build_id_filter(listing_id)
        if not filter_:
            return None
        data["updated_at"] = datetime.utcnow()
        await self.col.update_one(filter_, {"$set": data})
        await self._refresh_reco_cache()
        return await self.find_by_id(listing_id)

    async def delete(self, listing_id: str) -> bool:
        filter_ = self._build_id_filter(listing_id)
        if not filter_:
            return False
        result = await self.col.delete_one(filter_)
        if result.deleted_count > 0:
            await self._refresh_reco_cache()
            return True
        return False

    async def increment_views(self, listing_id: str):
        filter_ = self._build_id_filter(listing_id)
        if not filter_:
            return
        await self.col.update_one(filter_, {"$inc": {"views": 1}})

    async def get_all_categories(self) -> List[dict]:
        pipeline = [
            {"$match": {"$or": [{"active": 1}, {"active": True}]}},
            {"$group": {"_id": "$JobCategory", "count": {"$sum": 1}}},
            {"$sort": {"count": -1}},
        ]
        results = []
        async for doc in self.col.aggregate(pipeline):
            if doc["_id"] is not None:
                results.append({"id": doc["_id"], "count": doc["count"]})
        return results

    async def search(
        self,
        listing_type:    str = "job_offer",
        query:           str = None,
        category:        str = None,
        state:           str = None,
        employment_type: str = None,
        experience:      str = None,
        study_level:     str = None,
        skip:            int = 0,
        limit:           int = 20,
        sort_by:         str = "created_at",
        sort_order:      int = -1,
    ) -> Dict[str, Any]:

        must = []

        must.append({"$or": [{"active": 1}, {"active": True}]})

        if listing_type and listing_type in LISTING_TYPE_MAP:
            must.append({"listing_type_sid": LISTING_TYPE_MAP[listing_type]})

        if query:
            must.append({"$or": [
                {"Title":           {"$regex": query, "$options": "i"}},
                {"title":           {"$regex": query, "$options": "i"}},
                {"keywords":        {"$regex": query, "$options": "i"}},
                {"job.description": {"$regex": query, "$options": "i"}},
                {"JobDescription":  {"$regex": query, "$options": "i"}},
                {"employer_snapshot.company_name": {"$regex": query, "$options": "i"}},
            ]})

        if state:
            must.append({"$or": [
                {"Location_State":     state},
                {"job.location.state": state},
            ]})

        if category:
            must.append(self._build_category_filter(category))

        if employment_type:
            must.append(self._build_employment_filter(employment_type))

        if experience:
            must.append(self._build_experience_filter(experience))

        if study_level:
            must.append(self._build_study_filter(study_level))

        filter_ = {"$and": must} if len(must) > 1 else (must[0] if must else {})

        total = await self.col.count_documents(filter_)

        pipeline = [
            {"$match": filter_},
            {"$addFields": {
                "_sort_date": {
                    "$cond": {
                        "if":   {"$ifNull": ["$created_at", False]},
                        "then": "$created_at",
                        "else": {
                            "$cond": {
                                "if":   {"$ifNull": ["$date_add", False]},
                                "then": "$date_add",
                                "else": datetime.min
                            }
                        }
                    }
                }
            }},
            {"$sort":  {"_sort_date": sort_order}},
            {"$skip":  skip},
            {"$limit": limit},
        ]

        items = []
        async for doc in self.col.aggregate(pipeline):
            doc.pop("_sort_date", None)
            items.append(self._serialize(doc))

        return {"items": items, "total": total, "skip": skip, "limit": limit}

    async def find_by_user(self, user_id: str, listing_type: str = None) -> List[dict]:
        filter_ = {"$or": [{"user_id": user_id}, {"user_sid": user_id}]}
        if listing_type and listing_type in LISTING_TYPE_MAP:
            filter_["listing_type_sid"] = LISTING_TYPE_MAP[listing_type]
        cursor = self.col.find(filter_).sort([("created_at", -1), ("date_add", -1)])
        return [self._serialize(doc) async for doc in cursor]

    async def find_similar(self, listing_id: str, limit: int = 5) -> List[dict]:
        listing = await self.find_by_id(listing_id)
        if not listing:
            return []
        try:
            exclude_id = ObjectId(listing["_id"])
        except Exception:
            exclude_id = listing["_id"]
        filter_ = {
            "_id": {"$ne": exclude_id},
            "active": {"$in": [1, True]},
            "listing_type_sid": listing.get("listing_type_sid", 6),
        }
        category = listing.get("JobCategory") or (listing.get("job") or {}).get("category")
        state    = listing.get("Location_State") or ((listing.get("job") or {}).get("location") or {}).get("state")
        or_filters = []
        if category:
            or_filters += [{"JobCategory": category}, {"job.category": category}]
        if state:
            or_filters += [{"Location_State": state}, {"job.location.state": state}]
        if or_filters:
            filter_["$or"] = or_filters
        cursor = self.col.find(filter_).limit(limit)
        return [self._serialize(doc) async for doc in cursor]

    async def decrement_slots(self, listing_id: str) -> Optional[dict]:
        filter_ = self._build_id_filter(listing_id)
        if not filter_:
            return None
        await self.col.update_one(
            {**filter_, "available_slots": {"$gt": 0}},
            {"$inc": {"available_slots": -1}, "$set": {"updated_at": datetime.utcnow()}}
        )
        doc = await self.find_by_id(listing_id)
        if not doc:
            return None
        if doc.get("available_slots") == 0:
            await self.col.update_one(
                filter_,
                {"$set": {"active": False, "updated_at": datetime.utcnow()}}
            )
            doc["active"] = False
        return doc

    async def get_slots(self, listing_id: str) -> Optional[int]:
        filter_ = self._build_id_filter(listing_id)
        if not filter_:
            return None
        doc = await self.col.find_one(filter_, {"available_slots": 1})
        if not doc:
            return None
        return doc.get("available_slots")