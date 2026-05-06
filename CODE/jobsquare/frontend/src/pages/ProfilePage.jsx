// src/pages/ProfilePage.jsx
import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { User, Building2, MapPin, Phone, Globe, Mail, Edit2, FileText, Star, Briefcase } from 'lucide-react';
import useAuthStore from '../store/authStore';
import { usersAPI } from '../services/api';
import toast from 'react-hot-toast';

export default function ProfilePage() {
  const { user, refreshUser } = useAuthStore();
  const [analyzing, setAnalyzing] = useState(false);
  const [analysis, setAnalysis] = useState('');

  useEffect(() => { refreshUser(); }, []);

  const handleAnalyzeCV = async () => {
    setAnalyzing(true);
    try {
      const { chatbotAPI } = await import('../services/api');
      const res = await chatbotAPI.analyzeCV();
      setAnalysis(res.data.analysis);
    } catch {
      toast.error('Service d\'analyse indisponible');
    } finally {
      setAnalyzing(false);
    }
  };

  if (!user) return null;

  const profile = user.profile || {};
  const company = user.company || {};
  const cv = user.cv || {};
  const isEmployer = user.role === 'employer';

  return (
    <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      {/* Header */}
      <div className="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white mb-6 relative overflow-hidden">
        <div className="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full" />
        <div className="relative flex items-center gap-5">
          <div className="w-20 h-20 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center text-3xl font-bold border-2 border-white/30 shrink-0">
            {profile.logo ? (
              <img src={profile.logo} alt="" className="w-full h-full object-cover rounded-2xl" />
            ) : (
              (profile.full_name?.[0] || user.username?.[0] || 'U').toUpperCase()
            )}
          </div>
          <div className="flex-1 min-w-0">
            <h1 className="text-xl font-bold">{profile.full_name || user.username}</h1>
            <p className="text-blue-100 text-sm">{user.email}</p>
            <div className="flex items-center gap-2 mt-2">
              <span className={`text-xs font-medium px-2.5 py-1 rounded-full ${isEmployer ? 'bg-amber-400/20 text-amber-100' : 'bg-white/20 text-white'}`}>
                {isEmployer ? '🏢 Employeur' : '👤 Candidat'}
              </span>
              {user.featured && <span className="text-xs font-medium px-2.5 py-1 rounded-full bg-yellow-400/20 text-yellow-100"><Star size={10} className="inline" /> Vedette</span>}
            </div>
          </div>
          <Link to="/profile/edit" className="shrink-0 flex items-center gap-1.5 bg-white/20 hover:bg-white/30 text-white text-sm font-medium px-3 py-2 rounded-xl transition backdrop-blur">
            <Edit2 size={14} /> Modifier
          </Link>
        </div>
      </div>

      <div className="grid md:grid-cols-3 gap-5">
        {/* Left column */}
        <div className="space-y-4">
          {/* Contact */}
          <div className="bg-white rounded-xl border border-slate-200 p-5">
            <h3 className="font-semibold text-slate-800 mb-3 text-sm uppercase tracking-wide">Contact</h3>
            <ul className="space-y-2 text-sm text-slate-700">
              <li className="flex items-center gap-2"><Mail size={13} className="text-slate-400 shrink-0" /><span className="truncate">{user.email}</span></li>
              {profile.phone && <li className="flex items-center gap-2"><Phone size={13} className="text-slate-400 shrink-0" />{profile.phone}</li>}
              {profile.location?.state && <li className="flex items-center gap-2"><MapPin size={13} className="text-slate-400 shrink-0" />{profile.location.state}{profile.location.city ? `, ${profile.location.city}` : ''}</li>}
              {profile.website && <li className="flex items-center gap-2"><Globe size={13} className="text-slate-400 shrink-0" /><a href={profile.website} target="_blank" rel="noreferrer" className="text-blue-600 hover:underline truncate">{profile.website}</a></li>}
            </ul>
          </div>

          {/* Employer info */}
          {isEmployer && company.name && (
            <div className="bg-white rounded-xl border border-slate-200 p-5">
              <h3 className="font-semibold text-slate-800 mb-3 text-sm uppercase tracking-wide flex items-center gap-2"><Building2 size={13} /> Entreprise</h3>
              <p className="font-semibold text-slate-700 text-sm">{company.name}</p>
              {company.sector && <p className="text-xs text-slate-500 mt-1">{company.sector}</p>}
              {company.description && <p className="text-xs text-slate-600 mt-2 leading-relaxed line-clamp-4">{company.description}</p>}
            </div>
          )}

          {/* CV Skills */}
          {!isEmployer && cv.skills?.length > 0 && (
            <div className="bg-white rounded-xl border border-slate-200 p-5">
              <h3 className="font-semibold text-slate-800 mb-3 text-sm uppercase tracking-wide">Compétences</h3>
              <div className="flex flex-wrap gap-2">
                {cv.skills.map((s) => (
                  <span key={s} className="text-xs font-medium px-2.5 py-1 bg-indigo-50 text-indigo-700 rounded-full">{s}</span>
                ))}
              </div>
            </div>
          )}

          {/* Languages */}
          {!isEmployer && cv.languages?.length > 0 && (
            <div className="bg-white rounded-xl border border-slate-200 p-5">
              <h3 className="font-semibold text-slate-800 mb-3 text-sm uppercase tracking-wide">Langues</h3>
              <div className="flex flex-wrap gap-2">
                {cv.languages.map((l) => (
                  <span key={l} className="text-xs font-medium px-2.5 py-1 bg-green-50 text-green-700 rounded-full">{l}</span>
                ))}
              </div>
            </div>
          )}
        </div>

        {/* Right column */}
        <div className="md:col-span-2 space-y-4">
          {/* Experiences */}
          {!isEmployer && (
            <div className="bg-white rounded-xl border border-slate-200 p-5">
              <h3 className="font-semibold text-slate-800 mb-4 text-sm uppercase tracking-wide flex items-center gap-2"><Briefcase size={13} /> Expériences</h3>
              {cv.experiences?.length > 0 ? (
                <div className="space-y-4">
                  {cv.experiences.map((exp, i) => (
                    <div key={i} className="relative pl-5 border-l-2 border-blue-100">
                      <div class  Name="absolute -left-1.5 top-1 w-3 h-3 rounded-full bg-blue-400" />
                      <h4 className="font-semibold text-slate-800 text-sm">{exp.title}</h4>
                      <p className="text-xs text-blue-600 font-medium">{exp.company}</p>
                      {(exp.start_date || exp.end_date) && (
                        <p className="text-xs text-slate-500 mt-0.5">
                          {exp.start_date ? new Date(exp.start_date).toLocaleDateString('fr-FR', { year: 'numeric', month: 'short' }) : ''}
                          {exp.end_date ? ` → ${new Date(exp.end_date).toLocaleDateString('fr-FR', { year: 'numeric', month: 'short' })}` : ' → Présent'}
                        </p>
                      )}
                      {exp.description && <p className="text-xs text-slate-600 mt-1 leading-relaxed">{exp.description}</p>}
                    </div>
                  ))}
                </div>
              ) : (
                <p className="text-sm text-slate-400 italic">Aucune expérience renseignée. <Link to="/profile/edit" className="text-blue-600 hover:underline">Ajouter</Link></p>
              )}
            </div>
          )}

          {/* Education */}
          {!isEmployer && (
            <div className="bg-white rounded-xl border border-slate-200 p-5">
              <h3 className="font-semibold text-slate-800 mb-4 text-sm uppercase tracking-wide">Formation</h3>
              {cv.education?.length > 0 ? (
                <div className="space-y-3">
                  {cv.education.map((edu, i) => (
                    <div key={i} className="flex items-start gap-3">
                      <div className="w-8 h-8 rounded-lg bg-purple-50 border border-purple-100 flex items-center justify-center shrink-0">
                        <span className="text-xs">🎓</span>
                      </div>
                      <div>
                        <h4 className="font-semibold text-slate-800 text-sm">{edu.degree}</h4>
                        <p className="text-xs text-slate-500">{edu.institution}{edu.year ? ` · ${edu.year}` : ''}</p>
                      </div>
                    </div>
                  ))}
                </div>
              ) : (
                <p className="text-sm text-slate-400 italic">Aucune formation renseignée.</p>
              )}
            </div>
          )}

          {/* AI CV Analysis */}
          {!isEmployer && (
            <div className="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl border border-indigo-100 p-5">
              <div className="flex items-center justify-between mb-3">
                <h3 className="font-semibold text-slate-800 text-sm flex items-center gap-2">
                  <span className="text-lg">🤖</span> Analyse IA de votre profil
                </h3>
                <button
                  onClick={handleAnalyzeCV}
                  disabled={analyzing}
                  className="text-xs font-medium px-3 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-60 transition"
                >
                  {analyzing ? 'Analyse...' : 'Analyser mon CV'}
                </button>
              </div>
              {analysis ? (
                <div className="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap bg-white rounded-lg p-4 border border-indigo-100">{analysis}</div>
              ) : (
                <p className="text-sm text-slate-500">Obtenez des conseils personnalisés pour améliorer votre employabilité.</p>
              )}
            </div>
          )}

          {/* Employer quick actions */}
          {isEmployer && (
            <div className="bg-white rounded-xl border border-slate-200 p-5">
              <h3 className="font-semibold text-slate-800 mb-4 text-sm uppercase tracking-wide">Actions rapides</h3>
              <div className="grid grid-cols-2 gap-3">
                <Link to="/applications" className="flex items-center gap-2 p-3 bg-blue-50 text-blue-700 rounded-xl hover:bg-blue-100 transition text-sm font-medium">
                  <Briefcase size={15} /> Mes offres
                </Link>
                <Link to="/applications" className="flex items-center gap-2 p-3 bg-indigo-50 text-indigo-700 rounded-xl hover:bg-indigo-100 transition text-sm font-medium">
                  <User size={15} /> Candidatures
                </Link>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}
