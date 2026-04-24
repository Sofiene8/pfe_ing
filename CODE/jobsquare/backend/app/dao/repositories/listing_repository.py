"""app/dao/repositories/listing_repository.py — CRUD MongoDB pour Listing"""

from typing import Optional, List, Dict, Any
from datetime import datetime

from app.core.database import get_db

# Mapping listing_type (string) → listing_type_sid (int)
LISTING_TYPE_MAP = {
    "job_offer": 6,
    "internship": 7,   # adapte selon ta DB
    "training": 8,     # adapte selon ta DB
}


class ListingRepository:

    # -------------------------
    # COLLECTION
    # -------------------------
    @property
    def col(self):
        return get_db().listings

    # -------------------------
    # SERIALIZATION
    # -------------------------
    def _serialize(self, doc: dict) -> dict:
        if not doc:
            return None
        doc["_id"] = str(doc["_id"])
        return doc

    # -------------------------
    # FIND BY ID
    # -------------------------
    async def find_by_id(self, listing_id):
        try:
            sid = int(listing_id)
        except (ValueError, TypeError):
            return None

        doc = await self.col.find_one({
            "$or": [{"_id": sid}, {"sid": sid}]
        })
        return self._serialize(doc)

    # -------------------------
    # CREATE
    # -------------------------
    async def create(self, data: dict) -> dict:
        data["created_at"] = datetime.utcnow()
        data["updated_at"] = datetime.utcnow()
        result = await self.col.insert_one(data)
        return await self.find_by_id(data.get("sid"))

    # -------------------------
    # UPDATE
    # -------------------------
    async def update(self, listing_id: str, data: dict) -> Optional[dict]:
        try:
            sid = int(listing_id)
        except (ValueError, TypeError):
            return None

        data["updated_at"] = datetime.utcnow()
        await self.col.update_one({"sid": sid}, {"$set": data})
        return await self.find_by_id(sid)

    # -------------------------
    # DELETE
    # -------------------------
    async def delete(self, listing_id: str) -> bool:
        try:
            sid = int(listing_id)
        except (ValueError, TypeError):
            return False

        result = await self.col.delete_one({"sid": sid})
        return result.deleted_count > 0

    # -------------------------
    # INCREMENT VIEWS
    # -------------------------
    async def increment_views(self, listing_id: str):
        try:
            sid = int(listing_id)
        except (ValueError, TypeError):
            return

        await self.col.update_one({"sid": sid}, {"$inc": {"views": 1}})

    # -------------------------
    # SEARCH
    # -------------------------
    async def search(
        self,
        listing_type: str = "job_offer",
        query: str = None,
        category: str = None,
        state: str = None,
        employment_type: str = None,
        experience: str = None,
        study_level: str = None,
        skip: int = 0,
        limit: int = 20,
        sort_by: str = "date_add",
        sort_order: int = -1,
    ) -> Dict[str, Any]:

        filter_ = {"active": {"$in": [1, True]}}

        if listing_type and listing_type in LISTING_TYPE_MAP:
            filter_["listing_type_sid"] = LISTING_TYPE_MAP[listing_type]

        if query:
            filter_["$text"] = {"$search": query}

        if category:
            filter_["JobCategory"] = category

        if state:
            filter_["Location_State"] = state

        if employment_type:
            filter_["EmploymentType"] = employment_type

        if experience:
            filter_["id_Job_Experience"] = experience

        if study_level:
            filter_["Study"] = study_level

        total = await self.col.count_documents(filter_)

        cursor = (
            self.col.find(filter_)
            .sort(sort_by, sort_order)
            .skip(skip)
            .limit(limit)
        )

        items = [self._serialize(doc) async for doc in cursor]

        return {
            "items": items,
            "total": total,
            "skip": skip,
            "limit": limit,
        }

    # -------------------------
    # FIND BY USER
    # -------------------------
    async def find_by_user(self, user_id: str, listing_type: str = None) -> List[dict]:
        try:
            uid = int(user_id)
        except (ValueError, TypeError):
            return []

        filter_ = {"user_sid": uid}

        if listing_type and listing_type in LISTING_TYPE_MAP:
            filter_["listing_type_sid"] = LISTING_TYPE_MAP[listing_type]

        cursor = self.col.find(filter_).sort("date_add", -1)
        return [self._serialize(doc) async for doc in cursor]

    # -------------------------
    # FIND SIMILAR
    # -------------------------
    async def find_similar(self, listing_id: str, limit: int = 5) -> List[dict]:
        try:
            sid = int(listing_id)
        except (ValueError, TypeError):
            return []

        listing = await self.find_by_id(sid)
        if not listing:
            return []

        filter_ = {
            "sid": {"$ne": sid},
            "active": 1,
            "listing_type_sid": listing.get("listing_type_sid", 6),
        }

        category = listing.get("JobCategory")
        state = listing.get("Location_State")

        if category:
            filter_["JobCategory"] = category
        if state:
            filter_["Location_State"] = state

        cursor = self.col.find(filter_).limit(limit)
        return [self._serialize(doc) async for doc in cursor]