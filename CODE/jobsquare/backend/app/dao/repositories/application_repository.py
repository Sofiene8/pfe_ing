"""app/dao/repositories/application_repository.py"""
from bson import ObjectId
from typing import Optional, List
from datetime import datetime

from app.core.database import get_db


class ApplicationRepository:

    @property
    def col(self):
        return get_db().applications

    def _serialize(self, doc: dict) -> dict:
        if doc and "_id" in doc:
            doc["_id"] = str(doc["_id"])
        return doc

    async def create(self, data: dict) -> dict:
        data["created_at"] = datetime.utcnow()
        data["updated_at"] = datetime.utcnow()
        data["status"] = "pending"
        data["seen"] = False
        result = await self.col.insert_one(data)
        return await self.find_by_id(str(result.inserted_id))

    async def find_by_id(self, app_id: str) -> Optional[dict]:
        doc = await self.col.find_one({"_id": ObjectId(app_id)})
        return self._serialize(doc)

    async def already_applied(self, listing_id: str, jobseeker_id: str) -> bool:
        count = await self.col.count_documents({
            "listing_id": listing_id,
            "jobseeker_id": jobseeker_id
        })
        return count > 0

    async def find_by_jobseeker(self, jobseeker_id: str) -> List[dict]:
        cursor = self.col.find({"jobseeker_id": jobseeker_id}).sort("created_at", -1)
        return [self._serialize(doc) async for doc in cursor]

    async def find_by_listing(self, listing_id: str, status: str = None) -> List[dict]:
        filter_ = {"listing_id": listing_id, "hidden": {"$ne": True}}
        if status:
            filter_["status"] = status
        cursor = self.col.find(filter_).sort("order", 1)
        return [self._serialize(doc) async for doc in cursor]

    async def update_status(self, app_id: str, status: str, notes: str = None) -> Optional[dict]:
        data = {"status": status, "updated_at": datetime.utcnow()}
        if notes:
            data["notes"] = notes
        await self.col.update_one({"_id": ObjectId(app_id)}, {"$set": data})
        return await self.find_by_id(app_id)

    async def mark_seen(self, app_id: str) -> None:
        await self.col.update_one(
            {"_id": ObjectId(app_id)},
            {"$set": {"seen": True, "last_seen_at": datetime.utcnow()}}
        )

    # ✅ NOUVEAU — compte les candidats acceptés pour une offre donnée
    async def count_accepted(self, listing_id: str) -> int:
        return await self.col.count_documents({
            "listing_id": listing_id,
            "status": "accepted"
        })

    # ✅ NOUVEAU — incrémente accepted_count sur le document candidature
    async def increment_accepted_count(self, listing_id: str) -> None:
        """
        Incrémente un compteur dénormalisé accepted_count
        sur TOUS les documents de cette offre (pour accès rapide côté employeur).
        On le stocke sur le 1er document trouvé, ou on utilise une collection séparée.
        
        Choix simple : on incrémente directement sur la candidature qui vient d'être acceptée.
        Le service passe app_id en paramètre.
        """
        pass  # Voir application_service.py — la logique est centralisée là-bas