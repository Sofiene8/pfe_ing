from app.dao.repositories.search_repository import SearchRepository
from app.dao.entities.search_user import SearchUserEntity
from typing import Optional

class SearchService:
    def __init__(self, search_repository: SearchRepository):
        self.search_repository = search_repository

    async def record_search(
        self,
        user_id: str,
        query: Optional[str],
        filters: Optional[dict],
        results_count: int
    ) -> dict:
        entity = SearchUserEntity(
            user_id=user_id,
            query=query,
            filters=filters,
            results_count=results_count
        )
        return await self.search_repository.save_search(entity)

    async def get_user_search_history(self, user_id: str, limit: int = 20):
        return await self.search_repository.get_searches_by_user(user_id, limit)