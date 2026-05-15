"""
Endpoint: /api/v1/videos/questions/{listing_id}
Génère les 3 questions dynamiques (hard skills, projet, logique)
personnalisées selon le CV et profil du candidat.
"""
import os
import json
import httpx
from fastapi import APIRouter, Depends, HTTPException
from pydantic import BaseModel
from typing import List
from app.core.security import get_current_user
from app.core.database import get_db

GROQ_API_KEY = os.getenv("GROQ_API_KEY", "")
GROQ_API_URL = "https://api.groq.com/openai/v1"

router = APIRouter(prefix="/videos", tags=["Video Analysis"])


class DynamicQuestion(BaseModel):
    id: int
    phase: str
    label: str
    kpis: str
    is_dynamic: bool = False


class QuestionsResponse(BaseModel):
    questions: List[DynamicQuestion]


@router.get("/questions/{listing_id}", response_model=QuestionsResponse)
async def get_interview_questions(
    listing_id: str,
    current_user: dict = Depends(get_current_user),
):
    """
    Retourne les 8 questions d'entretien.
    Les questions 5, 6 et 7 sont générées dynamiquement par Groq
    selon le CV et profil du candidat.
    """
    db = get_db()

    # Récupérer le profil complet du candidat
    user = await db.users.find_one({"_id": current_user["_id"]})
    cv = user.get("cv", {}) if user else {}
    skills = cv.get("skills", [])
    experiences = cv.get("experiences", [])
    education = cv.get("education", [])
    projects = [e.get("title", "") + " chez " + e.get("company", "") for e in experiences]

    # Récupérer le titre de l'offre
    listing = None
    try:
        from bson import ObjectId
        listing = await db.listings.find_one({"_id": int(listing_id)})
        if not listing:
            listing = await db.listings.find_one({"_id": ObjectId(listing_id)})
    except Exception:
        pass
    listing_title = listing.get("title", "ce poste") if listing else "ce poste"
    listing_desc = listing.get("job", {}).get("description", "") if listing else ""

    # Générer les 3 questions dynamiques via Groq
    dynamic_questions = await _generate_dynamic_questions(
        skills=skills,
        projects=projects,
        education=education,
        listing_title=listing_title,
        listing_desc=listing_desc[:500],
    )

    # Questions fixes (1, 2, 3, 4, 8)
    questions = [
        DynamicQuestion(id=1, phase="introduction",         label="Présentez-vous",               kpis="Confiance • Clarté • Énergie"),
        DynamicQuestion(id=2, phase="adaptabilite",         label="Parlez d'un défi difficile que vous avez rencontré et comment vous l'avez surmonté", kpis="Gestion du stress • Méthode de résolution"),
        DynamicQuestion(id=3, phase="intelligence_sociale", label="Comment gérez-vous un conflit au sein d'une équipe ?", kpis="Empathie • Leadership • Esprit d'équipe"),
        DynamicQuestion(id=4, phase="alignement",           label=f"Pourquoi postulez-vous pour ce poste de {listing_title} ?", kpis="Motivation • Connaissance entreprise"),
        DynamicQuestion(id=5, phase="hard_skills",          label=dynamic_questions.get("hard_skills", f"Expliquez comment vous utiliseriez {skills[0] if skills else 'vos compétences'} pour résoudre un problème concret dans ce rôle."), kpis="Précision • Maîtrise des fondamentaux", is_dynamic=True),
        DynamicQuestion(id=6, phase="maitrise_projet",      label=dynamic_questions.get("maitrise_projet", f"Décrivez en détail votre projet le plus significatif : {projects[0] if projects else 'un projet personnel'}."), kpis="Architecture • Vision produit • Authenticité", is_dynamic=True),
        DynamicQuestion(id=7, phase="mindset",              label=dynamic_questions.get("mindset", "Si vous deviez concevoir un système de recommandation à grande échelle, comment l'architectureriez-vous ?"), kpis="Abstraction • Scalabilité", is_dynamic=True),
        DynamicQuestion(id=8, phase="maturite",             label="Parlez-moi d'un échec professionnel ou académique et ce que vous en avez appris", kpis="Honnêteté • Capacité d'apprentissage"),
    ]

    return QuestionsResponse(questions=questions)


async def _generate_dynamic_questions(
    skills: list,
    projects: list,
    education: list,
    listing_title: str,
    listing_desc: str,
) -> dict:
    """Génère 3 questions personnalisées via Groq LLM."""
    if not GROQ_API_KEY:
        return {}

    skills_str = ", ".join(skills[:6]) if skills else "compétences générales"
    projects_str = ", ".join(projects[:2]) if projects else "projets personnels"
    edu_str = education[0].get("degree", "") if education else ""

    prompt = f"""Tu es un expert recruteur tech. Génère 3 questions d'entretien PERSONNALISÉES pour ce candidat.

Profil candidat :
- Compétences : {skills_str}
- Expériences/Projets : {projects_str}
- Formation : {edu_str}
- Poste visé : {listing_title}
- Description poste : {listing_desc}

Génère exactement ces 3 questions :
1. "hard_skills" : Une question technique précise basée sur SES compétences réelles ({skills_str}). Pas générique — cite une techno spécifique qu'il connaît.
2. "maitrise_projet" : Une question sur UN de SES projets listés ({projects_str}). Demande un détail d'architecture ou de décision technique.
3. "mindset" : Un problème de logique ou de scalabilité en rapport avec le poste {listing_title}.

Réponds UNIQUEMENT en JSON :
{{
  "hard_skills": "<question précise et personnalisée>",
  "maitrise_projet": "<question sur un projet réel du candidat>",
  "mindset": "<problème logique lié au poste>"
}}"""

    try:
        async with httpx.AsyncClient(timeout=15) as client:
            response = await client.post(
                f"{GROQ_API_URL}/chat/completions",
                headers={
                    "Authorization": f"Bearer {GROQ_API_KEY}",
                    "Content-Type": "application/json",
                },
                json={
                    "model": "llama-3.3-70b-versatile",
                    "messages": [{"role": "user", "content": prompt}],
                    "temperature": 0.7,
                    "max_tokens": 400,
                },
            )
            response.raise_for_status()
            content = response.json()["choices"][0]["message"]["content"]
            clean = content.strip().lstrip("```json").lstrip("```").rstrip("```").strip()
            return json.loads(clean)
    except Exception:
        return {}