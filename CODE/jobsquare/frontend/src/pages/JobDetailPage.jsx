// src/pages/JobDetailPage.jsx
import { useState, useEffect } from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import {
  MapPin, Clock, Briefcase, GraduationCap, Eye, Star,
  ArrowLeft, Building2, CheckCircle, Calendar
} from 'lucide-react';
import { formatDistanceToNow, format } from 'date-fns';
import { fr } from 'date-fns/locale';
import toast from 'react-hot-toast';
import { listingsAPI, applicationsAPI } from '../services/api';
import useAuthStore from '../store/authStore';
import JobCard from '../components/jobs/JobCard';
import {
  getTitle, getCategory, getContractType,
  getExperience, getSkills, getLocation, getCompanyName, getFeatured,
} from '../components/jobs/JobCard';

// ── helpers spécifiques à la page détail ──────────────────────────────────

function getDescription(j) {
  // Format A : JobDescription (HTML nettoyé)
  // Format B : EmploymentType contient la description complète
  return j.job?.description
    || j.JobDescription
    || (j.EmploymentType && j.EmploymentType.length > 100 ? j.EmploymentType : '')
    || '';
}

function getRequirements(j) {
  return j.job?.requirements || j.JobRequirements || '';
}

function getStudyLevel(j) {
  return j.job?.study_level || j.Study || '';
}

function getSalary(j) {
  if (j.job?.salary_min && j.job?.salary_max) {
    return `${j.job.salary_min} – ${j.job.salary_max} ${j.job.salary_currency || 'MAD'}`;
  }
  // Format A : dans keywords "Entre X DH et Y DH"
  const kw = j.keywords || '';
  const m = kw.match(/Entre\s+([\d\s]+DH)\s+et\s+([\d\s]+DH)/i);
  if (m) return `${m[1].trim()} – ${m[2].trim()}`;
  return '';
}

function getExpirationDate(j) {
  return j.expiration_date || j.expirationDate || null;
}

// ── component ─────────────────────────────────────────────────────────────

export default function JobDetailPage() {
  const { id } = useParams();
  const [listing, setListing] = useState(null);
  const [similar, setSimilar] = useState([]);
  const [loading, setLoading] = useState(true);
  const [applying, setApplying] = useState(false);
  const [applied, setApplied] = useState(false);
  const [showApplyModal, setShowApplyModal] = useState(false);
  const [coverLetter, setCoverLetter] = useState('');
  const { isAuthenticated, user } = useAuthStore();
  const navigate = useNavigate();

  useEffect(() => {
    setLoading(true);
    Promise.all([
      listingsAPI.getOne(id),
      listingsAPI.getSimilar(id),
    ]).then(([listingRes, similarRes]) => {
      setListing(listingRes.data);
      setSimilar(similarRes.data || []);
    }).catch(() => toast.error('Offre introuvable'))
      .finally(() => setLoading(false));
  }, [id]);

  const handleApply = async () => {
    if (!isAuthenticated) { navigate('/login'); return; }
    if (user?.role !== 'jobseeker') { toast.error('Seuls les candidats peuvent postuler'); return; }
    setApplying(true);
    try {
      await applicationsAPI.apply(id, { comments: coverLetter });
      setApplied(true);
      setShowApplyModal(false);
      toast.success('Candidature envoyée avec succès !');
    } catch (err) {
      toast.error(err.response?.data?.detail || 'Erreur lors de la candidature');
    } finally {
      setApplying(false);
    }
  };

  if (loading) return (
    <div className="max-w-5xl mx-auto px-4 py-12">
      <div className="animate-pulse space-y-4">
        <div className="h-8 bg-slate-200 rounded w-2/3" />
        <div className="h-4 bg-slate-200 rounded w-1/3" />
        <div className="h-48 bg-slate-200 rounded" />
      </div>
    </div>
  );

  if (!listing) return (
    <div className="max-w-5xl mx-auto px-4 py-20 text-center">
      <p className="text-slate-500">Offre introuvable.</p>
      <Link to="/jobs" className="text-blue-600 hover:underline mt-2 inline-block">
        ← Retour aux offres
      </Link>
    </div>
  );

  const title       = getTitle(listing);
  const company     = getCompanyName(listing);
  const category    = getCategory(listing);
  const type        = getContractType(listing);
  const experience  = getExperience(listing);
  const studyLevel  = getStudyLevel(listing);
  const skills      = getSkills(listing);
  const location    = getLocation(listing);
  const featured    = getFeatured(listing);
  const description = getDescription(listing);
  const requirements = getRequirements(listing);
  const salary      = getSalary(listing);
  const logo        = listing.employer_snapshot?.logo || '';
  const createdAt   = listing.created_at || listing.date_add || null;
  const expiresAt   = getExpirationDate(listing);

  const timeAgo = createdAt
    ? formatDistanceToNow(new Date(createdAt), { locale: fr, addSuffix: true })
    : '';
  const expiresFormatted = expiresAt
    ? format(new Date(expiresAt), 'dd/MM/yyyy')
    : null;

  return (
    <div className="max-w-5xl mx-auto px-4 py-8">
      {/* Breadcrumb */}
      <Link to="/jobs" className="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 mb-6">
        <ArrowLeft size={15} /> Retour aux offres
      </Link>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* ── Main content ── */}
        <div className="lg:col-span-2 space-y-6">

          {/* Header card */}
          <div className="bg-white rounded-xl border border-slate-200 p-6">
            <div className="flex items-start gap-4">
              <div className="w-14 h-14 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0 text-xl font-bold text-blue-600 overflow-hidden">
                {logo
                  ? <img src={logo} alt={company} className="w-full h-full object-cover" />
                  : (company?.[0]?.toUpperCase() || 'E')
                }
              </div>
              <div className="flex-1 min-w-0">
                <div className="flex items-start justify-between gap-2">
                  <h1 className="text-xl font-bold text-slate-900 leading-tight">
                    {title || "Offre d'emploi"}
                  </h1>
                  {featured && (
                    <span className="shrink-0 flex items-center gap-1 text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded-full">
                      <Star size={10} className="fill-amber-500 text-amber-500" /> Vedette
                    </span>
                  )}
                </div>
                <p className="text-slate-600 mt-0.5 flex items-center gap-1.5">
                  <Building2 size={14} /> {company || 'Entreprise'}
                </p>
              </div>
            </div>

            {/* Meta */}
            <div className="flex flex-wrap gap-3 mt-4 text-sm text-slate-600">
              {location && (
                <span className="flex items-center gap-1.5">
                  <MapPin size={14} className="text-slate-400" /> {location}
                </span>
              )}
              {timeAgo && (
                <span className="flex items-center gap-1.5">
                  <Clock size={14} className="text-slate-400" /> {timeAgo}
                </span>
              )}
              <span className="flex items-center gap-1.5">
                <Eye size={14} className="text-slate-400" /> {listing.views || 0} vues
              </span>
            </div>

            {/* Tags */}
            <div className="flex flex-wrap gap-2 mt-4">
              {type && (
                <span className="text-xs font-medium px-2.5 py-1 rounded-full bg-green-100 text-green-700">
                  {type}
                </span>
              )}
              {category && (
                <span className="text-xs font-medium px-2.5 py-1 rounded-full bg-blue-50 text-blue-600">
                  {category}
                </span>
              )}
              {experience && (
                <span className="text-xs font-medium px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 flex items-center gap-1">
                  <Briefcase size={11} /> {experience}
                </span>
              )}
              {studyLevel && (
                <span className="text-xs font-medium px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 flex items-center gap-1">
                  <GraduationCap size={11} /> {studyLevel}
                </span>
              )}
            </div>
          </div>

          {/* Description */}
          {description && (
            <div className="bg-white rounded-xl border border-slate-200 p-6">
              <h2 className="font-semibold text-slate-800 mb-3">Description du poste</h2>
              <div
                className="prose prose-sm max-w-none text-slate-700 leading-relaxed whitespace-pre-line"
                dangerouslySetInnerHTML={{ __html: description }}
              />
            </div>
          )}

          {/* Requirements */}
          {requirements && (
            <div className="bg-white rounded-xl border border-slate-200 p-6">
              <h2 className="font-semibold text-slate-800 mb-3">Profil recherché</h2>
              <div
                className="prose prose-sm max-w-none text-slate-700 leading-relaxed whitespace-pre-line"
                dangerouslySetInnerHTML={{ __html: requirements }}
              />
            </div>
          )}

          {/* Skills */}
          {skills.length > 0 && (
            <div className="bg-white rounded-xl border border-slate-200 p-6">
              <h2 className="font-semibold text-slate-800 mb-3">Compétences requises</h2>
              <div className="flex flex-wrap gap-2">
                {skills.map((s) => (
                  <span key={s} className="text-sm px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full">
                    {s}
                  </span>
                ))}
              </div>
            </div>
          )}

          {/* Similar */}
          {similar.length > 0 && (
            <div>
              <h2 className="font-semibold text-slate-800 mb-3">Offres similaires</h2>
              <div className="grid gap-4">
                {similar.slice(0, 3).map((j) => (
                  <JobCard key={j._id} job={j} />
                ))}
              </div>
            </div>
          )}
        </div>

        {/* ── Sidebar ── */}
        <div className="space-y-4">

          {/* Apply button */}
          <div className="bg-white rounded-xl border border-slate-200 p-5 sticky top-4">
            {applied ? (
              <div className="flex items-center gap-2 text-green-600 font-medium justify-center py-2">
                <CheckCircle size={18} /> Candidature envoyée
              </div>
            ) : (
              <button
                onClick={() => setShowApplyModal(true)}
                className="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition flex items-center justify-center gap-2"
              >
                Postuler à cette offre
              </button>
            )}

            {expiresFormatted && (
              <p className="text-xs text-slate-400 text-center mt-3 flex items-center justify-center gap-1">
                <Calendar size={11} /> Expire le {expiresFormatted}
              </p>
            )}
          </div>

          {/* Company info */}
          <div className="bg-white rounded-xl border border-slate-200 p-5">
            <h3 className="font-semibold text-slate-800 mb-3">Entreprise</h3>
            <div className="flex items-center gap-3">
              <div className="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center font-bold text-blue-600">
                {logo
                  ? <img src={logo} alt="" className="w-full h-full object-cover rounded-lg" />
                  : (company?.[0]?.toUpperCase() || 'E')
                }
              </div>
              <div>
                <p className="font-medium text-slate-800">{company || '—'}</p>
                {location && <p className="text-xs text-slate-500">{location}</p>}
              </div>
            </div>
          </div>

          {/* Salary */}
          {salary && (
            <div className="bg-white rounded-xl border border-slate-200 p-5">
              <h3 className="font-semibold text-slate-800 mb-1">Rémunération</h3>
              <p className="text-blue-600 font-medium">{salary}</p>
            </div>
          )}
        </div>
      </div>

      {/* Apply modal */}
      {showApplyModal && (
        <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
          <div className="bg-white rounded-xl shadow-xl w-full max-w-lg p-6">
            <h2 className="font-semibold text-slate-800 text-lg mb-4">Postuler — {title}</h2>
            <textarea
              value={coverLetter}
              onChange={(e) => setCoverLetter(e.target.value)}
              placeholder="Lettre de motivation (optionnel)..."
              rows={5}
              className="w-full border border-slate-200 rounded-lg p-3 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <div className="flex gap-3 mt-4">
              <button
                onClick={() => setShowApplyModal(false)}
                className="flex-1 py-2.5 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 transition"
              >
                Annuler
              </button>
              <button
                onClick={handleApply}
                disabled={applying}
                className="flex-1 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition disabled:opacity-60"
              >
                {applying ? 'Envoi...' : 'Envoyer ma candidature'}
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
