"""
Service: AnalysisOrchestratorService
Orchestre le pipeline complet d'analyse vidéo :
  1. Extraction audio + frames
  2. Analyse NLP (Groq)
  3. Analyse Vision (YOLO)
  4. Scoring pondéré
  5. Persistance du rapport
"""
import time
import asyncio
from datetime import datetime

from app.dao.entities.video_submission import VideoSubmission
from app.dao.entities.analysis_report import AnalysisReport, PhaseScore, PHASES
from app.dao.repositories.video_submission_repository import VideoSubmissionRepository
from app.dao.repositories.analysis_report_repository import AnalysisReportRepository
from app.services.nlp_analysis_service import NLPAnalysisService
from app.services.vision_analysis_service import VisionAnalysisService
from app.services.scoring_service import ScoringService


class AnalysisOrchestratorService:

    def __init__(self):
        self.submission_repo = VideoSubmissionRepository()
        self.report_repo = AnalysisReportRepository()
        self.nlp_service = NLPAnalysisService()
        self.vision_service = VisionAnalysisService()
        self.scoring_service = ScoringService()

    async def process_submission(self, submission_id: str) -> AnalysisReport:
        """Point d'entrée principal du pipeline d'analyse."""
        start_time = time.time()

        # Récupération de la soumission
        submission = await self.submission_repo.find_by_id(submission_id)
        if not submission:
            raise ValueError(f"Soumission introuvable: {submission_id}")

        # Mise à jour statut → processing
        await self.submission_repo.update_status(
            submission_id, VideoSubmission.STATUS_PROCESSING
        )

        try:
            # ── Étape 1 : Analyse NLP et Vision en parallèle ──────────────
            nlp_task = asyncio.create_task(
                self.nlp_service.analyze(submission.file_path)
            )
            vision_task = asyncio.create_task(
                self.vision_service.analyze(submission.file_path)
            )
            nlp_result, vision_result = await asyncio.gather(nlp_task, vision_task)

            # ── Étape 2 : Scoring pondéré par phase ───────────────────────
            phase_scores = self.scoring_service.compute_phase_scores(
                nlp_result, vision_result
            )

            # ── Étape 3 : Score global et classification ──────────────────
            global_score, technical_score, soft_score = (
                self.scoring_service.compute_global_score(phase_scores)
            )
            hire_classification = self.scoring_service.classify(global_score, phase_scores)

            # ── Étape 4 : Red flags globaux ───────────────────────────────
            global_red_flags = self.scoring_service.aggregate_red_flags(
                nlp_result, vision_result, phase_scores
            )

            # ── Étape 5 : Insights textuels globaux ───────────────────────
            global_insights = await self.nlp_service.generate_global_insights(
                nlp_result, phase_scores, hire_classification
            )

            # ── Étape 6 : Construction et persistance du rapport ──────────
            processing_duration = time.time() - start_time
            report = AnalysisReport(
                submission_id=submission_id,
                user_id=submission.user_id,
                listing_id=submission.listing_id,
                application_id=submission.application_id,
                phase_scores=phase_scores,
                global_score=global_score,
                technical_score=technical_score,
                soft_score=soft_score,
                hire_classification=hire_classification,
                full_transcript=nlp_result.get("full_transcript", ""),
                global_red_flags=global_red_flags,
                global_insights=global_insights,
                processing_duration_seconds=processing_duration,
            )
            await self.report_repo.create(report)

            # Mise à jour statut → completed
            await self.submission_repo.update_status(
                submission_id, VideoSubmission.STATUS_COMPLETED
            )

            return report

        except Exception as e:
            await self.submission_repo.update_status(
                submission_id,
                VideoSubmission.STATUS_FAILED,
                error_message=str(e),
            )
            raise