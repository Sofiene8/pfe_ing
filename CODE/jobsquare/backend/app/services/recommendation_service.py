"""app/services/recommendation_service.py"""
import re
import numpy as np
from typing import List
from functools import lru_cache
from datetime import datetime
from sentence_transformers import SentenceTransformer
from sklearn.metrics.pairwise import cosine_similarity

from app.dao.repositories.user_repository import UserRepository
from app.dao.repositories.listing_repository import ListingRepository

MODEL_NAME = "paraphrase-multilingual-MiniLM-L12-v2"


@lru_cache(maxsize=1)
def _get_model() -> SentenceTransformer:
    return SentenceTransformer(MODEL_NAME)


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


# ── Extraction du profil utilisateur ──────────────────────────────────────────

def _extract_user_profile(user: dict) -> dict:
    """
    Lit la structure réelle MongoDB persistée par users.py / user.py :
      user.cv.skills          → List[str]
      user.cv.experiences     → List[{title, company, start_date, end_date, description}]
                                ⚠️  "experiences" avec s, pas "experience"
      user.cv.education       → List[{degree, institution, year}]
      user.cv.languages       → List[str]
      user.profile.location   → {city, state, country}

    Retourne un dict :
      skills      → List[str]
      experience  → str
      education   → str
      languages   → List[str]
      location    → str
    """
    cv      = user.get("cv") or {}
    profile = user.get("profile") or {}

    # ── Skills ────────────────────────────────────────────────────────
    # user.cv.skills (nouveau) → fallback user.skills / user.Skills (legacy)
    skills = cv.get("skills") or user.get("skills") or user.get("Skills") or []
    if isinstance(skills, str):
        skills = [s.strip() for s in re.split(r"[,;|]", skills) if s.strip()]
    skills = [_clean(str(s)) for s in skills if s]

    # ── Experiences ───────────────────────────────────────────────────
    # ⚠️  Le champ s'appelle "experiences" (avec s) dans CVData
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
    # Fallback champs legacy
    if not exp_parts:
        for field in ["Experience", "experience", "Objective", "objective", "Resume", "resume"]:
            v = _clean(user.get(field, ""))
            if v:
                exp_parts.append(v)
                break
    experience_text = " | ".join(exp_parts)

    # ── Education ─────────────────────────────────────────────────────
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
    # Fallback champs legacy
    if not edu_parts:
        for field in ["Study", "study", "Education", "education"]:
            v = _clean(user.get(field, ""))
            if v:
                edu_parts.append(v)
                break
    education_text = " | ".join(edu_parts)

    # ── Languages ─────────────────────────────────────────────────────
    languages = cv.get("languages") or []
    if isinstance(languages, str):
        languages = [l.strip() for l in languages.split(",") if l.strip()]
    languages = [_clean(str(l)) for l in languages if l]

    # ── Location ──────────────────────────────────────────────────────
    loc = profile.get("location") or {}
    loc_parts = []
    for v in [loc.get("city"), loc.get("state"), loc.get("country"),
              user.get("Location_City"), user.get("Location_State"), user.get("Location_Country")]:
        c = _clean(v)
        if c and c not in loc_parts:
            loc_parts.append(c)
    location_text = " ".join(loc_parts)

    return {
        "skills":    skills,
        "experience": experience_text,
        "education":  education_text,
        "languages":  languages,
        "location":   location_text,
    }


def _build_cv_text(user: dict, apply_texts: list = None, query_texts: list = None) -> str:
    """
    Construit le texte de profil pondéré selon la stratégie :

    Cold start (pas de candidatures ni de recherches) :
      UserProfile = 0.50·skills + 0.25·exp + 0.15·edu + 0.10·loc
      → répétition ×10 skills, ×5 exp, ×3 edu, ×2 loc

    Warm start (candidatures OU recherches existent) :
      UserProfile = 0.30·skills + 0.20·exp + 0.10·edu + 0.10·loc
                  + 0.15·query + 0.15·apply
      → répétition ×6 skills, ×4 exp, ×2 edu, ×2 loc, ×3 query, ×3 apply
    """
    p = _extract_user_profile(user)

    skills_str = ("Compétences : " + ", ".join(p["skills"])) if p["skills"] else ""

    # Langues intégrées à l'expérience comme signal complémentaire
    exp_str = p["experience"]
    if p["languages"]:
        lang_str = "Langues : " + ", ".join(p["languages"])
        exp_str  = " ".join(filter(None, [exp_str, lang_str]))

    edu_str = p["education"]
    loc_str = ("Localisation : " + p["location"]) if p["location"] else ""

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
    else:
        parts = (
            [skills_str] * 10 +
            [exp_str]    * 5  +
            [edu_str]    * 3  +
            [loc_str]    * 2
        )

    result = " ".join(p for p in parts if p)
    return result or user.get("email", "utilisateur_inconnu")


def _build_listing_text(listing: dict) -> str:
    job = listing.get("job", {}) or {}

    title = _clean(
        listing.get("title") or listing.get("Title") or
        listing.get("external_id") or ""
    )
    category   = _clean(job.get("category") or listing.get("JobCategory") or "")
    employment = _clean(job.get("employment_type") or listing.get("EmploymentType") or "")
    desc = _clean(job.get("description") or listing.get("JobDescription") or "")
    req  = _clean(job.get("requirements") or listing.get("JobRequirements") or "")

    skills_list = job.get("skills") or []
    skills_text = " ".join(str(s) for s in skills_list if s) if isinstance(skills_list, list) else ""
    kw_legacy   = _clean(listing.get("id_Job_MotsCls", "") or "")
    kw = f"{skills_text} {kw_legacy}".strip()

    raw_kw = listing.get("keywords", "")
    raw_kw = _clean(raw_kw)[:300] if isinstance(raw_kw, str) else ""

    loc   = job.get("location", {}) or {}
    city  = _clean(loc.get("city") or listing.get("Location_City") or "")
    state = _clean(loc.get("state") or listing.get("Location_State") or "")

    study = _clean(job.get("study_level") or listing.get("Study") or "")
    exp   = _clean(job.get("experience") or listing.get("Experience") or "")

    return (
        f"{title} {title} {title} "
        f"{category} {employment} "
        f"Compétences : {kw} {kw} "
        f"{desc} {req} "
        f"{raw_kw} "
        f"{study} {exp} "
        f"{city} {state}"
    ).strip()


# ── Service ────────────────────────────────────────────────────────────────────

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

        # Récupérer les signaux comportementaux
        apply_texts, query_texts = await self._fetch_behavioral_signals(user_id, user)

        embedding_scores = self._compute_embedding_scores(
            user, listings, apply_texts=apply_texts, query_texts=query_texts
        )

        scored = []
        for i, listing in enumerate(listings):
            boost = self._business_boost(listing, user)
            score = 0.85 * float(embedding_scores[i]) + 0.15 * boost
            if score > 0.05:
                scored.append({**listing, "_score": round(score, 4)})

        scored.sort(key=lambda x: x["_score"], reverse=True)
        return _serialize(scored[:limit])

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
        return _serialize(candidates[:limit])

    async def recommend_from_cv_text(self, cv_text: str, limit: int = 10) -> List[dict]:
        results  = await self.listing_repo.search(listing_type="job_offer", limit=500)
        listings = results.get("items", [])
        if not listings:
            return []

        scores = self._score_cv_text(cv_text, listings)
        scored = [
            {**listings[i], "_score": round(float(scores[i]), 4)}
            for i in np.argsort(scores)[::-1][:limit]
            if scores[i] > 0.05
        ]
        return _serialize(scored)

    # ── Signaux comportementaux ────────────────────────────────────────────────

    async def _fetch_behavioral_signals(self, user_id: str, user: dict) -> tuple:
        """
        Retourne (apply_texts, query_texts) depuis les collections
        applications et search_users.
        """
        apply_texts = []
        query_texts = []

        try:
            from app.core.database import get_db
            db = get_db()

            # ── Candidatures ──────────────────────────────────────────
            from bson import ObjectId
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

            applications = list(db["applications"].find(
                {"$or": conditions}, {"listing_id": 1}
            ))

            if applications:
                listing_ids = [a["listing_id"] for a in applications]
                applied = list(db["listings"].find(
                    {"$or": [
                        {"_id": {"$in": listing_ids}},
                        {"id": {"$in": listing_ids}},
                    ]},
                    {"Title": 1, "title": 1, "id_Job_MotsCls": 1,
                     "JobDescription": 1, "JobRequirements": 1, "job": 1}
                ))
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

            # ── Recherches ────────────────────────────────────────────
            searches = list(db["search_users"].find(
                {"user_id": user_id},
                {"query": 1, "filters": 1}
            ).sort("searched_at", -1).limit(20))

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
            import logging
            logging.getLogger(__name__).warning("Behavioral signals error: %s", e)

        return apply_texts, query_texts

    # ── Scoring ────────────────────────────────────────────────────────────────

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

    def _business_boost(self, listing: dict, user: dict) -> float:
        score = 0.0

        # ── Localisation ──────────────────────────────────────────────
        profile       = user.get("profile", {}) or {}
        user_loc      = profile.get("location", {}) or {}
        user_state    = (user_loc.get("state") or "").lower()
        user_city     = (user_loc.get("city") or "").lower()

        job           = listing.get("job", {}) or {}
        listing_loc   = job.get("location", {}) or {}
        listing_state = (listing_loc.get("state") or listing.get("Location_State") or "").lower()
        listing_city  = (listing_loc.get("city") or listing.get("Location_City") or "").lower()

        if user_state and user_state == listing_state:
            score += 0.3
        elif user_city and user_city == listing_city:
            score += 0.2

        # ── Featured ──────────────────────────────────────────────────
        if listing.get("featured"):
            score += 0.1

        # ── Popularité ────────────────────────────────────────────────
        views = listing.get("views", 0) or 0
        score += min(views / 1000, 0.1)

        # ── Récence ───────────────────────────────────────────────────
        date_val = (
            listing.get("created_at") or
            listing.get("date_add") or
            listing.get("activation_date")
        )
        if date_val:
            try:
                if isinstance(date_val, str):
                    date_val = datetime.strptime(date_val[:19], "%Y-%m-%d %H:%M:%S")
                days_old = (datetime.utcnow() - date_val).days
                if days_old <= 1:
                    score += 0.5
                elif days_old <= 3:
                    score += 0.4
                elif days_old <= 7:
                    score += 0.25
                elif days_old <= 30:
                    score += 0.1
            except Exception:
                pass

        return score