// src/pages/CVRecommendPage.jsx
// Page de recommandation depuis un CV texte libre (accessible sans compte)
import { useState } from "react";
import { useRecommendFromCV } from "../hooks/useRecommendations";
import RecommendedJobCard from "../components/jobs/RecommendedJobCard";
import Layout from "../components/layout/Layout";

const PLACEHOLDER = `Exemple :
Développeur Full Stack avec 4 ans d'expérience.
Maîtrise de React, Node.js, Python, FastAPI et MongoDB.
Expérience en déploiement Docker et AWS.
Recherche un poste en CDI sur Casablanca ou en remote.`;

export default function CVRecommendPage() {
  const [cvText, setCvText] = useState("");
  const [topN, setTopN] = useState(10);
  const { jobs, loading, error, recommend } = useRecommendFromCV();

  const handleSubmit = (e) => {
    e.preventDefault();
    recommend(cvText, topN);
  };

  return (
    <Layout>
      <div className="max-w-5xl mx-auto px-4 py-10">
        {/* Hero */}
        <div className="mb-8">
          <span className="inline-block rounded-full bg-blue-50 border border-blue-100 px-3 py-1 text-xs font-semibold text-blue-600 mb-3">
            IA · Recommandation CV
          </span>
          <h1 className="text-2xl font-bold text-slate-800 leading-tight">
            Trouvez les offres qui correspondent à votre profil
          </h1>
          <p className="text-slate-500 mt-2 text-sm max-w-xl">
            Collez votre CV ou décrivez votre profil. Notre moteur d'IA analyse
            la correspondance avec toutes les offres actives et vous retourne
            les plus pertinentes.
          </p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-5 gap-8">
          {/* Form */}
          <form
            onSubmit={handleSubmit}
            className="lg:col-span-2 space-y-4"
          >
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1.5">
                Votre CV / profil
              </label>
              <textarea
                value={cvText}
                onChange={(e) => setCvText(e.target.value)}
                placeholder={PLACEHOLDER}
                rows={14}
                required
                className="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-transparent resize-none transition"
              />
              <p className="text-xs text-slate-400 mt-1">
                {cvText.trim().split(/\s+/).filter(Boolean).length} mots
              </p>
            </div>

            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1.5">
                Nombre de résultats
              </label>
              <select
                value={topN}
                onChange={(e) => setTopN(Number(e.target.value))}
                className="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition"
              >
                {[5, 10, 15, 20].map((n) => (
                  <option key={n} value={n}>{n} offres</option>
                ))}
              </select>
            </div>

            <button
              type="submit"
              disabled={loading || !cvText.trim()}
              className="w-full rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center justify-center gap-2"
            >
              {loading ? (
                <>
                  <svg className="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="3" strokeOpacity="0.25"/>
                    <path d="M12 2a10 10 0 019.78 7.84" stroke="currentColor" strokeWidth="3" strokeLinecap="round"/>
                  </svg>
                  Analyse en cours…
                </>
              ) : (
                <>
                  <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                    <path strokeLinecap="round" strokeLinejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                  </svg>
                  Analyser mon profil
                </>
              )}
            </button>

            {error && (
              <p className="rounded-xl bg-red-50 border border-red-100 px-4 py-3 text-sm text-red-600">
                {error}
              </p>
            )}
          </form>

          {/* Results */}
          <div className="lg:col-span-3">
            {jobs.length > 0 ? (
              <>
                <div className="flex items-center justify-between mb-4">
                  <h2 className="text-sm font-semibold text-slate-700">
                    {jobs.length} offres trouvées
                  </h2>
                  <span className="text-xs text-slate-400">
                    Triées par correspondance
                  </span>
                </div>
                <div className="space-y-3">
                  {jobs.map((job, i) => (
                    <RecommendedJobCard key={job._id || i} job={job} rank={i + 1} />
                  ))}
                </div>
              </>
            ) : !loading ? (
              <div className="h-full flex flex-col items-center justify-center text-center py-16 text-slate-300">
                <svg className="w-16 h-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={1}>
                  <path strokeLinecap="round" strokeLinejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p className="text-sm text-slate-400">
                  Collez votre CV et lancez l'analyse
                </p>
              </div>
            ) : null}
          </div>
        </div>
      </div>
    </Layout>
  );
}
