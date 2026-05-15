"""app/api/v1/endpoints/recommendations.py"""
import json
import numpy as np
from datetime import datetime, date

from fastapi import APIRouter, Depends, Query
from fastapi.responses import JSONResponse
from pydantic import BaseModel
from app.core.security import get_current_user, require_employer

router = APIRouter()


class NumpyDatetimeEncoder(json.JSONEncoder):
    """Sérialise numpy types ET datetime → types JSON natifs."""
    def default(self, obj):
        if isinstance(obj, np.floating):
            return float(obj)
        if isinstance(obj, np.integer):
            return int(obj)
        if isinstance(obj, np.ndarray):
            return obj.tolist()
        if isinstance(obj, (datetime, date)):   # ✅ FIX — datetime non sérialisable
            return obj.isoformat()
        return super().default(obj)


# ✅ Pas d'instanciation au niveau module — lazy loading
_rec_service = None

def get_rec_service():
    global _rec_service
    if _rec_service is None:
        from app.services.recommendation_service import RecommendationService
        _rec_service = RecommendationService()
    return _rec_service


@router.get("/jobs")
async def recommend_jobs(
    limit: int = Query(10, ge=1, le=50),
    current_user=Depends(get_current_user),
):
    try:
        user_id = current_user.get("sub") or current_user.get("_id") or current_user.get("id")
        results = await get_rec_service().recommend_jobs_for_user(str(user_id), limit)
        return JSONResponse(content=json.loads(json.dumps(results, cls=NumpyDatetimeEncoder)))
    except Exception as e:
        import traceback
        traceback.print_exc()
        raise


@router.get("/candidates/{listing_id}")
async def recommend_candidates(
    listing_id: str,
    limit: int = Query(10, ge=1, le=50),
    current_user=Depends(require_employer),
):
    try:
        results = await get_rec_service().recommend_candidates_for_listing(listing_id, limit)
        return JSONResponse(content=json.loads(json.dumps(results, cls=NumpyDatetimeEncoder)))
    except Exception as e:
        import traceback
        traceback.print_exc()
        raise


class CVRequest(BaseModel):
    cv_text: str
    top_n: int = 10

@router.post("/jobs/from-cv")
async def recommend_from_cv(req: CVRequest):
    try:
        results = await get_rec_service().recommend_from_cv_text(req.cv_text, req.top_n)
        return JSONResponse(content=json.loads(json.dumps(results, cls=NumpyDatetimeEncoder)))
    except Exception as e:
        import traceback
        traceback.print_exc()
        raise