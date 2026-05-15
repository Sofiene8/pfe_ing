"""
Schemas Pydantic — Module d'analyse vidéo comportementale
"""
from datetime import datetime
from typing import Optional, List, Dict
from pydantic import BaseModel, Field


# ─── Upload ───────────────────────────────────────────────

class VideoUploadResponse(BaseModel):
    submission_id: str
    status: str
    message: str
    filename: str
    duration_seconds: float


class VideoStatusResponse(BaseModel):
    submission_id: str
    status: str           # pending | processing | completed | failed
    error_message: Optional[str] = None
    created_at: datetime
    updated_at: datetime


# ─── Rapport ──────────────────────────────────────────────

class KPIScore(BaseModel):
    name: str
    score: float
    label: str


class PhaseScoreResponse(BaseModel):
    phase: str
    label: str
    score: float
    kpi_scores: Dict[str, float]
    transcript_excerpt: str
    nlp_insights: str
    vision_insights: str
    red_flags: List[str]
    timestamp_start: float
    timestamp_end: float


class AnalysisReportResponse(BaseModel):
    report_id: str
    submission_id: str
    application_id: str
    user_id: str
    listing_id: str

    # Scores
    global_score: float = Field(..., ge=0, le=100)
    technical_score: float = Field(..., ge=0, le=100)
    soft_score: float = Field(..., ge=0, le=100)
    hire_classification: str   # Strong Hire | Hire | Lean Hire | No Hire

    # Détail par phase
    phase_scores: List[PhaseScoreResponse]

    # Synthèse globale
    full_transcript: str
    global_red_flags: List[str]
    global_insights: str
    processing_duration_seconds: float
    created_at: datetime

    class Config:
        populate_by_name = True


# ─── Dashboard recruteur ──────────────────────────────────

class CandidateSummary(BaseModel):
    user_id: str
    application_id: str
    full_name: str
    avatar_url: Optional[str] = None
    global_score: float
    hire_classification: str
    red_flags_count: int
    created_at: datetime


class ListingReportsDashboard(BaseModel):
    listing_id: str
    listing_title: str
    total_submissions: int
    candidates: List[CandidateSummary]