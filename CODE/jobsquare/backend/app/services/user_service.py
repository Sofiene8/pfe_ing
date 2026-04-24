"""app/services/user_service.py — Logique métier utilisateurs"""
from fastapi import HTTPException
from typing import Optional, List

from app.dao.repositories.user_repository import UserRepository


class UserService:
    def __init__(self):
        self.repo = UserRepository()

    def _sanitize(self, user: dict) -> dict:
        return {k: v for k, v in user.items() if k not in ("password", "verification_key")}

    async def get_user(self, user_id: str) -> dict:
        user = await self.repo.find_by_id(user_id)
        if not user:
            raise HTTPException(status_code=404, detail="Utilisateur introuvable")
        return self._sanitize(user)

    async def update_profile(self, user_id: str, data: dict) -> dict:
        # Flatten nested profile keys for MongoDB $set
        flat = {}
        if "location" in data:
            for k, v in data.pop("location").items():
                if v is not None:
                    flat[f"profile.location.{k}"] = v
        for k, v in data.items():
            if v is not None:
                flat[f"profile.{k}"] = v
        user = await self.repo.update(user_id, flat)
        return self._sanitize(user)

    async def update_company(self, user_id: str, data: dict) -> dict:
        flat = {f"company.{k}": v for k, v in data.items() if v is not None}
        user = await self.repo.update(user_id, flat)
        return self._sanitize(user)

    async def update_cv(self, user_id: str, data: dict) -> dict:
        flat = {f"cv.{k}": v for k, v in data.items() if v is not None}
        user = await self.repo.update(user_id, flat)
        return self._sanitize(user)

    async def update_avatar(self, user_id: str, url: str) -> dict:
        user = await self.repo.update(user_id, {"profile.logo": url})
        return self._sanitize(user)

    async def list_employers(self, skip: int = 0, limit: int = 20) -> List[dict]:
        employers = await self.repo.list_employers(skip, limit)
        return [self._sanitize(e) for e in employers]

    async def search_jobseekers(self, skill: str = None, location: str = None, limit: int = 20) -> List[dict]:
        candidates = await self.repo.search_jobseekers(skill, location, limit)
        return [self._sanitize(c) for c in candidates]

    async def delete_account(self, user_id: str) -> dict:
        deleted = await self.repo.delete(user_id)
        if not deleted:
            raise HTTPException(status_code=404, detail="Utilisateur introuvable")
        return {"message": "Compte supprimé avec succès"}