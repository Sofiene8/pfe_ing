"""
Service: ScoringService
Calcule les scores pondérés pour les 8 phases.
Pondération : 40% technique / 60% soft skills.
Génère la classification : Strong Hire | Hire | Lean Hire | No Hire.
"""
from typing import Dict, Any, List, Tuple

from app.dao.entities.analysis_report import (
    PhaseScore, PHASES, PHASE_KPIS,
    HIRE_STRONG, HIRE, LEAN_HIRE, NO_HIRE,
)

# Catégories techniques vs soft par phase
TECH_PHASES = {"hard_skills", "maitrise_projet", "mindset"}
SOFT_PHASES = {"introduction", "adaptabilite", "intelligence_sociale", "alignement", "maturite"}

# Poids vision dans le score final de chaque phase (30% vision, 70% NLP)
VISION_WEIGHT = 0.30
NLP_WEIGHT = 0.70

# Timestamps estimés (début de chaque phase dans une vidéo de 60s)
PHASE_TIMESTAMPS = {
    "introduction": (0.0, 7.5),
    "adaptabilite": (7.5, 15.0),
    "intelligence_sociale": (15.0, 22.5),
    "alignement": (22.5, 30.0),
    "hard_skills": (30.0, 37.5),
    "maitrise_projet": (37.5, 45.0),
    "mindset": (45.0, 52.5),
    "maturite": (52.5, 60.0),
}


class ScoringService:

    def compute_phase_scores(
        self,
        nlp_result: Dict[str, Any],
        vision_result: Dict[str, Any],
    ) -> List[PhaseScore]:
        """
        Fusionne les résultats NLP et Vision pour chaque phase.
        Retourne une liste de PhaseScore.
        """
        phase_analyses = nlp_result.get("phase_analyses", {})
        phase_segments = nlp_result.get("phase_segments", {})
        duration = vision_result.get("duration_seconds", 60.0)

        phase_scores = []

        for phase in PHASES:
            nlp_data = phase_analyses.get(phase, {})
            nlp_score = float(nlp_data.get("score", 50.0))
            kpi_scores = nlp_data.get("kpi_scores", {})
            nlp_insights = nlp_data.get("nlp_insights", "")
            nlp_red_flags = nlp_data.get("red_flags", [])

            # Vision : interpolation sur le segment temporel de la phase
            ts_start, ts_end = self._get_phase_timestamps(phase, duration)
            vision_score = self._extract_vision_score_for_phase(
                vision_result, ts_start, ts_end
            )
            vision_insights = self._build_vision_insights(vision_result, phase)

            # Score fusionné
            fused_score = round(
                nlp_score * NLP_WEIGHT + vision_score * VISION_WEIGHT, 1
            )
            fused_score = max(0.0, min(100.0, fused_score))

            # Red flags combinés
            combined_red_flags = list(nlp_red_flags)
            if vision_result.get("avg_eye_contact_score", 100) < 40:
                combined_red_flags.append("Contact visuel insuffisant")

            phase_scores.append(
                PhaseScore(
                    phase=phase,
                    score=fused_score,
                    kpi_scores=kpi_scores,
                    transcript_excerpt=phase_segments.get(phase, "")[:300],
                    nlp_insights=nlp_insights,
                    vision_insights=vision_insights,
                    red_flags=combined_red_flags,
                    timestamp_start=ts_start,
                    timestamp_end=ts_end,
                )
            )

        return phase_scores

    def compute_global_score(
        self, phase_scores: List[PhaseScore]
    ) -> Tuple[float, float, float]:
        """
        Calcule :
        - technical_score  (moyenne phases techniques)
        - soft_score       (moyenne phases soft)
        - global_score     (40% tech + 60% soft)
        """
        tech_scores = [ps.score for ps in phase_scores if ps.phase in TECH_PHASES]
        soft_scores = [ps.score for ps in phase_scores if ps.phase in SOFT_PHASES]

        technical_score = round(
            sum(tech_scores) / len(tech_scores) if tech_scores else 50.0, 1
        )
        soft_score = round(
            sum(soft_scores) / len(soft_scores) if soft_scores else 50.0, 1
        )
        global_score = round(
            technical_score * 0.40 + soft_score * 0.60, 1
        )

        return global_score, technical_score, soft_score

    def classify(
        self, global_score: float, phase_scores: List[PhaseScore]
    ) -> str:
        """
        Classification de recrutement basée sur le score global
        et des critères disqualifiants.
        """
        # Critères disqualifiants immédiats
        critical_red_flags = self._count_critical_flags(phase_scores)
        if critical_red_flags >= 3:
            return NO_HIRE

        # Vérifier si une phase technique critique est < 30
        for ps in phase_scores:
            if ps.phase in TECH_PHASES and ps.score < 30:
                return NO_HIRE

        # Classification par score
        if global_score >= 80:
            return HIRE_STRONG
        elif global_score >= 65:
            return HIRE
        elif global_score >= 50:
            return LEAN_HIRE
        else:
            return NO_HIRE

    def aggregate_red_flags(
        self,
        nlp_result: Dict,
        vision_result: Dict,
        phase_scores: List[PhaseScore],
    ) -> List[str]:
        """Agrège tous les red flags détectés en les dédupliquant."""
        all_flags = set()

        # Red flags vision globaux
        for flag in vision_result.get("red_flags", []):
            all_flags.add(flag)

        # Red flags par phase (les plus critiques)
        for ps in phase_scores:
            for flag in ps.red_flags:
                all_flags.add(flag)

        # Red flags NLP structurels
        phase_analyses = nlp_result.get("phase_analyses", {})
        for phase, data in phase_analyses.items():
            if data.get("authenticity_score", 100) < 40:
                all_flags.add(f"Authenticité douteuse — phase {phase}")

        return list(all_flags)

    def _get_phase_timestamps(self, phase: str, duration: float) -> Tuple[float, float]:
        """Calcule les timestamps réels de la phase selon la durée totale."""
        base = PHASE_TIMESTAMPS.get(phase, (0.0, 60.0))
        ratio = duration / 60.0
        return (round(base[0] * ratio, 1), round(base[1] * ratio, 1))

    def _extract_vision_score_for_phase(
        self,
        vision_result: Dict,
        ts_start: float,
        ts_end: float,
    ) -> float:
        """
        Score vision simplifié pour une phase (utilise les moyennes globales
        car la segmentation frame-par-frame est gérée dans VisionAnalysisService).
        """
        posture = vision_result.get("avg_posture_score", 50.0)
        eye_contact = vision_result.get("avg_eye_contact_score", 50.0)
        return round(posture * 0.4 + eye_contact * 0.6, 1)

    def _build_vision_insights(self, vision_result: Dict, phase: str) -> str:
        """Construit un insight visuel textuel."""
        posture = vision_result.get("avg_posture_score", 50)
        eye_contact = vision_result.get("avg_eye_contact_score", 50)
        dynamism = vision_result.get("dynamism_score", 50)

        parts = []
        if posture >= 70:
            parts.append("Posture ouverte et assurée")
        elif posture < 50:
            parts.append("Posture fermée ou tendue")

        if eye_contact >= 70:
            parts.append("bon contact visuel avec la caméra")
        elif eye_contact < 45:
            parts.append("contact visuel insuffisant")

        if dynamism >= 65:
            parts.append("gestuelle dynamique et engagée")

        return " — ".join(parts) if parts else "Comportement visuel dans la norme"

    def _count_critical_flags(self, phase_scores: List[PhaseScore]) -> int:
        """Compte les red flags critiques toutes phases confondues."""
        critical_keywords = [
            "arrogance", "mémorisé", "aide extérieure",
            "contradiction", "authenticité douteuse"
        ]
        count = 0
        for ps in phase_scores:
            for flag in ps.red_flags:
                if any(kw in flag.lower() for kw in critical_keywords):
                    count += 1
        return count