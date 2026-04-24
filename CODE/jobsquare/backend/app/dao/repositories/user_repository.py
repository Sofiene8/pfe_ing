"""app/dao/repositories/user_repository.py — CRUD MongoDB pour User"""
from bson import ObjectId
from bson.errors import InvalidId
from typing import Optional, List
from datetime import datetime

from app.core.database import get_db
from app.dao.entities.user import UserEntity


class UserRepository:

    @property
    def col(self):
        return get_db().users

    def _serialize(self, doc: dict) -> dict:
        if doc and "_id" in doc:
            doc["_id"] = str(doc["_id"])
        return doc

    async def create(self, data: dict) -> dict:
        data["created_at"] = datetime.utcnow()
        data["updated_at"] = datetime.utcnow()
        result = await self.col.insert_one(data)
        return await self.find_by_id(str(result.inserted_id))

    async def find_by_id(self, user_id: str) -> Optional[dict]:
        try:
            doc = await self.col.find_one({"_id": ObjectId(user_id)})
            return self._serialize(doc)
        except InvalidId:
            return None

    async def find_by_email(self, email: str) -> Optional[dict]:
        doc = await self.col.find_one({"email": email})
        return self._serialize(doc)

    async def find_by_username(self, username: str) -> Optional[dict]:
        doc = await self.col.find_one({"username": username})
        return self._serialize(doc)

    async def update(self, user_id: str, data: dict) -> Optional[dict]:
        data["updated_at"] = datetime.utcnow()
        await self.col.update_one({"_id": ObjectId(user_id)}, {"$set": data})
        return await self.find_by_id(user_id)

    async def delete(self, user_id: str) -> bool:
        result = await self.col.delete_one({"_id": ObjectId(user_id)})
        return result.deleted_count > 0

    async def list_employers(self, skip: int = 0, limit: int = 20) -> List[dict]:
        cursor = self.col.find({"role": "employer", "active": True}).skip(skip).limit(limit)
        return [self._serialize(doc) async for doc in cursor]

    async def search_jobseekers(self, skill: str = None, location: str = None, limit: int = 20) -> List[dict]:
        query = {"role": "jobseeker", "active": True}
        if skill:
            query["cv.skills"] = {"$in": [skill]}
        if location:
            query["profile.location.state"] = location
        cursor = self.col.find(query).limit(limit)
        return [self._serialize(doc) async for doc in cursor]

    async def activate(self, verification_key: str) -> Optional[dict]:
        result = await self.col.find_one_and_update(
            {"verification_key": verification_key},
            {"$set": {"active": True, "verification_key": None, "updated_at": datetime.utcnow()}},
            return_document=True
        )
        return self._serialize(result)