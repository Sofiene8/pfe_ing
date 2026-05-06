"""
recommendation/api/main.py  —  Jobsquare Recommendation API v3.2
Lancement : uvicorn api.main:app --reload --port 8001

Schema réel MongoDB (confirmé via user.py / users.py) :
  user.cv.skills          → List[str]
  user.cv.experiences     → List[{title, company, start_date, end_date, description}]
  user.cv.education       → List[{degree, institution, year}]
  user.cv.languages       → List[str]
  user.profile.full_name  → str
  user.profile.location   → {city, state, country}
  user.profile.phone      → str

Stratégie content-based :
  • Cold start (0 candidatures ET 0 recherches) :
      UserProfile = 0.50·skills + 0.25·exp + 0.15·edu + 0.10·loc

  • Warm start (candidatures OU recherches existent) :
      UserProfile = 0.30·skills + 0.20·exp + 0.10·edu + 0.10·loc
                  + 0.15·query + 0.15·apply
"""

from contextlib import asynccontextmanager
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from typing import List, Optional
import re, os, threading, logging
import numpy as np
from sentence_transformers import SentenceTransformer
from sklearn.metrics.pairwise import cosine_similarity
from pymongo import MongoClient
from bson import ObjectId

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# ── Config ─────────────────────────────────────────────────────────────────────
MONGO_URI  = os.getenv("MONGO_URI",  "mongodb://mongo:27017")
DB_NAME    = os.getenv("DB_NAME",    "jobsquaremadb")
MODEL_NAME = os.getenv("MODEL_NAME", "paraphrase-multilingual-MiniLM-L12-v2")
MIN_SCORE  = float(os.getenv("MIN_SCORE", "0.0"))

client = MongoClient(MONGO_URI)
db     = client[DB_NAME]

_refresh_lock = threading.Lock()

model: SentenceTransformer = None
listings_cache: list = []
listing_embeddings_cache: np.ndarray = np.empty((0, 384))


# ── Helpers ────────────────────────────────────────────────────────────────────

def clean(text) -> str:
    if not text:
        return ""
    text = re.sub(r"<[^>]+>", " ", str(text))
    text = re.sub(r"&[a-zA-Z]+;", " ", text)
    text = re.sub(r"[\r\n\t]+", " ", text)
    return re.sub(r"\s{2,}", " ", text).strip()


def _to_oid(uid: str):
    try:
        return ObjectId(uid)
    except Exception:
        return uid


def _first(*args) -> str:
    for v in args:
        c = clean(v)
        if c:
            return c
    return ""


# ── Listings ───────────────────────────────────────────────────────────────────

def load_listings():
    listings = list(db["listings"].find(
        {"active": {"$in": [1, True]}},
        {
            "_id": 1,
            "Title": 1, "title": 1,
            "JobDescription": 1,
            "JobRequirements": 1,
            "job": 1,
            "id_Job_MotsCls": 1,
            "JobCategory": 1,
            "EmploymentType": 1,
            "Location_City": 1,
            "Location_Country": 1,
            "Location_State": 1,
        }
    ))

    texts = []
    for l in listings:
        title = _first(l.get("Title"), l.get("title"))
        job   = l.get("job") or {}

        desc = _first(l.get("JobDescription"), job.get("description", ""))
        req  = _first(l.get("JobRequirements"), job.get("requirements", ""))
        kw   = clean(l.get("id_Job_MotsCls", ""))

        job_skills = job.get("skills", [])
        job_skills_str = (
            ", ".join(str(s) for s in job_skills if s)
            if isinstance(job_skills, list)
            else clean(str(job_skills))
        )
        all_skills = ", ".join(filter(None, [kw, job_skills_str]))

        location_str = " ".join(filter(None, [
            clean(l.get("Location_City", "")),
            clean(l.get("Location_State", "")),
            clean(l.get("Location_Country", "")),
        ]))

        text = " ".join(filter(None, [
            f"{title} {title}",   # titre ×2 pour le pondérer
            desc,
            req,
            f"Compétences : {all_skills}" if all_skills else "",
            f"Localisation : {location_str}" if location_str else "",
        ]))
        texts.append(text or "offre_vide")

    if not texts:
        return [], np.empty((0, 384))

    embeddings = model.encode(texts, normalize_embeddings=True, show_progress_bar=False)
    logger.info("Loaded %d listings into reco cache", len(listings))
    return listings, embeddings


# ── Extraction du profil — schema réel user.cv / user.profile ─────────────────

def _extract_cv_profile(user: dict) -> dict:
    """
    Lit exactement la structure persistée par users.py / user.py :
      user.cv.skills          → List[str]
      user.cv.experiences     → List[{title, company, start_date, end_date, description}]
      user.cv.education       → List[{degree, institution, year}]
      user.cv.languages       → List[str]
      user.profile.location   → {city, state, country}
      user.profile.full_name  → str

    Retourne un dict normalisé :
      skills      → List[str]
      experience  → str  (texte fusionné de toutes les expériences)
      education   → str  (texte fusionné de toutes les formations)
      languages   → List[str]
    """
    cv      = user.get("cv") or {}
    profile = user.get("profile") or {}

    # ── Skills ────────────────────────────────────────────────────────
    skills = cv.get("skills") or []
    if not isinstance(skills, list):
        skills = [clean(str(skills))] if skills else []
    skills = [clean(str(s)) for s in skills if s]

    # ── Experiences ───────────────────────────────────────────────────
    experiences = cv.get("experiences") or []
    exp_parts = []
    if isinstance(experiences, list):
        for exp in experiences:
            if isinstance(exp, dict):
                parts = filter(None, [
                    clean(exp.get("title", "")),
                    clean(exp.get("company", "")),
                    clean(exp.get("description", "")),
                ])
                text = " ".join(parts)
                if text:
                    exp_parts.append(text)
            elif exp:
                exp_parts.append(clean(str(exp)))
    experience_text = " | ".join(exp_parts)

    # ── Education ─────────────────────────────────────────────────────
    education_list = cv.get("education") or []
    edu_parts = []
    if isinstance(education_list, list):
        for edu in education_list:
            if isinstance(edu, dict):
                parts = filter(None, [
                    clean(edu.get("degree", "")),
                    clean(edu.get("institution", "")),
                    str(edu.get("year", "")) if edu.get("year") else "",
                ])
                text = " ".join(parts)
                if text:
                    edu_parts.append(text)
            elif edu:
                edu_parts.append(clean(str(edu)))
    education_text = " | ".join(edu_parts)

    # ── Languages ─────────────────────────────────────────────────────
    languages = cv.get("languages") or []
    if not isinstance(languages, list):
        languages = [clean(str(languages))] if languages else []
    languages = [clean(str(l)) for l in languages if l]

    return {
        "skills":     skills,
        "experience": experience_text,
        "education":  education_text,
        "languages":  languages,
    }


def _location_text(user: dict) -> str:
    """
    Lit user.profile.location.{city, state, country}
    puis fallback sur les champs plats Location_City / Location_Country.
    """
    profile  = user.get("profile") or {}
    location = profile.get("location") or {}

    parts = []
    for v in [
        location.get("city"),
        location.get("state"),
        location.get("country"),
        # fallbacks (anciens champs plats éventuels)
        user.get("Location_City"),
        user.get("Location_State"),
        user.get("Location_Country"),
    ]:
        c = clean(v)
        if c and c not in parts:
            parts.append(c)

    return ("Localisation : " + " ".join(parts)) if parts else ""


# ── Signaux comportementaux ────────────────────────────────────────────────────

def _fetch_behavioral_signals(user_id_raw: str, user: dict) -> tuple:
    """
    Retourne (apply_texts, query_texts).

    applications.jobseeker_id peut valoir :
      - l'ObjectId string de l'utilisateur  (nouveau backend)
      - user.sid (int)                       (ancienne migration)
    """
    apply_texts = []
    query_texts = []

    # ── Candidatures ──────────────────────────────────────────────────
    try:
        conditions = [{"jobseeker_id": user_id_raw}]
        sid = user.get("sid")
        if sid is not None:
            try:
                conditions.append({"jobseeker_id": int(sid)})
            except (TypeError, ValueError):
                pass
        try:
            conditions.append({"jobseeker_id": _to_oid(user_id_raw)})
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
                    _first(al.get("Title"), al.get("title")),
                    clean(al.get("id_Job_MotsCls", "")),
                    _first(al.get("JobDescription"), job.get("description", "")),
                    _first(al.get("JobRequirements"), job.get("requirements", "")),
                ]))
                if text:
                    apply_texts.append(text)
    except Exception as e:
        logger.warning("Erreur candidatures : %s", e)

    # ── Recherches ────────────────────────────────────────────────────
    try:
        searches = list(db["search_users"].find(
            {"user_id": user_id_raw},
            {"query": 1, "filters": 1}
        ).sort("searched_at", -1).limit(20))

        for s in searches:
            parts = [clean(s.get("query", ""))]
            for fk in ["category", "state", "employment_type", "experience", "study_level"]:
                fv = (s.get("filters") or {}).get(fk)
                if fv:
                    parts.append(clean(str(fv)))
            text = " ".join(p for p in parts if p)
            if text:
                query_texts.append(text)
    except Exception as e:
        logger.warning("Erreur recherches : %s", e)

    return apply_texts, query_texts


# ── Pondération et construction du texte profil ────────────────────────────────

def _build_profile_text(
    cv_profile: dict,
    location: str,
    apply_texts: list,
    query_texts: list,
) -> tuple:
    """
    Implémente les formules de pondération par répétition pondérée.

    Cold  : 0.50·skills + 0.25·exp + 0.15·edu + 0.10·loc  (×20 → 10+5+3+2)
    Warm  : 0.30·skills + 0.20·exp + 0.10·edu + 0.10·loc
          + 0.15·query  + 0.15·apply              (×20 → 6+4+2+2+3+3)
    """
    skills_str = (
        "Compétences : " + ", ".join(cv_profile["skills"])
    ) if cv_profile["skills"] else ""

    # On enrichit l'expérience avec les langues (signal faible mais utile)
    exp_str = cv_profile["experience"]
    if cv_profile["languages"]:
        lang_str = "Langues : " + ", ".join(cv_profile["languages"])
        exp_str  = " ".join(filter(None, [exp_str, lang_str]))

    edu_str   = cv_profile["education"]
    apply_str = " ".join(apply_texts)
    query_str = " ".join(query_texts)

    is_warm = bool(apply_texts or query_texts)

    if is_warm:
        parts = (
            [skills_str] * 6 +
            [exp_str]    * 4 +
            [edu_str]    * 2 +
            [location]   * 2 +
            [query_str]  * 3 +
            [apply_str]  * 3
        )
        strategy = "warm_start"
    else:
        parts = (
            [skills_str] * 10 +
            [exp_str]    * 5  +
            [edu_str]    * 3  +
            [location]   * 2
        )
        strategy = "cold_start"

    cv_text = " ".join(p for p in parts if p)
    return cv_text, strategy


# ── Lifespan ───────────────────────────────────────────────────────────────────

@asynccontextmanager
async def lifespan(app: FastAPI):
    global model, listings_cache, listing_embeddings_cache

    logger.info("⏳ Chargement du modèle : %s", MODEL_NAME)
    model = SentenceTransformer(MODEL_NAME)
    logger.info("✅ Modèle chargé.")

    listings_cache, listing_embeddings_cache = load_listings()
    logger.info("✅ Démarrage — %d listings en cache.", len(listings_cache))

    yield

    client.close()
    logger.info("🔌 MongoDB fermé.")


app = FastAPI(title="Jobsquare Recommendation API", version="3.2.0", lifespan=lifespan)


# ── Schémas ────────────────────────────────────────────────────────────────────

class RecommendationItem(BaseModel):
    rank: int
    listing_id: str
    title: str
    score: float
    city: Optional[str] = None
    country: Optional[str] = None


class RecommendRequest(BaseModel):
    cv_text: str
    top_n: int = 5


class RecommendResponse(BaseModel):
    recommendations: List[RecommendationItem]
    strategy: Optional[str] = None
    profile_debug: Optional[dict] = None


# ── Scoring ────────────────────────────────────────────────────────────────────

def _score_and_rank(
    cv_text: str,
    top_n: int,
    strategy: str,
    debug_profile: Optional[dict] = None,
) -> RecommendResponse:
    if not cv_text.strip():
        raise HTTPException(400, detail="Texte de profil vide.")
    if len(listings_cache) == 0:
        return RecommendResponse(recommendations=[], strategy=strategy)

    vec    = model.encode([cv_text], normalize_embeddings=True)
    scores = cosine_similarity(vec, listing_embeddings_cache)[0]

    eligible = np.where(scores >= MIN_SCORE)[0]
    if len(eligible) == 0:
        return RecommendResponse(recommendations=[], strategy=strategy)

    sorted_idx = eligible[np.argsort(scores[eligible])[::-1]]
    top_idx    = sorted_idx[:min(top_n, len(sorted_idx))]

    results = []
    for rank, idx in enumerate(top_idx, 1):
        l       = listings_cache[idx]
        title   = _first(l.get("Title"), l.get("title"))
        job     = l.get("job") or {}
        city    = _first(
            l.get("Location_City"),
            (job.get("location") or {}).get("city", "")
        ) or None
        country = _first(
            l.get("Location_Country"),
            (job.get("location") or {}).get("country", "")
        ) or None
        results.append(RecommendationItem(
            rank=rank,
            listing_id=str(l["_id"]),
            title=title,
            score=round(float(scores[idx]), 4),
            city=city,
            country=country,
        ))

    return RecommendResponse(
        recommendations=results,
        strategy=strategy,
        profile_debug=debug_profile,
    )


# ── Routes ─────────────────────────────────────────────────────────────────────

@app.get("/health")
def health():
    return {
        "status": "ok",
        "model_loaded": model is not None,
        "listings_cached": len(listings_cache),
    }


@app.post("/recommend", response_model=RecommendResponse)
def recommend(request: RecommendRequest):
    """Recommandation directe depuis un texte CV brut (mode test / legacy)."""
    if model is None:
        raise HTTPException(503, detail="Modèle pas encore chargé.")
    return _score_and_rank(request.cv_text, request.top_n, strategy="cv_text")


@app.get("/recommend/user/{user_id}", response_model=RecommendResponse)
def recommend_by_user(user_id: str, top_n: int = 5, debug: bool = False):
    """
    Recommandation personnalisée content-based pour un candidat.

    Paramètres :
      top_n  — nombre de résultats (défaut 5)
      debug  — true → retourne profile_debug pour diagnostiquer le profil construit

    Stratégies retournées dans le champ 'strategy' :
      cold_start    — profil seul (pas de candidatures ni de recherches)
      warm_start    — profil + candidatures + recherches
      fallback_email — profil cv entièrement vide
    """
    if model is None:
        raise HTTPException(503, detail="Modèle pas encore chargé.")

    # ── 1. Trouver le user ────────────────────────────────────────────
    user = db["users"].find_one({"_id": _to_oid(user_id)})
    if not user and user_id.isdigit():
        user = db["users"].find_one({"sid": int(user_id)})
    if not user:
        raise HTTPException(404, detail="Utilisateur introuvable.")

    # ── 2. Extraire le profil CV (user.cv + user.profile) ─────────────
    cv_profile = _extract_cv_profile(user)
    location   = _location_text(user)

    logger.info(
        "User %s — skills=%d, exp=%s, edu=%s, languages=%d, loc=%s",
        user_id,
        len(cv_profile["skills"]),
        bool(cv_profile["experience"]),
        bool(cv_profile["education"]),
        len(cv_profile["languages"]),
        bool(location),
    )

    # ── 3. Signaux comportementaux ────────────────────────────────────
    apply_texts, query_texts = _fetch_behavioral_signals(user_id, user)

    logger.info(
        "User %s — applies=%d, queries=%d",
        user_id, len(apply_texts), len(query_texts)
    )

    # ── 4. Construire le texte profil pondéré ─────────────────────────
    cv_text, strategy = _build_profile_text(
        cv_profile, location, apply_texts, query_texts
    )

    # Fallback si le profil CV est entièrement vide
    if not cv_text.strip():
        cv_text  = user.get("email", "")
        strategy = "fallback_email"
        if not cv_text:
            raise HTTPException(
                422,
                detail=(
                    "Profil insuffisant pour générer des recommandations. "
                    "Veuillez renseigner vos compétences et expériences dans votre profil."
                )
            )

    # ── 5. Debug optionnel ────────────────────────────────────────────
    debug_info = None
    if debug:
        debug_info = {
            "strategy":          strategy,
            "skills":            cv_profile["skills"],
            "languages":         cv_profile["languages"],
            "experience_preview": cv_profile["experience"][:200] if cv_profile["experience"] else "",
            "education_preview":  cv_profile["education"][:200]  if cv_profile["education"]  else "",
            "location":           location,
            "apply_count":        len(apply_texts),
            "query_count":        len(query_texts),
            "cv_text_length":     len(cv_text),
            "cv_text_preview":    cv_text[:400],
        }

    return _score_and_rank(cv_text, top_n, strategy=strategy, debug_profile=debug_info)


@app.post("/cache/refresh")
def refresh_cache():
    """Recharge les embeddings depuis MongoDB (à appeler après create/update/delete listing)."""
    global listings_cache, listing_embeddings_cache
    if model is None:
        raise HTTPException(503, detail="Modèle pas encore chargé.")
    with _refresh_lock:
        listings_cache, listing_embeddings_cache = load_listings()
    return {"refreshed": len(listings_cache)}