from fastapi import APIRouter, HTTPException, Depends
from app.services.dashboard_service import DashboardService
from app.services.listing_service import ListingService
from app.schemas.video_schemas import (
    AnalysisReportResponse, PhaseScoreResponse,
    ListingReportsDashboard, CandidateSummary
)
from app.core.security import get_current_user

router = APIRouter(prefix="/analysis", tags=["Analysis Reports"])
RECRUITER_ROLES = {"admin", "recruiter", "employer"}

def _is_recruiter(user: dict) -> bool:
    return user.get("role") in RECRUITER_ROLES

async def _assert_recruiter_owns_listing(listing_id: str, current_user: dict):
    if current_user.get("role") == "admin":
        return
    listing_service = ListingService()
    listing = await listing_service.get_listing(listing_id, increment_views=False)
    if not listing:
        raise HTTPException(status_code=404, detail="Offre introuvable")
    if str(listing.get("user_id", "")) != str(current_user.get("id", "")):
        raise HTTPException(status_code=403, detail="Acces refuse")

def _serialize_report(report) -> AnalysisReportResponse:
    phase_scores = [
        PhaseScoreResponse(
            phase=ps.phase, label=ps.label, score=ps.score,
            kpi_scores=ps.kpi_scores, transcript_excerpt=ps.transcript_excerpt,
            nlp_insights=ps.nlp_insights, vision_insights=ps.vision_insights,
            red_flags=ps.red_flags, timestamp_start=ps.timestamp_start,
            timestamp_end=ps.timestamp_end,
        )
        for ps in report.phase_scores
    ]
    return AnalysisReportResponse(
        report_id=str(report._id), submission_id=report.submission_id,
        application_id=report.application_id, user_id=report.user_id,
        listing_id=report.listing_id, global_score=report.global_score,
        technical_score=report.technical_score, soft_score=report.soft_score,
        hire_classification=report.hire_classification, phase_scores=phase_scores,
        full_transcript=report.full_transcript, global_red_flags=report.global_red_flags,
        global_insights=report.global_insights,
        processing_duration_seconds=report.processing_duration_seconds,
        created_at=report.created_at,
    )

@router.get("/application/{application_id}", response_model=AnalysisReportResponse)
async def get_report_by_application(application_id: str, current_user: dict = Depends(get_current_user)):
    service = DashboardService()
    report = await service.get_report_by_application(application_id)
    if not report:
        raise HTTPException(status_code=404, detail="Rapport introuvable")
    if _is_recruiter(current_user):
        await _assert_recruiter_owns_listing(report.listing_id, current_user)
    else:
        if str(report.user_id) != current_user.get("id"):
            raise HTTPException(status_code=403, detail="Acces refuse")
    return _serialize_report(report)

@router.get("/submission/{submission_id}", response_model=AnalysisReportResponse)
async def get_report_by_submission(submission_id: str, current_user: dict = Depends(get_current_user)):
    service = DashboardService()
    report = await service.get_report_by_submission(submission_id)
    if not report:
        raise HTTPException(status_code=404, detail="Rapport introuvable")
    if _is_recruiter(current_user):
        await _assert_recruiter_owns_listing(report.listing_id, current_user)
    else:
        if str(report.user_id) != current_user.get("id"):
            raise HTTPException(status_code=403, detail="Acces refuse")
    return _serialize_report(report)

@router.get("/listing/{listing_id}", response_model=ListingReportsDashboard)
async def get_listing_dashboard(listing_id: str, current_user: dict = Depends(get_current_user)):
    if not _is_recruiter(current_user):
        raise HTTPException(status_code=403, detail="Acces reserve aux recruteurs")
    await _assert_recruiter_owns_listing(listing_id, current_user)
    service = DashboardService()
    reports = await service.get_listing_reports(listing_id)
    candidates = [
        CandidateSummary(
            user_id=r.user_id, application_id=r.application_id, full_name="",
            global_score=r.global_score, hire_classification=r.hire_classification,
            red_flags_count=len(r.global_red_flags), created_at=r.created_at,
        )
        for r in reports
    ]
    return ListingReportsDashboard(listing_id=listing_id, listing_title="", total_submissions=len(reports), candidates=candidates)