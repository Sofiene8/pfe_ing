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
        listing = await self.listing_repo.find_by_id(listing_id)
        if not listing or not listing.get("active"):
            raise HTTPException(status_code=404, detail="Offre introuvable ou inactive")

        # ✅ Bloquer si l'offre est complète (available_slots == 0)
        slots = listing.get("available_slots")
        if slots is not None and slots <= 0:
            raise HTTPException(status_code=409, detail="Cette offre n'a plus de places disponibles")

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
        if not listing or str(listing.get("user_id", "")) != str(employer_id):
            raise HTTPException(status_code=403, detail="Non autorisé")
        return await self.app_repo.find_by_listing(listing_id)

    async def update_status(self, app_id: str, employer_id: str, status: str, notes: str = None) -> dict:
        app = await self.app_repo.find_by_id(app_id)
        if not app:
            raise HTTPException(status_code=404, detail="Candidature introuvable")

        listing = await self.listing_repo.find_by_id(app["listing_id"])
        if not listing :
            raise HTTPException(status_code=404, detail="Offre introuvable")
        listing_owner = str(
        listing.get("user_id") or
        listing.get("UserId") or
        listing.get("user_sid") or
        listing.get("id_User") or
        ""
        )
        if listing_owner and listing_owner != str(employer_id):
         raise HTTPException(status_code=403, detail="Non autorisé")
        valid_statuses = {"pending", "viewed", "shortlisted", "rejected", "accepted"}
        if status not in valid_statuses:
            raise HTTPException(status_code=400, detail=f"Statut invalide. Valeurs: {valid_statuses}")

        # LOGIQUE PRINCIPALE — si le candidat est accepté
        if status == "accepted" and app.get("status") != "accepted":
            # 1. Mettre à jour le statut de la candidature
            updated_app = await self.app_repo.update_status(app_id, status, notes)

            # 2. Incrémenter accepted_count sur la candidature elle-même
            await self.app_repo.col.update_one(
                {"listing_id": app["listing_id"]},
                {"$inc": {"accepted_count": 1}},
                upsert=False
            )
            # On stocke aussi accepted_count sur le listing pour affichage rapide
            await self.listing_repo.col.update_one(
                self.listing_repo._build_id_filter(app["listing_id"]),
                {"$inc": {"accepted_count": 1}}
            )

            # 3. Décrémenter available_slots + masquer si slots == 0
            slots = listing.get("available_slots")
            if slots is not None:  # Seulement pour les offres avec limite de places
                await self.listing_repo.decrement_slots(app["listing_id"])

            return updated_app

        # Cas normal (pas accepted, ou déjà accepted)
        return await self.app_repo.update_status(app_id, status, notes)