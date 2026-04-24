"""app/api/v1/recommendations.py"""
from fastapi import APIRouter, Depends, Query
from app.services.recommendation_service import RecommendationService
from app.core.security import get_current_user, require_employer

router = APIRouter()
rec_service = RecommendationService()


@router.get("/jobs")
async def recommend_jobs(
    limit: int = Query(10, ge=1, le=50),
    current_user=Depends(get_current_user)
):
    return await rec_service.recommend_jobs_for_user(current_user["sub"], limit)


@router.get("/candidates/{listing_id}")
async def recommend_candidates(
    listing_id: str,
    limit: int = Query(10, ge=1, le=50),
    current_user=Depends(require_employer),
):
    return await rec_service.recommend_candidates_for_listing(listing_id, limit)