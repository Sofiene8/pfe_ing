// src/components/jobs/RecommendedJobs.jsx
import { useRecommendedJobs } from "../../hooks/useRecommendations";
import RecommendedJobCard from "./RecommendedJobCard";
import { Link } from "react-router-dom";

const Skeleton = () => (
  <div className="rounded-2xl border border-slate-100 bg-white p-5 space-y-3 animate-pulse">
    <div className="h-3 w-20 rounded-full bg-slate-100" />
    <div className="h-4 w-3/4 rounded-full bg-slate-100" />
    <div className="h-3 w-1/2 rounded-full bg-slate-100" />
    <div className="h-1.5 w-full rounded-full bg-slate-100 mt-3" />
  </div>
);

export default function RecommendedJobs({ limit = 6 }) {
  const { jobs, loading, error, refetch } = useRecommendedJobs(limit);

  return (
    <section className="w-full">
      {/* Header */}
      <div className="flex items-center justify-between mb-5">
        <div>
          <h2 className="text-lg font-semibold text-slate-800">
            Recommandées pour vous
          </h2>
          <p className="text-sm text-slate-400 mt-0.5">
            Basées sur votre CV et votre profil
          </p>
        </div>
        <div className="flex items-center gap-2">
          <button
            onClick={refetch}
            className="p-2 rounded-xl text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors"
            title="Actualiser"
          >
            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
              <path strokeLinecap="round" strokeLinejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
          </button>
          <Link
            to="/jobs"
            className="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors"
          >
            Voir tout →
          </Link>
        </div>
      </div>

      {/* Error */}
      {error && (
        <div className="rounded-xl bg-red-50 border border-red-100 px-4 py-3 text-sm text-red-600 mb-4">
          {error}
        </div>
      )}

      {/* Grid */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        {loading
          ? Array.from({ length: limit }).map((_, i) => <Skeleton key={i} />)
          : jobs.length === 0
          ? (
            <div className="col-span-full text-center py-12 text-slate-400">
              <svg className="w-10 h-10 mx-auto mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
              <p className="text-sm">Aucune recommandation pour l'instant.</p>
              <p className="text-xs mt-1">Complétez votre CV pour obtenir des suggestions.</p>
              <Link
                to="/cv"
                className="mt-3 inline-block text-sm font-medium text-blue-600 hover:underline"
              >
                Compléter mon CV →
              </Link>
            </div>
          )
          : jobs.map((job, i) => (
            <RecommendedJobCard key={job._id} job={job} rank={i + 1} />
          ))}
      </div>
    </section>
  );
}
