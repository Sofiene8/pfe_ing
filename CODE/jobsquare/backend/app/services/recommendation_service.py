"""app/services/recommendation_service.py — Recommandations basées sur le CV"""
from typing import List, Optional
from app.dao.repositories.user_repository import UserRepository
from app.dao.repositories.listing_repository import ListingRepository


class RecommendationService:
    """
    Système de recommandation hybride :
    - Content-based : correspondance compétences CV ↔ offre
    - Collaborative : popularité + vues
    - Location-aware : priorité régionale
    """

    def __init__(self):
        self.user_repo = UserRepository()
        self.listing_repo = ListingRepository()

    async def recommend_jobs_for_user(self, user_id: str, limit: int = 10) -> List[dict]:
        user = await self.user_repo.find_by_id(user_id)
        if not user:
            return []

        cv = user.get("cv", {})
        skills = cv.get("skills", [])
        profile = user.get("profile", {})
        location = (profile.get("location") or {}).get("state")

        # Score chaque offre active
        results = await self.listing_repo.search(
            listing_type="job_offer",
            state=location,
            limit=100,
        )
        listings = results.get("items", [])

        scored = []
        for listing in listings:
            score = self._score(listing, skills, location)
            if score > 0:
                scored.append({**listing, "_score": score})

        # Tri par score décroissant
        scored.sort(key=lambda x: x["_score"], reverse=True)
        return scored[:limit]

    def _score(self, listing: dict, user_skills: List[str], user_location: Optional[str]) -> float:
        score = 0.0
        job = listing.get("job", {}) or {}
        listing_skills = [s.lower() for s in job.get("skills", [])]
        user_skills_lower = [s.lower() for s in user_skills]

        # Correspondance compétences (poids fort)
        if user_skills_lower and listing_skills:
            matched = set(user_skills_lower) & set(listing_skills)
            score += len(matched) / max(len(listing_skills), 1) * 50

        # Correspondance localisation (poids moyen)
        if user_location and job.get("location", {}) and \
                job["location"].get("state") == user_location:
            score += 25

        # Featured boost
        if listing.get("featured"):
            score += 10

        # Popularité (vues normalisées)
        views = listing.get("views", 0)
        score += min(views / 100, 10)

        return score

    async def recommend_candidates_for_listing(self, listing_id: str, limit: int = 10) -> List[dict]:
        """Pour les employeurs : candidats correspondant à une offre"""
        listing = await self.listing_repo.find_by_id(listing_id)
        if not listing:
            return []

        job = listing.get("job", {}) or {}
        skills = job.get("skills", [])
        state = (job.get("location") or {}).get("state")

        # Chercher candidats avec compétences matchantes
        candidates = []
        if skills:
            for skill in skills[:3]:  # Limiter les requêtes
                found = await self.user_repo.search_jobseekers(skill=skill, location=state, limit=30)
                candidates.extend(found)

        # Dédoublonner
        seen = set()
        unique = []
        for c in candidates:
            uid = c.get("_id")
            if uid not in seen:
                seen.add(uid)
                c.pop("password", None)
                c.pop("verification_key", None)
                c["_score"] = self._score_candidate(c, skills)
                unique.append(c)

        unique.sort(key=lambda x: x["_score"], reverse=True)
        return unique[:limit]

    def _score_candidate(self, user: dict, required_skills: List[str]) -> float:
        cv = user.get("cv", {}) or {}
        candidate_skills = [s.lower() for s in cv.get("skills", [])]
        required_lower = [s.lower() for s in required_skills]
        if not required_lower:
            return 0
        matched = set(candidate_skills) & set(required_lower)
        return len(matched) / len(required_lower) * 100