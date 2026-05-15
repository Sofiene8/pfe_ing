"""app/services/recommendation_service.py"""
import re
import logging
import numpy as np
from typing import List, Optional
from functools import lru_cache
from datetime import datetime
from sentence_transformers import SentenceTransformer
from sklearn.metrics.pairwise import cosine_similarity

from app.dao.repositories.user_repository import UserRepository
from app.dao.repositories.listing_repository import ListingRepository

logger = logging.getLogger(__name__)

MODEL_NAME = "paraphrase-multilingual-MiniLM-L12-v2"

# ── Domaines métier ────────────────────────────────────────────────────────────

DOMAIN_KEYWORDS = {
    "tech": {
        "python", "javascript", "typescript", "react", "vue", "angular", "node",
        "nodejs", "php", "java", "kotlin", "swift", "c++", "c#", "rust", "go",
        "golang", "ruby", "scala", "r", "matlab", "sql", "nosql", "mongodb",
        "postgresql", "mysql", "redis", "elasticsearch", "docker", "kubernetes",
        "aws", "azure", "gcp", "git", "linux", "bash", "devops", "ci/cd",
        "jenkins", "terraform", "ansible", "nginx", "api", "rest", "graphql",
        "microservices", "machine learning", "deep learning", "tensorflow",
        "pytorch", "pandas", "numpy", "spark", "hadoop", "data", "blockchain",
        "web", "frontend", "backend", "fullstack", "full-stack", "mobile",
        "android", "ios", "flutter", "react native", "développeur", "developer",
        "ingénieur logiciel", "software engineer", "data scientist", "devops",
        "sysadmin", "informatique", "numérique", "digital",
    },
    "finance": {
        "comptabilité", "comptable", "finance", "financier", "audit", "auditeur",
        "contrôle de gestion", "trésorerie", "fiscalité", "bilan", "excel",
        "sage", "sap", "cegid", "erp financier", "reporting financier",
    },
    "rh": {
        "ressources humaines", "rh", "recrutement", "paie", "formation rh",
        "gestion du personnel", "sirh", "talent", "onboarding",
    },
    "admin": {
        "assistante administrative", "assistant administratif", "secrétaire",
        "secrétariat", "accueil", "accueil téléphonique", "gestion administrative",
        "bureautique", "classement", "archivage", "courrier", "agenda",
        "office manager", "assistanat", "polyvalent", "administration",
        "chargé d'accueil", "réceptionniste", "back office",
    },
    "chimie": {
        "chimiste", "chimie", "hplc", "spectroscopie", "microbiologie",
        "analyses chimiques", "réactifs chimiques", "laboratoire chimie",
        "technicien chimiste", "contrôle qualité chimie",
    },
    "industrie": {
        "cnc", "usinage", "mécanique", "soudure", "automatisme", "plc", "scada",
        "maintenance", "industrielle", "industrie", "électromécanique",
        "électrotechnique", "fabrication", "atelier", "pneumatique", "hydraulique",
        "mécatronique", "composants", "automobile", "production industrielle",
    },
    "agriculture": {
        "agriculture", "agricole", "agronomie", "agroalimentaire",
        "irrigation", "élevage", "technicien agricole", "cultures",
        "semences", "zootechnie", "sylviculture",
    },
    "vente": {
        "commercial", "commerciale", "vente", "vendeur", "key account",
        "account manager", "business developer", "prospection", "crm",
        "chargé de clientèle", "relation client", "technico-commercial",
    },
    "marketing": {
        "marketing", "communication", "community manager", "seo", "sem",
        "réseaux sociaux", "content manager", "brand manager", "digital marketing",
        "chef de produit", "responsable marketing",
    },
}


def _detect_user_domain(skills: List[str], experience_text: str) -> Optional[str]:
    combined = " ".join(skills).lower() + " " + experience_text.lower()
    domain_scores = {}
    for domain, keywords in DOMAIN_KEYWORDS.items():
        score = sum(1 for kw in keywords if kw in combined)
        if score > 0:
            domain_scores[domain] = score
    if not domain_scores:
        return None
    best_domain = max(domain_scores, key=domain_scores.get)
    return best_domain if domain_scores[best_domain] >= 2 else None


def _listing_domain_score(listing: dict) -> dict:
    job   = listing.get("job") or {}
    title = (listing.get("title") or listing.get("Title") or "").lower()
    desc  = (listing.get("JobDescription") or job.get("description") or "").lower()
    req   = (listing.get("JobRequirements") or job.get("requirements") or "").lower()
    kw    = (listing.get("id_Job_MotsCls") or "").lower()
    skills_str = " ".join(str(s).lower() for s in (job.get("skills") or []) if s)
    combined = f"{title} {desc} {req} {kw} {skills_str}"
    scores = {}
    for domain, keywords in DOMAIN_KEYWORDS.items():
        score = sum(1 for kw in keywords if kw in combined)
        if score > 0:
            scores[domain] = score
    return scores


def _is_domain_compatible(user_domain: Optional[str], listing: dict) -> bool:
    if user_domain is None:
        return True
    listing_domains = _listing_domain_score(listing)
    if not listing_domains:
        return True
    best_domain = max(listing_domains, key=listing_domains.get)
    best_score  = listing_domains[best_domain]
    if best_score >= 2 and best_domain != user_domain:
        return False
    return True


# ── Normalisation des scores ───────────────────────────────────────────────────

def _normalize_scores(scored: List[dict], target_max: float = 0.99) -> List[dict]:
    """
    Renormalise les _score pour que :
      - le meilleur score → target_max  (99%)
      - les autres → proportionnels au meilleur
      - score minimum affiché : 20% (pour éviter 0% sur des offres gardées)

    Formule : normalized = (score / max_score) * target_max
    Plafond à target_max, plancher à 0.20.
    """
    if not scored:
        return scored

    max_score = max(item["_score"] for item in scored)
    if max_score <= 0:
        return scored

    for item in scored:
        raw        = item["_score"]
        normalized = (raw / max_score) * target_max
        normalized = max(0.20, min(target_max, normalized))
        item["_score"] = round(normalized, 4)

    return scored


# ── Helpers ────────────────────────────────────────────────────────────────────

def _clean(text) -> str:
    if not text:
        return ""
    text = re.sub(r"<[^>]+>", " ", str(text))
    text = re.sub(r"&[a-zA-Z]+;", " ", text)
    return re.sub(r"\s+", " ", text).strip()


def _serialize(obj):
    if isinstance(obj, dict):
        return {k: _serialize(v) for k, v in obj.items()}
    if isinstance(obj, list):
        return [_serialize(i) for i in obj]
    if isinstance(obj, np.floating):
        return float(obj)
    if isinstance(obj, np.integer):
        return int(obj)
    if isinstance(obj, np.ndarray):
        return obj.tolist()
    try:
        from bson import ObjectId
        if isinstance(obj, ObjectId):
            return str(obj)
    except ImportError:
        pass
    return obj


@lru_cache(maxsize=1)
def _get_model() -> SentenceTransformer:
    return SentenceTransformer(MODEL_NAME)


# ── Extraction du profil utilisateur ──────────────────────────────────────────

def _extract_user_profile(user: dict) -> dict:
    cv      = user.get("cv") or {}
    profile = user.get("profile") or {}

    # Skills
    skills = cv.get("skills") or user.get("skills") or user.get("Skills") or []
    if isinstance(skills, str):
        skills = [s.strip() for s in re.split(r"[,;|]", skills) if s.strip()]
    skills = [_clean(str(s)) for s in skills if s]

    # Experiences (⚠️ "experiences" avec s)
    experiences = cv.get("experiences") or cv.get("experience") or []
    exp_parts = []
    if isinstance(experiences, list):
        for exp in experiences:
            if isinstance(exp, dict):
                text = " ".join(filter(None, [
                    _clean(exp.get("title", "")),
                    _clean(exp.get("company", "")),
                    _clean(exp.get("description", "")),
                ]))
                if text:
                    exp_parts.append(text)
            elif exp:
                exp_parts.append(_clean(str(exp)))
    if not exp_parts:
        for field in ["Experience", "experience", "Objective", "objective", "Resume", "resume"]:
            v = _clean(user.get(field, ""))
            if v:
                exp_parts.append(v)
                break
    experience_text = " | ".join(exp_parts)

    # Education
    education_list = cv.get("education") or []
    edu_parts = []
    if isinstance(education_list, list):
        for edu in education_list:
            if isinstance(edu, dict):
                text = " ".join(filter(None, [
                    _clean(edu.get("degree", "")),
                    _clean(edu.get("institution", "")),
                    str(edu.get("year", "")) if edu.get("year") else "",
                ]))
                if text:
                    edu_parts.append(text)
            elif edu:
                edu_parts.append(_clean(str(edu)))
    if not edu_parts:
        for field in ["Study", "study", "Education", "education"]:
            v = _clean(user.get(field, ""))
            if v:
                edu_parts.append(v)
                break
    education_text = " | ".join(edu_parts)

    # Languages
    languages = cv.get("languages") or []
    if isinstance(languages, str):
        languages = [l.strip() for l in languages.split(",") if l.strip()]
    languages = [_clean(str(l)) for l in languages if l]

    # Location
    loc = profile.get("location") or {}
    loc_parts = []
    for v in [
        loc.get("city"), loc.get("state"), loc.get("country"),
        user.get("Location_City"), user.get("Location_State"), user.get("Location_Country"),
    ]:
        c = _clean(v)
        if c and c not in loc_parts:
            loc_parts.append(c)
    location_text = " ".join(loc_parts)

    return {
        "skills":     skills,
        "experience": experience_text,
        "education":  education_text,
        "languages":  languages,
        "location":   location_text,
    }


def _build_cv_text(
    user: dict,
    apply_texts: list = None,
    query_texts: list = None,
) -> str:
    p = _extract_user_profile(user)

    skills_str = ("Compétences : " + ", ".join(p["skills"])) if p["skills"] else ""
    exp_str    = p["experience"]
    if p["languages"]:
        exp_str = " ".join(filter(None, [exp_str, "Langues : " + ", ".join(p["languages"])]))
    edu_str   = p["education"]
    loc_str   = ("Localisation : " + p["location"]) if p["location"] else ""
    apply_str = " ".join(apply_texts) if apply_texts else ""
    query_str = " ".join(query_texts) if query_texts else ""
    is_warm   = bool(apply_str or query_str)

    if is_warm:
        parts = (
            [skills_str] * 6 +
            [exp_str]    * 4 +
            [edu_str]    * 2 +
            [loc_str]    * 2 +
            [query_str]  * 3 +
            [apply_str]  * 3
        )
        logger.info("cv_text strategy=warm_start applies=%d queries=%d",
                    len(apply_texts or []), len(query_texts or []))
    else:
        parts = (
            [skills_str] * 10 +
            [exp_str]    * 5  +
            [edu_str]    * 3  +
            [loc_str]    * 2
        )
        logger.info("cv_text strategy=cold_start skills=%d exp=%s edu=%s",
                    len(p["skills"]), bool(p["experience"]), bool(p["education"]))

    result = " ".join(seg for seg in parts if seg)
    return result or user.get("email", "utilisateur_inconnu")


def _build_listing_text(listing: dict) -> str:
    job = listing.get("job", {}) or {}
    title = _clean(
        listing.get("title") or listing.get("Title") or
        listing.get("external_id") or ""
    )
    category   = _clean(job.get("category")       or listing.get("JobCategory")    or "")
    employment = _clean(job.get("employment_type") or listing.get("EmploymentType") or "")
    desc = _clean(job.get("description")  or listing.get("JobDescription") or "")
    req  = _clean(job.get("requirements") or listing.get("JobRequirements") or "")

    skills_list = job.get("skills") or []
    skills_text = " ".join(str(s) for s in skills_list if s) if isinstance(skills_list, list) else ""
    kw_legacy   = _clean(listing.get("id_Job_MotsCls", "") or "")
    kw = f"{skills_text} {kw_legacy}".strip()

    raw_kw = listing.get("keywords", "")
    raw_kw = _clean(raw_kw)[:300] if isinstance(raw_kw, str) else ""

    loc   = job.get("location", {}) or {}
    city  = _clean(loc.get("city")  or listing.get("Location_City")  or "")
    state = _clean(loc.get("state") or listing.get("Location_State") or "")
    study = _clean(job.get("study_level") or listing.get("Study")      or "")
    exp   = _clean(job.get("experience")  or listing.get("Experience") or "")

    return (
        f"{title} {title} {title} "
        f"{category} {employment} "
        f"Compétences : {kw} {kw} "
        f"{desc} {req} "
        f"{raw_kw} "
        f"{study} {exp} "
        f"{city} {state}"
    ).strip()


# ── Signaux comportementaux ────────────────────────────────────────────────────

async def _fetch_behavioral_signals(user_id: str, user: dict) -> tuple:
    apply_texts = []
    query_texts = []
    try:
        from app.core.database import get_db
        from bson import ObjectId

        db = get_db()
        if db is None:
            logger.warning("DB non initialisée — signaux comportementaux ignorés.")
            return apply_texts, query_texts

        sid = user.get("sid")
        conditions = [{"jobseeker_id": user_id}]
        if sid is not None:
            try:
                conditions.append({"jobseeker_id": int(sid)})
            except (TypeError, ValueError):
                pass
        try:
            conditions.append({"jobseeker_id": ObjectId(user_id)})
        except Exception:
            pass

        applications = await db["applications"].find(
            {"$or": conditions}, {"listing_id": 1}
        ).to_list(length=200)

        if applications:
            listing_ids = [a["listing_id"] for a in applications]
            applied = await db["listings"].find(
                {"$or": [
                    {"_id": {"$in": listing_ids}},
                    {"id": {"$in": listing_ids}},
                ]},
                {"Title": 1, "title": 1, "id_Job_MotsCls": 1,
                 "JobDescription": 1, "JobRequirements": 1, "job": 1}
            ).to_list(length=200)
            for al in applied:
                job  = al.get("job") or {}
                text = " ".join(filter(None, [
                    _clean(al.get("Title") or al.get("title", "")),
                    _clean(al.get("id_Job_MotsCls", "")),
                    _clean(al.get("JobDescription") or job.get("description", "")),
                    _clean(al.get("JobRequirements") or job.get("requirements", "")),
                ]))
                if text:
                    apply_texts.append(text)

        searches = await db["search_users"].find(
            {"user_id": user_id}, {"query": 1, "filters": 1}
        ).sort("searched_at", -1).to_list(length=20)

        for s in searches:
            parts = [_clean(s.get("query", ""))]
            for fk in ["category", "state", "employment_type", "experience", "study_level"]:
                fv = (s.get("filters") or {}).get(fk)
                if fv:
                    parts.append(_clean(str(fv)))
            text = " ".join(p for p in parts if p)
            if text:
                query_texts.append(text)

    except Exception as e:
        logger.warning("Behavioral signals error for user %s: %s", user_id, e)

    logger.info(
        "User %s — applies=%d, queries=%d → %s",
        user_id, len(apply_texts), len(query_texts),
        "warm_start" if (apply_texts or query_texts) else "cold_start",
    )
    return apply_texts, query_texts


# ── Service principal ──────────────────────────────────────────────────────────

class RecommendationService:

    def __init__(self):
        self.user_repo    = UserRepository()
        self.listing_repo = ListingRepository()

    async def recommend_jobs_for_user(self, user_id: str, limit: int = 10) -> List[dict]:
        user = await self.user_repo.find_by_id(user_id)
        if not user:
            return []

        results  = await self.listing_repo.search(listing_type="job_offer", limit=500)
        listings = results.get("items", [])
        if not listings:
            return []

        apply_texts, query_texts = await _fetch_behavioral_signals(user_id, user)

        # Filtre de domaine
        profile     = _extract_user_profile(user)
        user_domain = _detect_user_domain(profile["skills"], profile["experience"])
        logger.info("User %s — detected domain: %s", user_id, user_domain)

        if user_domain:
            compatible = [l for l in listings if _is_domain_compatible(user_domain, l)]
            logger.info("Domain filter: %d → %d listings", len(listings), len(compatible))
            listings = compatible if len(compatible) >= limit else listings

        embedding_scores = self._compute_embedding_scores(
            user, listings,
            apply_texts=apply_texts,
            query_texts=query_texts,
        )

        scored = []
        for i, listing in enumerate(listings):
            sem_score   = float(embedding_scores[i])
            boost       = 0.02 if listing.get("featured") else 0.0
            final_score = sem_score + boost
            if final_score > 0.10:
                scored.append({**listing, "_score": round(final_score, 4)})

        scored.sort(key=lambda x: x["_score"], reverse=True)
        top = scored[:limit]

        # ── Renormalisation : meilleur score → 99%, autres proportionnels ──
        top = _normalize_scores(top, target_max=0.99)

        return _serialize(top)

    async def recommend_candidates_for_listing(self, listing_id: str, limit: int = 10) -> List[dict]:
        listing = await self.listing_repo.find_by_id(listing_id)
        if not listing:
            return []

        job    = listing.get("job", {}) or {}
        skills = job.get("skills", [])
        state  = (job.get("location") or {}).get("state")

        candidates = []
        seen = set()
        for skill in skills[:3]:
            found = await self.user_repo.search_jobseekers(skill=skill, location=state, limit=50)
            for c in found:
                uid = c.get("_id")
                if uid not in seen:
                    seen.add(uid)
                    c.pop("password", None)
                    c.pop("verification_key", None)
                    candidates.append(c)

        if not candidates:
            return []

        listing_text = _build_listing_text(listing)
        model        = _get_model()
        listing_emb  = model.encode([listing_text], normalize_embeddings=True)
        cv_texts     = [_build_cv_text(c) for c in candidates]
        cv_embs      = model.encode(cv_texts, normalize_embeddings=True, batch_size=32)
        scores       = cosine_similarity(listing_emb, cv_embs)[0]

        for i, candidate in enumerate(candidates):
            candidate["_score"] = round(float(scores[i]), 4)

        candidates.sort(key=lambda x: x["_score"], reverse=True)

        # Renormalisation candidats aussi
        candidates = _normalize_scores(candidates[:limit], target_max=0.99)
        return _serialize(candidates)

    async def recommend_from_cv_text(self, cv_text: str, limit: int = 10) -> List[dict]:
        results  = await self.listing_repo.search(listing_type="job_offer", limit=500)
        listings = results.get("items", [])
        if not listings:
            return []

        scores = self._score_cv_text(cv_text, listings)
        scored = [
            {**listings[i], "_score": round(float(scores[i]), 4)}
            for i in np.argsort(scores)[::-1][:limit]
            if scores[i] > 0.10
        ]
        scored = _normalize_scores(scored, target_max=0.99)
        return _serialize(scored)

    def _compute_embedding_scores(
        self,
        user: dict,
        listings: List[dict],
        apply_texts: list = None,
        query_texts: list = None,
    ) -> np.ndarray:
        model         = _get_model()
        cv_text       = _build_cv_text(user, apply_texts or [], query_texts or [])
        cv_emb        = model.encode([cv_text], normalize_embeddings=True)
        listing_texts = [_build_listing_text(l) for l in listings]
        listing_embs  = model.encode(listing_texts, normalize_embeddings=True, batch_size=32)
        return cosine_similarity(cv_emb, listing_embs)[0]

    def _score_cv_text(self, cv_text: str, listings: List[dict]) -> np.ndarray:
        model         = _get_model()
        cv_emb        = model.encode([cv_text], normalize_embeddings=True)
        listing_texts = [_build_listing_text(l) for l in listings]
        listing_embs  = model.encode(listing_texts, normalize_embeddings=True, batch_size=32)
        return cosine_similarity(cv_emb, listing_embs)[0]