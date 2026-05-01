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
    """Convertit récursivement numpy.float32, ObjectId → types JSON natifs."""
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


def _build_cv_text(user: dict) -> str:
    """
    Construit un texte représentatif du profil utilisateur.
    Supporte les deux formats : nouveau (cv.skills, profile) et legacy.
    """
    parts = []

    # ── Compétences (poids x3) ───────────────────────────────────────────────
    skills = user.get("skills") or user.get("Skills") or []
    if isinstance(skills, list) and skills:
        skills_text = " ".join(str(s) for s in skills if s)
        parts.append(f"Compétences : {skills_text} {skills_text} {skills_text}")
    elif isinstance(skills, str) and skills.strip():
        parts.append(f"Compétences : {skills.strip()} {skills.strip()} {skills.strip()}")
    else:
        cv = user.get("cv", {}) or {}
        cv_skills = cv.get("skills", [])
        if cv_skills:
            skills_text = " ".join(str(s) for s in cv_skills if s)
            parts.append(f"Compétences : {skills_text} {skills_text} {skills_text}")

    # ── Formation ─────────────────────────────────────────────────────────────
    cv = user.get("cv", {}) or {}
    for edu in cv.get("education", []):
        deg  = _clean(edu.get("degree", ""))
        inst = _clean(edu.get("institution", ""))
        if deg or inst:
            parts.append(f"{deg} {inst}")

    for field in ["Study", "study", "education"]:
        v = _clean(user.get(field, ""))
        if v:
            parts.append(v)
            break

    # ── Expérience ────────────────────────────────────────────────────────────
    for exp in cv.get("experience", []):
        title   = _clean(exp.get("title", ""))
        company = _clean(exp.get("company", ""))
        desc    = _clean(exp.get("description", ""))
        if title or company:
            parts.append(f"{title} {company} {desc}")

    for field in ["Experience", "experience", "Objective", "objective", "Resume", "resume"]:
        v = _clean(user.get(field, ""))
        if v:
            parts.append(v)
            break

    # ── Localisation ──────────────────────────────────────────────────────────
    profile = user.get("profile", {}) or {}
    loc     = profile.get("location", {}) or {}
    city    = _clean(loc.get("city", "") or loc.get("state", ""))
    if city:
        parts.append(city)

    return " ".join(parts) or user.get("email", "utilisateur_inconnu")


def _build_listing_text(listing: dict) -> str:
    """
    Construit un texte représentatif d'une offre.
    ✅ Supporte les deux formats :
      - Nouveau : title, job.description, job.requirements, job.skills (array)
      - Legacy  : Title, JobDescription, JobRequirements, id_Job_MotsCls (string)
    """
    job = listing.get("job", {}) or {}

    # ── Titre (poids x3) ──────────────────────────────────────────────────────
    title = _clean(
        listing.get("title") or
        listing.get("Title") or
        listing.get("external_id") or ""
    )

    # ── Catégorie / type de contrat ───────────────────────────────────────────
    category   = _clean(job.get("category") or listing.get("JobCategory") or "")
    employment = _clean(job.get("employment_type") or listing.get("EmploymentType") or "")

    # ── Description & prérequis ───────────────────────────────────────────────
    desc = _clean(job.get("description") or listing.get("JobDescription") or "")
    req  = _clean(job.get("requirements") or listing.get("JobRequirements") or "")

    # ── Compétences (poids x2) ────────────────────────────────────────────────
    # Nouveau format : job.skills = ["React", "MongoDB", ...]
    skills_list = job.get("skills") or []
    skills_text = " ".join(str(s) for s in skills_list if s) if isinstance(skills_list, list) else ""

    # Legacy : id_Job_MotsCls = "react, node.js, python"
    kw_legacy = _clean(listing.get("id_Job_MotsCls", "") or "")

    kw = f"{skills_text} {kw_legacy}".strip()

    # ── Mots-clés bruts legacy (limités pour ne pas noyer) ───────────────────
    raw_kw = listing.get("keywords", "")
    raw_kw = _clean(raw_kw)[:300] if isinstance(raw_kw, str) else ""

    # ── Localisation ──────────────────────────────────────────────────────────
    loc   = job.get("location", {}) or {}
    city  = _clean(loc.get("city") or listing.get("Resume") or listing.get("Location_City") or "")
    state = _clean(loc.get("state") or listing.get("Location_State") or "")

    # ── Niveau / expérience ───────────────────────────────────────────────────
    study = _clean(job.get("study_level") or listing.get("Study") or "")
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


class RecommendationService:

    def __init__(self):
        self.user_repo    = UserRepository()
        self.listing_repo = ListingRepository()

    async def recommend_jobs_for_user(self, user_id: str, limit: int = 10) -> List[dict]:
        user = await self.user_repo.find_by_id(user_id)
        if not user:
            return []

        # ✅ Limite 500 pour inclure toutes les offres (legacy + nouvelles)
        results  = await self.listing_repo.search(listing_type="job_offer", limit=500)
        listings = results.get("items", [])
        if not listings:
            return []

        embedding_scores = self._compute_embedding_scores(user, listings)

        scored = []
        for i, listing in enumerate(listings):
            boost = self._business_boost(listing, user)
            # ✅ Embedding 85% — boost business 15% seulement
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

    def _compute_embedding_scores(self, user: dict, listings: List[dict]) -> np.ndarray:
        model         = _get_model()
        cv_text       = _build_cv_text(user)
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

        # ── Localisation ──────────────────────────────────────────────────────
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

        # ── Featured ──────────────────────────────────────────────────────────
        # ✅ Réduit de 0.35 → 0.1
        if listing.get("featured"):
            score += 0.1

        # ── Popularité ────────────────────────────────────────────────────────
        # ✅ Réduit — max 0.1
        views = listing.get("views", 0) or 0
        score += min(views / 1000, 0.1)

        # ── Récence ───────────────────────────────────────────────────────────
        # ✅ NOUVEAU — nouvelles offres remontent même sans featured ni vues
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