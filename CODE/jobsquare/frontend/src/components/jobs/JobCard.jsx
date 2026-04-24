// src/components/jobs/JobCard.jsx
import { Link } from 'react-router-dom';
import { MapPin, Clock, Star, Eye } from 'lucide-react';
import { formatDistanceToNow } from 'date-fns';
import { fr } from 'date-fns/locale';

const TYPE_LABELS = {
  CDI:       { label: 'CDI',       color: 'bg-green-100 text-green-700'   },
  CDD:       { label: 'CDD',       color: 'bg-amber-100 text-amber-700'   },
  Stage:     { label: 'Stage',     color: 'bg-purple-100 text-purple-700' },
  Freelance: { label: 'Freelance', color: 'bg-blue-100 text-blue-700'     },
};

const CATEGORY_MAP = {
  '2001': 'Informatique', '2002': 'Finance & Comptabilite',
  '2003': 'Juridique & Conseil', '2005': 'Industrie & Production',
  '2007': 'Industrie & Production', '2008': 'Sante & Medical',
  '2009': 'Commerce & Vente', '2010': 'Marketing & Communication',
  '2011': 'Logistique & Transport', '2012': 'BTP & Architecture',
  '2013': 'Administration & Gestion', '2014': 'Finance & Comptabilite',
  '2015': 'Juridique & Conseil', '2016': 'BTP & Architecture',
  '2017': 'Education & Formation', '2018': 'Tourisme & Hotellerie',
  '2019': 'Agriculture & Environnement', '2020': 'Arts & Medias',
  '2021': 'Informatique & Technologies', '2022': 'Telecommunications',
  '2023': 'Marketing & Communication', '2024': 'Administration & Gestion',
  '2025': 'Service Client', '2026': 'Ressources Humaines',
  '2028': 'BTP & Architecture', '2029': 'Sante & Medical',
  '2030': 'Commerce & Vente', '2032': 'Agriculture & Environnement',
  '2033': 'Administration & Gestion', '2034': 'Telecommunications',
  '2035': 'BTP & Architecture', '76': 'Autre',
};

const EXPERIENCE_MAP = {
  '988': 'Debutant', '989': '1-2 ans', '990': '2-5 ans', '991': '5 ans+',
  '995': 'Debutant', '997': 'Debutant', '998': '1-2 ans', '999': '2-5 ans',
  '1000': '5 ans+', '1001': '1-2 ans', '1002': '2-5 ans', '1003': '2-5 ans',
};

export function getTitle(j) {
  if (j.job?.title) return j.job.title;
  const t = j.Title || j.title || '';
  // Title est un vrai titre si ce n'est pas un code 4 chiffres
  if (t && !/^\d{3,4}$/.test(t.trim())) return t;
  return j.external_id || '';
}

export function getCategory(j) {
  if (j.job?.category) return j.job.category;
  const raw = String(j.JobCategory || '');
  const firstCode = raw.split(',')[0].trim();
  return CATEGORY_MAP[firstCode] || '';
}

export function getContractType(j) {
  if (j.job?.employment_type) return j.job.employment_type;
  // EmploymentType="76" = code, pas texte → cherche dans keywords
  const et = String(j.EmploymentType || '');
  if (TYPE_LABELS[et]) return et;
  for (const type of ['CDI', 'CDD', 'Stage', 'Freelance']) {
    if ((j.keywords || '').includes(type)) return type;
  }
  return '';
}

export function getExperience(j) {
  if (j.job?.experience) return j.job.experience;
  const code = String(j.id_Job_Experience || '');
  return EXPERIENCE_MAP[code] || j.Study || j.Experience || '';
}

export function getSkills(j) {
  if (Array.isArray(j.job?.skills) && j.job.skills.length) return j.job.skills;
  const raw = j.id_Job_MotsCls || j.Skills || '';
  if (raw && raw !== '0') {
    return String(raw).split(/[,;]/).map(s => s.trim()).filter(Boolean);
  }
  return [];
}

export function getLocation(j) {
  if (j.job?.location) {
    const { city, state } = j.job.location;
    return [city, state].filter(s => s && s !== '0').join(', ');
  }
  const city  = j.Location_City  && j.Location_City  !== '0' ? j.Location_City  : (j.Resume || '');
  const state = j.Location_State && j.Location_State !== '0' ? j.Location_State : '';
  return [city, state].filter(Boolean).join(', ') || j.OtherPhone || j.GooglePlace || '';
}

export function getCompanyName(j) {
  return j.employer_snapshot?.company_name || '';
}

export function getFeatured(j) {
  return j.featured === true || j.featured === 1;
}

// ── component ────────────────────────────────────────────────────────────────

export default function JobCard({ job }) {
  const title      = getTitle(job);
  const type       = getContractType(job);
  const category   = getCategory(job);
  const experience = getExperience(job);
  const skills     = getSkills(job);
  const location   = getLocation(job);
  const company    = getCompanyName(job);
  const logo       = job.employer_snapshot?.logo || '';
  const featured   = getFeatured(job);
  const createdAt  = job.created_at || job.createdAt || job.date_add || job.activation_date || null;
  const typeStyle  = TYPE_LABELS[type] ?? null;
  const timeAgo    = createdAt
    ? formatDistanceToNow(new Date(createdAt), { locale: fr, addSuffix: true })
    : '';

  return (
    <Link
      to={`/jobs/${job._id}`}
      className="group bg-white rounded-xl border border-slate-200 hover:border-blue-300 hover:shadow-lg transition-all p-5 flex flex-col gap-3"
    >
      <div className="flex items-start justify-between gap-3">
        <div className="flex items-center gap-3">
          <div className="w-11 h-11 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0 text-lg font-bold text-blue-600 overflow-hidden">
            {logo
              ? <img src={logo} alt="" className="w-full h-full object-cover rounded-lg" />
              : (company?.[0]?.toUpperCase() || 'E')
            }
          </div>
          <div>
            <h3 className="font-semibold text-slate-800 group-hover:text-blue-600 transition line-clamp-1">
              {title || "Offre d'emploi"}
            </h3>
            <p className="text-xs text-slate-500">{company || 'Entreprise'}</p>
          </div>
        </div>
        {featured && (
          <div className="shrink-0 flex items-center gap-1 text-xs font-medium text-amber-600 bg-amber-50 px-2 py-1 rounded-full">
            <Star size={10} className="fill-amber-500 text-amber-500" /> Vedette
          </div>
        )}
      </div>

      <div className="flex flex-wrap gap-2">
        {typeStyle && (
          <span className={`text-xs font-medium px-2.5 py-1 rounded-full ${typeStyle.color}`}>
            {typeStyle.label}
          </span>
        )}
        {category && (
          <span className="text-xs font-medium px-2.5 py-1 rounded-full bg-blue-50 text-blue-600">
            {category}
          </span>
        )}
        {experience && (
          <span className="text-xs font-medium px-2.5 py-1 rounded-full bg-slate-100 text-slate-600">
            {experience}
          </span>
        )}
      </div>

      {skills.length > 0 && (
        <div className="flex flex-wrap gap-1.5">
          {skills.slice(0, 3).map((s) => (
            <span key={s} className="text-xs px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded">
              {s}
            </span>
          ))}
          {skills.length > 3 && (
            <span className="text-xs px-2 py-0.5 bg-slate-100 text-slate-500 rounded">
              +{skills.length - 3}
            </span>
          )}
        </div>
      )}

      <div className="flex items-center justify-between pt-1 border-t border-slate-100 mt-auto">
        <div className="flex items-center gap-3 text-xs text-slate-500">
          {location && (
            <span className="flex items-center gap-1"><MapPin size={11} /> {location}</span>
          )}
          {timeAgo && (
            <span className="flex items-center gap-1"><Clock size={11} /> {timeAgo}</span>
          )}
        </div>
        <span className="flex items-center gap-1 text-xs text-slate-400">
          <Eye size={11} /> {job.views || 0}
        </span>
      </div>
    </Link>
  );
}
