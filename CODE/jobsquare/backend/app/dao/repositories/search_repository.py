from motor.motor_asyncio import AsyncIOMotorDatabase
from app.dao.entities.search_user import SearchUserEntity
from datetime import datetime
from typing import List

class SearchRepository:
    def __init__(self, db: AsyncIOMotorDatabase):
        self.collection = db["search_users"]

    async def save_search(self, search: SearchUserEntity) -> dict:
        doc = search.model_dump()
        result = await self.collection.insert_one(doc)
        doc["_id"] = str(result.inserted_id)
        return doc

    async def get_searches_by_user(self, user_id: str, limit: int = 20) -> List[dict]:
        cursor = self.collection.find(
            {"user_id": user_id},
            {"_id": 0}
        ).sort("searched_at", -1).limit(limit)
        return await cursor.to_list(length=limit)

    async def get_recent_searches(self, limit: int = 100) -> List[dict]:
        cursor = self.collection.find({}, {"_id": 0}).sort("searched_at", -1).limit(limit)
        return await cursor.to_list(length=limit)