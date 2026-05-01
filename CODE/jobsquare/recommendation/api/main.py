"""
api/main.py  —  Jobsquare Recommendation API
Lancement : uvicorn api.main:app --reload --port 8001
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

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

MONGO_URI  = os.getenv("MONGO_URI",  "mongodb://mongo:27017")
DB_NAME    = os.getenv("DB_NAME",    "jobsquare")
MODEL_NAME = os.getenv("MODEL_NAME", "paraphrase-multilingual-MiniLM-L12-v2")

client = MongoClient(MONGO_URI)
db     = client[DB_NAME]

# Verrou pour éviter les refresh concurrents
_refresh_lock = threading.Lock()

# État global — initialisé dans lifespan
model: SentenceTransformer = None
listings_cache: list = []
listing_embeddings_cache: np.ndarray = np.empty((0, 384))


def clean(text):
    if not text: return ""
    text = re.sub(r"<[^>]+>", " ", str(text))
    text = re.sub(r"&[a-zA-Z]+;", " ", text)
    return re.sub(r"\s+", " ", text).strip()


def load_listings():
    listings = list(db["listings"].find(
        {"active": {"$in": [1, True]}},
        {
            "_id": 1,
            "Title": 1,
            "title": 1,
            "JobDescription": 1,
            "JobRequirements": 1,
            "job": 1,
            "id_Job_MotsCls": 1,
            "Location_City": 1,
            "Location_Country": 1
        }
    ))

    texts = []

    for l in listings:
        title = clean(l.get("Title") or l.get("title", ""))

        job = l.get("job", {}) or {}

        desc = clean(
            l.get("JobDescription") or
            job.get("description", "")
        )

        req = clean(
            l.get("JobRequirements") or
            job.get("requirements", "")
        )

        kw = clean(l.get("id_Job_MotsCls", ""))

        # ---- Nouveau format skills ----
        job_skills = job.get("skills", [])

        if isinstance(job_skills, list):
            job_skills_str = ", ".join(
                str(s) for s in job_skills if s
            )
        else:
            job_skills_str = clean(str(job_skills))

        # Fusion des deux sources
        all_skills = ", ".join(
            filter(None, [kw, job_skills_str])
        )

        # Pondération sémantique
        text_for_embedding = (
            f"{title} {title} "
            f"{desc} "
            f"{req} "
            f"Compétences : {all_skills}"
        )

        texts.append(text_for_embedding)

    if not texts:
        return [], np.empty((0, 384))

    embeddings = model.encode(
        texts,
        normalize_embeddings=True,
        show_progress_bar=False
    )

    logger.info(
        "Loaded %d listings into reco cache",
        len(listings)
    )

    return listings, embeddings

@asynccontextmanager
async def lifespan(app: FastAPI):
    """Chargement du modèle et des embeddings au démarrage."""
    global model, listings_cache, listing_embeddings_cache

    logger.info("⏳ Chargement du modèle SentenceTransformer : %s", MODEL_NAME)
    model = SentenceTransformer(MODEL_NAME)
    logger.info("✅ Modèle chargé.")

    logger.info("⏳ Encodage des listings...")
    listings_cache, listing_embeddings_cache = load_listings()
    logger.info("✅ Démarrage terminé — %d listings en cache.", len(listings_cache))

    yield  # L'application tourne ici

    client.close()
    logger.info("🔌 Connexion MongoDB fermée.")


app = FastAPI(title="Jobsquare Recommendation API", version="2.2.0", lifespan=lifespan)


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
    if model is None:
        raise HTTPException(503, detail="Modèle pas encore chargé, réessayez dans quelques secondes.")
    if not request.cv_text.strip():
        raise HTTPException(400, detail="cv_text est vide")
    if len(listings_cache) == 0:
        return RecommendResponse(recommendations=[])

    vec    = model.encode([request.cv_text], normalize_embeddings=True)
    scores = cosine_similarity(vec, listing_embeddings_cache)[0]
    top_n  = min(request.top_n, len(listings_cache))
    top_idx = np.argsort(scores)[::-1][:top_n]

    results = []
    for rank, idx in enumerate(top_idx, 1):
        l = listings_cache[idx]
        title   = l.get("Title") or l.get("title", "")
        city    = l.get("Location_City") or (l.get("job") or {}).get("location", {}).get("city")
        country = l.get("Location_Country") or (l.get("job") or {}).get("location", {}).get("country")
        results.append(RecommendationItem(
            rank=rank,
            listing_id=str(l["_id"]),
            title=title,
            score=round(float(scores[idx]), 4),
            city=city,
            country=country,
        ))
    return RecommendResponse(recommendations=results)


@app.get("/recommend/user/{user_id}", response_model=RecommendResponse)
def recommend_by_user(user_id: str, top_n: int = 5):
    from bson import ObjectId
    try:    user = db["users"].find_one({"_id": ObjectId(user_id)})
    except: user = db["users"].find_one({"_id": user_id})
    if not user:
        raise HTTPException(404, detail="Utilisateur introuvable")

    parts = []
    for f in ["Resume", "resume", "Objective", "bio", "Study", "education", "Experience", "experience"]:
        v = clean(user.get(f))
        if v:
            parts.append(v)
    for sf in ["Skills", "skills"]:
        sk = user.get(sf, [])
        if isinstance(sk, list) and sk:
            parts.append("Compétences : " + ", ".join(str(s) for s in sk if s))
            break
        elif isinstance(sk, str) and sk.strip():
            parts.append("Compétences : " + sk.strip())
            break

    cv_text = " ".join(parts) or user.get("email", "")
    return recommend(RecommendRequest(cv_text=cv_text, top_n=top_n))


@app.post("/cache/refresh")
def refresh_cache():
    """Recharge les embeddings depuis MongoDB.
    Appelé automatiquement par listing_repository après chaque create/update/delete."""
    global listings_cache, listing_embeddings_cache
    if model is None:
        raise HTTPException(503, detail="Modèle pas encore chargé.")
    with _refresh_lock:
        listings_cache, listing_embeddings_cache = load_listings()
    return {"refreshed": len(listings_cache)}