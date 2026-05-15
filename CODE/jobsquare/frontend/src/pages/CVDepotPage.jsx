// frontend/src/pages/CVDepotPage.jsx
import { useState, useRef, useEffect } from 'react';
import { Link } from 'react-router-dom';
import {
  Upload, FileText, CheckCircle, ArrowRight, Download,
  Sparkles, RotateCcw, AlertTriangle, Info, ChevronDown,
  ChevronUp, Zap, Target, Award, TrendingUp, X
} from 'lucide-react';
import useAuthStore from '../store/authStore';
import { usersAPI } from '../services/api';
import { cvAnalysisAPI } from '../services/cvAnalysisAPI';
import toast from 'react-hot-toast';

// ─── ANALYSIS STEPS CONFIG ─────────────────────────────────────────────────────
const STEPS = [
  { id: 1, icon: '📤', label: 'Dépôt' },
  { id: 2, icon: '🔍', label: 'Extraction' },
  { id: 3, icon: '🧠', label: 'Analyse IA' },
  { id: 4, icon: '📊', label: 'Rapport' },
  { id: 5, icon: '✨', label: 'Amélioration' },
];

const ANALYZE_PHASES = [
  { step: 2, prog: 18, label: 'Lecture et extraction du texte...', sub: 'Analyse du contenu PDF/DOCX' },
  { step: 2, prog: 32, label: 'Identification des entités...', sub: 'Compétences, expériences, formation, projets' },
  { step: 3, prog: 50, label: 'Analyse sémantique IA...', sub: 'Vectorisation et comparaison au marché' },
  { step: 3, prog: 65, label: 'Comparaison aux standards...', sub: 'CV performants, exigences recruteurs, ATS' },
  { step: 4, prog: 80, label: 'Détection des problèmes...', sub: 'Score ATS, structure, mots-clés, incohérences' },
  { step: 5, prog: 93, label: 'Génération de la version améliorée...', sub: 'Réécriture optimisée par le LLM' },
];

// ─── SCORE RING SVG ────────────────────────────────────────────────────────────
function ScoreRing({ score, color }) {
  const r = 44;
  const circ = 2 * Math.PI * r;
  const offset = circ - (score / 100) * circ;
  const c = color === 'green' ? '#22c55e' : color === 'red' ? '#ef4444' : '#f59e0b';
  return (
    <div className="relative w-28 h-28 shrink-0">
      <svg className="-rotate-90 w-full h-full" viewBox="0 0 112 112">
        <circle cx="56" cy="56" r={r} fill="none" stroke="#e2e8f0" strokeWidth="10" />
        <circle cx="56" cy="56" r={r} fill="none" stroke={c} strokeWidth="10"
          strokeDasharray={circ} strokeDashoffset={offset} strokeLinecap="round"
          style={{ transition: 'stroke-dashoffset 1.5s ease' }} />
      </svg>
      <div className="absolute inset-0 flex flex-col items-center justify-center">
        <span className="text-2xl font-extrabold" style={{ color: c }}>{score}</span>
        <span className="text-xs text-slate-400">/100</span>
      </div>
    </div>
  );
}

// ─── MINI SCORE BAR ────────────────────────────────────────────────────────────
function ScoreBar({ label, value, icon }) {
  const color = value >= 70 ? 'bg-green-500' : value >= 50 ? 'bg-amber-400' : 'bg-red-400';
  const textColor = value >= 70 ? 'text-green-700' : value >= 50 ? 'text-amber-700' : 'text-red-700';
  return (
    <div className="flex items-center gap-3">
      <span className="text-xs text-slate-500 w-20 shrink-0">{icon} {label}</span>
      <div className="flex-1 bg-slate-100 rounded-full h-2 overflow-hidden">
        <div className={`h-full rounded-full ${color} transition-all duration-1000`} style={{ width: `${value}%` }} />
      </div>
      <span className={`text-xs font-bold w-8 text-right ${textColor}`}>{value}%</span>
    </div>
  );
}

// ─── TAG ──────────────────────────────────────────────────────────────────────
function Tag({ children, variant = 'default' }) {
  const v = {
    tech: 'bg-indigo-50 text-indigo-700 border-indigo-100',
    ats: 'bg-green-50 text-green-700 border-green-100',
    soft: 'bg-amber-50 text-amber-700 border-amber-100',
    missing: 'bg-red-50 text-red-600 border-red-100',
    strength: 'bg-emerald-50 text-emerald-700 border-emerald-100',
    default: 'bg-slate-50 text-slate-600 border-slate-100',
  };
  return (
    <span className={`px-2.5 py-1 rounded-lg text-xs font-medium border ${v[variant]}`}>
      {children}
    </span>
  );
}

// ─── ISSUE CARD ───────────────────────────────────────────────────────────────
function IssueCard({ issue }) {
  const [open, setOpen] = useState(false);
  const bg = { high: 'bg-red-50 border-red-200', med: 'bg-amber-50 border-amber-200', low: 'bg-blue-50 border-blue-200' };
  const badge = { high: 'bg-red-100 text-red-700', med: 'bg-amber-100 text-amber-700', low: 'bg-blue-100 text-blue-700' };
  const badgeLabel = { high: 'Critique', med: 'Important', low: 'Suggestion' };

  return (
    <div className={`rounded-xl border ${bg[issue.severity]} overflow-hidden transition-all`}>
      <button
        onClick={() => setOpen(!open)}
        className="w-full flex items-center gap-3 p-3 text-left"
      >
        <span className="text-lg shrink-0">{issue.icon}</span>
        <div className="flex-1 min-w-0">
          <div className="flex items-center gap-2 flex-wrap">
            <span className="text-sm font-semibold text-slate-800">{issue.title}</span>
            <span className={`px-2 py-0.5 rounded-full text-xs font-bold ${badge[issue.severity]}`}>
              {badgeLabel[issue.severity]}
            </span>
            {issue.category && (
              <span className="px-2 py-0.5 rounded-full text-xs bg-slate-100 text-slate-500">
                {issue.category}
              </span>
            )}
          </div>
        </div>
        {open ? <ChevronUp size={14} className="text-slate-400 shrink-0" /> : <ChevronDown size={14} className="text-slate-400 shrink-0" />}
      </button>
      {open && (
        <div className="px-4 pb-3 border-t border-slate-100 bg-white/60">
          <p className="text-sm text-slate-600 mt-2 leading-relaxed">{issue.desc}</p>
          {issue.fix && (
            <div className="mt-2 flex gap-2 items-start bg-white rounded-lg p-2.5 border border-slate-200">
              <Zap size={13} className="text-indigo-500 mt-0.5 shrink-0" />
              <p className="text-xs text-indigo-700 font-medium">{issue.fix}</p>
            </div>
          )}
        </div>
      )}
    </div>
  );
}

// ─── IMPROVED CV PREVIEW ──────────────────────────────────────────────────────
function ImprovedCVPreview({ cv }) {
  if (!cv) return null;
  return (
    <div className="bg-white rounded-xl border border-slate-200 p-6 text-slate-800 text-sm leading-relaxed overflow-y-auto max-h-[520px]">
      {/* Header */}
      <div className="border-b-2 border-indigo-600 pb-4 mb-5">
        <h2 className="text-xl font-extrabold text-slate-900">{cv.name || '—'}</h2>
        <p className="text-indigo-600 font-semibold mt-0.5">{cv.title}</p>
        <p className="text-slate-400 text-xs mt-1">{cv.contact}</p>
      </div>

      {/* Summary */}
      {cv.summary && (
        <section className="mb-5">
          <h3 className="cv-section-title">Résumé Professionnel</h3>
          <p className="text-slate-700">{cv.summary}</p>
        </section>
      )}

      {/* Experiences */}
      {cv.experiences?.length > 0 && (
        <section className="mb-5">
          <h3 className="cv-section-title">Expériences Professionnelles</h3>
          {cv.experiences.map((exp, i) => (
            <div key={i} className="mb-4">
              <div className="flex justify-between items-start flex-wrap gap-1">
                <div>
                  <p className="font-bold text-slate-900">{exp.role}</p>
                  <p className="text-slate-600 text-xs">{exp.company}</p>
                </div>
                <span className="text-xs text-slate-400 bg-slate-50 border border-slate-100 px-2 py-0.5 rounded-md">{exp.period}</span>
              </div>
              <ul className="mt-2 space-y-1 list-none">
                {exp.bullets?.map((b, j) => (
                  <li key={j} className="text-slate-600 flex gap-2">
                    <span className="text-indigo-400 mt-1 shrink-0">▸</span>
                    <span>{b}</span>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </section>
      )}

      {/* Education */}
      {cv.education?.length > 0 && (
        <section className="mb-5">
          <h3 className="cv-section-title">Formation</h3>
          {cv.education.map((e, i) => (
            <div key={i} className="flex justify-between items-baseline flex-wrap">
              <div>
                <p className="font-semibold">{e.degree}</p>
                <p className="text-slate-500 text-xs">{e.school}</p>
              </div>
              <span className="text-xs text-slate-400">{e.year}</span>
            </div>
          ))}
        </section>
      )}

      {/* Skills */}
      {cv.skills?.length > 0 && (
        <section className="mb-5">
          <h3 className="cv-section-title">Compétences</h3>
          <div className="flex flex-wrap gap-1.5">
            {cv.skills.map((s, i) => (
              <span key={i} className="bg-indigo-50 text-indigo-700 border border-indigo-100 px-2.5 py-1 rounded-lg text-xs font-medium">{s}</span>
            ))}
          </div>
        </section>
      )}

      {/* Projects */}
      {cv.projects?.length > 0 && (
        <section className="mb-5">
          <h3 className="cv-section-title">Projets</h3>
          {cv.projects.map((p, i) => (
            <div key={i} className="mb-2">
              <p className="font-semibold">{p.name || p}</p>
              {p.desc && <p className="text-slate-500 text-xs">{p.desc}</p>}
            </div>
          ))}
        </section>
      )}

      {/* Certifications */}
      {cv.certifications?.length > 0 && (
        <section className="mb-5">
          <h3 className="cv-section-title">Certifications</h3>
          {cv.certifications.map((c, i) => <p key={i} className="text-slate-700">{c}</p>)}
        </section>
      )}

      {/* Languages */}
      {cv.languages?.length > 0 && (
        <section>
          <h3 className="cv-section-title">Langues</h3>
          <div className="flex flex-wrap gap-1.5">
            {cv.languages.map((l, i) => (
              <span key={i} className="bg-slate-50 border border-slate-100 text-slate-600 px-2.5 py-1 rounded-lg text-xs">{l}</span>
            ))}
          </div>
        </section>
      )}

      <style>{`
        .cv-section-title {
          font-size: 0.7rem;
          font-weight: 700;
          text-transform: uppercase;
          letter-spacing: 0.1em;
          color: #6366f1;
          border-bottom: 1px solid #e0e7ff;
          padding-bottom: 4px;
          margin-bottom: 10px;
        }
      `}</style>
    </div>
  );
}

// ─── DOWNLOAD HELPERS ──────────────────────────────────────────────────────────
function buildTxtCV(imp) {
  let txt = `${imp.name}\n${imp.title}\n${imp.contact}\n${'═'.repeat(50)}\n\n`;
  txt += `RÉSUMÉ PROFESSIONNEL\n${'─'.repeat(30)}\n${imp.summary}\n\n`;
  if (imp.experiences?.length) {
    txt += `EXPÉRIENCES PROFESSIONNELLES\n${'─'.repeat(30)}\n`;
    imp.experiences.forEach(e => {
      txt += `\n${e.role} — ${e.company} (${e.period})\n`;
      e.bullets?.forEach(b => (txt += `  ▸ ${b}\n`));
    });
    txt += '\n';
  }
  if (imp.education?.length) {
    txt += `FORMATION\n${'─'.repeat(30)}\n`;
    imp.education.forEach(e => (txt += `${e.degree} — ${e.school} (${e.year})\n`));
    txt += '\n';
  }
  if (imp.skills?.length) txt += `COMPÉTENCES\n${'─'.repeat(30)}\n${imp.skills.join(' | ')}\n\n`;
  if (imp.certifications?.length) txt += `CERTIFICATIONS\n${'─'.repeat(30)}\n${imp.certifications.join('\n')}\n\n`;
  if (imp.languages?.length) txt += `LANGUES\n${'─'.repeat(30)}\n${imp.languages.join(' | ')}\n`;
  return txt;
}

// ─── MAIN PAGE ─────────────────────────────────────────────────────────────────
export default function CVDepotPage() {
  const { user, refreshUser } = useAuthStore();
  const [uploading, setUploading] = useState(false);
  const [dragOver, setDragOver] = useState(false);

  // Analysis state
  const [analysisPhase, setAnalysisPhase] = useState('idle'); // idle | analyzing | done | error
  const [progress, setProgress] = useState(0);
  const [currentStep, setCurrentStep] = useState(1);
  const [phaseLabel, setPhaseLabel] = useState('');
  const [phaseSub, setPhaseSub] = useState('');
  const [analysisResult, setAnalysisResult] = useState(null);
  const [activeTab, setActiveTab] = useState('issues');
  const phaseIntervalRef = useRef(null);

  const cv = user?.cv || {};
  const hasCVFile = !!cv.uploaded_cv_path;

  // Load saved analysis on mount
  useEffect(() => {
    if (hasCVFile) {
      cvAnalysisAPI.getSavedAnalysis()
        .then(res => {
          if (res.data?.analysis) {
            setAnalysisResult(res.data.analysis);
            setAnalysisPhase('done');
          }
        })
        .catch(() => {});
    }
  }, [hasCVFile]);

  // ── Upload CV file (profile) ─────────────────────────────────────────────
  const handleFileUpload = async (file) => {
    if (!file) return;
    const allowed = ['application/pdf', 'application/msword',
      'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    if (!allowed.includes(file.type) && !file.name.match(/\.(pdf|doc|docx)$/i)) {
      toast.error('Format invalide. PDF ou Word uniquement.'); return;
    }
    if (file.size > 10 * 1024 * 1024) { toast.error('Fichier trop volumineux (max 10 Mo)'); return; }

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

  // ── Animate phases while waiting for LLM ─────────────────────────────────
  const animatePhases = () => {
    let idx = 0;
    phaseIntervalRef.current = setInterval(() => {
      if (idx < ANALYZE_PHASES.length) {
        const p = ANALYZE_PHASES[idx];
        setCurrentStep(p.step);
        setProgress(p.prog);
        setPhaseLabel(p.label);
        setPhaseSub(p.sub);
        idx++;
      }
    }, 900);
  };

  // ── Trigger LLM analysis ──────────────────────────────────────────────────
  const handleAnalyze = async (fileOverride = null) => {
    setAnalysisPhase('analyzing');
    setProgress(5);
    setCurrentStep(1);
    setPhaseLabel('Préparation de l\'analyse...');
    setPhaseSub('Connexion au service IA');
    setAnalysisResult(null);

    animatePhases();

    try {
      let res;
      if (fileOverride) {
        res = await cvAnalysisAPI.uploadAndAnalyze(fileOverride);
      } else {
        res = await cvAnalysisAPI.analyzeExistingCV();
      }

      clearInterval(phaseIntervalRef.current);
      setProgress(100);
      setCurrentStep(5);
      setPhaseLabel('Analyse terminée !');
      setAnalysisResult(res.data.analysis);

      setTimeout(() => {
        setAnalysisPhase('done');
        setActiveTab('issues');
      }, 500);

    } catch (err) {
      clearInterval(phaseIntervalRef.current);
      const msg = err.response?.data?.detail || 'Erreur lors de l\'analyse IA';
      toast.error(msg);
      setAnalysisPhase(hasCVFile ? 'idle' : 'error');
    }
  };

  // ── Analyze from upload zone (upload + analyze) ───────────────────────────
  const handleAnalyzeFile = async (file) => {
    if (!file) return;
    const allowed = ['application/pdf', 'application/msword',
      'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    if (!allowed.includes(file.type) && !file.name.match(/\.(pdf|doc|docx)$/i)) {
      toast.error('Format invalide. PDF ou Word uniquement.'); return;
    }
    if (file.size > 10 * 1024 * 1024) { toast.error('Fichier trop volumineux (max 10 Mo)'); return; }
    await handleAnalyze(file);
  };

  const handleReset = () => {
    clearInterval(phaseIntervalRef.current);
    setAnalysisPhase('idle');
    setAnalysisResult(null);
    setProgress(0);
    setCurrentStep(1);
  };

  const downloadCV = () => {
    if (!analysisResult?.improved_cv) return;
    const txt = buildTxtCV(analysisResult.improved_cv);
    const blob = new Blob([txt], { type: 'text/plain;charset=utf-8' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'CV_Ameliore_IA.txt';
    a.click();
    toast.success('CV amélioré téléchargé !');
  };

  // ── Render ─────────────────────────────────────────────────────────────────
  return (
    <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

      {/* Header */}
      <div className="text-center mb-8">
        <h1 className="text-3xl font-extrabold text-slate-800">Déposer mon CV</h1>
        <p className="text-slate-500 mt-2">Rendez votre profil visible auprès des recruteurs</p>
      </div>

      {/* CV Status */}
      {hasCVFile && (
        <div className="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
          <CheckCircle size={20} className="text-green-500 shrink-0" />
          <div className="flex-1">
            <p className="text-sm font-semibold text-green-800">CV déjà déposé</p>
            <p className="text-xs text-green-600 mt-0.5">Visible par les employeurs. Déposez un nouveau fichier pour le remplacer.</p>
          </div>
          <a href={`${import.meta.env.VITE_API_URL?.replace('/api/v1', '') || 'http://localhost:8000'}${cv.uploaded_cv_path}`}
            target="_blank" rel="noreferrer"
            className="flex items-center gap-1 text-xs font-medium text-green-700 bg-white border border-green-200 px-3 py-1.5 rounded-lg hover:bg-green-50 transition">
            <Download size={12} /> Voir
          </a>
        </div>
      )}

      {/* Upload Zone */}
      <div
        onDrop={(e) => { e.preventDefault(); setDragOver(false); handleFileUpload(e.dataTransfer.files?.[0]); }}
        onDragOver={(e) => { e.preventDefault(); setDragOver(true); }}
        onDragLeave={() => setDragOver(false)}
        className={`relative border-2 border-dashed rounded-2xl p-10 text-center transition-colors ${
          dragOver ? 'border-blue-400 bg-blue-50' : 'border-slate-300 hover:border-blue-400 hover:bg-slate-50'
        }`}
      >
        <label className="cursor-pointer block">
          <div className="flex flex-col items-center gap-3">
            <div className={`w-16 h-16 rounded-2xl flex items-center justify-center transition ${dragOver ? 'bg-blue-100' : 'bg-slate-100'}`}>
              {uploading
                ? <div className="w-6 h-6 border-2 border-blue-600 border-t-transparent rounded-full animate-spin" />
                : <Upload size={28} className={dragOver ? 'text-blue-600' : 'text-slate-400'} />
              }
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
          <input type="file" accept=".pdf,.doc,.docx" className="hidden"
            onChange={(e) => handleFileUpload(e.target.files?.[0])} />
        </label>
      </div>

      {/* Profile Completeness */}
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
            {done
              ? <span className="flex items-center gap-1 text-xs font-medium text-green-600"><CheckCircle size={13} /> Complété</span>
              : <Link to="/profile/edit" className="text-xs font-medium text-blue-600 hover:underline flex items-center gap-1">Compléter <ArrowRight size={11} /></Link>
            }
          </div>
        ))}
      </div>

      {/* ═══════════════ AI ANALYSIS SECTION ═══════════════ */}
      <div className="mt-8">

        {/* ── IDLE ── */}
        {analysisPhase === 'idle' && (
          <div className="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100 p-6">
            <div className="flex items-center gap-2 mb-3">
              <Sparkles size={18} className="text-indigo-500" />
              <h2 className="font-bold text-slate-800 text-lg">Analyse IA de votre CV</h2>
            </div>
            <p className="text-sm text-slate-600 mb-5 leading-relaxed">
              Notre IA analyse votre CV en profondeur : extraction des compétences, score ATS, comparaison au marché,
              détection des problèmes et génération automatique d'une version améliorée.
            </p>

            {hasCVFile ? (
              <button onClick={() => handleAnalyze()}
                className="flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition text-sm">
                <Zap size={16} /> Analyser mon CV avec l'IA
              </button>
            ) : (
              <div>
                <p className="text-sm font-semibold text-slate-700 mb-3">
                  Ou analysez directement un fichier :
                </p>
                <label className="cursor-pointer inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition text-sm">
                  <Upload size={16} /> Choisir un CV à analyser
                  <input type="file" accept=".pdf,.doc,.docx" className="hidden"
                    onChange={(e) => handleAnalyzeFile(e.target.files?.[0])} />
                </label>
              </div>
            )}
          </div>
        )}

        {/* ── ANALYZING ── */}
        {analysisPhase === 'analyzing' && (
          <div className="bg-white rounded-2xl border border-slate-200 p-8">
            {/* Steps */}
            <div className="flex gap-1 mb-8 bg-slate-50 rounded-xl p-1.5 border border-slate-100">
              {STEPS.map(s => (
                <div key={s.id} className={`flex-1 py-2 px-2 rounded-lg text-center text-xs font-semibold transition-all flex items-center justify-center gap-1 ${
                  s.id < currentStep ? 'bg-green-100 text-green-700' :
                  s.id === currentStep ? 'bg-indigo-600 text-white shadow-sm' :
                  'text-slate-400'
                }`}>
                  <span>{s.id < currentStep ? '✓' : s.icon}</span>
                  <span className="hidden sm:inline">{s.label}</span>
                </div>
              ))}
            </div>

            {/* Animated icon */}
            <div className="text-center mb-6">
              <div className="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-500
                              flex items-center justify-center text-3xl mb-4 animate-pulse shadow-lg shadow-indigo-200">
                🤖
              </div>
              <h3 className="font-bold text-slate-800 text-lg">{phaseLabel}</h3>
              <p className="text-slate-500 text-sm mt-1 italic">{phaseSub}</p>
            </div>

            {/* Progress bar */}
            <div className="bg-slate-100 rounded-full h-2 overflow-hidden">
              <div className="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full transition-all duration-700"
                   style={{ width: `${progress}%` }} />
            </div>
            <p className="text-center text-xs text-slate-400 mt-2">{progress}% — Cela peut prendre 20-30 secondes</p>
          </div>
        )}

        {/* ── DONE ── */}
        {analysisPhase === 'done' && analysisResult && (
          <div className="space-y-5">

            {/* Score Hero */}
            <div className="bg-gradient-to-br from-slate-800 to-indigo-900 rounded-2xl p-6 flex gap-6 items-center flex-wrap">
              <ScoreRing score={analysisResult.score} color={analysisResult.score_color} />
              <div className="flex-1 min-w-0">
                <p className="text-indigo-300 text-xs font-semibold uppercase tracking-wider mb-1">Score Global</p>
                <h2 className="text-white font-extrabold text-2xl mb-1">{analysisResult.score_label}</h2>
                <p className="text-indigo-200 text-sm leading-relaxed">{analysisResult.score_summary}</p>
                <div className="mt-4 space-y-2">
                  <ScoreBar label="ATS" value={analysisResult.scores_detail?.ats || 0} icon="🤖" />
                  <ScoreBar label="Structure" value={analysisResult.scores_detail?.structure || 0} icon="📐" />
                  <ScoreBar label="Contenu" value={analysisResult.scores_detail?.content || 0} icon="📝" />
                  <ScoreBar label="Mots-clés" value={analysisResult.scores_detail?.keywords || 0} icon="🔑" />
                </div>
              </div>
            </div>

            {/* Tab Bar */}
            <div className="flex gap-1.5 p-1 bg-slate-100 rounded-xl">
              {[
                { id: 'issues', icon: <AlertTriangle size={13} />, label: `Problèmes (${analysisResult.issues?.length || 0})` },
                { id: 'extracted', icon: <Target size={13} />, label: 'Données extraites' },
                { id: 'market', icon: <TrendingUp size={13} />, label: 'Marché' },
                { id: 'improved', icon: <Award size={13} />, label: 'CV amélioré' },
              ].map(t => (
                <button key={t.id} onClick={() => setActiveTab(t.id)}
                  className={`flex-1 py-2 px-2 rounded-lg text-xs font-semibold flex items-center justify-center gap-1.5 transition-all ${
                    activeTab === t.id ? 'bg-white text-indigo-700 shadow-sm' : 'text-slate-500 hover:text-slate-700'
                  }`}>
                  {t.icon} <span className="hidden sm:inline">{t.label}</span>
                  <span className="sm:hidden">{t.label.split(' ')[0]}</span>
                </button>
              ))}
            </div>

            {/* Tab: Issues */}
            {activeTab === 'issues' && (
              <div className="bg-white rounded-xl border border-slate-200 p-5 space-y-2">
                <h3 className="font-semibold text-slate-800 mb-4 flex items-center gap-2 text-sm">
                  <AlertTriangle size={15} className="text-amber-500" />
                  Problèmes détectés & recommandations
                </h3>
                {analysisResult.issues?.length
                  ? analysisResult.issues.map((issue, i) => <IssueCard key={i} issue={issue} />)
                  : <p className="text-sm text-green-600 flex items-center gap-2"><CheckCircle size={14} /> Aucun problème majeur détecté !</p>
                }
              </div>
            )}

            {/* Tab: Extracted */}
            {activeTab === 'extracted' && (
              <div className="bg-white rounded-xl border border-slate-200 p-5 space-y-5">
                {/* Info grid */}
                <div className="grid grid-cols-2 sm:grid-cols-3 gap-3">
                  {[
                    ['👤', 'Nom', analysisResult.extracted?.name],
                    ['💼', 'Titre', analysisResult.extracted?.title],
                    ['📅', 'Expérience', analysisResult.extracted?.years_experience],
                    ['🎓', 'Formation', analysisResult.extracted?.education_level],
                    ['📍', 'Localisation', analysisResult.extracted?.location],
                    ['🌐', 'Langues', analysisResult.extracted?.languages?.join(', ')],
                  ].map(([icon, label, val]) => (
                    <div key={label} className="bg-slate-50 rounded-xl p-3 border border-slate-100">
                      <p className="text-xs text-slate-400 mb-0.5">{icon} {label}</p>
                      <p className="text-sm font-semibold text-slate-700 truncate">{val || '—'}</p>
                    </div>
                  ))}
                </div>

                {/* Skills */}
                {analysisResult.extracted?.skills_tech?.length > 0 && (
                  <div>
                    <p className="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Compétences techniques</p>
                    <div className="flex flex-wrap gap-1.5">
                      {analysisResult.extracted.skills_tech.map(s => <Tag key={s} variant="tech">{s}</Tag>)}
                    </div>
                  </div>
                )}
                {analysisResult.extracted?.skills_soft?.length > 0 && (
                  <div>
                    <p className="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Soft Skills</p>
                    <div className="flex flex-wrap gap-1.5">
                      {analysisResult.extracted.skills_soft.map(s => <Tag key={s} variant="soft">{s}</Tag>)}
                    </div>
                  </div>
                )}
                {analysisResult.extracted?.ats_keywords?.length > 0 && (
                  <div>
                    <p className="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Mots-clés ATS présents</p>
                    <div className="flex flex-wrap gap-1.5">
                      {analysisResult.extracted.ats_keywords.map(k => <Tag key={k} variant="ats">{k}</Tag>)}
                    </div>
                  </div>
                )}
                {analysisResult.extracted?.certifications?.length > 0 && (
                  <div>
                    <p className="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Certifications</p>
                    <div className="flex flex-wrap gap-1.5">
                      {analysisResult.extracted.certifications.map(c => <Tag key={c}>{c}</Tag>)}
                    </div>
                  </div>
                )}
              </div>
            )}

            {/* Tab: Market */}
            {activeTab === 'market' && (
              <div className="bg-white rounded-xl border border-slate-200 p-5 space-y-5">
                {analysisResult.market_comparison?.strengths?.length > 0 && (
                  <div>
                    <p className="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 flex items-center gap-1">
                      <CheckCircle size={12} className="text-green-500" /> Points forts
                    </p>
                    <div className="flex flex-wrap gap-1.5">
                      {analysisResult.market_comparison.strengths.map(s => <Tag key={s} variant="strength">{s}</Tag>)}
                    </div>
                  </div>
                )}
                {analysisResult.market_comparison?.missing_skills?.length > 0 && (
                  <div>
                    <p className="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 flex items-center gap-1">
                      <X size={12} className="text-red-500" /> Compétences manquantes (selon le marché)
                    </p>
                    <div className="flex flex-wrap gap-1.5">
                      {analysisResult.market_comparison.missing_skills.map(s => <Tag key={s} variant="missing">{s}</Tag>)}
                    </div>
                  </div>
                )}
                {analysisResult.market_comparison?.missing_keywords?.length > 0 && (
                  <div>
                    <p className="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 flex items-center gap-1">
                      <Info size={12} className="text-amber-500" /> Mots-clés ATS à ajouter
                    </p>
                    <div className="flex flex-wrap gap-1.5">
                      {analysisResult.market_comparison.missing_keywords.map(k => <Tag key={k} variant="missing">{k}</Tag>)}
                    </div>
                  </div>
                )}
                {analysisResult.market_comparison?.sector && (
                  <p className="text-sm text-slate-600">
                    <span className="font-semibold">Secteur détecté :</span> {analysisResult.market_comparison.sector}
                  </p>
                )}
              </div>
            )}

            {/* Tab: Improved CV */}
            {activeTab === 'improved' && (
              <div className="bg-white rounded-xl border border-slate-200 p-5">
                <div className="flex items-center justify-between mb-4 flex-wrap gap-3">
                  <h3 className="font-semibold text-slate-800 flex items-center gap-2 text-sm">
                    <Sparkles size={15} className="text-indigo-500" /> Version améliorée par l'IA
                  </h3>
                  <button onClick={downloadCV}
                    className="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-xs font-semibold rounded-xl hover:bg-indigo-700 transition">
                    <Download size={13} /> Télécharger (.txt)
                  </button>
                </div>
                <ImprovedCVPreview cv={analysisResult.improved_cv} />
              </div>
            )}

            {/* Actions */}
            <div className="flex gap-3 flex-wrap">
              <button onClick={() => handleAnalyze()}
                className="flex items-center gap-2 px-4 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition">
                <RotateCcw size={14} /> Relancer l'analyse
              </button>
              <button onClick={handleReset}
                className="flex items-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition">
                Analyser un autre fichier
              </button>
            </div>
          </div>
        )}

      </div>
    </div>
  );
}
