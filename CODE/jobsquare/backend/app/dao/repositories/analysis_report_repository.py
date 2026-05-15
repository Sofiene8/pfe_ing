"""
Repository: AnalysisReportRepository
Accès MongoDB pour les rapports d'analyse IA.
"""
from typing import Optional, List
from bson import ObjectId
from app.core.database import get_db
from app.dao.entities.analysis_report import AnalysisReport


class AnalysisReportRepository:

    def __init__(self):
        self.db = get_db()
        self.collection = self.db[AnalysisReport.COLLECTION]

    async def create(self, report: AnalysisReport) -> AnalysisReport:
        doc = report.to_dict()
        await self.collection.insert_one(doc)
        return report

    async def find_by_submission_id(self, submission_id: str) -> Optional[AnalysisReport]:
        doc = await self.collection.find_one({"submission_id": submission_id})
        if not doc:
            return None
        return AnalysisReport.from_dict(doc)

    async def find_by_application_id(self, application_id: str) -> Optional[AnalysisReport]:
        doc = await self.collection.find_one({"application_id": application_id})
        if not doc:
            return None
        return AnalysisReport.from_dict(doc)

    async def find_by_listing_id(self, listing_id: str) -> List[AnalysisReport]:
        cursor = self.collection.find({"listing_id": listing_id}).sort("global_score", -1)
        docs = await cursor.to_list(length=200)
        return [AnalysisReport.from_dict(d) for d in docs]

    async def find_by_user_id(self, user_id: str) -> List[AnalysisReport]:
        cursor = self.collection.find({"user_id": user_id}).sort("created_at", -1)
        docs = await cursor.to_list(length=50)
        return [AnalysisReport.from_dict(d) for d in docs]

    async def find_by_id(self, report_id: str) -> Optional[AnalysisReport]:
        doc = await self.collection.find_one({"_id": ObjectId(report_id)})
        if not doc:
            return None
        return AnalysisReport.from_dict(doc)
