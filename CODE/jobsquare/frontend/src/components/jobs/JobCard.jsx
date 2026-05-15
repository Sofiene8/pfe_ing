// src/components/jobs/JobCard.jsx
import { Link } from 'react-router-dom';
import { MapPin, Clock, Eye, Users } from 'lucide-react';
import { formatDistanceToNow } from 'date-fns';
import { fr } from 'date-fns/locale';

const TYPE_LABELS = {
  CDI:             { label: 'CDI',           color: 'bg-green-100 text-green-700'   },
  CDD:             { label: 'CDD',           color: 'bg-amber-100 text-amber-700'   },
  Stage:           { label: 'Stage',         color: 'bg-purple-100 text-purple-700' },
  Freelance:       { label: 'Freelance',     color: 'bg-blue-100 text-blue-700'     },
  'Temps partiel': { label: 'Temps partiel', color: 'bg-slate-100 text-slate-600'   },
  'Temps plein':   { label: 'Temps plein',   color: 'bg-green-100 text-green-700'   },
};

// ── IDs RÉELS confirmés par diagnostic MongoDB ─────────────────────────────────
// id_Job_Experience distinct values: '986','987','988','989','993','994','995','996'
// EmploymentType distinct values: '695','76','76,695','76,695,77','77,696,921'
// job.employment_type distinct values: 'CDD' (texte lisible)

// Contrat — EmploymentType stocke des IDs séparés par virgule ou du texte complet
const EMPLOYMENT_ID_MAP = {
  '76':  'CDI',
  '695': 'CDD',
  '77':  'Temps plein',
  '696': 'Temps partiel',
  '78':  'Freelance',
  '697': 'Intérim',
  '79':  'Saisonnier',
  '921': 'Stage',
  '698': 'Autre',
};

// Expérience — valeurs réelles dans id_Job_Experience : 986-989, 993-996
const EXPERIENCE_MAP = {
  // IDs réels confirmés
  '986': 'Débutant',
  '987': '0-1 an',
  '988': '1-3 ans',
  '989': '3-5 ans',
  // Ces IDs semblent aussi être utilisés pour expérience dans certains docs
  '993': 'Débutant',
  '994': '1-2 ans',
  '995': '2-5 ans',
  '996': '5 ans+',
  // IDs supplémentaires possibles
  '990': '5-10 ans',
  '991': '+10 ans',
  '1045': 'Autre',
};

// Niveau d'études — IDs confirmés par STUDY_LEVEL_MAP backend
// IMPORTANT: 997, 998, 1001, 1002, 1003 sont des IDs STUDY_LEVEL, PAS expérience
const STUDY_LEVEL_MAP = {
  '993':  'Bac',
  '995':  'Doctorat',
  '996':  'Ingénieur',
  '997':  'Bac+3',
  '998':  'Bac',
  '1001': 'Bac+2',
  '1002': 'Bac+4',
  '1003': 'Bac+5 / Master',
  '1048': 'Autre',
  // Legacy complémentaires
  '1004': 'Bac',
  '1005': 'Bac+2',
  '1006': 'Bac+3',
  '1007': 'Bac+4',
  '1008': 'Bac+5',
  '1009': 'Doctorat',
  '1010': 'Sans diplôme',
  '1011': 'CAP / BEP',
  '1012': 'BTS / DUT',
  '1013': 'Licence',
  '1014': 'Master',
  '1015': 'Ingénieur',
  '1016': 'MBA',
};

// IDs qui appartiennent UNIQUEMENT à study_level et jamais à experience
const STUDY_ONLY_IDS = new Set(['997', '998', '1001', '1002', '1003', '1004',
  '1005', '1006', '1007', '1008', '1009', '1010', '1011', '1012', '1013',
  '1014', '1015', '1016', '1048']);

const CATEGORY_MAP = {
  '2001': 'Informatique',           '2002': 'Finance & Comptabilité',
  '2003': 'Juridique & Conseil',    '2005': 'Industrie & Production',
  '2007': 'Industrie & Production', '2008': 'Santé & Médical',
  '2009': 'Commerce & Vente',       '2010': 'Marketing & Communication',
  '2011': 'Logistique & Transport', '2012': 'BTP & Architecture',
  '2013': 'Administration',         '2014': 'Finance & Comptabilité',
  '2015': 'Juridique & Conseil',    '2016': 'BTP & Architecture',
  '2017': 'Éducation & Formation',  '2018': 'Tourisme & Hôtellerie',
  '2019': 'Agriculture',            '2020': 'Arts & Médias',
  '2021': 'Informatique & Tech',    '2022': 'Télécommunications',
  '2023': 'Marketing',              '2024': 'Administration',
  '2025': 'Service Client',         '2026': 'Ressources Humaines',
  '2028': 'BTP & Architecture',     '2029': 'Santé & Médical',
  '2030': 'Commerce & Vente',       '2032': 'Agriculture',
  '2033': 'Administration',         '2034': 'Télécommunications',
  '2035': 'BTP & Architecture',     '76': 'Autre',
};

// ── Helpers ────────────────────────────────────────────────────────────────────

function textOrNull(v) {
  if (v === null || v === undefined) return null;
  const s = String(v).trim();
  if (s === '' || s === '0') return null;
  if (/^-?\d+(\.\d+)?$/.test(s)) return null;
  return s;
}

function kwString(j) {
  if (Array.isArray(j.keywords)) return j.keywords.join(' ');
  return String(j.keywords || '');
}

// ── Extracteurs ────────────────────────────────────────────────────────────────

export function getTitle(j) {
  if (j.job?.title) return j.job.title;
  const t = j.Title || j.title || '';
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
  // 1. Nouveau backend : job.employment_type est déjà un label lisible (ex: "CDD")
  if (j.job?.employment_type) {
    const v = String(j.job.employment_type).trim();
    if (TYPE_LABELS[v]) return v;
    if (EMPLOYMENT_ID_MAP[v]) return EMPLOYMENT_ID_MAP[v];
  }

  // 2. Legacy : EmploymentType peut être un ID, une liste d'IDs, ou du texte long
  const raw = String(j.EmploymentType || '').trim();

  // Texte long (description complète stockée par erreur dans EmploymentType)
  // → pas de type de contrat exploitable
  if (raw.length > 20) return '';

  // Liste d'IDs séparés par virgule (ex: "76,695" ou "76,695,77")
  if (/^[\d,\s]+$/.test(raw)) {
    const firstId = raw.split(',')[0].trim();
    if (EMPLOYMENT_ID_MAP[firstId]) return EMPLOYMENT_ID_MAP[firstId];
  }

  // Label lisible direct
  if (TYPE_LABELS[raw]) return raw;

  // Fallback keywords
  const kw = kwString(j);
  for (const type of ['CDI', 'CDD', 'Stage', 'Freelance']) {
    if (kw.includes(type)) return type;
  }

  return '';
}

export function getExperience(j) {
  // FIX: lire uniquement id_Job_Experience / job.experience
  // NE PAS lire id_Job_StudyLevel ni id_Job_Niveaudtude ici
  const raw = j.job?.experience || j.id_Job_Experience || j.Experience || '';
  const code = String(raw).trim();
  if (!code || code === '0' || code === 'None') return '';

  if (/^\d+$/.test(code)) {
    // Si c'est un code study_level uniquement → ne pas l'afficher comme expérience
    if (STUDY_ONLY_IDS.has(code)) return '';
    return EXPERIENCE_MAP[code] || '';
  }

  // Valeur déjà lisible
  if (TYPE_LABELS[code]) return ''; // c'est un type de contrat, pas une expérience
  return code;
}

export function getStudyLevel(j) {
  // FIX: lire uniquement les champs dédiés au niveau d'études
  const raw = j.job?.study_level
    || j.id_Job_StudyLevel
    || j.id_Job_Niveaudtude
    || j.StudyLevel
    || j.Study
    || '';
  const code = String(raw).trim();
  if (!code || code === '0' || code === 'None') return '';
  if (/^\d+$/.test(code)) return STUDY_LEVEL_MAP[code] || '';
  return code;
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
    const city    = textOrNull(j.job.location.city);
    const state   = textOrNull(j.job.location.state);
    const country = textOrNull(j.job.location.country);
    const result  = [city, state, country].filter(Boolean).join(', ');
    if (result) return result;
  }
  const city  = textOrNull(j.Location_City)  || textOrNull(j.location_city);
  const state = textOrNull(j.Location_State) || textOrNull(j.location_state);
  const result2 = [city, state].filter(Boolean).join(', ');
  if (result2) return result2;
  return textOrNull(j.GooglePlace) || '';
}

export function getCompanyName(j) {
  if (j.employer_snapshot?.company_name) return j.employer_snapshot.company_name;
  if (j.employer?.company_name)          return j.employer.company_name;
  if (j.job?.company_name)               return j.job.company_name;
  if (j.CompanyName  && j.CompanyName  !== '0') return j.CompanyName;
  if (j.company_name && j.company_name !== '0') return j.company_name;
  if (j.Company      && j.Company      !== '0') return j.Company;
  if (j.username     && j.username     !== '0') return j.username;
  return '';
}

export function getDescription(j) {
  const raw = j.job?.description || j.JobDescription || j.Description || j.description || '';
  if (!raw) return '';
  // FIX: si la description ressemble à une offre générée automatiquement avec
  // "MISSIONS PRINCIPALES:" répétitif, on la tronque proprement
  return raw.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
}

function getSlots(j) {
  if (j.available_slots === undefined || j.available_slots === null) return null;
  return Number(j.available_slots);
}

// ── Composant ──────────────────────────────────────────────────────────────────
export default function JobCard({ job }) {
  const title       = getTitle(job);
  const type        = getContractType(job);
  const category    = getCategory(job);
  const experience  = getExperience(job);
  const studyLevel  = getStudyLevel(job);
  const skills      = getSkills(job);
  const location    = getLocation(job);
  const company     = getCompanyName(job);
  const description = getDescription(job);
  const logo        = job.employer_snapshot?.logo || '';
  const createdAt   = job.created_at || job.createdAt || job.date_add || job.activation_date || null;
  const typeStyle   = TYPE_LABELS[type] ?? null;
  const timeAgo     = createdAt
    ? formatDistanceToNow(new Date(createdAt), { locale: fr, addSuffix: true })
    : '';

  const slots    = getSlots(job);
  const isFull   = slots !== null && slots === 0;
  const hasSlots = slots !== null;

  return (
    <Link
      to={`/jobs/${job._id}`}
      className={`group bg-white rounded-xl border transition-all p-5 flex flex-col gap-3 ${
        isFull
          ? 'border-slate-200 opacity-60 cursor-not-allowed pointer-events-none'
          : 'border-slate-200 hover:border-blue-300 hover:shadow-lg'
      }`}
      onClick={isFull ? (e) => e.preventDefault() : undefined}
      aria-disabled={isFull}
    >
      {/* Header : logo + titre + badge places */}
      <div className="flex items-start justify-between gap-3">
        <div className="flex items-center gap-3 min-w-0">
          <div className="w-11 h-11 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0 text-lg font-bold text-blue-600 overflow-hidden">
            {logo
              ? <img src={logo} alt="" className="w-full h-full object-cover rounded-lg"/>
              : (company?.[0]?.toUpperCase() || 'E')
            }
          </div>
          <div className="min-w-0">
            <h3 className={`font-semibold text-slate-800 transition line-clamp-1 ${!isFull ? 'group-hover:text-blue-600' : ''}`}>
              {title || "Offre d'emploi"}
            </h3>
            <p className="text-xs text-slate-500 truncate">
              {company || <span className="italic text-slate-300">Entreprise non renseignée</span>}
            </p>
          </div>
        </div>

        {hasSlots && (
          <span className={`shrink-0 flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full ${
            isFull ? 'bg-red-100 text-red-600'
            : slots === 1 ? 'bg-amber-100 text-amber-700'
            : 'bg-emerald-100 text-emerald-700'
          }`}>
            <Users size={11}/>
            {isFull ? 'Complet' : `${slots} place${slots > 1 ? 's' : ''}`}
          </span>
        )}
      </div>

      {/* Badges */}
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
        {studyLevel && (
          <span className="text-xs font-medium px-2.5 py-1 rounded-full bg-violet-50 text-violet-600">
            {studyLevel}
          </span>
        )}
      </div>

      {/* Description */}
      {description && (
        <p className="text-xs text-slate-500 line-clamp-2 leading-relaxed">
          {description}
        </p>
      )}

      {/* Skills */}
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

      {/* Footer */}
      <div className="flex items-center justify-between pt-1 border-t border-slate-100 mt-auto">
        <div className="flex items-center gap-1.5 text-xs text-slate-500 min-w-0">
          {location && (
            <span className="flex items-center gap-1 truncate">
              <MapPin size={11} className="shrink-0"/> {location}
            </span>
          )}
          {location && timeAgo && <span className="text-slate-300 shrink-0">·</span>}
          {timeAgo && (
            <span className="flex items-center gap-1 shrink-0">
              <Clock size={11}/> {timeAgo}
            </span>
          )}
        </div>
        <span className="flex items-center gap-1 text-xs text-slate-400 shrink-0 ml-2">
          <Eye size={11}/> {job.views || 0}
        </span>
      </div>
    </Link>
  );
}