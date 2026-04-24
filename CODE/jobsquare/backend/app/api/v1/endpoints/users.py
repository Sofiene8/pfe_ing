"""app/api/v1/users.py — Controller Users"""
from fastapi import APIRouter, Depends, UploadFile, File, HTTPException
from pydantic import BaseModel
from typing import Optional, List
import os, shutil, uuid
from pathlib import Path

from app.dao.repositories.user_repository import UserRepository
from app.core.security import get_current_user
from app.core.config import settings

router = APIRouter()
user_repo = UserRepository()


class ProfileUpdate(BaseModel):
    full_name: Optional[str] = None
    phone: Optional[str] = None
    gender: Optional[str] = None
    website: Optional[str] = None
    location_city: Optional[str] = None
    location_state: Optional[str] = None
    location_country: Optional[str] = None


class CompanyUpdate(BaseModel):
    name: Optional[str] = None
    description: Optional[str] = None
    commercial_register: Optional[str] = None
    sector: Optional[str] = None


class CVUpdate(BaseModel):
    model_sid: Optional[int] = None
    color_sid: Optional[int] = None
    skills: Optional[List[str]] = None
    languages: Optional[List[str]] = None
    experiences: Optional[list] = None
    education: Optional[list] = None


def _sanitize(user: dict) -> dict:
    return {k: v for k, v in user.items() if k not in ("password", "verification_key")}


@router.get("/{user_id}")
async def get_user(user_id: str):
    user = await user_repo.find_by_id(user_id)
    if not user:
        raise HTTPException(status_code=404, detail="Utilisateur introuvable")
    return _sanitize(user)


@router.put("/me/profile")
async def update_profile(body: ProfileUpdate, current_user=Depends(get_current_user)):
    update_data = {"profile": {}}
    if body.full_name: update_data["profile"]["full_name"] = body.full_name
    if body.phone: update_data["profile"]["phone"] = body.phone
    if body.gender: update_data["profile"]["gender"] = body.gender
    if body.website: update_data["profile"]["website"] = body.website
    location = {}
    if body.location_city: location["city"] = body.location_city
    if body.location_state: location["state"] = body.location_state
    if body.location_country: location["country"] = body.location_country
    if location:
        update_data["profile"]["location"] = location
    # Flatten for $set
    flat = {f"profile.{k}": v for k, v in update_data["profile"].items()}
    user = await user_repo.update(current_user["sub"], flat)
    return _sanitize(user)


@router.put("/me/company")
async def update_company(body: CompanyUpdate, current_user=Depends(get_current_user)):
    flat = {f"company.{k}": v for k, v in body.model_dump(exclude_none=True).items()}
    user = await user_repo.update(current_user["sub"], flat)
    return _sanitize(user)


@router.put("/me/cv")
async def update_cv(body: CVUpdate, current_user=Depends(get_current_user)):
    flat = {f"cv.{k}": v for k, v in body.model_dump(exclude_none=True).items()}
    user = await user_repo.update(current_user["sub"], flat)
    return _sanitize(user)


@router.post("/me/avatar")
async def upload_avatar(file: UploadFile = File(...), current_user=Depends(get_current_user)):
    if file.content_type not in ("image/jpeg", "image/png", "image/webp"):
        raise HTTPException(status_code=400, detail="Format image invalide")
    upload_dir = Path(settings.UPLOAD_DIR) / "avatars"
    upload_dir.mkdir(parents=True, exist_ok=True)
    ext = file.filename.split(".")[-1]
    filename = f"{uuid.uuid4()}.{ext}"
    dest = upload_dir / filename
    with open(dest, "wb") as f:
        shutil.copyfileobj(file.file, f)
    url = f"/uploads/avatars/{filename}"
    await user_repo.update(current_user["sub"], {"profile.logo": url})
    return {"url": url}


@router.post("/me/cv-file")
async def upload_cv_file(file: UploadFile = File(...), current_user=Depends(get_current_user)):
    allowed = ("application/pdf", "application/msword",
               "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
    if file.content_type not in allowed:
        raise HTTPException(status_code=400, detail="Format CV invalide (PDF ou Word uniquement)")
    upload_dir = Path(settings.UPLOAD_DIR) / "cvs"
    upload_dir.mkdir(parents=True, exist_ok=True)
    ext = file.filename.split(".")[-1]
    filename = f"{uuid.uuid4()}.{ext}"
    dest = upload_dir / filename
    with open(dest, "wb") as f:
        shutil.copyfileobj(file.file, f)
    url = f"/uploads/cvs/{filename}"
    await user_repo.update(current_user["sub"], {"cv.uploaded_cv_path": url})
    return {"url": url}