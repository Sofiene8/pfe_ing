# backend/app/services/cv_analysis_service.py
"""
Service d'analyse intelligente de CV via LLM (Groq).
Pipeline: PDF → texte → LLM extraction → LLM analyse → LLM amélioration → rapport JSON
"""

import json
import re
import os
import logging
from pathlib import Path
from typing import Optional

from groq import Groq
import pdfplumber
import docx2txt

logger = logging.getLogger(__name__)

# ─── Modèle Groq recommandé ────────────────────────────────────────────────────
# llama-3.3-70b-versatile : meilleur rapport qualité/vitesse pour l'analyse de CV
GROQ_MODEL = "llama-3.3-70b-versatile"

# ─── Client Groq ───────────────────────────────────────────────────────────────
def get_groq_client() -> Groq:
    api_key = os.getenv("GROQ_API_KEY")
    if not api_key:
        raise ValueError("GROQ_API_KEY manquant dans les variables d'environnement")
    return Groq(api_key=api_key)


# ─── Extraction texte du fichier ───────────────────────────────────────────────
def extract_text_from_file(file_path: str) -> str:
    """Extrait le texte brut d'un PDF ou Word."""
    path = Path(file_path)
    if not path.exists():
        raise FileNotFoundError(f"Fichier introuvable: {file_path}")

    ext = path.suffix.lower()

    if ext == ".pdf":
        text_parts = []
        try:
            with pdfplumber.open(file_path) as pdf:
                for page in pdf.pages:
                    page_text = page.extract_text()
                    if page_text:
                        text_parts.append(page_text)
            return "\n".join(text_parts)
        except Exception as e:
            logger.error(f"Erreur lecture PDF: {e}")
            raise ValueError(f"Impossible de lire le PDF: {e}")

    elif ext in (".doc", ".docx"):
        try:
            return docx2txt.process(file_path)
        except Exception as e:
            logger.error(f"Erreur lecture DOCX: {e}")
            raise ValueError(f"Impossible de lire le document Word: {e}")

    else:
        raise ValueError(f"Format non supporté: {ext}. Utilisez PDF, DOC ou DOCX.")


# ─── Prompt builder ────────────────────────────────────────────────────────────
SYSTEM_PROMPT = """Tu es un expert RH senior, consultant en recrutement et spécialiste ATS (Applicant Tracking System).
Tu maîtrises parfaitement l'analyse de CV, les standards du marché de l'emploi, et les exigences des recruteurs modernes.
Tu réponds TOUJOURS et UNIQUEMENT en JSON valide, sans backticks, sans texte avant ou après le JSON."""

def build_analysis_prompt(cv_text: str, filename: str) -> str:
    # Groq gère bien les contextes longs — on peut passer plus de texte qu'avec certains modèles
    return f"""Analyse ce CV de manière experte et complète.

Nom du fichier: {filename}

Contenu du CV:
{cv_text[:6000]}

Génère un JSON avec cette structure EXACTE:
{{
  "score": <entier 0-100 représentant la qualité globale>,
  "score_label": <"Faible" | "Moyen" | "Bon" | "Excellent">,
  "score_color": <"red" | "amber" | "green">,
  "score_summary": "<synthèse en 1-2 phrases de la qualité du CV>",

  "extracted": {{
    "name": "<nom complet du candidat>",
    "email": "<adresse email>",
    "phone": "<numéro de téléphone>",
    "location": "<ville ou région>",
    "linkedin": "<URL LinkedIn si présente, sinon vide>",
    "title": "<titre/poste professionnel actuel ou visé>",
    "education_level": "<niveau d'études: Bac | Licence | Master | Doctorat | Autre>",
    "years_experience": "<estimation du nombre d'années d'expérience>",
    "skills_tech": ["<liste des compétences techniques détectées>"],
    "skills_soft": ["<liste des soft skills détectés>"],
    "certifications": ["<liste des certifications>"],
    "ats_keywords": ["<10-15 mots-clés ATS importants présents dans le CV>"],
    "languages": ["<langues parlées avec niveau si mentionné>"],
    "projects": ["<projets notables mentionnés>"]
  }},

  "scores_detail": {{
    "ats": <0-100, compatibilité avec les systèmes ATS>,
    "structure": <0-100, clarté et organisation du CV>,
    "content": <0-100, richesse et pertinence du contenu>,
    "keywords": <0-100, densité et pertinence des mots-clés>
  }},

  "market_comparison": {{
    "missing_skills": ["<compétences importantes du marché absentes du CV>"],
    "missing_keywords": ["<mots-clés ATS manquants selon le secteur>"],
    "strengths": ["<3-5 points forts du CV>"],
    "sector": "<secteur d'activité détecté>"
  }},

  "issues": [
    {{
      "severity": "<high | med | low>",
      "icon": "<emoji représentatif>",
      "category": "<ATS | Structure | Contenu | Mots-clés | Formatage | Cohérence>",
      "title": "<titre court du problème>",
      "desc": "<description détaillée avec recommandation concrète>",
      "fix": "<action précise à effectuer pour corriger>"
    }}
  ],

  "improved_cv": {{
    "name": "<nom du candidat>",
    "title": "<titre optimisé avec mots-clés ATS intégrés>",
    "contact": "<email | téléphone | ville | LinkedIn>",
    "summary": "<accroche professionnelle percutante de 3-4 phrases, riche en mots-clés ATS, orientée valeur ajoutée>",
    "experiences": [
      {{
        "role": "<titre du poste optimisé>",
        "company": "<nom de l'entreprise>",
        "period": "<dates>",
        "bullets": [
          "<réalisation quantifiée avec chiffre: ex 'Augmentation de 35% des performances'>",
          "<impact business mesurable>",
          "<technologie ou méthode utilisée avec résultat>"
        ]
      }}
    ],
    "education": [
      {{
        "degree": "<diplôme complet>",
        "school": "<établissement>",
        "year": "<année d'obtention>"
      }}
    ],
    "skills": ["<liste de 10-12 compétences optimisées pour ATS>"],
    "certifications": ["<certifications avec année si disponible>"],
    "languages": ["<langue et niveau CECRL: ex 'Anglais B2'>"],
    "projects": [
      {{
        "name": "<nom du projet>",
        "desc": "<description courte orientée impact et technologies>"
      }}
    ]
  }}
}}

Instructions importantes:
- Analyse chaque section avec un regard critique de recruteur senior
- Les issues doivent être triées par sévérité (high en premier)
- L'improved_cv doit être substantiellement meilleur que l'original
- Les bullets d'expérience doivent commencer par un verbe d'action fort
- Intègre un maximum de mots-clés ATS dans l'improved_cv
- Le résumé de l'improved_cv doit accrocher un recruteur en 10 secondes"""


# ─── Parse LLM response ────────────────────────────────────────────────────────
def parse_llm_json(raw: str) -> dict:
    """Extrait et parse le JSON depuis la réponse LLM."""
    clean = raw.strip()
    # Remove markdown code fences
    clean = re.sub(r"```json\s*", "", clean)
    clean = re.sub(r"```\s*", "", clean)
    clean = clean.strip()

    # Find JSON boundaries
    start = clean.find("{")
    end = clean.rfind("}") + 1
    if start == -1 or end == 0:
        raise ValueError("Aucun JSON trouvé dans la réponse LLM")

    json_str = clean[start:end]
    return json.loads(json_str)


# ─── Main analysis function ────────────────────────────────────────────────────
async def analyze_cv_with_llm(file_path: str, filename: str) -> dict:
    """
    Pipeline complet d'analyse CV:
    1. Extraction texte (PDF/DOCX)
    2. Appel LLM Groq pour analyse complète
    3. Retourne rapport structuré JSON
    """
    # Step 1: Extract text
    logger.info(f"Extraction du texte: {filename}")
    cv_text = extract_text_from_file(file_path)

    if not cv_text or len(cv_text.strip()) < 50:
        raise ValueError(
            "Le CV semble vide ou illisible. "
            "Assurez-vous que le PDF contient du texte (pas uniquement des images)."
        )

    logger.info(f"Texte extrait: {len(cv_text)} caractères")

    # Step 2: Call Groq LLM
    # Note: Groq est synchrone — on utilise run_in_executor pour ne pas bloquer la boucle async
    import asyncio
    client = get_groq_client()
    prompt = build_analysis_prompt(cv_text, filename)

    logger.info(f"Appel Groq LLM ({GROQ_MODEL}) en cours...")

    def call_groq() -> str:
        response = client.chat.completions.create(
            model=GROQ_MODEL,
            max_tokens=4096,
            temperature=0.2,          # Faible température pour des sorties JSON stables
            messages=[
                {"role": "system", "content": SYSTEM_PROMPT},
                {"role": "user",   "content": prompt},
            ],
        )
        return response.choices[0].message.content

    # Exécute l'appel synchrone dans un thread séparé pour préserver async
    loop = asyncio.get_event_loop()
    raw_response = await loop.run_in_executor(None, call_groq)

    logger.info(f"Réponse Groq reçue: {len(raw_response)} caractères")

    # Step 3: Parse
    result = parse_llm_json(raw_response)

    # Validate minimum required fields
    required = ["score", "extracted", "scores_detail", "issues", "improved_cv"]
    for field in required:
        if field not in result:
            raise ValueError(f"Champ requis manquant dans la réponse LLM: {field}")

    # Attach metadata
    result["filename"] = filename
    result["cv_text_length"] = len(cv_text)

    return result


# ─── Save analysis to user profile ────────────────────────────────────────────
def save_analysis_to_user(user_repository, user_id: str, analysis: dict) -> None:
    """Persiste le résultat d'analyse dans le profil utilisateur MongoDB."""
    update_data = {
        "cv.ai_analysis": {
            "score": analysis.get("score"),
            "score_label": analysis.get("score_label"),
            "score_color": analysis.get("score_color"),
            "score_summary": analysis.get("score_summary"),
            "scores_detail": analysis.get("scores_detail"),
            "market_comparison": analysis.get("market_comparison"),
            "issues": analysis.get("issues", []),
            "extracted": analysis.get("extracted"),
            "filename": analysis.get("filename"),
        }
    }
    user_repository.update_user(user_id, update_data)
    logger.info(f"Analyse sauvegardée pour l'utilisateur {user_id}")