"""app/dao/repositories/blog_repository.py"""
from bson import ObjectId
from typing import Optional, List, Dict, Any
from datetime import datetime

from app.core.database import get_db


class BlogRepository:

    @property
    def col(self):
        return get_db().blog_posts

    def _serialize(self, doc: dict) -> dict:
        if doc and "_id" in doc:
            doc["_id"] = str(doc["_id"])
        return doc

    async def create(self, data: dict) -> dict:
        data["created_at"] = datetime.utcnow()
        data["updated_at"] = datetime.utcnow()
        result = await self.col.insert_one(data)
        return await self.find_by_id(str(result.inserted_id))

    async def find_by_id(self, post_id: str) -> Optional[dict]:
        doc = await self.col.find_one({"_id": ObjectId(post_id)})
        return self._serialize(doc)

    async def find_by_slug(self, slug: str) -> Optional[dict]:
        doc = await self.col.find_one({"slug": slug, "active": True})
        return self._serialize(doc)

    async def list_posts(self, category: str = None, skip: int = 0, limit: int = 10) -> Dict[str, Any]:
        filter_: dict = {"active": True}
        if category:
            filter_["category.name"] = category
        total = await self.col.count_documents(filter_)
        cursor = self.col.find(filter_, {"content": 0}).sort("created_at", -1).skip(skip).limit(limit)
        items = [self._serialize(doc) async for doc in cursor]
        return {"items": items, "total": total}

    async def update(self, post_id: str, data: dict) -> Optional[dict]:
        data["updated_at"] = datetime.utcnow()
        await self.col.update_one({"_id": ObjectId(post_id)}, {"$set": data})
        return await self.find_by_id(post_id)

    async def delete(self, post_id: str) -> bool:
        result = await self.col.delete_one({"_id": ObjectId(post_id)})
        return result.deleted_count > 0