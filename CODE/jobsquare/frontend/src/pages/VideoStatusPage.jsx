import { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import api from "../services/api";

const STATUS_CONFIG = {
  pending: {
    icon: "⏳",
    label: "En attente de traitement",
    color: "text-amber-600 bg-amber-50",
    bar: "bg-amber-400",
    progress: 15,
    description: "Votre vidéo a bien été reçue. Le traitement va démarrer.",
  },
  processing: {
    icon: "🧠",
    label: "Analyse IA en cours",
    color: "text-blue-600 bg-blue-50",
    bar: "bg-blue-500",
    progress: 65,
    description: "Notre IA analyse votre discours, posture et soft skills.",
  },
  completed: {
    icon: "✅",
    label: "Analyse terminée",
    color: "text-green-600 bg-green-50",
    bar: "bg-green-500",
    progress: 100,
    description: "Votre rapport est prêt !",
  },
  failed: {
    icon: "❌",
    label: "Erreur d'analyse",
    color: "text-red-600 bg-red-50",
    bar: "bg-red-400",
    progress: 100,
    description: "Une erreur est survenue lors du traitement.",
  },
};

const STEPS = [
  { key: "upload",      label: "Vidéo reçue",           statuses: ["pending", "processing", "completed", "failed"] },
  { key: "transcribe",  label: "Transcription audio",   statuses: ["processing", "completed"] },
  { key: "nlp",         label: "Analyse du discours",   statuses: ["processing", "completed"] },
  { key: "vision",      label: "Analyse visuelle",      statuses: ["processing", "completed"] },
  { key: "scoring",     label: "Calcul des scores",     statuses: ["completed"] },
  { key: "report",      label: "Rapport généré",        statuses: ["completed"] },
];

export default function VideoStatusPage() {
  const { submissionId } = useParams();
  const navigate = useNavigate();
  const [status, setStatus] = useState("pending");
  const [error, setError] = useState(null);
  const [dots, setDots] = useState("");

  // Animation dots
  useEffect(() => {
    const interval = setInterval(() => {
      setDots((d) => (d.length >= 3 ? "" : d + "."));
    }, 500);
    return () => clearInterval(interval);
  }, []);

  // Polling toutes les 3 secondes
  useEffect(() => {
    let mounted = true;
    let timer;

    const poll = async () => {
      try {
        const res = await api.get(`/videos/${submissionId}/status`);
        const newStatus = res.data.status;
        if (mounted) {
          setStatus(newStatus);
          if (newStatus === "failed") {
            setError(res.data.error_message || "Erreur inconnue");
          }
          if (newStatus !== "completed" && newStatus !== "failed") {
            timer = setTimeout(poll, 3000);
          }
        }
      } catch (err) {
        if (mounted) {
          setError("Impossible de vérifier le statut.");
        }
      }
    };

    poll();
    return () => {
      mounted = false;
      clearTimeout(timer);
    };
  }, [submissionId]);

  const config = STATUS_CONFIG[status] || STATUS_CONFIG.pending;

  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center px-4">
      <div className="bg-white rounded-3xl shadow-sm border border-gray-100 max-w-lg w-full p-8">

        {/* Status badge */}
        <div className={`inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold mb-6 ${config.color}`}>
          <span className="text-xl">{config.icon}</span>
          {config.label}
          {status === "processing" && <span className="font-mono">{dots}</span>}
        </div>

        {/* Progress bar */}
        <div className="w-full bg-gray-100 rounded-full h-2 mb-2">
          <div
            className={`h-2 rounded-full transition-all duration-1000 ${config.bar}`}
            style={{ width: `${config.progress}%` }}
          />
        </div>
        <p className="text-sm text-gray-500 mb-8">{config.description}</p>

        {/* Steps */}
        <div className="space-y-3">
          {STEPS.map((step) => {
            const isDone = step.statuses.includes(status);
            const isActive = step.key === "transcribe" && status === "processing";
            return (
              <div
                key={step.key}
                className={`flex items-center gap-3 p-3 rounded-xl transition-all ${
                  isDone ? "bg-green-50" : "bg-gray-50"
                }`}
              >
                <span className="text-lg">
                  {isDone ? "✅" : isActive ? "⚙️" : "⬜"}
                </span>
                <span
                  className={`text-sm font-medium ${
                    isDone ? "text-green-700" : "text-gray-400"
                  }`}
                >
                  {step.label}
                  {isActive && (
                    <span className="ml-1 text-blue-500 font-mono text-xs">{dots}</span>
                  )}
                </span>
              </div>
            );
          })}
        </div>

        {/* Erreur */}
        {error && (
          <div className="mt-6 bg-red-50 border border-red-200 rounded-xl p-4 text-sm text-red-700">
            <strong>Erreur :</strong> {error}
          </div>
        )}

        {/* Actions */}
        <div className="mt-8 flex gap-3">
          {status === "completed" && (
            <button
              onClick={() => navigate(`/analysis/submission/${submissionId}`)}
              className="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-2xl transition-colors"
            >
              Voir mon rapport →
            </button>
          )}
          {status === "failed" && (
            <button
              onClick={() => navigate(-2)}
              className="flex-1 bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 rounded-2xl transition-colors"
            >
              Réessayer l'upload
            </button>
          )}
          {(status === "pending" || status === "processing") && (
            <button
              onClick={() => navigate("/applications")}
              className="flex-1 border border-gray-200 text-gray-600 font-semibold py-3 rounded-2xl hover:bg-gray-50 transition-colors"
            >
              Revenir à mes candidatures
            </button>
          )}
        </div>

        <p className="text-xs text-center text-gray-400 mt-4">
          ID : {submissionId}
        </p>
      </div>
    </div>
  );
}