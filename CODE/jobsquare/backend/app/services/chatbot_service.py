# backend/app/services/chatbot_service.py
import re
import json
import logging
import unicodedata
from typing import Optional
import numpy as np
from sentence_transformers import SentenceTransformer
from sklearn.metrics.pairwise import cosine_similarity
from groq import Groq
import os

from app.dao.repositories.listing_repository import ListingRepository

logger = logging.getLogger(__name__)

MODEL_NAME = "paraphrase-multilingual-MiniLM-L12-v2"
_model: Optional[SentenceTransformer] = None


def _get_model() -> SentenceTransformer:
    global _model
    if _model is None:
        logger.info("[Chatbot] Chargement modèle embedding...")
        _model = SentenceTransformer(MODEL_NAME)
    return _model


def _get_groq() -> Groq:
    key = os.getenv("GROQ_API_KEY")
    if not key:
        raise ValueError("GROQ_API_KEY manquant")
    return Groq(api_key=key)


# ── Text utils ─────────────────────────────────────────────────────────────────

def _clean(text) -> str:
    if not text:
        return ""
    text = re.sub(r"<[^>]+>", " ", str(text))
    text = re.sub(r"&[a-zA-Z]+;", " ", text)
    return re.sub(r"\s+", " ", text).strip()


def _norm(text: str) -> str:
    """Lowercase + strip accents."""
    t = unicodedata.normalize("NFD", text.lower())
    t = "".join(c for c in t if unicodedata.category(c) != "Mn")
    return re.sub(r"\s+", " ", t).strip()


# ── Query cleaner ──────────────────────────────────────────────────────────────
# Supprime les mots conversationnels pour améliorer la similarité embedding
_STOP_WORDS = [
    "je veux", "je cherche", "je voudrais", "je recherche", "j'aimerais",
    "je souhaite", "je desire", "je desirerais", "montrez moi", "montre moi",
    "trouvez moi", "trouve moi", "donnez moi", "donne moi", "affiche moi",
    "pouvez vous", "peux tu", "est ce que", "est-ce que",
    "des offres", "des postes", "des emplois", "les offres", "les postes",
    "une offre", "un poste", "un emploi", "du travail",
    "d'emploi", "d emploi", "de travail",
    "dans le domaine", "dans le secteur", "dans le domaine de",
    "en lien avec", "qui concerne", "relatif a", "relatif au",
    "s'il vous plait", "sil vous plait", "svp", "stp", "merci",
    "bonjour", "bonsoir", "salut", "hello",
    "pour moi", "pour nous",

]

def _clean_query(text: str) -> str:
    t = _norm(text)
    # Supprimer phrases conversationnelles completes en premier
    stop_phrases = [
        "je veux", "je cherche", "je voudrais", "je recherche", "j aimerais",
        "je souhaite", "montrez moi", "montre moi", "trouvez moi", "trouve moi",
        "donnez moi", "donne moi", "affiche moi", "pouvez vous", "peux tu",
        "est ce que", "des offres", "des postes", "des emplois", "les offres",
        "une offre", "un poste", "un emploi", "du travail", "d emploi",
        "dans le domaine de", "dans le domaine", "dans le secteur",
        "s il vous plait", "svp", "stp", "merci", "bonjour", "bonsoir", "salut",
        "pour moi", "pour nous", "en lien avec", "relatif a",
    ]
    for phrase in stop_phrases:
        t = t.replace(phrase, " ")
    # Supprimer mots seuls parasites (seulement s ils sont isoles)
    for word in ["en", "de", "du", "des", "les", "le", "la", "un", "une",
                 "et", "ou", "au", "aux", "par", "sur", "avec", "sans",
                 "dans", "pour", "sur", "un", "une"]:
        t = re.sub(r"\b" + word + r"\b", " ", t)
    t = re.sub(r"\s+", " ", t).strip()
    return t if len(t) >= 3 else _norm(text)


# ── Category label map ────────────────────────────────────────────────────────
CATEGORY_MAP = {
    "Commerce":   "Commerce Ventes Commercial ADV",
    "IT":         "Informatique Technologies Développement Logiciel Web Full Stack Data Science Machine Learning",
    "Marketing":  "Marketing Communication Digital SEO",
    "Santé":      "Santé Médical Médecin Infirmier Pharmacien",
    "Finance":    "Finance Comptabilité Audit Fiscalité",
    "Industrie":  "Industrie Ingénierie Mécanique Maintenance Qualité Chimie Laboratoire",
    "RH":         "Ressources Humaines Recrutement",
    "Logistique": "Logistique Transport Supply Chain",
    "Hôtellerie": "Hôtellerie Tourisme Restauration",
    "Informatique & Technologies":   "Informatique Technologies Développement Logiciel Web Full Stack Data Science",
    "Finance & Comptabilité":        "Finance Comptabilité Audit",
    "Marketing & Communication":     "Marketing Communication Digital",
    "Ressources Humaines":           "Ressources Humaines Recrutement",
    "Commercial & Ventes":           "Commerce Ventes Commercial",
    "Ingénierie & Industrie":        "Industrie Ingénierie Mécanique Maintenance Chimie",
    "Santé & Médical":               "Santé Médical Médecin Infirmier",
    "Éducation & Formation":         "Éducation Formation Enseignement",
    "Architecture & BTP":            "Architecture BTP Construction",
    "Transport & Logistique":        "Transport Logistique Supply Chain",
    "Tourisme & Hôtellerie":         "Tourisme Hôtellerie Restauration",
    "Agriculture & Agroalimentaire": "Agriculture Agroalimentaire",
    "Arts & Design":                 "Arts Design Graphisme",
    "Administration & Secrétariat":  "Administration Secrétariat",
}


def _cat_label(raw) -> str:
    if not raw:
        return ""
    return CATEGORY_MAP.get(str(raw).strip(), _clean(str(raw)))


# ── Job keywords for interview detection ──────────────────────────────────────
_JOB_WORDS = {
    "developpeur", "developer", "ingenieur", "engineer", "comptable",
    "data", "analyst", "manager", "directeur", "technicien", "commercial",
    "marketing", "medecin", "infirmier", "enseignant", "professeur",
    "designer", "architecte", "logistique", "finance", "full stack",
    "backend", "frontend", "devops", "python", "java", "javascript",
    "assistant", "responsable", "charge", "expert", "consultant",
    "stagiaire", "informatique", "rh", "juridique", "chimiste",
    "biologiste", "administrateur", "systeme", "reseau", "securite",
    "chef", "coordinateur", "superviseur", "auditeur", "acheteur",
    "vendeur", "fiscaliste", "analyste", "scientifique",
    "bi", "sql", "excel", "power bi", "tableau", "machine learning",
    "intelligence artificielle", "ia", "ai",
}


def _has_job(text: str) -> bool:
    n = _norm(text)
    return any(w in n for w in _JOB_WORDS)


# ── Listing text builder ───────────────────────────────────────────────────────

def _listing_text(listing: dict) -> str:
    job    = listing.get("job") or {}
    title  = _clean(listing.get("title") or listing.get("Title") or "")
    desc   = _clean(job.get("description") or listing.get("JobDescription") or "")[:400]
    req    = _clean(job.get("requirements") or listing.get("JobRequirements") or "")[:200]
    kw     = _clean(listing.get("id_Job_MotsCls") or "")
    skills = " ".join(str(s) for s in (job.get("skills") or []) if s)
    cat    = _cat_label(job.get("category") or listing.get("JobCategory") or "")
    loc    = job.get("location") or {}
    city   = _clean(loc.get("city") or listing.get("Location_City") or "")
    state  = _clean(loc.get("state") or listing.get("Location_State") or "")
    co     = ""
    snap   = listing.get("employer_snapshot") or {}
    if isinstance(snap, dict):
        co = _clean(snap.get("company_name") or "")
    # title x4 + category x4 = signal très fort
    return f"{title} {title} {title} {title} {cat} {cat} {cat} {cat} {kw} {skills} {co} {desc} {req} {city} {state}".strip()


def _serialize(listing: dict) -> dict:
    job  = listing.get("job") or {}
    loc  = job.get("location") or {}
    snap = listing.get("employer_snapshot") or {}

    contract = str(listing.get("EmploymentType") or job.get("employment_type") or "")
    if contract.isdigit():
        contract = ""

    location = str(
        loc.get("city") or loc.get("state") or
        listing.get("Location_City") or listing.get("Location_State") or ""
    )
    if location.isdigit():
        location = ""

    title = listing.get("title") or listing.get("Title") or ""
    m = re.search(r"recherche\s+un\(e\)\s+(.+?)(?:\s+pour\s|\s+afin|\.|$)", title, re.I)
    if m:
        title = m.group(1).strip()
    else:
        title = title.split("\n")[0].split("|")[0].strip()[:80]

    return {
        "id":          str(listing.get("_id", "")),
        "title":       title,
        "company":     snap.get("company_name") or "" if isinstance(snap, dict) else "",
        "location":    location,
        "contract":    contract,
        "experience":  job.get("experience") or listing.get("Experience") or "",
        "category":    _cat_label(job.get("category") or listing.get("JobCategory") or ""),
        "description": "",
        "score":       round(float(listing.get("_score", 0)) * 100),
    }


# ══════════════════════════════════════════════════════════════════════════════
class ChatbotService:

    def __init__(self):
        self.listing_repo = ListingRepository()

    # ── Search ─────────────────────────────────────────────────────────────────
    async def search_jobs_by_text(self, user_query: str, top_k: int = 5) -> dict:
        if not user_query or len(user_query.strip()) < 3:
            return {"mode": "search", "message": "Veuillez décrire le type d'emploi recherché.", "jobs": []}

        model = _get_model()

        # FIX: nettoyer la requête conversationnelle avant l'embedding
        clean_q = _clean_query(user_query)
        logger.info("[Chatbot] Query: '%s' → '%s'", user_query, clean_q)
        query_emb = model.encode([clean_q], normalize_embeddings=True)

        try:
            results  = await self.listing_repo.search(listing_type="job_offer", limit=300)
            listings = results.get("items", [])
        except Exception as e:
            logger.error("[Chatbot] DB error: %s", e)
            return {"mode": "search", "message": "Erreur base de données.", "jobs": []}

        if not listings:
            return {"mode": "search", "message": "Aucune offre disponible.", "jobs": []}

        logger.info("[Chatbot] %d offres indexées", len(listings))

        texts  = [_listing_text(l) for l in listings]
        embs   = model.encode(texts, normalize_embeddings=True, batch_size=32)
        scores = cosine_similarity(query_emb, embs)[0]
        top_idx = np.argsort(scores)[::-1][:top_k]

        THRESHOLD = 0.505
        jobs = []
        for i in top_idx:
            if scores[i] >= THRESHOLD:
                item = dict(listings[i])
                item["_score"] = float(scores[i])
                jobs.append(_serialize(item))

        if not jobs:
            return {
                "mode":    "search",
                "message": "Aucune offre ne correspond exactement à votre recherche. Essayez d'autres mots-clés.",
                "jobs":    [],
            }

        msg = await self._search_message(user_query, jobs)
        return {"mode": "search", "message": msg, "jobs": jobs, "count": len(jobs)}

    async def _search_message(self, query: str, jobs: list) -> str:
        summary = "\n".join(
            f"- {j['title']} chez {j['company'] or 'N/A'} ({j['location'] or 'N/A'})"
            for j in jobs
        )
        prompt = (
            f'Tu es un assistant emploi amical. Utilisateur cherche : "{query}"\n'
            f"Offres trouvées :\n{summary}\n\n"
            "Réponds en 2-3 phrases : confirme les résultats, encourage à postuler. Français, chaleureux."
        )
        try:
            client = _get_groq()
            resp = client.chat.completions.create(
                model="llama-3.3-70b-versatile", max_tokens=150, temperature=0.7,
                messages=[{"role": "user", "content": prompt}],
            )
            return resp.choices[0].message.content.strip()
        except Exception as e:
            logger.warning("[Chatbot] LLM search msg error: %s", e)
            return f"J'ai trouvé {len(jobs)} offres pour votre recherche !"

    # ── Interview ──────────────────────────────────────────────────────────────
    async def get_interview_advice(self, job_description: str) -> dict:
        if not job_description or not job_description.strip():
            return {
                "mode": "interview", "needs_clarification": True,
                "message": "Précisez le poste visé. Ex : *Data Analyst*, *Développeur Full Stack*..."
            }

        if not _has_job(job_description):
            return {
                "mode": "interview", "needs_clarification": True,
                "message": "Précisez le poste visé. Ex : *Data Analyst*, *Développeur Full Stack*, *Comptable*...",
            }

        advice = await self._interview_llm(job_description)
        return {"mode": "interview", **advice}

    async def _interview_llm(self, job_description: str) -> dict:
        prompt = f"""Tu es un coach carrière expert en entretiens d'embauche.
Poste visé par l'utilisateur : {job_description}

Génère des conseils complets. Réponds UNIQUEMENT en JSON :
{{
  "resume": "Résumé du poste en 1 phrase",
  "technical": {{
    "title": "Préparation technique",
    "tips": ["Conseil 1","Conseil 2","Conseil 3","Conseil 4"],
    "likely_questions": ["Question 1 ?","Question 2 ?","Question 3 ?"]
  }},
  "softskills": {{
    "title": "Soft Skills",
    "skills": [{{"name":"Skill","how":"Comment le démontrer"}}]
  }},
  "communication": {{
    "title": "Communication",
    "tips": ["Conseil 1","Conseil 2","Conseil 3"],
    "dos": ["Faire 1","Faire 2","Faire 3"],
    "donts": ["Éviter 1","Éviter 2","Éviter 3"]
  }},
  "behavioral": {{
    "title": "Questions STAR",
    "intro": "Explication STAR",
    "questions": [
      {{"question":"Q1 ?","hint":"Conseil STAR"}},
      {{"question":"Q2 ?","hint":"Conseil STAR"}},
      {{"question":"Q3 ?","hint":"Conseil STAR"}}
    ]
  }},
  "final_tips": ["Conseil 1","Conseil 2","Conseil 3"]
}}
Adapte précisément au poste. En français."""

        try:
            client = _get_groq()
            resp = client.chat.completions.create(
                model="llama-3.3-70b-versatile", max_tokens=2000, temperature=0.4,
                messages=[
                    {"role": "system", "content": "Expert RH. JSON valide uniquement, sans backticks."},
                    {"role": "user",   "content": prompt},
                ],
                response_format={"type": "json_object"},
            )
            raw = resp.choices[0].message.content
            raw = re.sub(r"```json\s*|```\s*", "", raw).strip()
            return json.loads(raw[raw.find("{"):raw.rfind("}")+1])
        except Exception as e:
            logger.error("[Chatbot] LLM interview error: %s", e)
            return {
                "resume": job_description[:100],
                "technical": {
                    "title": "Préparation technique",
                    "tips": [
                        "Révisez les compétences clés du poste",
                        "Préparez des exemples concrets de réalisations",
                        "Entraînez-vous avec des exercices pratiques",
                        "Documentez-vous sur l'entreprise et son secteur",
                    ],
                    "likely_questions": [
                        "Parlez-moi de votre expérience ?",
                        "Pourquoi ce poste vous intéresse-t-il ?",
                        "Quelles sont vos compétences principales ?",
                    ],
                },
                "softskills": {
                    "title": "Soft Skills",
                    "skills": [
                        {"name": "Communication", "how": "Soyez clair et structuré dans vos réponses"},
                        {"name": "Adaptabilité",  "how": "Donnez des exemples concrets de flexibilité"},
                    ],
                },
                "communication": {
                    "title": "Communication",
                    "tips": ["Parlez clairement", "Écoutez attentivement", "Posez des questions pertinentes"],
                    "dos":   ["Arrivez à l'heure", "Préparez des questions", "Souriez"],
                    "donts": ["Interrompre", "Parler négativement d'un ancien employeur", "Regarder votre téléphone"],
                },
                "behavioral": {
                    "title": "Questions STAR",
                    "intro": "Situation → Tâche → Action → Résultat",
                    "questions": [
                        {"question": "Un défi que vous avez surmonté ?",    "hint": "Décrivez la situation et votre action concrète"},
                        {"question": "Un travail d'équipe réussi ?",         "hint": "Mettez en avant votre rôle et le résultat"},
                        {"question": "Une erreur et la leçon retenue ?",     "hint": "Montrez votre capacité d'apprentissage"},
                    ],
                },
                "final_tips": [
                    "Préparez-vous soigneusement en amont",
                    "Soyez authentique et honnête",
                    "Croyez en vos compétences !",
                ],
            }