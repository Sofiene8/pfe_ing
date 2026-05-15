"""
Service: VideoUploadService
Gère la réception, validation et stockage des vidéos candidats.
Puis enfile la tâche d'analyse de manière asynchrone.
"""
import os
import uuid
import asyncio
from datetime import datetime
from pathlib import Path
from typing import Optional

from fastapi import UploadFile, HTTPException
from app.dao.entities.video_submission import VideoSubmission
from app.dao.repositories.video_submission_repository import VideoSubmissionRepository

# Limite stricte : 1 minute = 60 secondes
MAX_DURATION_SECONDS = 60
MAX_FILE_SIZE_MB = 100
ALLOWED_MIME_TYPES = {"video/mp4", "video/webm", "video/quicktime", "video/x-msvideo"}

UPLOAD_DIR = Path(os.getenv("VIDEO_UPLOAD_DIR", "/app/uploads/videos"))
UPLOAD_DIR.mkdir(parents=True, exist_ok=True)


class VideoUploadService:

    def __init__(self):
        self.repo = VideoSubmissionRepository()

    async def upload_video(
        self,
        file: UploadFile,
        user_id: str,
        listing_id: str,
        application_id: str,
    ) -> VideoSubmission:
        """
        Valide, stocke la vidéo et crée une entrée en base.
        Lance le worker d'analyse en arrière-plan.
        """
        # 1. Vérification du type MIME
        if file.content_type not in ALLOWED_MIME_TYPES:
            raise HTTPException(
                status_code=400,
                detail=f"Format non supporté: {file.content_type}. Formats acceptés: MP4, WebM, MOV, AVI"
            )

        # 2. Lecture + vérification taille
        content = await file.read()
        file_size_mb = len(content) / (1024 * 1024)
        if file_size_mb > MAX_FILE_SIZE_MB:
            raise HTTPException(
                status_code=400,
                detail=f"Fichier trop volumineux ({file_size_mb:.1f} MB). Maximum: {MAX_FILE_SIZE_MB} MB"
            )

        # 3. Vérification candidature unique par offre
        existing = await self.repo.find_by_application_id(application_id)
        if existing:
            raise HTTPException(
                status_code=409,
                detail="Une vidéo a déjà été soumise pour cette candidature."
            )

        # 4. Sauvegarde sur disque
        unique_filename = f"{uuid.uuid4()}{Path(file.filename).suffix}"
        file_path = UPLOAD_DIR / unique_filename
        with open(file_path, "wb") as f:
            f.write(content)

        # 5. Extraction durée vidéo (via ffprobe si disponible)
        duration = await self._get_video_duration(str(file_path))
        if duration and duration > MAX_DURATION_SECONDS:
            # Supprimer le fichier et rejeter
            file_path.unlink(missing_ok=True)
            raise HTTPException(
                status_code=400,
                detail=f"Vidéo trop longue ({duration:.1f}s). Maximum: {MAX_DURATION_SECONDS}s (1 minute)"
            )

        # 6. Création en base
        submission = VideoSubmission(
            user_id=user_id,
            listing_id=listing_id,
            application_id=application_id,
            filename=unique_filename,
            file_path=str(file_path),
            file_size=len(content),
            duration_seconds=duration or 0.0,
            mime_type=file.content_type,
            status=VideoSubmission.STATUS_PENDING,
        )
        await self.repo.create(submission)

        # 7. Lancement asynchrone du worker d'analyse
        asyncio.create_task(self._trigger_analysis(str(submission._id)))

        return submission

    async def get_status(self, submission_id: str) -> Optional[VideoSubmission]:
        return await self.repo.find_by_id(submission_id)

    async def _trigger_analysis(self, submission_id: str):
        """
        Déclenche le worker d'analyse après un court délai.
        En production, remplacer par Celery ou RQ.
        """
        await asyncio.sleep(1)
        try:
            from app.services.analysis_orchestrator_service import AnalysisOrchestratorService
            orchestrator = AnalysisOrchestratorService()
            await orchestrator.process_submission(submission_id)
        except Exception as e:
            await self.repo.update_status(
                submission_id,
                VideoSubmission.STATUS_FAILED,
                error_message=str(e),
            )

    async def _get_video_duration(self, file_path: str) -> Optional[float]:
        """Utilise ffprobe pour extraire la durée réelle de la vidéo."""
        try:
            proc = await asyncio.create_subprocess_exec(
                "ffprobe", "-v", "quiet", "-print_format", "json",
                "-show_streams", file_path,
                stdout=asyncio.subprocess.PIPE,
                stderr=asyncio.subprocess.PIPE,
            )
            stdout, _ = await proc.communicate()
            if proc.returncode == 0:
                import json
                data = json.loads(stdout)
                for stream in data.get("streams", []):
                    if stream.get("codec_type") == "video":
                        return float(stream.get("duration", 0))
        except Exception:
            pass
        return None
