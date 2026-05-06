from pydantic import BaseModel, Field
from typing import Optional, List
from datetime import datetime
from bson import ObjectId

class SearchUserEntity(BaseModel):
    user_id: str
    query: Optional[str] = None          # mot-clé recherché
    filters: Optional[dict] = None       # filtres appliqués (secteur, ville, type...)
    results_count: int = 0
    searched_at: datetime = Field(default_factory=datetime.utcnow)

    class Config:
        arbitrary_types_allowed = True