// src/pages/CVDepotPage.jsx
import { useState } from 'react';
import { Link } from 'react-router-dom';
import { Upload, FileText, CheckCircle, ArrowRight, Download, Sparkles } from 'lucide-react';
import useAuthStore from '../store/authStore';
import { usersAPI, chatbotAPI } from '../services/api';
import toast from 'react-hot-toast';

export default function CVDepotPage() {
  const { user, refreshUser } = useAuthStore();
  const [uploading, setUploading] = useState(false);
  const [analyzing, setAnalyzing] = useState(false);
  const [analysis, setAnalysis] = useState('');
  const [dragOver, setDragOver] = useState(false);

  const cv = user?.cv || {};
  const hasCVFile = !!cv.uploaded_cv_path;

  const handleFile = async (file) => {
    if (!file) return;
    const allowed = ['application/pdf', 'application/msword',
      'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    if (!allowed.includes(file.type)) {
      toast.error('Format invalide. PDF ou Word uniquement.');
      return;
    }
    if (file.size > 10 * 1024 * 1024) {
      toast.error('Fichier trop volumineux (max 10 Mo)');
      return;
    }
    setUploading(true);
    try {
      await usersAPI.uploadCvFile(file);
      await refreshUser();
      toast.success('CV déposé avec succès !');
    } catch (err) {
      toast.error(err.response?.data?.detail || 'Erreur lors du dépôt');
    } finally {
      setUploading(false);
    }
  };

  const handleDrop = (e) => {
    e.preventDefault();
    setDragOver(false);
    const file = e.dataTransfer.files?.[0];
    handleFile(file);
  };

  const handleAnalyze = async () => {
    setAnalyzing(true);
    try {
      const res = await chatbotAPI.analyzeCV();
      setAnalysis(res.data.analysis);
    } catch {
      toast.error('Service d\'analyse indisponible');
    } finally {
      setAnalyzing(false);
    }
  };

  return (
    <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div className="text-center mb-8">
        <h1 className="text-3xl font-extrabold text-slate-800">Déposer mon CV</h1>
        <p className="text-slate-500 mt-2">Rendez votre profil visible auprès des recruteurs</p>
      </div>

      {/* Current CV status */}
      {hasCVFile && (
        <div className="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
          <CheckCircle size={20} className="text-green-500 shrink-0" />
          <div className="flex-1">
            <p className="text-sm font-semibold text-green-800">CV déjà déposé</p>
            <p className="text-xs text-green-600 mt-0.5">Votre CV est visible par les employeurs. Vous pouvez le remplacer en déposant un nouveau fichier.</p>
          </div>
          <a href={`${import.meta.env.VITE_API_URL?.replace('/api/v1', '') || 'http://localhost:8000'}${cv.uploaded_cv_path}`} target="_blank" rel="noreferrer"
            className="flex items-center gap-1 text-xs font-medium text-green-700 bg-white border border-green-200 px-3 py-1.5 rounded-lg hover:bg-green-50 transition">
            <Download size={12} /> Voir
          </a>
        </div>
      )}

      {/* Upload zone */}
      <div
        onDrop={handleDrop}
        onDragOver={(e) => { e.preventDefault(); setDragOver(true); }}
        onDragLeave={() => setDragOver(false)}
        className={`relative border-2 border-dashed rounded-2xl p-10 text-center transition-colors ${
          dragOver ? 'border-blue-400 bg-blue-50' : 'border-slate-300 hover:border-blue-400 hover:bg-slate-50'
        }`}
      >
        <label className="cursor-pointer block">
          <div className="flex flex-col items-center gap-3">
            <div className={`w-16 h-16 rounded-2xl flex items-center justify-center transition ${
              dragOver ? 'bg-blue-100' : 'bg-slate-100'
            }`}>
              {uploading ? (
                <div className="w-6 h-6 border-2 border-blue-600 border-t-transparent rounded-full animate-spin" />
              ) : (
                <Upload size={28} className={dragOver ? 'text-blue-600' : 'text-slate-400'} />
              )}
            </div>
            <div>
              <p className="text-base font-semibold text-slate-700">
                {uploading ? 'Envoi en cours...' : 'Glissez votre CV ici ou cliquez pour sélectionner'}
              </p>
              <p className="text-sm text-slate-500 mt-1">PDF, DOC, DOCX — Max 10 Mo</p>
            </div>
            <div className="mt-2 px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition inline-block">
              Choisir un fichier
            </div>
          </div>
          <input type="file" accept=".pdf,.doc,.docx" className="hidden" onChange={(e) => handleFile(e.target.files?.[0])} />
        </label>
      </div>

      {/* Profile completeness */}
      <div className="mt-8 bg-white rounded-xl border border-slate-200 p-6">
        <h2 className="font-semibold text-slate-800 mb-4 flex items-center gap-2">
          <FileText size={16} /> Complétude du profil
        </h2>
        {[
          { label: 'Nom complet', done: !!user?.profile?.full_name },
          { label: 'Téléphone', done: !!user?.profile?.phone },
          { label: 'Localisation', done: !!user?.profile?.location?.state },
          { label: 'Compétences', done: (cv.skills?.length || 0) > 0 },
          { label: 'Expériences', done: (cv.experiences?.length || 0) > 0 },
          { label: 'Formation', done: (cv.education?.length || 0) > 0 },
          { label: 'Fichier CV', done: hasCVFile },
        ].map(({ label, done }) => (
          <div key={label} className="flex items-center justify-between py-2.5 border-b border-slate-50 last:border-0">
            <span className="text-sm text-slate-700">{label}</span>
            {done ? (
              <span className="flex items-center gap-1 text-xs font-medium text-green-600"><CheckCircle size={13} /> Complété</span>
            ) : (
              <Link to="/profile/edit" className="text-xs font-medium text-blue-600 hover:underline flex items-center gap-1">
                Compléter <ArrowRight size={11} />
              </Link>
            )}
          </div>
        ))}
      </div>

      {/* AI Analysis */}
      <div className="mt-6 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl border border-indigo-100 p-6">
        <div className="flex items-center justify-between mb-3">
          <h2 className="font-semibold text-slate-800 flex items-center gap-2">
            <Sparkles size={16} className="text-indigo-500" /> Analyse IA de votre profil
          </h2>
          <button
            onClick={handleAnalyze}
            disabled={analyzing}
            className="text-sm font-medium px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-60 transition"
          >
            {analyzing ? 'Analyse...' : 'Analyser'}
          </button>
        </div>
        {analysis ? (
          <div className="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap bg-white rounded-lg p-4 border border-indigo-100">{analysis}</div>
        ) : (
          <p className="text-sm text-slate-600">Obtenez des recommandations personnalisées pour améliorer votre CV et augmenter vos chances d'être recruté.</p>
        )}
      </div>
    </div>
  );
}
