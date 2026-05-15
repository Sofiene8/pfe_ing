import { useState, useEffect, useRef, useCallback } from "react";
import { useNavigate, useSearchParams } from "react-router-dom";
import api from "../services/api";

const STATIC_QUESTIONS = [
  { id: 1, phase: "introduction",         label: "Présentez-vous",                                    kpis: "Confiance • Clarté • Énergie" },
  { id: 2, phase: "adaptabilite",         label: "Parlez d'un défi difficile que vous avez surmonté", kpis: "Gestion du stress • Méthode de résolution" },
  { id: 3, phase: "intelligence_sociale", label: "Comment gérez-vous un conflit en équipe ?",          kpis: "Empathie • Leadership • Esprit d'équipe" },
  { id: 4, phase: "alignement",           label: "Pourquoi postulez-vous pour ce poste ?",             kpis: "Motivation • Connaissance entreprise" },
  { id: 5, phase: "hard_skills",          label: "Question technique personnalisée…",                  kpis: "Précision • Maîtrise des fondamentaux",    is_dynamic: true },
  { id: 6, phase: "maitrise_projet",      label: "Question sur votre projet…",                         kpis: "Architecture • Vision produit • Authenticité", is_dynamic: true },
  { id: 7, phase: "mindset",              label: "Problème de logique personnalisé…",                  kpis: "Abstraction • Scalabilité",               is_dynamic: true },
  { id: 8, phase: "maturite",             label: "Parlez-moi d'un échec et ce que vous en avez appris", kpis: "Honnêteté • Capacité d'apprentissage" },
];

const MAX_DURATION = 60;
const ALLOWED_TYPES = ["video/mp4", "video/webm", "video/quicktime"];

export default function VideoUploadPage() {
  const navigate = useNavigate();
  const [searchParams] = useSearchParams();
  const listingId     = searchParams.get("listing_id");
  const applicationId = searchParams.get("application_id");

  const fileInputRef = useRef(null);
  const videoRef     = useRef(null);

  const [questions, setQuestions]   = useState(STATIC_QUESTIONS);
  const [loadingQ, setLoadingQ]     = useState(true);
  const [file, setFile]             = useState(null);
  const [previewUrl, setPreviewUrl] = useState(null);
  const [duration, setDuration]     = useState(null);
  const [error, setError]           = useState("");
  const [uploading, setUploading]   = useState(false);
  const [dragOver, setDragOver]     = useState(false);

  useEffect(() => {
    if (!listingId) { setLoadingQ(false); return; }
    api.get(`/videos/questions/${listingId}`)
      .then(res => { if (res.data?.questions) setQuestions(res.data.questions); })
      .catch(() => {})
      .finally(() => setLoadingQ(false));
  }, [listingId]);

  const validateFile = useCallback((f) => {
    setError("");
    if (!ALLOWED_TYPES.includes(f.type)) { setError("Format non supporté. Utilisez MP4, WebM ou MOV."); return false; }
    if (f.size > 100 * 1024 * 1024) { setError("Fichier trop lourd (max 100 MB)."); return false; }
    return true;
  }, []);

  const handleFile = useCallback((f) => {
    if (!validateFile(f)) return;
    setFile(f);
    setPreviewUrl(URL.createObjectURL(f));
  }, [validateFile]);

  const handleDrop = (e) => { e.preventDefault(); setDragOver(false); const f = e.dataTransfer.files[0]; if (f) handleFile(f); };

  const handleVideoLoaded = () => {
    if (videoRef.current) {
      const dur = videoRef.current.duration;
      setDuration(dur);
      if (dur > MAX_DURATION) { setError(`Vidéo trop longue (${Math.round(dur)}s). Maximum : 60 secondes.`); setFile(null); setPreviewUrl(null); }
    }
  };

  const handleSubmit = async () => {
    if (!file || error) return;
    if (!listingId || !applicationId) { setError("Paramètres manquants."); return; }
    setUploading(true);
    try {
      const formData = new FormData();
      formData.append("file", file);
      formData.append("listing_id", listingId);
      formData.append("application_id", applicationId);
      const response = await api.post("/videos/upload", formData, { headers: { "Content-Type": "multipart/form-data" } });
      navigate(`/video-status/${response.data.submission_id}`);
    } catch (err) {
      setError(err.response?.data?.detail || "Erreur lors de l'envoi. Réessayez.");
    } finally {
      setUploading(false);
    }
  };

  return (
    <div className="min-h-screen bg-gray-50 py-8 px-4">
      <div className="max-w-4xl mx-auto">
        <div className="mb-8 text-center">
          <span className="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full mb-3">Analyse IA Comportementale</span>
          <h1 className="text-3xl font-bold text-gray-900 mb-2">Votre vidéo de présentation</h1>
          <p className="text-gray-500 max-w-xl mx-auto">
            Enregistrez une vidéo de <strong>maximum 1 minute</strong>. Les questions <span className="text-blue-600 font-medium">5, 6 et 7 sont personnalisées</span> selon votre profil.
          </p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 className="font-semibold text-gray-800 mb-4 flex items-center gap-2"><span>📋</span> Les 8 questions à aborder</h2>
            <div className="space-y-3">
              {questions.map((q) => (
                <div key={q.id} className={`flex gap-3 p-3 rounded-xl transition-colors ${q.is_dynamic ? "bg-blue-50 border border-blue-100" : "bg-gray-50 hover:bg-blue-50"} ${loadingQ && q.is_dynamic ? "animate-pulse" : ""}`}>
                  <span className={`flex-shrink-0 w-7 h-7 rounded-full text-white text-xs font-bold flex items-center justify-center ${q.is_dynamic ? "bg-blue-500" : "bg-blue-600"}`}>{q.id}</span>
                  <div>
                    <div className="flex items-center gap-1.5 flex-wrap">
                      <p className="text-sm font-medium text-gray-800">{loadingQ && q.is_dynamic ? "Génération en cours…" : q.label}</p>
                      {q.is_dynamic && !loadingQ && <span className="text-xs bg-blue-100 text-blue-600 px-1.5 py-0.5 rounded-full font-medium">✨ Personnalisée</span>}
                      {q.is_dynamic && loadingQ && <span className="text-xs bg-blue-100 text-blue-500 px-1.5 py-0.5 rounded-full">🤖 IA…</span>}
                    </div>
                    <p className="text-xs text-gray-400 mt-0.5">{q.kpis}</p>
                  </div>
                </div>
              ))}
            </div>
          </div>

          <div className="space-y-5">
            <div
              onDragOver={(e) => { e.preventDefault(); setDragOver(true); }}
              onDragLeave={() => setDragOver(false)}
              onDrop={handleDrop}
              onClick={() => fileInputRef.current?.click()}
              className={`border-2 border-dashed rounded-2xl p-8 text-center cursor-pointer transition-all ${dragOver ? "border-blue-500 bg-blue-50" : "border-gray-200 hover:border-blue-400 hover:bg-gray-50"} ${file && !error ? "border-green-400 bg-green-50" : ""}`}
            >
              <input ref={fileInputRef} type="file" accept="video/mp4,video/webm,video/quicktime" className="hidden" onChange={(e) => e.target.files[0] && handleFile(e.target.files[0])} />
              {file ? (
                <div className="text-green-700">
                  <div className="text-4xl mb-2">✅</div>
                  <p className="font-semibold">{file.name}</p>
                  <p className="text-sm mt-1">{duration ? `${Math.round(duration)}s` : ""} • {(file.size / 1024 / 1024).toFixed(1)} MB</p>
                  <p className="text-xs mt-2 text-green-600">Cliquez pour changer</p>
                </div>
              ) : (
                <div className="text-gray-400">
                  <div className="text-5xl mb-3">🎬</div>
                  <p className="font-medium text-gray-600">Déposez votre vidéo ici</p>
                  <p className="text-sm mt-1">ou cliquez pour parcourir</p>
                  <p className="text-xs mt-3">MP4 • WebM • MOV — Max 1 min / 100 MB</p>
                </div>
              )}
            </div>

            {error && <div className="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm flex items-start gap-2"><span>⚠️</span><span>{error}</span></div>}

            {previewUrl && !error && (
              <div className="rounded-2xl overflow-hidden bg-black shadow">
                <video ref={videoRef} src={previewUrl} controls className="w-full max-h-48 object-contain" onLoadedMetadata={handleVideoLoaded} />
              </div>
            )}

            {duration && duration <= MAX_DURATION && (
              <div className="flex items-center gap-2 text-sm">
                <div className="flex-1 bg-gray-200 rounded-full h-2">
                  <div className="bg-green-500 h-2 rounded-full" style={{ width: `${Math.min(100, (duration / MAX_DURATION) * 100)}%` }} />
                </div>
                <span className="text-gray-500 font-medium">{Math.round(duration)}s / {MAX_DURATION}s</span>
              </div>
            )}

            <button
              onClick={handleSubmit}
              disabled={!file || !!error || uploading || loadingQ}
              className={`w-full py-4 rounded-2xl font-semibold text-white text-lg transition-all ${!file || !!error || uploading || loadingQ ? "bg-gray-300 cursor-not-allowed" : "bg-blue-600 hover:bg-blue-700 shadow-lg active:scale-95"}`}
            >
              {uploading ? <span className="flex items-center justify-center gap-2"><span className="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin" />Envoi en cours…</span>
                : loadingQ ? "Chargement des questions…" : "Envoyer ma vidéo pour analyse IA →"}
            </button>
            <p className="text-xs text-center text-gray-400">🔒 Vidéo traitée de manière confidentielle.</p>
          </div>
        </div>
      </div>
    </div>
  );
}