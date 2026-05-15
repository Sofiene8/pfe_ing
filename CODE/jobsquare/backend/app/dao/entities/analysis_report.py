"""
Entity: AnalysisReport
Représente le rapport complet d'analyse IA d'une vidéo candidat.
Contient les scores pour les 8 phases + recommandation de recrutement.
"""
from datetime import datetime
from typing import Optional
from bson import ObjectId


# Les 8 phases d'évaluation
PHASES = [
    "introduction",
    "adaptabilite",
    "intelligence_sociale",
    "alignement",
    "hard_skills",
    "maitrise_projet",
    "mindset",
    "maturite",
]

PHASE_LABELS = {
    "introduction": "Présentez-vous",
    "adaptabilite": "Défi difficile rencontré",
    "intelligence_sociale": "Gestion des conflits",
    "alignement": "Pourquoi nous ?",
    "hard_skills": "Question technique",
    "maitrise_projet": "Expliquez votre projet",
    "mindset": "Question de logique",
    "maturite": "Parlez-moi d'un échec",
}

PHASE_KPIS = {
    "introduction": ["confiance", "clarte", "energie"],
    "adaptabilite": ["gestion_stress", "methode_resolution"],
    "intelligence_sociale": ["empathie", "leadership", "esprit_equipe"],
    "alignement": ["motivation", "connaissance_entreprise"],
    "hard_skills": ["precision", "maitrise_fondamentaux"],
    "maitrise_projet": ["architecture", "vision_produit", "authenticite"],
    "mindset": ["abstraction", "scalabilite"],
    "maturite": ["honnetete", "capacite_apprentissage"],
}

# Classifications de recrutement
HIRE_STRONG = "Strong Hire"
HIRE = "Hire"
LEAN_HIRE = "Lean Hire"
NO_HIRE = "No Hire"


class PhaseScore:
    def __init__(
        self,
        phase: str,
        score: float,          # 0-100
        kpi_scores: dict,      # {kpi_name: score}
        transcript_excerpt: str,
        nlp_insights: str,
        vision_insights: str,
        red_flags: list,
        timestamp_start: float,
        timestamp_end: float,
    ):
        self.phase = phase
        self.label = PHASE_LABELS.get(phase, phase)
        self.score = score
        self.kpi_scores = kpi_scores
        self.transcript_excerpt = transcript_excerpt
        self.nlp_insights = nlp_insights
        self.vision_insights = vision_insights
        self.red_flags = red_flags
        self.timestamp_start = timestamp_start
        self.timestamp_end = timestamp_end

    def to_dict(self) -> dict:
        return {
            "phase": self.phase,
            "label": self.label,
            "score": self.score,
            "kpi_scores": self.kpi_scores,
            "transcript_excerpt": self.transcript_excerpt,
            "nlp_insights": self.nlp_insights,
            "vision_insights": self.vision_insights,
            "red_flags": self.red_flags,
            "timestamp_start": self.timestamp_start,
            "timestamp_end": self.timestamp_end,
        }

    @classmethod
    def from_dict(cls, data: dict) -> "PhaseScore":
        return cls(**{k: v for k, v in data.items() if k != "label"})


class AnalysisReport:
    COLLECTION = "analysis_reports"

    def __init__(
        self,
        submission_id: str,
        user_id: str,
        listing_id: str,
        application_id: str,
        phase_scores: list,                # list of PhaseScore
        global_score: float,               # 0-100 (pondéré 40% tech / 60% soft)
        technical_score: float,            # score technique agrégé
        soft_score: float,                 # score soft skills agrégé
        hire_classification: str,          # Strong Hire / Hire / Lean Hire / No Hire
        full_transcript: str,
        global_red_flags: list,
        global_insights: str,
        processing_duration_seconds: float,
        _id: Optional[ObjectId] = None,
        created_at: Optional[datetime] = None,
    ):
        self._id = _id or ObjectId()
        self.submission_id = submission_id
        self.user_id = user_id
        self.listing_id = listing_id
        self.application_id = application_id
        self.phase_scores = phase_scores
        self.global_score = global_score
        self.technical_score = technical_score
        self.soft_score = soft_score
        self.hire_classification = hire_classification
        self.full_transcript = full_transcript
        self.global_red_flags = global_red_flags
        self.global_insights = global_insights
        self.processing_duration_seconds = processing_duration_seconds
        self.created_at = created_at or datetime.utcnow()

    def to_dict(self) -> dict:
        return {
            "_id": self._id,
            "submission_id": self.submission_id,
            "user_id": self.user_id,
            "listing_id": self.listing_id,
            "application_id": self.application_id,
            "phase_scores": [ps.to_dict() for ps in self.phase_scores],
            "global_score": self.global_score,
            "technical_score": self.technical_score,
            "soft_score": self.soft_score,
            "hire_classification": self.hire_classification,
            "full_transcript": self.full_transcript,
            "global_red_flags": self.global_red_flags,
            "global_insights": self.global_insights,
            "processing_duration_seconds": self.processing_duration_seconds,
            "created_at": self.created_at,
        }

    @classmethod
    def from_dict(cls, data: dict) -> "AnalysisReport":
        phase_scores = [PhaseScore.from_dict(ps) for ps in data.get("phase_scores", [])]
        return cls(
            _id=data.get("_id"),
            submission_id=data["submission_id"],
            user_id=data["user_id"],
            listing_id=data["listing_id"],
            application_id=data["application_id"],
            phase_scores=phase_scores,
            global_score=data["global_score"],
            technical_score=data["technical_score"],
            soft_score=data["soft_score"],
            hire_classification=data["hire_classification"],
            full_transcript=data["full_transcript"],
            global_red_flags=data.get("global_red_flags", []),
            global_insights=data.get("global_insights", ""),
            processing_duration_seconds=data.get("processing_duration_seconds", 0),
            created_at=data.get("created_at"),
        )