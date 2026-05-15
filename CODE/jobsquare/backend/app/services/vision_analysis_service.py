"""
Service: VisionAnalysisService
Analyse visuelle de la vidéo candidat via YOLO et OpenCV.
Évalue : posture, contact visuel, dynamisme, environnement, red flags visuels.
"""
import os
import asyncio
import tempfile
from typing import Dict, Any, List
from pathlib import Path


# Intervalles d'échantillonnage (en fps équivalent)
SAMPLE_RATE_FPS = 2    # Analyser 2 frames par seconde
YOLO_MODEL_PATH = os.getenv("YOLO_MODEL_PATH", "yolov8n-pose.pt")


class VisionAnalysisService:

    async def analyze(self, video_path: str) -> Dict[str, Any]:
        """
        Pipeline vision complet exécuté dans un thread pool
        pour ne pas bloquer la boucle asyncio.
        """
        loop = asyncio.get_event_loop()
        result = await loop.run_in_executor(None, self._analyze_sync, video_path)
        return result

    def _analyze_sync(self, video_path: str) -> Dict[str, Any]:
        """Analyse synchrone — à exécuter dans un thread."""
        try:
            import cv2
            return self._run_analysis(video_path)
        except ImportError:
            return self._mock_analysis()

    def _run_analysis(self, video_path: str) -> Dict[str, Any]:
        """Analyse réelle avec OpenCV + YOLO."""
        import cv2

        cap = cv2.VideoCapture(video_path)
        fps = cap.get(cv2.CAP_PROP_FPS) or 25
        total_frames = int(cap.get(cv2.CAP_PROP_FRAME_COUNT))
        duration = total_frames / fps

        # Chargement YOLO (lazy)
        yolo_model = self._load_yolo()

        # Métriques accumulées
        frames_analyzed = 0
        posture_scores = []
        eye_contact_scores = []
        hand_movement_scores = []
        multiple_persons_detected = 0
        looking_away_frames = 0
        frame_timestamps = []

        frame_idx = 0
        sample_every = max(1, int(fps / SAMPLE_RATE_FPS))

        while cap.isOpened():
            ret, frame = cap.read()
            if not ret:
                break

            if frame_idx % sample_every == 0:
                timestamp = frame_idx / fps
                metrics = self._analyze_frame(frame, yolo_model)

                posture_scores.append(metrics["posture_score"])
                eye_contact_scores.append(metrics["eye_contact_score"])
                hand_movement_scores.append(metrics["hand_movement_score"])

                if metrics["multiple_persons"]:
                    multiple_persons_detected += 1
                if metrics["eye_contact_score"] < 40:
                    looking_away_frames += 1

                frames_analyzed += 1
                frame_timestamps.append(timestamp)

            frame_idx += 1

        cap.release()

        # Calcul moyennes
        def safe_avg(lst):
            return round(sum(lst) / len(lst), 1) if lst else 50.0

        avg_posture = safe_avg(posture_scores)
        avg_eye_contact = safe_avg(eye_contact_scores)
        avg_hand_movement = safe_avg(hand_movement_scores)

        # Red flags visuels
        red_flags = []
        if multiple_persons_detected > frames_analyzed * 0.1:
            red_flags.append("Présence potentielle d'une tierce personne détectée")
        if looking_away_frames > frames_analyzed * 0.4:
            red_flags.append("Contact visuel insuffisant avec la caméra")
        if avg_posture < 40:
            red_flags.append("Posture fermée ou instabilité corporelle notable")

        return {
            "duration_seconds": round(duration, 1),
            "frames_analyzed": frames_analyzed,
            "avg_posture_score": avg_posture,
            "avg_eye_contact_score": avg_eye_contact,
            "avg_hand_movement_score": avg_hand_movement,
            "multiple_persons_ratio": (
                multiple_persons_detected / frames_analyzed if frames_analyzed else 0
            ),
            "looking_away_ratio": (
                looking_away_frames / frames_analyzed if frames_analyzed else 0
            ),
            "red_flags": red_flags,
            "confidence_score": round(
                (avg_posture * 0.4 + avg_eye_contact * 0.6), 1
            ),
            "dynamism_score": avg_hand_movement,
        }

    def _analyze_frame(self, frame, yolo_model) -> Dict[str, Any]:
        """Analyse une frame individuelle."""
        metrics = {
            "posture_score": 50.0,
            "eye_contact_score": 50.0,
            "hand_movement_score": 50.0,
            "multiple_persons": False,
        }

        if yolo_model is None:
            return metrics

        try:
            results = yolo_model(frame, verbose=False)
            if not results or len(results) == 0:
                return metrics

            result = results[0]
            keypoints = result.keypoints

            if keypoints is None or len(keypoints.data) == 0:
                return metrics

            # Plusieurs personnes détectées ?
            metrics["multiple_persons"] = len(keypoints.data) > 1

            # Analyse de la première personne détectée
            kps = keypoints.data[0].cpu().numpy()  # shape: (17, 3) — x, y, conf

            # Posture : épaules alignées + dos droit
            metrics["posture_score"] = self._score_posture(kps)

            # Contact visuel : nez centré dans le frame
            metrics["eye_contact_score"] = self._score_eye_contact(kps, frame.shape)

            # Dynamisme des mains
            metrics["hand_movement_score"] = self._score_hand_movement(kps)

        except Exception:
            pass

        return metrics

    def _score_posture(self, kps) -> float:
        """Score posture basé sur alignement épaules (indices 5, 6) et hanches (11, 12)."""
        try:
            left_shoulder = kps[5]
            right_shoulder = kps[6]
            if left_shoulder[2] > 0.3 and right_shoulder[2] > 0.3:
                shoulder_diff = abs(left_shoulder[1] - right_shoulder[1])
                # Épaules bien alignées → score élevé
                score = max(0, 100 - shoulder_diff * 2)
                return min(100.0, float(score))
        except Exception:
            pass
        return 50.0

    def _score_eye_contact(self, kps, frame_shape) -> float:
        """Score contact visuel basé sur position du nez (indice 0) dans le frame."""
        try:
            nose = kps[0]
            if nose[2] > 0.3:
                h, w = frame_shape[:2]
                # Nez centré horizontalement = bon contact visuel
                center_x = nose[0] / w
                deviation = abs(center_x - 0.5)
                score = max(0, 100 - deviation * 200)
                return min(100.0, float(score))
        except Exception:
            pass
        return 50.0

    def _score_hand_movement(self, kps) -> float:
        """Score dynamisme mains basé sur position poignets (indices 9, 10)."""
        try:
            left_wrist = kps[9]
            right_wrist = kps[10]
            if left_wrist[2] > 0.2 and right_wrist[2] > 0.2:
                # Mains visibles = dynamisme positif
                return 70.0
            elif left_wrist[2] > 0.2 or right_wrist[2] > 0.2:
                return 55.0
        except Exception:
            pass
        return 40.0

    def _load_yolo(self):
        """Charge le modèle YOLO Pose."""
        try:
            from ultralytics import YOLO
            return YOLO(YOLO_MODEL_PATH)
        except Exception:
            return None

    def _mock_analysis(self) -> Dict[str, Any]:
        """Résultats simulés si OpenCV/YOLO non disponibles (dev/test)."""
        return {
            "duration_seconds": 55.0,
            "frames_analyzed": 110,
            "avg_posture_score": 72.0,
            "avg_eye_contact_score": 68.0,
            "avg_hand_movement_score": 65.0,
            "multiple_persons_ratio": 0.0,
            "looking_away_ratio": 0.15,
            "red_flags": [],
            "confidence_score": 69.6,
            "dynamism_score": 65.0,
        }