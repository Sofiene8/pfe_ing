"""
Entity: VideoSubmission
Représente une soumission vidéo d'un candidat pour une offre d'emploi.
"""
from datetime import datetime
from typing import Optional
from bson import ObjectId


class VideoSubmission:
    COLLECTION = "video_submissions"

    # Statuts du pipeline d'analyse
    STATUS_PENDING = "pending"
    STATUS_PROCESSING = "processing"
    STATUS_COMPLETED = "completed"
    STATUS_FAILED = "failed"

    def __init__(
        self,
        user_id: str,
        listing_id: str,
        application_id: str,
        filename: str,
        file_path: str,
        file_size: int,
        duration_seconds: float,
        mime_type: str = "video/mp4",
        status: str = "pending",
        error_message: Optional[str] = None,
        _id: Optional[ObjectId] = None,
        created_at: Optional[datetime] = None,
        updated_at: Optional[datetime] = None,
    ):
        self._id = _id or ObjectId()
        self.user_id = user_id
        self.listing_id = listing_id
        self.application_id = application_id
        self.filename = filename
        self.file_path = file_path
        self.file_size = file_size
        self.duration_seconds = duration_seconds
        self.mime_type = mime_type
        self.status = status
        self.error_message = error_message
        self.created_at = created_at or datetime.utcnow()
        self.updated_at = updated_at or datetime.utcnow()

    def to_dict(self) -> dict:
        return {
            "_id": self._id,
            "user_id": self.user_id,
            "listing_id": self.listing_id,
            "application_id": self.application_id,
            "filename": self.filename,
            "file_path": self.file_path,
            "file_size": self.file_size,
            "duration_seconds": self.duration_seconds,
            "mime_type": self.mime_type,
            "status": self.status,
            "error_message": self.error_message,
            "created_at": self.created_at,
            "updated_at": self.updated_at,
        }

    @classmethod
    def from_dict(cls, data: dict) -> "VideoSubmission":
        return cls(
            _id=data.get("_id"),
            user_id=data["user_id"],
            listing_id=data["listing_id"],
            application_id=data["application_id"],
            filename=data["filename"],
            file_path=data["file_path"],
            file_size=data["file_size"],
            duration_seconds=data["duration_seconds"],
            mime_type=data.get("mime_type", "video/mp4"),
            status=data.get("status", "pending"),
            error_message=data.get("error_message"),
            created_at=data.get("created_at"),
            updated_at=data.get("updated_at"),
        )