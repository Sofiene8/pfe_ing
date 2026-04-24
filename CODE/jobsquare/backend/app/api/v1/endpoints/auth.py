"""app/api/v1/auth.py — Controller Auth"""
from fastapi import APIRouter, Depends
from pydantic import BaseModel, EmailStr
from typing import Optional

from app.services.auth_service import AuthService
from app.core.security import get_current_user

router = APIRouter()
auth_service = AuthService()


class RegisterRequest(BaseModel):
    email: EmailStr
    password: str
    role: str = "jobseeker"
    username: Optional[str] = None
    full_name: Optional[str] = None
    company_name: Optional[str] = None
    phone: Optional[str] = None


class LoginRequest(BaseModel):
    email: EmailStr
    password: str


class RefreshRequest(BaseModel):
    refresh_token: str


class ChangePasswordRequest(BaseModel):
    old_password: str
    new_password: str


@router.post("/register", status_code=201)
async def register(body: RegisterRequest):
    profile = {"full_name": body.full_name, "phone": body.phone}
    company = {"name": body.company_name} if body.company_name else {}
    return await auth_service.register(
        email=body.email,
        password=body.password,
        role=body.role,
        username=body.username,
        profile=profile,
        company=company,
    )


@router.post("/login")
async def login(body: LoginRequest):
    return await auth_service.login(body.email, body.password)


@router.post("/refresh")
async def refresh(body: RefreshRequest):
    return await auth_service.refresh(body.refresh_token)


@router.get("/verify/{key}")
async def verify_email(key: str):
    return await auth_service.verify_email(key)


@router.put("/change-password")
async def change_password(body: ChangePasswordRequest, current_user=Depends(get_current_user)):
    return await auth_service.change_password(current_user["sub"], body.old_password, body.new_password)


@router.get("/me")
async def me(current_user=Depends(get_current_user)):
    from app.dao.repositories.user_repository import UserRepository
    repo = UserRepository()
    user = await repo.find_by_id(current_user["sub"])
    if user:
        user.pop("password", None)
        user.pop("verification_key", None)
    return user