"""
Repository: VideoSubmissionRepository
Accès MongoDB pour les soumissions vidéo.
"""
from datetime import datetime
from typing import Optional, List
from bson import ObjectId
from app.core.database import get_db
from app.dao.entities.video_submission import VideoSubmission


class VideoSubmissionRepository:

    def __init__(self):
        self.db = get_db()
        self.collection = self.db[VideoSubmission.COLLECTION]

    async def create(self, submission: VideoSubmission) -> VideoSubmission:
        doc = submission.to_dict()
        await self.collection.insert_one(doc)
        return submission

    async def find_by_id(self, submission_id: str) -> Optional[VideoSubmission]:
        doc = await self.collection.find_one({"_id": ObjectId(submission_id)})
        if not doc:
            return None
        return VideoSubmission.from_dict(doc)

    async def find_by_application_id(self, application_id: str) -> Optional[VideoSubmission]:
        doc = await self.collection.find_one({"application_id": application_id})
        if not doc:
            return None
        return VideoSubmission.from_dict(doc)

    async def find_by_user_id(self, user_id: str) -> List[VideoSubmission]:
        cursor = self.collection.find({"user_id": user_id}).sort("created_at", -1)
        docs = await cursor.to_list(length=100)
        return [VideoSubmission.from_dict(d) for d in docs]

    async def update_status(
        self,
        submission_id: str,
        status: str,
        error_message: Optional[str] = None,
    ) -> bool:
        update = {
            "$set": {
                "status": status,
                "updated_at": datetime.utcnow(),
            }
        }
        if error_message:
            update["$set"]["error_message"] = error_message
        result = await self.collection.update_one(
            {"_id": ObjectId(submission_id)}, update
        )
        return result.modified_count > 0

    async def find_pending(self) -> List[VideoSubmission]:
        cursor = self.collection.find(
            {"status": VideoSubmission.STATUS_PENDING}
        ).sort("created_at", 1)
        docs = await cursor.to_list(length=50)
        return [VideoSubmission.from_dict(d) for d in docs]

    async def delete_by_id(self, submission_id: str) -> bool:
        result = await self.collection.delete_one({"_id": ObjectId(submission_id)})
        return result.deleted_count > 0
