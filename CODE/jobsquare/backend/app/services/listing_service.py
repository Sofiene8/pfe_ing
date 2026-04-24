"""app/services/listing_service.py — Logique métier des offres (PROD CLEAN)"""

from fastapi import HTTPException
from datetime import datetime, timedelta

from app.dao.repositories.listing_repository import ListingRepository
from app.dao.repositories.user_repository import UserRepository


class ListingService:

    def __init__(self):
        self.listing_repo = ListingRepository()
        self.user_repo = UserRepository()

    # -------------------------
    # CREATE LISTING
    # -------------------------
    async def create_listing(self, user_id: str, data: dict) -> dict:

        user = await self.user_repo.find_by_id(user_id)
        if not user:
            raise HTTPException(status_code=404, detail="Utilisateur introuvable")

        data["employer_snapshot"] = {
            "user_id": user_id,
            "company_name": user.get("company", {}).get("name"),
            "logo": user.get("profile", {}).get("logo"),
            "location_city": user.get("profile", {}).get("location", {}).get("city"),
        }

        data["user_id"] = user_id

        data["activation_date"] = datetime.utcnow()
        data["updated_at"] = datetime.utcnow()

        if not data.get("expiration_date"):
            data["expiration_date"] = datetime.utcnow() + timedelta(days=30)

        return await self.listing_repo.create(data)

    # -------------------------
    # GET LISTING
    # -------------------------
    async def get_listing(self, listing_id: str, increment_views: bool = True) -> dict:

        listing = await self.listing_repo.find_by_id(listing_id)

        if not listing:
            raise HTTPException(status_code=404, detail="Offre introuvable")

        if increment_views:
            await self.listing_repo.increment_views(listing_id)

        return listing

    # -------------------------
    # UPDATE LISTING
    # -------------------------
    async def update_listing(self, listing_id: str, user_id: str, data: dict) -> dict:

        listing = await self.listing_repo.find_by_id(listing_id)

        if not listing:
            raise HTTPException(status_code=404, detail="Offre introuvable")

        if str(listing.get("user_id")) != str(user_id):
            raise HTTPException(status_code=403, detail="Non autorisé")

        data["updated_at"] = datetime.utcnow()

        return await self.listing_repo.update(listing_id, data)

    # -------------------------
    # DELETE LISTING
    # -------------------------
    async def delete_listing(self, listing_id: str, user_id: str, role: str) -> dict:

        listing = await self.listing_repo.find_by_id(listing_id)

        if not listing:
            raise HTTPException(status_code=404, detail="Offre introuvable")

        if str(listing.get("user_id")) != str(user_id) and role != "admin":
            raise HTTPException(status_code=403, detail="Non autorisé")

        await self.listing_repo.delete(listing_id)

        return {"message": "Offre supprimée"}

    # -------------------------
    # SEARCH LISTINGS
    # -------------------------
    async def search_listings(self, **kwargs) -> dict:

        return await self.listing_repo.search(**kwargs)

    # -------------------------
    # MY LISTINGS
    # -------------------------
    async def get_my_listings(self, user_id: str, listing_type: str = None) -> list:

        return await self.listing_repo.find_by_user(user_id, listing_type)

    # -------------------------
    # SIMILAR LISTINGS
    # -------------------------
    async def get_similar(self, listing_id: str) -> list:

        return await self.listing_repo.find_similar(listing_id)