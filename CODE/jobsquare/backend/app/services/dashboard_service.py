"""
Service: DashboardService
Agrège les données pour le dashboard recruteur.
"""
from typing import List, Optional
from app.dao.repositories.analysis_report_repository import AnalysisReportRepository
from app.dao.repositories.video_submission_repository import VideoSubmissionRepository
from app.dao.entities.analysis_report import AnalysisReport


class DashboardService:

    def __init__(self):
        self.report_repo = AnalysisReportRepository()
        self.submission_repo = VideoSubmissionRepository()

    async def get_report_by_application(
        self, application_id: str
    ) -> Optional[AnalysisReport]:
        return await self.report_repo.find_by_application_id(application_id)

    async def get_report_by_submission(
        self, submission_id: str
    ) -> Optional[AnalysisReport]:
        return await self.report_repo.find_by_submission_id(submission_id)

    async def get_listing_reports(self, listing_id: str) -> List[AnalysisReport]:
        """Retourne tous les rapports pour une offre, triés par score décroissant."""
        return await self.report_repo.find_by_listing_id(listing_id)

    async def get_candidate_reports(self, user_id: str) -> List[AnalysisReport]:
        """Retourne tous les rapports d'un candidat."""
        return await self.report_repo.find_by_user_id(user_id)