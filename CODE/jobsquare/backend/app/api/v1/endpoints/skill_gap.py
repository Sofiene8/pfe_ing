"""app/api/v1/endpoints/skill_gap.py"""
from fastapi import APIRouter, Depends
from app.core.security import get_current_user
from app.services.skill_gap_service import SkillGapService

router = APIRouter()
skill_gap_service = SkillGapService()

@router.get("/{listing_id}")
async def analyze_skill_gap(
    listing_id: str,
    current_user=Depends(get_current_user),
):
    # FIX: get_current_user retourne le user complet, pas le payload JWT
    # Le champ est "id" (string) ou "_id", pas "sub"
    user_id = current_user.get("id") or str(current_user.get("_id", ""))
    return await skill_gap_service.analyze(
        user_id    = user_id,
        listing_id = listing_id,
    )