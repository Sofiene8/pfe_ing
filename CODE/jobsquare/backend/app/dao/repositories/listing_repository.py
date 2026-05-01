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
    "job_offer": 6,
    "internship": 7,
    "training": 8,
}

# ---------------------------------------------------------------------------
# MAPPING SLUG FRONTEND → IDs JobCategory stockés dans MongoDB (héritage PHP)
#
# ⚠️  CES VALEURS SONT À VALIDER contre ta base réelle.
#     Lance cette commande pour voir tous les IDs existants :
#
#       db.listings.distinct("JobCategory")
#
#     Puis ajuste les listes ci-dessous en conséquence.
#     Les IDs sont stockés en STRING dans Mongo (ex: "2021"),
#     on cherche aussi en int (2021) par sécurité.
# ---------------------------------------------------------------------------
CATEGORY_SLUG_TO_IDS: Dict[str, List[Any]] = {
    # Informatique & Technologies
    "IT": ["2021", "2022", "2023", "2024", "2025",
           2021, 2022, 2023, 2024, 2025],

    # Finance & Comptabilité
    "Finance": ["2031", "2032", "2033",
                2031, 2032, 2033],

    # Marketing & Communication
    "Marketing": ["2041", "2042", "2043",
                  2041, 2042, 2043],

    # Ressources Humaines
    "RH": ["2051", "2052",
           2051, 2052],

    # Commercial & Ventes
    "Commercial": ["2061", "2062", "2063",
                   2061, 2062, 2063],

    # Juridique & Droit
    "Juridique": ["2071", "2072",
                  2071, 2072],

    # Ingénierie & Industrie
    "Ingenierie": ["2081", "2082", "2083", "2084",
                   2081, 2082, 2083, 2084],

    # Santé & Médical
    "Sante": ["2091", "2092",
              2091, 2092],

    # Éducation & Formation
    "Education": ["2101", "2102",
                  2101, 2102],

    # Architecture & BTP
    "BTP": ["2111", "2112", "2113",
            2111, 2112, 2113],

    # Transport & Logistique
    "Transport": ["2121", "2122",
                  2121, 2122],

    # Tourisme & Hôtellerie
    "Tourisme": ["2131", "2132",
                 2131, 2132],

    # Agriculture & Agroalimentaire
    "Agriculture": ["2141", "2142",
                    2141, 2142],

    # Arts & Design
    "Design": ["2151", "2152",
               2151, 2152],

    # Administration & Secrétariat
    "Admin": ["2161", "2162",
              2161, 2162],
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
            if doc.get("Experience") or doc.get("id_Job_Experience"):
                job["experience"] = doc.get("Experience") or doc.get("id_Job_Experience")
            if doc.get("Study") or doc.get("id_Job_Niveaudtude"):
                job["study_level"] = doc.get("Study") or doc.get("id_Job_Niveaudtude")
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
        """
        Résout un slug frontend (ex: "IT") en filtre MongoDB.

        Trois cas :
          1. Le slug existe dans CATEGORY_SLUG_TO_IDS → filtre $in sur les IDs legacy
          2. Le slug ressemble à un ID numérique (ex: "2021") → filtre direct
          3. Slug inconnu → regex case-insensitive (pour les nouvelles offres)
        """
        # Cas 1 — slug connu dans le mapping
        ids = CATEGORY_SLUG_TO_IDS.get(category)
        if ids:
            return {"$or": [
                {"JobCategory":  {"$in": ids}},
                {"job.category": {"$in": ids}},
            ]}

        # Cas 2 — l'utilisateur a passé directement un ID numérique en string
        if category.isdigit():
            return {"$or": [
                {"JobCategory":  {"$in": [category, int(category)]}},
                {"job.category": {"$in": [category, int(category)]}},
            ]}

        # Cas 3 — slug inconnu, on tente une correspondance texte
        # (utile pour les offres récentes qui stockent le nom de catégorie en clair)
        return {"$or": [
            {"JobCategory":  {"$regex": category, "$options": "i"}},
            {"job.category": {"$regex": category, "$options": "i"}},
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
        """
        Retourne toutes les valeurs distinctes de JobCategory présentes
        dans la base, avec le compte d'offres actives par catégorie.

        Utilisé par l'endpoint /listings/categories pour :
          - Valider / compléter le CATEGORY_SLUG_TO_IDS
          - Afficher les compteurs dans le frontend
        """
        pipeline = [
            {"$match": {"$or": [{"active": 1}, {"active": True}]}},
            {"$group": {
                "_id":   "$JobCategory",
                "count": {"$sum": 1},
            }},
            {"$sort": {"count": -1}},
        ]
        results = []
        async for doc in self.col.aggregate(pipeline):
            if doc["_id"] is not None:
                results.append({"id": doc["_id"], "count": doc["count"]})
        return results

    async def search(
        self,
        listing_type: str = "job_offer",
        query: str = None,
        category: str = None,
        state: str = None,
        employment_type: str = None,
        experience: str = None,
        study_level: str = None,
        skip: int = 0,
        limit: int = 20,
        sort_by: str = "created_at",
        sort_order: int = -1,
    ) -> Dict[str, Any]:

        must = []

        # active — supporte integer (1) ET boolean (True)
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

        # ✅ FIX — Utilise _build_category_filter au lieu de la comparaison directe
        if category:
            cat_filter = self._build_category_filter(category)
            must.append(cat_filter)

        if employment_type:
            must.append({"$or": [
                {"EmploymentType":      employment_type},
                {"job.employment_type": employment_type},
            ]})

        if experience:
            must.append({"$or": [
                {"id_Job_Experience": experience},
                {"job.experience":    experience},
            ]})

        if study_level:
            must.append({"$or": [
                {"Study":           study_level},
                {"job.study_level": study_level},
            ]})

        filter_ = {"$and": must} if len(must) > 1 else (must[0] if must else {})

        total = await self.col.count_documents(filter_)

        # Aggregation pipeline avec tri robuste
        # Les offres legacy ont "date_add" (string), les nouvelles ont "created_at" (datetime)
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
            {"$sort": {"_sort_date": sort_order}},
            {"$skip": skip},
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
        cursor = (
            self.col.find(filter_)
            .sort([("created_at", -1), ("date_add", -1)])
        )
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