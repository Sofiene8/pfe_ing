"""
Endpoint: /api/v1/videos/
Upload et statut des vidéos candidats.
"""
from fastapi import APIRouter, UploadFile, File, Depends, HTTPException, Form
from fastapi.responses import JSONResponse

from app.services.video_upload_service import VideoUploadService
from app.schemas.video_schemas import VideoUploadResponse, VideoStatusResponse
from app.core.security import get_current_user

router = APIRouter(prefix="/videos", tags=["Video Analysis"])


@router.post("/upload", response_model=VideoUploadResponse)
async def upload_video(
    file: UploadFile = File(..., description="Vidéo MP4/WebM, max 1 minute"),
    listing_id: str = Form(...),
    application_id: str = Form(...),
    current_user: dict = Depends(get_current_user),
):
    """
    Upload d'une vidéo de présentation candidat (max 60 secondes).
    Lance automatiquement le pipeline d'analyse IA en arrière-plan.
    """
    service = VideoUploadService()
    submission = await service.upload_video(
        file=file,
        user_id=str(current_user["_id"]),
        listing_id=listing_id,
        application_id=application_id,
    )

    return VideoUploadResponse(
        submission_id=str(submission._id),
        status=submission.status,
        message="Vidéo reçue. L'analyse IA est en cours, vous serez notifié(e) une fois terminée.",
        filename=submission.filename,
        duration_seconds=submission.duration_seconds,
    )


@router.get("/{submission_id}/status", response_model=VideoStatusResponse)
async def get_video_status(
    submission_id: str,
    current_user: dict = Depends(get_current_user),
):
    """
    Polling du statut d'analyse d'une vidéo soumise.
    Statuts : pending | processing | completed | failed
    """
    service = VideoUploadService()
    submission = await service.get_status(submission_id)

    if not submission:
        raise HTTPException(status_code=404, detail="Soumission introuvable")

    # Vérifier que l'utilisateur est le propriétaire ou un recruteur
    if str(submission.user_id) != str(current_user["_id"]) and current_user.get("role") not in ("admin", "recruiter"):
        raise HTTPException(status_code=403, detail="Accès refusé")

    return VideoStatusResponse(
        submission_id=str(submission._id),
        status=submission.status,
        error_message=submission.error_message,
        created_at=submission.created_at,
        updated_at=submission.updated_at,
    )