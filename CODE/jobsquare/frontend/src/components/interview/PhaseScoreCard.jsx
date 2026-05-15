const PHASE_ICONS = {
  introduction:         "👋",
  adaptabilite:         "🧗",
  intelligence_sociale: "🤝",
  alignement:           "🎯",
  hard_skills:          "⚙️",
  maitrise_projet:      "🏗️",
  mindset:              "🧠",
  maturite:             "🌱",
};

function getScoreStyle(score) {
  if (score >= 75) return { bar: "bg-green-500", text: "text-green-700", bg: "bg-green-50" };
  if (score >= 55) return { bar: "bg-blue-500",  text: "text-blue-700",  bg: "bg-blue-50" };
  if (score >= 40) return { bar: "bg-amber-500", text: "text-amber-700", bg: "bg-amber-50" };
  return              { bar: "bg-red-500",   text: "text-red-700",   bg: "bg-red-50" };
}

export default function PhaseScoreCard({ phaseScore: ps, isActive, onClick }) {
  const style = getScoreStyle(ps.score);
  const icon = PHASE_ICONS[ps.phase] || "📌";

  return (
    <div
      onClick={onClick}
      className={`
        rounded-2xl border cursor-pointer transition-all select-none
        ${isActive
          ? "border-blue-300 shadow-md bg-blue-50"
          : "border-gray-100 bg-white hover:border-gray-200 hover:shadow-sm"
        }
      `}
    >
      {/* Header */}
      <div className="flex items-center gap-3 p-4">
        <span className="text-2xl">{icon}</span>
        <div className="flex-1 min-w-0">
          <p className="font-semibold text-gray-800 text-sm truncate">{ps.label}</p>
          <div className="flex items-center gap-2 mt-1.5">
            <div className="flex-1 bg-gray-100 rounded-full h-1.5">
              <div
                className={`h-1.5 rounded-full transition-all ${style.bar}`}
                style={{ width: `${ps.score}%` }}
              />
            </div>
            <span className={`text-sm font-bold ${style.text}`}>
              {Math.round(ps.score)}
            </span>
          </div>
        </div>
        <span className="text-gray-300 text-sm">{isActive ? "▲" : "▼"}</span>
      </div>

      {/* Red flags mini */}
      {ps.red_flags.length > 0 && (
        <div className="px-4 pb-3 flex flex-wrap gap-1">
          {ps.red_flags.slice(0, 2).map((f, i) => (
            <span
              key={i}
              className="bg-red-50 text-red-600 border border-red-100 text-xs px-2 py-0.5 rounded-full"
            >
              ⚠ {f.length > 30 ? f.slice(0, 28) + "…" : f}
            </span>
          ))}
        </div>
      )}

      {/* Détails dépliés */}
      {isActive && (
        <div className="border-t border-gray-100 px-4 py-4 space-y-4">
          {/* KPIs */}
          <div>
            <p className="text-xs font-semibold text-gray-500 mb-2">KPIs détaillés</p>
            <div className="space-y-1.5">
              {Object.entries(ps.kpi_scores).map(([kpi, score]) => (
                <div key={kpi} className="flex items-center gap-2 text-xs">
                  <span className="text-gray-500 w-36 capitalize">
                    {kpi.replace(/_/g, " ")}
                  </span>
                  <div className="flex-1 bg-gray-100 rounded-full h-1.5">
                    <div
                      className={`h-1.5 rounded-full ${getScoreStyle(score).bar}`}
                      style={{ width: `${score}%` }}
                    />
                  </div>
                  <span className="font-semibold text-gray-700 w-6 text-right">{Math.round(score)}</span>
                </div>
              ))}
            </div>
          </div>

          {/* NLP insight */}
          {ps.nlp_insights && (
            <div>
              <p className="text-xs font-semibold text-gray-500 mb-1">Analyse discours</p>
              <p className="text-sm text-gray-600 bg-gray-50 rounded-xl p-3">{ps.nlp_insights}</p>
            </div>
          )}

          {/* Vision insight */}
          {ps.vision_insights && (
            <div>
              <p className="text-xs font-semibold text-gray-500 mb-1">Analyse visuelle</p>
              <p className="text-sm text-gray-600 bg-gray-50 rounded-xl p-3">{ps.vision_insights}</p>
            </div>
          )}

          {/* Transcript */}
          {ps.transcript_excerpt && (
            <div>
              <p className="text-xs font-semibold text-gray-500 mb-1">Extrait transcription</p>
              <blockquote className="text-sm text-gray-500 italic border-l-2 border-gray-200 pl-3">
                "{ps.transcript_excerpt}"
              </blockquote>
            </div>
          )}

          {/* Timestamp */}
          <p className="text-xs text-gray-400">
            ⏱ {ps.timestamp_start.toFixed(1)}s → {ps.timestamp_end.toFixed(1)}s
          </p>
        </div>
      )}
    </div>
  );
}