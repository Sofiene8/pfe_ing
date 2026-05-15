"""app/api/v1/applications.py — Controller Candidatures"""
from fastapi import APIRouter, Depends, UploadFile, File
from pydantic import BaseModel
from typing import Optional

from app.services.application_service import ApplicationService
from app.core.security import get_current_user, require_jobseeker

router = APIRouter()
app_service = ApplicationService()


class ApplyRequest(BaseModel):
    comments: Optional[str] = ""
    resume: Optional[str] = None   # URL ou base64


class StatusUpdate(BaseModel):
    status: str
    notes: Optional[str] = None


@router.post("/{listing_id}", status_code=201)
async def apply(listing_id: str, body: ApplyRequest, current_user=Depends(require_jobseeker)):
    return await app_service.apply(listing_id, current_user.get("id") or str(current_user.get("_id", "")), body.model_dump())


@router.get("/my")
async def my_applications(current_user=Depends(get_current_user)):
    return await app_service.get_my_applications(current_user.get("id") or str(current_user.get("_id", "")))


@router.get("/listing/{listing_id}")
async def listing_applications(listing_id: str, current_user=Depends(get_current_user)):
    return await app_service.get_listing_applications(listing_id, current_user.get("id") or str(current_user.get("_id", "")))


@router.patch("/{app_id}/status")
async def update_status(app_id: str, body: StatusUpdate, current_user=Depends(get_current_user)):
    return await app_service.update_status(app_id, current_user.get("id") or str(current_user.get("_id", "")), body.status, body.notes)