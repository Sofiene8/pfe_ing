"""app/api/v1/listings.py — Controller Listings"""
from fastapi import APIRouter, Depends, Query, UploadFile, File
from pydantic import BaseModel
from typing import Optional, List
from datetime import datetime

from app.services.listing_service import ListingService
from app.core.security import get_current_user, require_employer

router = APIRouter()
listing_service = ListingService()

@router.get("/categories")
async def get_categories():
    return await listing_service.listing_repo.get_all_categories()
class JobDetailsIn(BaseModel):
    category: Optional[str] = None
    employment_type: Optional[str] = None
    description: Optional[str] = None
    requirements: Optional[str] = None
    skills: List[str] = []
    study_level: Optional[str] = None
    experience: Optional[str] = None
    salary_min: Optional[float] = None
    salary_max: Optional[float] = None
    salary_currency: str = "TND"
    motorized: Optional[bool] = None
    licence: Optional[bool] = None
    location_state: Optional[str] = None
    location_city: Optional[str] = None
    location_country: Optional[str] = None


class ListingCreate(BaseModel):
    listing_type: str = "job_offer"
    title: str
    keywords: List[str] = []
    expiration_date: Optional[datetime] = None
    job: Optional[JobDetailsIn] = None


class ListingUpdate(BaseModel):
    title: Optional[str] = None
    active: Optional[bool] = None
    keywords: Optional[List[str]] = None
    expiration_date: Optional[datetime] = None
    job: Optional[JobDetailsIn] = None


@router.get("")
async def search_listings(
    listing_type: str = Query("job_offer"),
    q: Optional[str] = Query(None),
    category: Optional[str] = Query(None),
    state: Optional[str] = Query(None),
    employment_type: Optional[str] = Query(None),
    experience: Optional[str] = Query(None),
    study_level: Optional[str] = Query(None),
    skip: int = Query(0, ge=0),
    limit: int = Query(20, ge=1, le=100),
    sort_by: str = Query("created_at"),
    sort_order: int = Query(-1),
):
    return await listing_service.search_listings(
        listing_type=listing_type,
        query=q,
        category=category,
        state=state,
        employment_type=employment_type,
        experience=experience,
        study_level=study_level,
        skip=skip,
        limit=limit,
        sort_by=sort_by,
        sort_order=sort_order,
    )


@router.get("/my")
async def my_listings(
    listing_type: Optional[str] = Query(None),
    current_user=Depends(get_current_user),
):
    return await listing_service.get_my_listings(current_user["sub"], listing_type)


@router.get("/{listing_id}")
async def get_listing(listing_id: str):
    return await listing_service.get_listing(listing_id)


@router.get("/{listing_id}/similar")
async def similar_listings(listing_id: str):
    return await listing_service.get_similar(listing_id)


@router.post("", status_code=201)
async def create_listing(body: ListingCreate, current_user=Depends(require_employer)):
    data = body.model_dump()
    if data.get("job") and data["job"].get("location_state"):
        loc = {
            "state": data["job"].pop("location_state", None),
            "city": data["job"].pop("location_city", None),
            "country": data["job"].pop("location_country", None),
        }
        data["job"]["location"] = loc
    return await listing_service.create_listing(current_user["sub"], data)


@router.put("/{listing_id}")
async def update_listing(listing_id: str, body: ListingUpdate, current_user=Depends(get_current_user)):
    return await listing_service.update_listing(listing_id, current_user["sub"], body.model_dump(exclude_none=True))


@router.delete("/{listing_id}")
async def delete_listing(listing_id: str, current_user=Depends(get_current_user)):
    return await listing_service.delete_listing(listing_id, current_user["sub"], current_user.get("role"))