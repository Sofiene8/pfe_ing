import { useState } from "react";
import { useParams } from "react-router-dom";
import api from "../services/api";

export default function SkillGapPage() {
  const { listingId } = useParams();
  const [result, setResult]   = useState(null);
  const [loading, setLoading] = useState(false);

  const analyze = async () => {
    setLoading(true);
    try {
      const { data } = await api.get(`/skill-gap/${listingId}`);
      setResult(data);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="max-w-3xl mx-auto p-6">
      <h1 className="text-2xl font-bold mb-4"> Analyse des compétences</h1>

      {!result && (
        <button
          onClick={analyze}
          disabled={loading}
          className="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"
        >
          {loading ? "Analyse en cours..." : "Analyser mon profil"}
        </button>
      )}

      {result && (
        <div className="space-y-6">
          {/* Score */}
          <div className="bg-white rounded-xl p-5 shadow">
            <h2 className="font-semibold text-lg mb-2">{result.listing_title}</h2>
            <div className="flex items-center gap-3">
              <div className="text-4xl font-bold text-blue-600">{result.match_score}%</div>
              <div className="text-gray-500">de correspondance</div>
            </div>
            <div className="w-full bg-gray-200 rounded-full h-3 mt-3">
              <div
                className="bg-blue-500 h-3 rounded-full"
                style={{ width: `${result.match_score}%` }}
              />
            </div>
            <p className="text-gray-600 mt-3 text-sm">{result.llm_analysis}</p>
          </div>

          {/* Compétences */}
          <div className="grid grid-cols-2 gap-4">
            <div className="bg-green-50 rounded-xl p-4">
              <h3 className="font-semibold text-green-700 mb-2"> Compétences acquises</h3>
              {result.matching_skills.length > 0
                ? result.matching_skills.map(s => (
                    <span key={s} className="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full mr-1 mb-1">{s}</span>
                  ))
                : <p className="text-sm text-gray-500">Aucune détectée</p>
              }
            </div>
            <div className="bg-red-50 rounded-xl p-4">
              <h3 className="font-semibold text-red-700 mb-2">Compétences manquantes</h3>
              {result.missing_skills.map(s => (
                <span key={s} className="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full mr-1 mb-1">{s}</span>
              ))}
            </div>
          </div>

          {/* Ressources RAG */}
          {Object.keys(result.resources).length > 0 && (
            <div className="bg-white rounded-xl p-5 shadow">
              <h3 className="font-semibold text-lg mb-3">Ressources recommandées</h3>
              {Object.entries(result.resources).map(([skill, links]) => (
                <div key={skill} className="mb-3">
                  <p className="font-medium text-gray-700 capitalize">{skill}</p>
                  <ul className="list-disc list-inside text-sm text-blue-600">
                    {links.map(l => <li key={l}>{l}</li>)}
                  </ul>
                </div>
              ))}
            </div>
          )}

          {/* Plan d'action LLM */}
          <div className="bg-blue-50 rounded-xl p-5">
            <h3 className="font-semibold text-lg mb-2">Plan d'action personnalisé</h3>
            <p className="text-gray-700 whitespace-pre-line text-sm">{result.action_plan}</p>
          </div>
        </div>
      )}
    </div>
  );
}