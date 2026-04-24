"""app/dao/entities/user.py — Entités Pydantic pour User"""
from pydantic import BaseModel, EmailStr, Field
from typing import Optional, List
from datetime import datetime
from enum import Enum


class UserRole(str, Enum):
    jobseeker = "jobseeker"
    employer = "employer"
    admin = "admin"


class Location(BaseModel):
    city: Optional[str] = None
    state: Optional[str] = None
    country: Optional[str] = None
    zip_code: Optional[str] = None
    latitude: Optional[float] = None
    longitude: Optional[float] = None


class UserProfile(BaseModel):
    full_name: Optional[str] = None
    phone: Optional[str] = None
    location: Optional[Location] = None
    gender: Optional[str] = None
    birth_date: Optional[datetime] = None
    website: Optional[str] = None
    logo: Optional[str] = None
    private_space: Optional[str] = None


class CompanyInfo(BaseModel):
    name: Optional[str] = None
    description: Optional[str] = None
    commercial_register: Optional[str] = None
    sector: Optional[str] = None


class CVExperience(BaseModel):
    title: Optional[str] = None
    company: Optional[str] = None
    start_date: Optional[datetime] = None
    end_date: Optional[datetime] = None
    description: Optional[str] = None


class CVEducation(BaseModel):
    degree: Optional[str] = None
    institution: Optional[str] = None
    year: Optional[int] = None


class CVData(BaseModel):
    model_sid: Optional[int] = None
    color_sid: Optional[int] = None
    experiences: List[CVExperience] = []
    education: List[CVEducation] = []
    skills: List[str] = []
    languages: List[str] = []
    uploaded_cv_path: Optional[str] = None


class UserEntity(BaseModel):
    id: Optional[str] = Field(None, alias="_id")
    username: Optional[str] = None
    password: str
    email: EmailStr
    role: UserRole = UserRole.jobseeker
    active: bool = False
    verification_key: Optional[str] = None
    featured: bool = False
    ip: Optional[str] = None
    reference_uid: Optional[str] = None
    profile: Optional[UserProfile] = None
    company: Optional[CompanyInfo] = None
    cv: Optional[CVData] = None
    counter_cv_access: int = 0
    created_at: datetime = Field(default_factory=datetime.utcnow)
    updated_at: datetime = Field(default_factory=datetime.utcnow)

    class Config:
        populate_by_name = True