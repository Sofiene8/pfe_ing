import os
import json
import asyncio
import tempfile
from pathlib import Path
from typing import Dict, Any

import httpx

GROQ_API_KEY = os.getenv("GROQ_API_KEY", "")
GROQ_API_URL = "https://api.groq.com/openai/v1"

PHASE_PROMPTS = {
    "introduction":         {"label": "Presentez-vous",                  "kpis": ["confiance", "clarte", "energie"],                          "weight": "soft"},
    "adaptabilite":         {"label": "Defi difficile rencontre",         "kpis": ["gestion_stress", "methode_resolution"],                    "weight": "soft"},
    "intelligence_sociale": {"label": "Gestion des conflits",             "kpis": ["empathie", "leadership", "esprit_equipe"],                 "weight": "soft"},
    "alignement":           {"label": "Pourquoi nous ?",                  "kpis": ["motivation", "connaissance_entreprise"],                   "weight": "soft"},
    "hard_skills":          {"label": "Question technique",               "kpis": ["precision", "maitrise_fondamentaux"],                      "weight": "tech"},
    "maitrise_projet":      {"label": "Expliquez votre projet",           "kpis": ["architecture", "vision_produit", "authenticite"],          "weight": "tech"},
    "mindset":              {"label": "Question de logique",              "kpis": ["abstraction", "scalabilite"],                              "weight": "tech"},
    "maturite":             {"label": "Parlez-moi d'un echec",            "kpis": ["honnetete", "capacite_apprentissage"],                     "weight": "soft"},
}


class NLPAnalysisService:

    async def analyze(self, video_path: str) -> Dict[str, Any]:
        audio_path = await self._extract_audio(video_path)
        transcript = await self._transcribe(audio_path)
        Path(audio_path).unlink(missing_ok=True)

        # Nouvelle strategie : analyse globale en une seule passe LLM
        phase_analyses = await self._analyze_all_phases(transcript)

        # Reconstruction des segments pour la compatibilite
        phase_segments = {
            phase: phase_analyses.get(phase, {}).get("transcript_excerpt", "")
            for phase in PHASE_PROMPTS
        }

        return {
            "full_transcript": transcript,
            "phase_segments": phase_segments,
            "phase_analyses": {
                phase: {
                    "score": data.get("score", 50.0),
                    "kpi_scores": data.get("kpi_scores", {}),
                    "nlp_insights": data.get("nlp_insights", ""),
                    "red_flags": data.get("red_flags", []),
                    "authenticity_score": data.get("authenticity_score", 50),
                }
                for phase, data in phase_analyses.items()
            },
        }

    async def _analyze_all_phases(self, transcript: str) -> Dict[str, Any]:
        """
        Analyse intelligente : une seule passe LLM qui evalue toutes les phases
        en tenant compte du contexte global de la transcription.
        
        Strategie intelligente :
        - Si le candidat a repondu a une question : noter son contenu
        - Si la reponse est partielle : noter ce qui est dit avec une penalite moderee
        - Si aucune reponse : score bas mais avec explication claire
        - Le LLM identifie les passages pertinents meme si non structures
        """
        if not transcript or len(transcript.strip()) < 20:
            return {phase: self._empty_phase(phase) for phase in PHASE_PROMPTS}

        phases_desc = "\n".join([
            f"- {k}: {v['label']} (KPIs: {', '.join(v['kpis'])})"
            for k, v in PHASE_PROMPTS.items()
        ])

        prompt = f"""Tu es un expert RH senior. Analyse cette transcription d'entretien video.

TRANSCRIPTION COMPLETE :
"{transcript}"

INSTRUCTIONS IMPORTANTES :
1. Le candidat devait repondre a 8 questions dans cet ordre :
{phases_desc}

2. La transcription peut etre courte ou incomplete - c'est normal.
3. Pour chaque phase, cherche dans la transcription les elements pertinents, MEME INDIRECTS.
   Exemple : une presentation qui mentionne des projets peut partiellement repondre a "maitrise_projet"
4. Si le candidat n'a clairement pas repondu a une phase, donne un score entre 15-25.
5. Si le candidat a partiellement repondu, score entre 30-60 selon la qualite.
6. Si la reponse est bonne, score entre 60-90.
7. Sois GENEREUX dans l'interpretation - cherche les elements positifs.

Reponds UNIQUEMENT en JSON valide (pas de backticks, pas de commentaires) :
{{
  "introduction": {{
    "score": <0-100>,
    "kpi_scores": {{"confiance": <0-100>, "clarte": <0-100>, "energie": <0-100>}},
    "transcript_excerpt": "<extrait pertinent ou vide>",
    "nlp_insights": "<observation concrete en 1-2 phrases>",
    "red_flags": ["<flag si pertinent>"],
    "authenticity_score": <0-100>
  }},
  "adaptabilite": {{
    "score": <0-100>,
    "kpi_scores": {{"gestion_stress": <0-100>, "methode_resolution": <0-100>}},
    "transcript_excerpt": "<extrait ou vide>",
    "nlp_insights": "<observation>",
    "red_flags": [],
    "authenticity_score": <0-100>
  }},
  "intelligence_sociale": {{
    "score": <0-100>,
    "kpi_scores": {{"empathie": <0-100>, "leadership": <0-100>, "esprit_equipe": <0-100>}},
    "transcript_excerpt": "<extrait ou vide>",
    "nlp_insights": "<observation>",
    "red_flags": [],
    "authenticity_score": <0-100>
  }},
  "alignement": {{
    "score": <0-100>,
    "kpi_scores": {{"motivation": <0-100>, "connaissance_entreprise": <0-100>}},
    "transcript_excerpt": "<extrait ou vide>",
    "nlp_insights": "<observation>",
    "red_flags": [],
    "authenticity_score": <0-100>
  }},
  "hard_skills": {{
    "score": <0-100>,
    "kpi_scores": {{"precision": <0-100>, "maitrise_fondamentaux": <0-100>}},
    "transcript_excerpt": "<extrait ou vide>",
    "nlp_insights": "<observation>",
    "red_flags": [],
    "authenticity_score": <0-100>
  }},
  "maitrise_projet": {{
    "score": <0-100>,
    "kpi_scores": {{"architecture": <0-100>, "vision_produit": <0-100>, "authenticite": <0-100>}},
    "transcript_excerpt": "<extrait ou vide>",
    "nlp_insights": "<observation>",
    "red_flags": [],
    "authenticity_score": <0-100>
  }},
  "mindset": {{
    "score": <0-100>,
    "kpi_scores": {{"abstraction": <0-100>, "scalabilite": <0-100>}},
    "transcript_excerpt": "<extrait ou vide>",
    "nlp_insights": "<observation>",
    "red_flags": [],
    "authenticity_score": <0-100>
  }},
  "maturite": {{
    "score": <0-100>,
    "kpi_scores": {{"honnetete": <0-100>, "capacite_apprentissage": <0-100>}},
    "transcript_excerpt": "<extrait ou vide>",
    "nlp_insights": "<observation>",
    "red_flags": [],
    "authenticity_score": <0-100>
  }}
}}"""

        try:
            response = await self._call_llm(prompt, max_tokens=2000)
            clean = response.strip()
            # Nettoyer les backticks markdown
            if clean.startswith("```"):
                clean = clean.split("```")[1]
                if clean.startswith("json"):
                    clean = clean[4:]
            clean = clean.strip().rstrip("```").strip()
            data = json.loads(clean)

            # Valider et normaliser chaque phase
            result = {}
            for phase, config in PHASE_PROMPTS.items():
                phase_data = data.get(phase, {})
                kpi_scores = phase_data.get("kpi_scores", {})
                # S'assurer que tous les KPIs sont presents
                for kpi in config["kpis"]:
                    if kpi not in kpi_scores:
                        kpi_scores[kpi] = 50.0
                # Calculer score moyen si non fourni
                score = phase_data.get("score")
                if not score and kpi_scores:
                    score = sum(kpi_scores.values()) / len(kpi_scores)
                result[phase] = {
                    "score": round(float(score or 50), 1),
                    "kpi_scores": {k: float(v) for k, v in kpi_scores.items()},
                    "transcript_excerpt": str(phase_data.get("transcript_excerpt", ""))[:300],
                    "nlp_insights": str(phase_data.get("nlp_insights", "Analyse disponible.")),
                    "red_flags": list(phase_data.get("red_flags", [])),
                    "authenticity_score": float(phase_data.get("authenticity_score", 50)),
                }
            return result

        except Exception as e:
            # Fallback : analyser phase par phase
            return await self._analyze_phases_individually(transcript)

    async def _analyze_phases_individually(self, transcript: str) -> Dict[str, Any]:
        """Fallback : analyse phase par phase si la passe globale echoue."""
        result = {}
        tasks = [
            self._analyze_single_phase(phase, transcript)
            for phase in PHASE_PROMPTS
        ]
        responses = await asyncio.gather(*tasks, return_exceptions=True)
        for i, phase in enumerate(PHASE_PROMPTS.keys()):
            if isinstance(responses[i], Exception):
                result[phase] = self._empty_phase(phase)
            else:
                result[phase] = responses[i]
        return result

    async def _analyze_single_phase(self, phase: str, transcript: str) -> Dict[str, Any]:
        """Analyse une phase en cherchant les elements pertinents dans toute la transcription."""
        config = PHASE_PROMPTS[phase]
        kpis = config["kpis"]
        kpi_list = "\n".join([f"- {k} (0-100)" for k in kpis])

        prompt = f"""Transcription complete d'un entretien video :
"{transcript}"

Evalue la phase "{config['label']}" en cherchant les elements pertinents dans cette transcription.
Meme si le candidat n'a pas repondu directement, cherche des indices indirects.

KPIs a evaluer :
{kpi_list}

Reponds en JSON uniquement :
{{
  "kpi_scores": {{{", ".join([f'"{k}": <score>' for k in kpis])}}},
  "transcript_excerpt": "<passage pertinent extrait>",
  "nlp_insights": "<observation concrete 1-2 phrases>",
  "red_flags": [],
  "authenticity_score": <0-100>
}}"""

        try:
            response = await self._call_llm(prompt, max_tokens=400)
            clean = response.strip().lstrip("```json").lstrip("```").rstrip("```").strip()
            data = json.loads(clean)
            kpi_scores = data.get("kpi_scores", {})
            score = sum(kpi_scores.values()) / len(kpi_scores) if kpi_scores else 50.0
            return {
                "score": round(float(score), 1),
                "kpi_scores": {k: float(v) for k, v in kpi_scores.items()},
                "transcript_excerpt": str(data.get("transcript_excerpt", ""))[:300],
                "nlp_insights": str(data.get("nlp_insights", "")),
                "red_flags": list(data.get("red_flags", [])),
                "authenticity_score": float(data.get("authenticity_score", 50)),
            }
        except Exception:
            return self._empty_phase(phase)

    async def generate_global_insights(self, nlp_result: Dict, phase_scores: list, hire_classification: str) -> str:
        transcript_summary = nlp_result.get("full_transcript", "")[:1500]
        scores_summary = {ps.phase: ps.score for ps in phase_scores}
        prompt = f"""Tu es un expert RH. Redige une synthese professionnelle de 3-4 phrases sur ce candidat.
Classification: {hire_classification}
Scores par phase: {json.dumps(scores_summary, ensure_ascii=False)}
Transcription: {transcript_summary}
Sois objectif, factuel, bienveillant et utile pour le recruteur. En francais."""
        return await self._call_llm(prompt, max_tokens=300)

    async def _extract_audio(self, video_path: str) -> str:
        audio_path = tempfile.mktemp(suffix=".mp3")
        cmd = ["ffmpeg", "-i", video_path, "-q:a", "0", "-map", "a", "-ar", "16000", "-ac", "1", audio_path, "-y", "-loglevel", "quiet"]
        proc = await asyncio.create_subprocess_exec(*cmd, stdout=asyncio.subprocess.PIPE, stderr=asyncio.subprocess.PIPE)
        await proc.communicate()
        return audio_path

    async def _transcribe(self, audio_path: str) -> str:
        if not GROQ_API_KEY:
            return "[Transcription indisponible - GROQ_API_KEY manquant]"
        async with httpx.AsyncClient(timeout=60) as client:
            with open(audio_path, "rb") as f:
                response = await client.post(
                    f"{GROQ_API_URL}/audio/transcriptions",
                    headers={"Authorization": f"Bearer {GROQ_API_KEY}"},
                    files={"file": ("audio.mp3", f, "audio/mpeg")},
                    data={"model": "whisper-large-v3", "language": "fr"},
                )
            response.raise_for_status()
            return response.json().get("text", "")

    async def _call_llm(self, prompt: str, max_tokens: int = 800) -> str:
        if not GROQ_API_KEY:
            return "{}"
        async with httpx.AsyncClient(timeout=45) as client:
            response = await client.post(
                f"{GROQ_API_URL}/chat/completions",
                headers={"Authorization": f"Bearer {GROQ_API_KEY}", "Content-Type": "application/json"},
                json={"model": "llama-3.3-70b-versatile", "messages": [{"role": "user", "content": prompt}], "temperature": 0.3, "max_tokens": max_tokens},
            )
            response.raise_for_status()
            return response.json()["choices"][0]["message"]["content"]

    def _empty_phase(self, phase: str) -> Dict[str, Any]:
        kpis = PHASE_PROMPTS[phase]["kpis"]
        return {
            "score": 20.0,
            "kpi_scores": {k: 20.0 for k in kpis},
            "transcript_excerpt": "",
            "nlp_insights": "Aucun element pertinent trouve dans la transcription pour cette phase.",
            "red_flags": ["Absence de reponse pour cette phase"],
            "authenticity_score": 50,
        }