import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import api from "../services/api";
import RadarChart from "../components/interview/RadarChart";
import HireDecisionBadge from "../components/interview/HireDecisionBadge";
import PhaseScoreCard from "../components/interview/PhaseScoreCard";
import RedFlagAlerts from "../components/interview/RedFlagAlerts";
import VideoPlayerWithTimestamps from "../components/interview/VideoPlayerWithTimestamps";

export default function CandidateReportPage() {
  const { applicationId } = useParams();
  const [report, setReport] = useState(null);
  const [candidate, setCandidate] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [activePhase, setActivePhase] = useState(null);

  useEffect(() => {
    api.get(`/analysis/application/${applicationId}`)
      .then(async (res) => {
        setReport(res.data);
        // Charger le profil du candidat
        try {
          const userRes = await api.get(`/users/${res.data.user_id}`);
          setCandidate(userRes.data);
        } catch {
          // Fallback si l'endpoint user n'est pas accessible
        }
      })
      .catch(() => setError("Rapport introuvable ou analyse en cours."))
      .finally(() => setLoading(false));
  }, [applicationId]);

  if (loading) return <LoadingState />;
  if (error)   return <ErrorState message={error} />;
  if (!report) return null;

  const candidateName = candidate?.profile?.full_name
    || candidate?.username
    || "Candidat";

  const radarData = report.phase_scores.map((ps) => ({
    phase: ps.phase,
    label: ps.label,
    score: ps.score,
  }));

  const dateStr = new Date(report.created_at).toLocaleDateString("fr-FR", {
    day: "numeric", month: "long", year: "numeric",
  });

  return (
    <div className="min-h-screen bg-gray-50 py-8 px-4">
      <div className="max-w-6xl mx-auto space-y-6">

        {/* En-tête */}
        <div className="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
          <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
              <p className="text-sm text-gray-400 mb-1">Rapport d'analyse comportementale IA</p>
              <h1 className="text-2xl font-bold text-gray-900">{candidateName}</h1>
              <p className="text-sm text-gray-400 mt-1">
                Traité en {report.processing_duration_seconds.toFixed(1)}s • {dateStr}
              </p>
            </div>
            <HireDecisionBadge classification={report.hire_classification} large />
          </div>
        </div>

        {/* Scores globaux */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          <ScoreCard label="Score Global"  value={report.global_score}    color="blue"   description="Score pondéré 40% technique / 60% soft skills" />
          <ScoreCard label="Soft Skills"   value={report.soft_score}      color="purple" description="Communication, empathie, leadership" />
          <ScoreCard label="Hard Skills"   value={report.technical_score} color="teal"   description="Technique, logique, expertise projet" />
        </div>

        {/* Alertes */}
        {report.global_red_flags.length > 0 && (
          <RedFlagAlerts flags={report.global_red_flags} />
        )}

        {/* Radar + Synthèse */}
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <div className="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 className="font-semibold text-gray-800 mb-4">Profil comportemental</h2>
            <RadarChart data={radarData} />
          </div>

          <div className="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col gap-4">
            <div>
              <h2 className="font-semibold text-gray-800 mb-3">Synthèse RH</h2>
              <p className="text-gray-600 leading-relaxed text-sm">{report.global_insights}</p>
            </div>

            <div className="pt-4 border-t border-gray-100 flex-1">
              <h3 className="text-sm font-semibold text-gray-500 mb-2">Transcription complète</h3>
              <div className="bg-gray-50 rounded-xl p-4 max-h-44 overflow-y-auto">
                <p className="text-sm text-gray-600 leading-relaxed italic">
                  {report.full_transcript || "Aucune transcription disponible."}
                </p>
              </div>
            </div>
          </div>
        </div>

        {/* Phases */}
        <div className="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
          <h2 className="font-semibold text-gray-800 mb-5">Analyse par phase</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {report.phase_scores.map((ps) => (
              <PhaseScoreCard
                key={ps.phase}
                phaseScore={ps}
                isActive={activePhase === ps.phase}
                onClick={() => setActivePhase(activePhase === ps.phase ? null : ps.phase)}
              />
            ))}
          </div>
        </div>

        {/* Replay */}
        <VideoPlayerWithTimestamps
          submissionId={report.submission_id}
          phases={report.phase_scores}
          activePhase={activePhase}
          onPhaseClick={setActivePhase}
        />

      </div>
    </div>
  );
}

function ScoreCard({ label, value, color, description }) {
  const colors = { blue: "bg-blue-600", purple: "bg-purple-600", teal: "bg-teal-600" };
  return (
    <div className="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center gap-4">
      <div className={`w-16 h-16 rounded-2xl ${colors[color]} flex items-center justify-center text-white text-2xl font-bold flex-shrink-0`}>
        {Math.round(value)}
      </div>
      <div className="flex-1">
        <p className="font-semibold text-gray-800">{label}</p>
        <p className="text-xs text-gray-400 mt-0.5">{description}</p>
        <div className="mt-2 w-full bg-gray-100 rounded-full h-1.5">
          <div className={`h-1.5 rounded-full ${colors[color]}`} style={{ width: `${value}%` }} />
        </div>
      </div>
    </div>
  );
}

function LoadingState() {
  return (
    <div className="min-h-screen flex items-center justify-center">
      <div className="text-center">
        <div className="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin mx-auto mb-4" />
        <p className="text-gray-500">Chargement du rapport…</p>
      </div>
    </div>
  );
}

function ErrorState({ message }) {
  return (
    <div className="min-h-screen flex items-center justify-center px-4">
      <div className="bg-red-50 border border-red-200 rounded-2xl p-8 max-w-md text-center">
        <p className="text-4xl mb-3">😕</p>
        <p className="font-semibold text-red-700">{message}</p>
      </div>
    </div>
  );
}