import { useRef, useEffect, useState } from "react";
import api from "../../services/api";

const PHASE_ICONS = {
  introduction: "👋", adaptabilite: "🧗", intelligence_sociale: "🤝",
  alignement: "🎯", hard_skills: "⚙️", maitrise_projet: "🏗️",
  mindset: "🧠", maturite: "🌱",
};

export default function VideoPlayerWithTimestamps({ submissionId, phases, activePhase, onPhaseClick }) {
  const videoRef = useRef(null);
  const [videoUrl, setVideoUrl] = useState(null);
  const [error, setError] = useState(false);

  // Charger la vidéo comme blob avec le token d'auth
  useEffect(() => {
    if (!submissionId) return;
    let objectUrl = null;

    api.get(`/videos/${submissionId}/stream`, { responseType: "blob" })
      .then(res => {
        objectUrl = URL.createObjectURL(res.data);
        setVideoUrl(objectUrl);
      })
      .catch(() => setError(true));

    return () => {
      if (objectUrl) URL.revokeObjectURL(objectUrl);
    };
  }, [submissionId]);

  // Naviguer à un timestamp quand une phase est sélectionnée
  useEffect(() => {
    if (activePhase && videoRef.current && videoUrl) {
      const ps = phases.find(p => p.phase === activePhase);
      if (ps) {
        videoRef.current.currentTime = ps.timestamp_start;
        videoRef.current.play().catch(() => {});
      }
    }
  }, [activePhase, phases, videoUrl]);

  return (
    <div className="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
      <div className="p-5 border-b border-gray-100">
        <h2 className="font-semibold text-gray-800">Replay vidéo</h2>
        <p className="text-xs text-gray-400 mt-0.5">
          Cliquez sur une phase pour naviguer directement dans la vidéo
        </p>
      </div>

      <div className="flex flex-col lg:flex-row">
        {/* Lecteur */}
        <div className="flex-1 bg-black min-h-48 flex items-center justify-center">
          {error ? (
            <div className="text-gray-400 text-sm text-center p-8">
              <p className="text-3xl mb-2">🎬</p>
              <p>Vidéo non disponible</p>
            </div>
          ) : !videoUrl ? (
            <div className="text-gray-400 text-sm flex items-center gap-2">
              <span className="w-5 h-5 border-2 border-gray-400 border-t-transparent rounded-full animate-spin" />
              Chargement de la vidéo…
            </div>
          ) : (
            <video
              ref={videoRef}
              src={videoUrl}
              controls
              className="w-full max-h-64 lg:max-h-80 object-contain"
            />
          )}
        </div>

        {/* Navigation phases */}
        <div className="w-full lg:w-64 border-t lg:border-t-0 lg:border-l border-gray-100 overflow-y-auto max-h-80">
          {phases.map((ps) => (
            <button
              key={ps.phase}
              onClick={() => onPhaseClick(ps.phase)}
              className={`w-full text-left px-4 py-3 border-b border-gray-50 flex items-center gap-3 hover:bg-gray-50 transition-colors ${
                activePhase === ps.phase ? "bg-blue-50 border-l-2 border-l-blue-500" : ""
              }`}
            >
              <span className="text-lg flex-shrink-0">{PHASE_ICONS[ps.phase] || "📌"}</span>
              <div className="flex-1 min-w-0">
                <p className="text-xs font-semibold text-gray-700 truncate">{ps.label}</p>
                <p className="text-xs text-gray-400">
                  {ps.timestamp_start.toFixed(0)}s — {ps.timestamp_end.toFixed(0)}s
                </p>
              </div>
              <span className={`text-xs font-bold ${
                ps.score >= 75 ? "text-green-600" :
                ps.score >= 55 ? "text-blue-600" :
                ps.score >= 40 ? "text-amber-600" : "text-red-600"
              }`}>
                {Math.round(ps.score)}
              </span>
            </button>
          ))}
        </div>
      </div>
    </div>
  );
}