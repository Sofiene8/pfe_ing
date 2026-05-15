"""
api/main.py  —  Jobsquare Recommendation API
Lancement : uvicorn api.main:app --reload --port 8000
"""

from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from typing import List, Optional
import re, numpy as np
from sentence_transformers import SentenceTransformer
from sklearn.metrics.pairwise import cosine_similarity
from pymongo import MongoClient
from bson import ObjectId

MONGO_URI  = "mongodb://localhost:27017"
DB_NAME    = "jobsquare"
MODEL_NAME = "paraphrase-multilingual-MiniLM-L12-v2"

# Score minimum pour qu'une recommandation soit retournée
MIN_SCORE = 0.05

app    = FastAPI(title="Jobsquare Recommendation API", version="2.0.0")
model  = SentenceTransformer(MODEL_NAME)
client = MongoClient(MONGO_URI)
db     = client[DB_NAME]


# ── Nettoyage texte ────────────────────────────────────────────────────────

def clean(text) -> str:
    if not text:
        return ""
    text = str(text)
    text = re.sub(r"<[^>]+>", " ", text)          # balises HTML
    text = re.sub(r"&[a-zA-Z]+;", " ", text)       # entités HTML
    text = re.sub(r"[\r\n\t]+", " ", text)
    text = re.sub(r"\s{2,}", " ", text)
    return text.strip()


def is_valid_text(val) -> bool:
    """Retourne True si val est une vraie chaîne de texte (pas un nombre, pas vide)."""
    if not val:
        return False
    s = str(val).strip()
    if not s:
        return False
    # Rejeter les valeurs purement numériques (ex: Title="2008", Location_City=0)
    try:
        float(s)
        return False
    except ValueError:
        return True


# ── Construction du texte d'une offre ─────────────────────────────────────

def build_listing_text(l: dict) -> str:
    """
    Construit le texte embedding d'une offre.
    Gère les deux formats DB :
      - Ancien : Title, JobDescription, JobRequirements, JobCategory, id_Job_MotsCls
      - Nouveau : title, job.category, employer_snapshot.company_name
    """
    parts = []

    # ── Titre (répété 2× pour plus de poids) ──────────────────────────────
    # Nouveau format : l["title"] | Ancien format : l["Title"]
    title = clean(l.get("title") or l.get("Title", ""))
    if is_valid_text(title):
        parts.append(f"{title} {title}")

    # ── Catégorie (très discriminante) ────────────────────────────────────
    job_sub  = l.get("job") or {}
    category = clean(job_sub.get("category") or l.get("JobCategory", ""))
    if is_valid_text(category):
        parts.append(category)

    # ── Description et exigences ──────────────────────────────────────────
    desc = clean(l.get("JobDescription", ""))
    if desc:
        parts.append(desc)

    req = clean(l.get("JobRequirements", ""))
    if req:
        parts.append(req)

    # ── Mots-clés / compétences ───────────────────────────────────────────
    keywords = clean(l.get("id_Job_MotsCls", ""))
    if keywords:
        parts.append("Compétences : " + keywords)

    # ── Type d'emploi ─────────────────────────────────────────────────────
    emp_type = clean(l.get("EmploymentType", ""))
    if is_valid_text(emp_type):
        parts.append(emp_type)

    # ── Localisation ──────────────────────────────────────────────────────
    city    = clean(l.get("Location_City", ""))
    country = clean(l.get("Location_Country", ""))
    if is_valid_text(city) or is_valid_text(country):
        loc = " ".join(p for p in [city, country] if is_valid_text(p))
        parts.append(loc)

    return " ".join(parts) if parts else "offre_inconnue"


# ── Construction du texte CV d'un utilisateur ──────────────────────────────

def build_user_text(user: dict) -> str:
    """
    Construit le texte embedding d'un utilisateur.
    Essaie les variantes majuscule/minuscule des champs CV.
    """
    parts = []

    # Champs textuels CV
    for field_variants in [
        ["Resume", "resume"],
        ["Objective", "objective", "bio"],
        ["Study", "study", "education"],
        ["Experience", "experience"],
    ]:
        for field in field_variants:
            val = clean(user.get(field))
            if val:
                parts.append(val)
                break

    # Compétences (liste ou chaîne)
    for skills_field in ["Skills", "skills"]:
        skills = user.get(skills_field)
        if isinstance(skills, list):
            skills = [str(s) for s in skills if s and str(s).strip()]
            if skills:
                parts.append("Compétences : " + ", ".join(skills))
                break
        elif isinstance(skills, str) and skills.strip():
            parts.append("Compétences : " + skills.strip())
            break

    # Fallback : nom complet ou email
    if not parts:
        return clean(user.get("FullName") or user.get("email") or "utilisateur_inconnu")

    return " ".join(parts)


# ── Chargement et cache des offres ─────────────────────────────────────────

def load_listings():
    """
    Charge toutes les offres ACTIVES depuis MongoDB.
    Gère les deux formats : active=1 (ancien int) et active=True (nouveau bool).
    Filtre les offres dont le titre est invalide (données corrompues).
    """
    raw = list(db["listings"].find(
        # ← FIX 1 : matcher active=1 ET active=True
        {"active": {"$in": [1, True]}},
        {
            "_id": 1,
            # Ancien format
            "Title": 1, "JobDescription": 1, "JobRequirements": 1,
            "JobCategory": 1, "EmploymentType": 1,
            "id_Job_MotsCls": 1, "Location_City": 1, "Location_Country": 1,
            # Nouveau format
            "title": 1, "job": 1, "employer_snapshot": 1,
        }
    ))

    listings, texts = [], []
    for l in raw:
        # ← FIX 2 : rejeter les offres avec titre invalide (ex: Title="2008")
        title = l.get("title") or l.get("Title", "")
        if not is_valid_text(str(title)):
            continue

        text = build_listing_text(l)
        listings.append(l)
        texts.append(text)

    embeddings = model.encode(texts, normalize_embeddings=True, batch_size=32) if texts else np.array([])
    return listings, embeddings


listings_cache, listing_embeddings_cache = load_listings()


# ── Modèles Pydantic ───────────────────────────────────────────────────────

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
    exclude_listing_ids: Optional[List[str]] = None  # offres à exclure

class RecommendResponse(BaseModel):
    recommendations: List[RecommendationItem]


# ── Endpoints ──────────────────────────────────────────────────────────────

@app.get("/health")
def health():
    return {
        "status": "ok",
        "listings_cached": len(listings_cache),
        "model": MODEL_NAME,
    }


@app.post("/recommend", response_model=RecommendResponse)
def recommend(request: RecommendRequest):
    if not request.cv_text.strip():
        raise HTTPException(400, detail="cv_text est vide")
    if not listings_cache:
        raise HTTPException(503, detail="Aucune offre en cache")

    vec    = model.encode([request.cv_text], normalize_embeddings=True)
    scores = cosine_similarity(vec, listing_embeddings_cache)[0]

    # ← FIX 4 : exclure les offres déjà postulées
    exclude_ids = set(request.exclude_listing_ids or [])

    results = []
    # Trier par score décroissant et itérer jusqu'à top_n résultats valides
    for idx in np.argsort(scores)[::-1]:
        if len(results) >= request.top_n:
            break

        l     = listings_cache[idx]
        score = float(scores[idx])

        # Ignorer les scores trop faibles
        if score < MIN_SCORE:
            break

        listing_id = str(l["_id"])
        if listing_id in exclude_ids:
            continue

        title = l.get("title") or l.get("Title") or "—"
        city    = l.get("Location_City")
        country = l.get("Location_Country")

        results.append(RecommendationItem(
            rank=len(results) + 1,
            listing_id=listing_id,
            title=title,
            score=round(score, 4),
            city=city if is_valid_text(str(city or "")) else None,
            country=country if is_valid_text(str(country or "")) else None,
        ))

    return RecommendResponse(recommendations=results)


@app.get("/recommend/user/{user_id}", response_model=RecommendResponse)
def recommend_by_user(user_id: str, top_n: int = 5):
    # ← FIX 3 : chercher par ObjectId ET par sid (entier)
    user = None
    try:
        user = db["users"].find_one({"_id": ObjectId(user_id)})
    except Exception:
        pass
    if not user:
        try:
            user = db["users"].find_one({"sid": int(user_id)})
        except (ValueError, TypeError):
            pass
    if not user:
        user = db["users"].find_one({"_id": user_id})
    if not user:
        raise HTTPException(404, detail="Utilisateur introuvable")

    # ← FIX 4 : récupérer les offres déjà postulées pour les exclure
    jobseeker_id = user.get("sid") or str(user["_id"])
    already_applied = db["applications"].distinct(
        "listing_id",
        {"$or": [
            {"jobseeker_id": jobseeker_id},
            {"jobseeker_id": str(user["_id"])},
        ]}
    )
    exclude_ids = [str(lid) for lid in already_applied]

    # Construire le texte CV
    cv_text = build_user_text(user)

    return recommend(RecommendRequest(
        cv_text=cv_text,
        top_n=top_n,
        exclude_listing_ids=exclude_ids,
    ))


@app.post("/cache/refresh")
def refresh_cache():
    global listings_cache, listing_embeddings_cache
    listings_cache, listing_embeddings_cache = load_listings()
    return {
        "refreshed": len(listings_cache),
        "message": f"{len(listings_cache)} offres chargées dans le cache",
    }