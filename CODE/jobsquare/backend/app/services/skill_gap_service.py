"""Skill Gap Analysis — LLM + RAG + Agentic AI"""
import logging
from typing import Optional
from app.dao.repositories.listing_repository import ListingRepository
from app.dao.repositories.user_repository import UserRepository
from app.core.llm import get_llm_client

logger = logging.getLogger(__name__)

# ── RAG : base de ressources d'apprentissage ──────────────────────────────────

LEARNING_RESOURCES = {
    "python":          ["Python.org docs", "Automate the Boring Stuff", "Real Python"],
    "react":           ["React.dev", "Scrimba React Course", "Full Stack Open"],
    "docker":          ["Docker Docs", "Play with Docker", "TechWorld with Nana"],
    "kubernetes":      ["Kubernetes.io", "KodeKloud", "CKA Course"],
    "machine learning":["Coursera ML (Andrew Ng)", "fast.ai", "Kaggle Learn"],
    "sql":             ["SQLZoo", "Mode Analytics SQL Tutorial", "LeetCode SQL"],
    "aws":             ["AWS Skill Builder", "A Cloud Guru", "AWS Well-Architected"],
    "typescript":      ["TypeScript Handbook", "Execute Program", "Total TypeScript"],
    "java":            ["Java Docs", "Baeldung", "Codecademy Java"],
    "node":            ["Node.js Docs", "The Odin Project", "NodeSchool"],
    "git":             ["Pro Git Book", "Learn Git Branching", "GitHub Skills"],
    "linux":           ["Linux Journey", "OverTheWire", "The Linux Command Line"],
    "devops":          ["DevOps Roadmap", "90 Days of DevOps", "KodeKloud"],
    "data":            ["Kaggle Learn", "DataCamp", "Mode Analytics"],
    "comptabilité":    ["OHADA Academy", "Coursera Finance", "Khan Academy Finance"],
    "excel":           ["Excel Jet", "Chandoo.org", "ExcelJet"],
}

def _get_resources(skill: str) -> list:
    skill_lower = skill.lower()
    for key, resources in LEARNING_RESOURCES.items():
        if key in skill_lower or skill_lower in key:
            return resources
    return [f"Rechercher '{skill}' sur Coursera, Udemy, YouTube"]


# ── RAG : extraction des skills du listing ────────────────────────────────────

def _extract_listing_skills(listing: dict) -> list:
    job = listing.get("job") or {}
    skills = job.get("skills") or []
    if isinstance(skills, list) and skills:
        return [str(s).strip() for s in skills if s]

    # Fallback : extraire depuis description/requirements via keywords
    import re
    text = " ".join(filter(None, [
        str(listing.get("title", "")),
        str(job.get("description", "")),
        str(job.get("requirements", "")),
        str(listing.get("JobDescription", "")),
        str(listing.get("JobRequirements", "")),
        str(listing.get("id_Job_MotsCls", "")),
    ])).lower()

    # Liste de compétences courantes à détecter
    known_skills = [
        # Tech
        "python", "javascript", "typescript", "react", "vue", "angular",
        "node", "nodejs", "java", "php", "sql", "mongodb", "postgresql",
        "mysql", "docker", "kubernetes", "aws", "azure", "git", "linux",
        "devops", "machine learning", "excel", "powerpoint", "word",
        # Admin / RH
        "comptabilité", "audit", "recrutement", "communication",
        "gestion", "administration", "secrétariat", "bureautique",
        "archivage", "accueil", "rédaction", "organisation",
        "planification", "reporting", "facturation", "saisie",
        # Marketing
        "marketing", "seo", "réseaux sociaux", "community management",
        "photoshop", "illustrator", "canva", "wordpress",
        # Finance
        "finance", "trésorerie", "fiscalité", "sage", "sap", "cegid",
    ]
    found = [kw for kw in known_skills if kw in text]
    if not found:
        title_words = re.findall(r'\b\w{4,}\b', listing.get("title", "").lower())
        found = [w for w in title_words if w not in 
                 {"pour", "avec", "dans", "chez", "notre", "votre", "vous", "nous"}]
    return found[:8]


# ── Agent Principal ───────────────────────────────────────────────────────────

class SkillGapService:

    def __init__(self):
        self.listing_repo = ListingRepository()
        self.user_repo    = UserRepository()

    async def analyze(self, user_id: str, listing_id: str) -> dict:
        """
        Pipeline Agentic :
        1. Récupérer le profil user + le listing (RAG)
        2. LLM identifie les skill gaps
        3. LLM recommande les ressources d'apprentissage
        4. LLM génère un plan d'action personnalisé
        """

        # ── Étape 1 : RAG — Récupération des données ──
        user    = await self.user_repo.find_by_id(user_id)
        listing = await self.listing_repo.find_by_id(listing_id)

        if not user or not listing:
            return {"error": "User ou listing introuvable"}

        # Profil utilisateur
        cv = user.get("cv") or {}
        user_skills = cv.get("skills") or user.get("skills") or []
        if isinstance(user_skills, str):
            import re
            user_skills = [s.strip() for s in re.split(r"[,;|]", user_skills) if s.strip()]
        user_skills = [str(s).lower().strip() for s in user_skills if s]

        experiences = cv.get("experiences") or []
        exp_text = " | ".join([
            f"{e.get('title','')} {e.get('company','')} {e.get('description','')}"
            for e in (experiences if isinstance(experiences, list) else [])
            if isinstance(e, dict)
        ])

        # Skills requis par le poste
        required_skills = _extract_listing_skills(listing)
        job             = listing.get("job") or {}
        listing_title   = listing.get("title", "Poste inconnu")
        listing_desc    = (job.get("description") or "")[:500]
        listing_req     = (job.get("requirements") or "")[:500]

        # ── Étape 2 : LLM — Analyse des lacunes ──
        gap_result = await self._llm_identify_gaps(
            user_skills    = user_skills,
            required_skills= required_skills,
            listing_title  = listing_title,
            listing_desc   = listing_desc,
            listing_req    = listing_req,
            exp_text       = exp_text,
        )

        # ── Étape 3 : RAG — Ressources pour chaque lacune ──
        import json
        resources = {}
        for skill in gap_result.get("missing_skills", []):
            resources[skill] = _get_resources(skill)

        # ── Étape 4 : LLM — Plan d'action ──
        action_plan = await self._llm_generate_action_plan(
            missing_skills = gap_result.get("missing_skills", []),
            listing_title  = listing_title,
            user_name      = user.get("profile", {}).get("full_name") or user.get("email", ""),
        )

        result= {
            "listing_title":    listing_title,
            "user_skills":      user_skills,
            "required_skills":  required_skills,
            "matching_skills":  gap_result.get("matching_skills", []),
            "missing_skills":   gap_result.get("missing_skills", []),
            "match_score":      gap_result.get("match_score", 0),
            "llm_analysis":     gap_result.get("analysis", ""),
            "resources":        resources,
            "action_plan":      action_plan,
        }
        return json.loads(json.dumps(result, ensure_ascii=False))
    async def _llm_identify_gaps(
        self,
        user_skills: list,
        required_skills: list,
        listing_title: str,
        listing_desc: str,
        listing_req: str,
        exp_text: str,
    ) -> dict:
        client = get_llm_client()

        prompt = f"""Tu es un expert RH et coach de carrière.

POSTE CIBLÉ : {listing_title}
DESCRIPTION : {listing_desc}
EXIGENCES : {listing_req}

COMPÉTENCES DU CANDIDAT : {", ".join(user_skills) or "Non renseignées"}
EXPÉRIENCES : {exp_text or "Non renseignées"}
COMPÉTENCES REQUISES DÉTECTÉES : {", ".join(required_skills) or "Non spécifiées"}

Analyse les lacunes et réponds UNIQUEMENT en JSON valide avec cette structure :
{{
  "matching_skills": ["skill1", "skill2"],
  "missing_skills": ["skill3", "skill4"],
  "match_score": 75,
  "analysis": "Analyse concise en 2-3 phrases"
}}

- match_score : pourcentage de 0 à 100
- missing_skills : compétences manquantes les plus importantes (max 6)
- matching_skills : compétences du candidat qui correspondent
"""

        try:
            response = client.chat.completions.create(
                model      ="llama-3.3-70b-versatile",
                max_tokens = 800,
                messages   = [{"role": "user", "content": prompt}],
            )
            import json, re
            text = response.choices[0].message.content
            # Extraire le JSON proprement
            match = re.search(r'\{.*\}', text, re.DOTALL)
            if match:
                return json.loads(match.group())
        except Exception as e:
            logger.error("LLM gap analysis error: %s", e)

        # Fallback basique sans LLM
        user_set     = set(user_skills)
        req_set      = set(s.lower() for s in required_skills)
        matching     = list(user_set & req_set)
        missing      = list(req_set - user_set)
        match_score  = int((len(matching) / max(len(req_set), 1)) * 100)
        return {
            "matching_skills": matching,
            "missing_skills":  missing[:6],
            "match_score":     match_score,
            "analysis": f"Correspondance de {match_score}% avec le poste.",
        }

    async def _llm_generate_action_plan(
        self,
        missing_skills: list,
        listing_title: str,
        user_name: str,
    ) -> str:
        if not missing_skills:
            return f"Félicitations ! Votre profil correspond bien à ce poste."

        client = get_llm_client()
        prompt = f"""Tu es un coach de carrière expert.

Le candidat {user_name} vise le poste : {listing_title}
Compétences à acquérir : {", ".join(missing_skills)}

Génère un plan d'action court et motivant (4-6 étapes max) pour combler ces lacunes en 3 mois.
Sois concret, pratique et encourageant. Réponds en français."""

        try:
            response = client.chat.completions.create(
                model      = "llama-3.3-70b-versatile",
                max_tokens = 600,
                messages   = [{"role": "user", "content": prompt}],
            )
            return response.choices[0].message.content
        except Exception as e:
            logger.error("LLM action plan error: %s", e)
            return f"Plan suggéré : apprendre {', '.join(missing_skills[:3])} via des cours en ligne.".encode('utf-8').decode('utf-8')