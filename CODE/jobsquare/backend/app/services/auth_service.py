"""app/services/auth_service.py — Logique d'authentification"""
import secrets
from typing import Optional
from fastapi import HTTPException, status

from app.core.security import hash_password, verify_password, create_access_token, create_refresh_token, decode_token
from app.dao.repositories.user_repository import UserRepository


class AuthService:
    def __init__(self):
        self.user_repo = UserRepository()

    async def register(self, email: str, password: str, role: str, username: str = None, **extra) -> dict:
        # Vérification unicité email
        existing = await self.user_repo.find_by_email(email)
        if existing:
            raise HTTPException(status_code=400, detail="Email déjà utilisé")

        verification_key = secrets.token_urlsafe(32)
        user_data = {
            "email": email,
            "password": hash_password(password),
            "role": role,
            "username": username or email.split("@")[0],
            "active": True,
            "verification_key": verification_key,
            "featured": False,
            "counter_cv_access": 0,
            "profile": extra.get("profile", {}),
            "company": extra.get("company", {}),
            "cv": {"experiences": [], "education": [], "skills": [], "languages": []},
        }
        user = await self.user_repo.create(user_data)
        # TODO: envoyer email de vérification avec verification_key
        return {"user": _sanitize(user), "verification_key": verification_key}

    async def login(self, email: str, password: str) -> dict:
        user = await self.user_repo.find_by_email(email)
        if not user:
            raise HTTPException(status_code=401, detail="Email ou mot de passe incorrect")
        if not verify_password(password, user["password"]):
            raise HTTPException(status_code=401, detail="Email ou mot de passe incorrect")
        if user.get("active") is False or user.get("active") == 0:
            raise HTTPException(status_code=403, detail="Compte désactivé.")

        token_data = {"sub": user["_id"], "email": user["email"], "role": user["role"]}
        return {
            "access_token": create_access_token(token_data),
            "refresh_token": create_refresh_token(token_data),
            "token_type": "bearer",
            "user": _sanitize(user),
        }

    async def refresh(self, refresh_token: str) -> dict:
        payload = decode_token(refresh_token)
        if payload.get("type") != "refresh":
            raise HTTPException(status_code=401, detail="Refresh token invalide")
        user = await self.user_repo.find_by_id(payload["sub"])
        if not user:
            raise HTTPException(status_code=401, detail="Utilisateur introuvable")
        token_data = {"sub": user["_id"], "email": user["email"], "role": user["role"]}
        return {
            "access_token": create_access_token(token_data),
            "token_type": "bearer",
        }

    async def verify_email(self, key: str) -> dict:
        user = await self.user_repo.activate(key)
        if not user:
            raise HTTPException(status_code=400, detail="Lien de vérification invalide ou expiré")
        return {"message": "Compte activé avec succès", "user": _sanitize(user)}

    async def change_password(self, user_id: str, old_password: str, new_password: str) -> dict:
        user = await self.user_repo.find_by_id(user_id)
        if not verify_password(old_password, user["password"]):
            raise HTTPException(status_code=400, detail="Ancien mot de passe incorrect")
        await self.user_repo.update(user_id, {"password": hash_password(new_password)})
        return {"message": "Mot de passe modifié avec succès"}


def _sanitize(user: dict) -> dict:
    """Retire les champs sensibles"""
    return {k: v for k, v in user.items() if k not in ("password", "verification_key")}