"""app/services/application_service.py — Logique des candidatures"""
from fastapi import HTTPException

from app.dao.repositories.application_repository import ApplicationRepository
from app.dao.repositories.listing_repository import ListingRepository
from app.dao.repositories.user_repository import UserRepository


class ApplicationService:
    def __init__(self):
        self.app_repo = ApplicationRepository()
        self.listing_repo = ListingRepository()
        self.user_repo = UserRepository()

    async def apply(self, listing_id: str, jobseeker_id: str, data: dict) -> dict:
        # Vérifications
        listing = await self.listing_repo.find_by_id(listing_id)
        if not listing or not listing.get("active"):
            raise HTTPException(status_code=404, detail="Offre introuvable ou inactive")

        already = await self.app_repo.already_applied(listing_id, jobseeker_id)
        if already:
            raise HTTPException(status_code=409, detail="Vous avez déjà postulé à cette offre")

        user = await self.user_repo.find_by_id(jobseeker_id)

        app_data = {
            **data,
            "listing_id": listing_id,
            "jobseeker_id": jobseeker_id,
            "jobseeker_snapshot": {
                "full_name": user.get("profile", {}).get("full_name"),
                "email": user.get("email"),
                "phone": user.get("profile", {}).get("phone"),
                "username": user.get("username"),
            },
            "listing_snapshot": {
                "title": listing.get("title"),
                "company_name": listing.get("employer_snapshot", {}).get("company_name"),
            },
        }
        return await self.app_repo.create(app_data)

    async def get_my_applications(self, jobseeker_id: str) -> list:
        return await self.app_repo.find_by_jobseeker(jobseeker_id)

    async def get_listing_applications(self, listing_id: str, employer_id: str) -> list:
        listing = await self.listing_repo.find_by_id(listing_id)
        if not listing or listing["user_id"] != employer_id:
            raise HTTPException(status_code=403, detail="Accès non autorisé")
        return await self.app_repo.find_by_listing(listing_id)

    async def update_status(self, app_id: str, employer_id: str, status: str, notes: str = None) -> dict:
        app = await self.app_repo.find_by_id(app_id)
        if not app:
            raise HTTPException(status_code=404, detail="Candidature introuvable")
        # Vérifier que l'employeur est bien le propriétaire de l'offre
        listing = await self.listing_repo.find_by_id(app["listing_id"])
        if not listing or listing["user_id"] != employer_id:
            raise HTTPException(status_code=403, detail="Non autorisé")
        valid_statuses = {"pending", "viewed", "shortlisted", "rejected", "accepted"}
        if status not in valid_statuses:
            raise HTTPException(status_code=400, detail=f"Statut invalide. Valeurs: {valid_statuses}")
        return await self.app_repo.update_status(app_id, status, notes)