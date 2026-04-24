"""app/schemas/responses.py — Schémas de réponse API standardisés"""
from pydantic import BaseModel, EmailStr
from typing import Optional, List, Any
from datetime import datetime


# ─── Generic ─────────────────────────────────────────────────────────────────

class MessageResponse(BaseModel):
    message: str


class PaginatedResponse(BaseModel):
    items: List[Any]
    total: int
    skip: int
    limit: int


# ─── Auth ─────────────────────────────────────────────────────────────────────

class TokenResponse(BaseModel):
    access_token: str
    refresh_token: Optional[str] = None
    token_type: str = "bearer"
    user: Optional[dict] = None


# ─── User (public, sans données sensibles) ───────────────────────────────────

class LocationOut(BaseModel):
    city: Optional[str] = None
    state: Optional[str] = None
    country: Optional[str] = None


class ProfileOut(BaseModel):
    full_name: Optional[str] = None
    phone: Optional[str] = None
    location: Optional[LocationOut] = None
    gender: Optional[str] = None
    website: Optional[str] = None
    logo: Optional[str] = None


class CompanyOut(BaseModel):
    name: Optional[str] = None
    description: Optional[str] = None
    sector: Optional[str] = None


class CVOut(BaseModel):
    skills: List[str] = []
    languages: List[str] = []
    experiences: List[dict] = []
    education: List[dict] = []
    uploaded_cv_path: Optional[str] = None
    model_sid: Optional[int] = None
    color_sid: Optional[int] = None


class UserPublicOut(BaseModel):
    id: Optional[str] = None
    username: Optional[str] = None
    email: str
    role: str
    active: bool = False
    featured: bool = False
    profile: Optional[ProfileOut] = None
    company: Optional[CompanyOut] = None
    cv: Optional[CVOut] = None
    created_at: Optional[datetime] = None


# ─── Listing ─────────────────────────────────────────────────────────────────

class JobLocationOut(BaseModel):
    state: Optional[str] = None
    city: Optional[str] = None
    country: Optional[str] = None
    latitude: Optional[float] = None
    longitude: Optional[float] = None


class JobDetailsOut(BaseModel):
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
    location: Optional[JobLocationOut] = None


class EmployerSnapshotOut(BaseModel):
    user_id: Optional[str] = None
    company_name: Optional[str] = None
    logo: Optional[str] = None
    location_city: Optional[str] = None


class ListingOut(BaseModel):
    id: Optional[str] = None
    listing_type: str
    user_id: str
    employer_snapshot: Optional[EmployerSnapshotOut] = None
    title: Optional[str] = None
    active: bool = True
    featured: bool = False
    views: int = 0
    keywords: List[str] = []
    activation_date: Optional[datetime] = None
    expiration_date: Optional[datetime] = None
    job: Optional[JobDetailsOut] = None
    created_at: Optional[datetime] = None
    updated_at: Optional[datetime] = None


# ─── Application ─────────────────────────────────────────────────────────────

class ApplicationOut(BaseModel):
    id: Optional[str] = None
    listing_id: str
    jobseeker_id: str
    jobseeker_snapshot: Optional[dict] = None
    listing_snapshot: Optional[dict] = None
    comments: Optional[str] = None
    status: str = "pending"
    seen: bool = False
    notes: Optional[str] = None
    created_at: Optional[datetime] = None
    updated_at: Optional[datetime] = None