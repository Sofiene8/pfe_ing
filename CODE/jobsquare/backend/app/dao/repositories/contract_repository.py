"""app/dao/repositories/contract_repository.py — Contrats/abonnements"""
from bson import ObjectId
from typing import Optional, List
from datetime import datetime

from app.core.database import get_db


class ContractRepository:

    @property
    def col(self):
        return get_db().contracts

    def _serialize(self, doc: dict) -> dict:
        if doc and "_id" in doc:
            doc["_id"] = str(doc["_id"])
        return doc

    async def create(self, data: dict) -> dict:
        data["created_at"] = datetime.utcnow()
        result = await self.col.insert_one(data)
        return await self.find_by_id(str(result.inserted_id))

    async def find_by_id(self, contract_id: str) -> Optional[dict]:
        doc = await self.col.find_one({"_id": ObjectId(contract_id)})
        return self._serialize(doc)

    async def find_active_by_user(self, user_id: str) -> List[dict]:
        cursor = self.col.find({
            "user_id": user_id,
            "status": "active",
            "expired_date": {"$gte": datetime.utcnow()}
        })
        return [self._serialize(doc) async for doc in cursor]

    async def find_all_by_user(self, user_id: str) -> List[dict]:
        cursor = self.col.find({"user_id": user_id}).sort("creation_date", -1)
        return [self._serialize(doc) async for doc in cursor]

    async def update_status(self, contract_id: str, status: str) -> Optional[dict]:
        await self.col.update_one(
            {"_id": ObjectId(contract_id)},
            {"$set": {"status": status, "updated_at": datetime.utcnow()}}
        )
        return await self.find_by_id(contract_id)

    async def expire_old_contracts(self) -> int:
        """Expirer les contrats dépassés — pour un scheduler"""
        result = await self.col.update_many(
            {"status": "active", "expired_date": {"$lt": datetime.utcnow()}},
            {"$set": {"status": "expired"}}
        )
        return result.modified_count