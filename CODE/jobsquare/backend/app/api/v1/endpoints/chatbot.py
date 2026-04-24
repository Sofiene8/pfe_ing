"""app/api/v1/chatbot.py — Chatbot conversationnel intelligent (Claude API)"""
import httpx
from fastapi import APIRouter, Depends, HTTPException
from pydantic import BaseModel
from typing import List, Optional

from app.core.config import settings
from app.core.security import get_current_user
from app.dao.repositories.user_repository import UserRepository

router = APIRouter()
user_repo = UserRepository()

SYSTEM_PROMPT = """Tu es JobBot, un assistant intelligent de la plateforme d'emploi JobSquare (Tunisie).
Tu aides les utilisateurs à :
- Trouver des offres d'emploi adaptées à leur profil
- Améliorer leur CV et leur lettre de motivation
- Préparer les entretiens d'embauche
- Comprendre les tendances du marché de l'emploi tunisien
- Naviguer sur la plateforme

Réponds toujours en français, de façon concise et professionnelle.
Ne fournis pas d'informations inexactes. Si tu ne sais pas, dis-le clairement.
"""


class ChatMessage(BaseModel):
    role: str   # "user" | "assistant"
    content: str


class ChatRequest(BaseModel):
    message: str
    history: List[ChatMessage] = []
    include_profile: bool = False


@router.post("/chat")
async def chat(body: ChatRequest, current_user=Depends(get_current_user)):
    if not settings.ANTHROPIC_API_KEY:
        raise HTTPException(status_code=503, detail="Service chatbot non configuré")

    # Construire le contexte utilisateur si demandé
    system = SYSTEM_PROMPT
    if body.include_profile:
        user = await user_repo.find_by_id(current_user["sub"])
        if user:
            cv = user.get("cv", {}) or {}
            profile = user.get("profile", {}) or {}
            skills = cv.get("skills", [])
            location = (profile.get("location") or {}).get("state", "")
            role = user.get("role", "")
            system += f"\n\nContexte utilisateur:\n- Rôle: {role}\n- Localisation: {location}\n- Compétences: {', '.join(skills)}"

    # Construire l'historique de messages
    messages = [{"role": m.role, "content": m.content} for m in body.history]
    messages.append({"role": "user", "content": body.message})

    async with httpx.AsyncClient(timeout=30.0) as client:
        response = await client.post(
            "https://api.anthropic.com/v1/messages",
            headers={
                "x-api-key": settings.ANTHROPIC_API_KEY,
                "anthropic-version": "2023-06-01",
                "content-type": "application/json",
            },
            json={
                "model": "claude-haiku-4-5-20251001",
                "max_tokens": 1024,
                "system": system,
                "messages": messages,
            },
        )

    if response.status_code != 200:
        raise HTTPException(status_code=502, detail="Erreur service chatbot")

    data = response.json()
    reply = data["content"][0]["text"]
    return {
        "reply": reply,
        "usage": data.get("usage", {}),
    }


@router.post("/analyze-cv")
async def analyze_cv(current_user=Depends(get_current_user)):
    """Analyse le CV de l'utilisateur et propose des améliorations"""
    if not settings.ANTHROPIC_API_KEY:
        raise HTTPException(status_code=503, detail="Service non configuré")

    user = await user_repo.find_by_id(current_user["sub"])
    if not user:
        raise HTTPException(status_code=404, detail="Utilisateur introuvable")

    cv = user.get("cv", {}) or {}
    profile = user.get("profile", {}) or {}

    cv_text = f"""
Profil: {profile.get('full_name', 'Non renseigné')}
Compétences: {', '.join(cv.get('skills', []))}
Langues: {', '.join(cv.get('languages', []))}
Expériences: {len(cv.get('experiences', []))} expérience(s)
Formation: {len(cv.get('education', []))} formation(s)
"""

    async with httpx.AsyncClient(timeout=30.0) as client:
        response = await client.post(
            "https://api.anthropic.com/v1/messages",
            headers={
                "x-api-key": settings.ANTHROPIC_API_KEY,
                "anthropic-version": "2023-06-01",
                "content-type": "application/json",
            },
            json={
                "model": "claude-haiku-4-5-20251001",
                "max_tokens": 1024,
                "system": "Tu es un expert en recrutement. Analyse ce profil et donne des conseils précis pour améliorer l'employabilité. Réponds en français.",
                "messages": [{"role": "user", "content": f"Analyse ce profil:\n{cv_text}\n\nDonne 3 points forts et 3 axes d'amélioration."}],
            },
        )

    data = response.json()
    return {"analysis": data["content"][0]["text"]}