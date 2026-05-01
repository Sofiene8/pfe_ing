// src/components/jobs/RecommendedCandidates.jsx
// Composant employeur : liste les candidats recommandés pour une offre
import { useState, useEffect } from "react";
import { getRecommendedCandidates } from "../../services/recommendationService";

const ScorePill = ({ score }) => {
  const pct = Math.round(score * 100);
  const cls =
    pct >= 70
      ? "bg-emerald-50 text-emerald-700 border-emerald-200"
      : pct >= 45
      ? "bg-amber-50 text-amber-700 border-amber-200"
      : "bg-slate-50 text-slate-500 border-slate-200";
  return (
    <span className={`rounded-full border px-2.5 py-0.5 text-xs font-semibold ${cls}`}>
      {pct}% match
    </span>
  );
};

const Avatar = ({ name }) => {
  const initials = (name || "?")
    .split(" ")
    .slice(0, 2)
    .map((w) => w[0])
    .join("")
    .toUpperCase();
  return (
    <div className="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-700 font-semibold text-sm flex-shrink-0">
      {initials}
    </div>
  );
};

export default function RecommendedCandidates({ listingId }) {
  const [candidates, setCandidates] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    if (!listingId) return;
    setLoading(true);
    getRecommendedCandidates(listingId)
      .then(setCandidates)
      .catch((e) => setError(e?.response?.data?.detail || "Erreur"))
      .finally(() => setLoading(false));
  }, [listingId]);

  if (loading)
    return (
      <div className="space-y-3">
        {Array.from({ length: 4 }).map((_, i) => (
          <div key={i} className="h-16 rounded-xl bg-slate-100 animate-pulse" />
        ))}
      </div>
    );

  if (error)
    return (
      <p className="text-sm text-red-500 bg-red-50 rounded-xl px-4 py-3">{error}</p>
    );

  if (!candidates.length)
    return (
      <p className="text-sm text-slate-400 text-center py-8">
        Aucun candidat correspondant trouvé.
      </p>
    );

  return (
    <div className="space-y-3">
      <div className="flex items-center justify-between mb-1">
        <h3 className="text-sm font-semibold text-slate-700">
          Candidats recommandés
        </h3>
        <span className="text-xs text-slate-400">{candidates.length} profils</span>
      </div>

      {candidates.map((c, i) => {
        const name = c.FullName || c.email?.split("@")[0] || "Candidat";
        const email = c.email || "";
        const skills = Array.isArray(c.Skills || c.skills)
          ? (c.Skills || c.skills).slice(0, 3)
          : [];

        return (
          <div
            key={c._id || i}
            className="flex items-center gap-3 rounded-xl border border-slate-100 bg-white p-3 hover:shadow-sm transition"
          >
            <Avatar name={name} />
            <div className="flex-1 min-w-0">
              <p className="text-sm font-medium text-slate-800 truncate">{name}</p>
              {email && (
                <p className="text-xs text-slate-400 truncate">{email}</p>
              )}
              {skills.length > 0 && (
                <div className="flex flex-wrap gap-1 mt-1">
                  {skills.map((s) => (
                    <span
                      key={s}
                      className="rounded-full bg-slate-50 border border-slate-200 px-2 py-0.5 text-xs text-slate-500"
                    >
                      {s}
                    </span>
                  ))}
                </div>
              )}
            </div>
            <ScorePill score={c._score} />
          </div>
        );
      })}
    </div>
  );
}
