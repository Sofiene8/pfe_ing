"""app/dao/entities/listing.py — Entités Pydantic pour Listing (Mongo Legacy Compatible)"""

from pydantic import BaseModel, Field
from typing import Optional, List, Union, Any
from datetime import datetime
from enum import Enum


# -------------------------
# ENUMS
# -------------------------
class ListingType(str, Enum):
    job_offer = "job_offer"
    cv = "cv"


class AccessType(str, Enum):
    everyone = "everyone"
    no_one = "no_one"


# -------------------------
# LOCATION (ADAPTÉ MONGO)
# -------------------------
class JobLocation(BaseModel):
    state: Optional[str] = None
    city: Optional[str] = None
    country: Optional[str] = None
    latitude: Optional[float] = None
    longitude: Optional[float] = None


# -------------------------
# JOB DETAILS (HYBRIDE DB + CLEAN STRUCTURE)
# -------------------------
class JobDetails(BaseModel):
    category: Optional[Union[str, int]] = None
    employment_type: Optional[Union[str, int]] = None
    description: Optional[str] = None
    requirements: Optional[str] = None

    skills: List[str] = Field(default_factory=list)

    study_level: Optional[str] = None
    experience: Optional[str] = None

    salary_min: Optional[float] = None
    salary_max: Optional[float] = None
    salary_currency: str = "TND"

    motorized: Optional[Union[bool, int]] = None
    licence: Optional[Union[bool, int]] = None

    location_state: Optional[str] = None
    location_city: Optional[str] = None
    location_country: Optional[str] = None


# -------------------------
# EMPLOYER SNAPSHOT
# -------------------------
class EmployerSnapshot(BaseModel):
    user_id: Optional[Union[str, int]] = None
    company_name: Optional[str] = None
    logo: Optional[str] = None
    location_city: Optional[str] = None


# -------------------------
# MAIN ENTITY
# -------------------------
class ListingEntity(BaseModel):
    id: Optional[str] = Field(None, alias="_id")

    sid: Optional[int] = None  # 🔥 IMPORTANT (TON ID BUSINESS)

    listing_type: ListingType = ListingType.job_offer

    user_id: Optional[Union[str, int]] = None
    user_sid: Optional[int] = None

    title: Optional[str] = None

    active: Optional[Union[bool, int]] = True
    featured: Optional[Union[bool, int]] = False

    views: int = 0

    access_type: AccessType = AccessType.everyone

    keywords: List[str] = Field(default_factory=list)

    activation_date: Optional[str] = None
    expiration_date: Optional[str] = None

    job: Optional[JobDetails] = None

    contract_id: Optional[int] = None
    preview: Optional[Union[bool, int]] = False

    created_at: datetime = Field(default_factory=datetime.utcnow)
    updated_at: datetime = Field(default_factory=datetime.utcnow)

    # -------------------------
    # Pydantic V2 config
    # -------------------------
    class Config:
        populate_by_name = True
        arbitrary_types_allowed = True