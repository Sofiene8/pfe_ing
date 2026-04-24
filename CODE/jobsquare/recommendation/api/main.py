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

MONGO_URI  = "mongodb://localhost:27017"
DB_NAME    = "jobsquare"
MODEL_NAME = "paraphrase-multilingual-MiniLM-L12-v2"

app   = FastAPI(title="Jobsquare Recommendation API", version="2.0.0")
model = SentenceTransformer(MODEL_NAME)
client = MongoClient(MONGO_URI)
db     = client[DB_NAME]


def clean(text):
    if not text: return ""
    text = re.sub(r"<[^>]+>", " ", str(text))
    text = re.sub(r"&[a-zA-Z]+;", " ", text)
    return re.sub(r"\s+", " ", text).strip()


def load_listings():
    listings = list(db["listings"].find(
        {"active": 1},
        {"_id":1,"Title":1,"JobDescription":1,"JobRequirements":1,
         "id_Job_MotsCls":1,"Location_City":1,"Location_Country":1}
    ))
    texts = []
    for l in listings:
        t = clean(l.get("Title",""))
        d = clean(l.get("JobDescription",""))
        r = clean(l.get("JobRequirements",""))
        k = clean(l.get("id_Job_MotsCls",""))
        texts.append(f"{t} {t} {d} {r} Compétences : {k}")
    embeddings = model.encode(texts, normalize_embeddings=True)
    return listings, embeddings

listings_cache, listing_embeddings_cache = load_listings()


class RecommendationItem(BaseModel):
    rank: int; listing_id: str; title: str; score: float
    city: Optional[str] = None; country: Optional[str] = None

class RecommendRequest(BaseModel):
    cv_text: str; top_n: int = 5

class RecommendResponse(BaseModel):
    recommendations: List[RecommendationItem]


@app.get("/health")
def health():
    return {"status": "ok", "listings_cached": len(listings_cache)}


@app.post("/recommend", response_model=RecommendResponse)
def recommend(request: RecommendRequest):
    if not request.cv_text.strip():
        raise HTTPException(400, detail="cv_text est vide")
    vec    = model.encode([request.cv_text], normalize_embeddings=True)
    scores = cosine_similarity(vec, listing_embeddings_cache)[0]
    top_idx = np.argsort(scores)[::-1][:request.top_n]
    results = []
    for rank, idx in enumerate(top_idx, 1):
        l = listings_cache[idx]
        results.append(RecommendationItem(
            rank=rank, listing_id=str(l["_id"]),
            title=l.get("Title",""), score=round(float(scores[idx]),4),
            city=l.get("Location_City"), country=l.get("Location_Country"),
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
    for f in ["Resume","resume","Objective","bio","Study","education","Experience","experience"]:
        v = clean(user.get(f))
        if v: parts.append(v)
    for sf in ["Skills","skills"]:
        sk = user.get(sf,[])
        if isinstance(sk, list) and sk:
            parts.append("Compétences : " + ", ".join(str(s) for s in sk if s))
            break
        elif isinstance(sk, str) and sk.strip():
            parts.append("Compétences : " + sk.strip())
            break
    cv_text = " ".join(parts) or user.get("email","")
    return recommend(RecommendRequest(cv_text=cv_text, top_n=top_n))


@app.post("/cache/refresh")
def refresh_cache():
    global listings_cache, listing_embeddings_cache
    listings_cache, listing_embeddings_cache = load_listings()
    return {"refreshed": len(listings_cache)}