// src/components/jobs/RecommendedJobCard.jsx
import { Link } from "react-router-dom";

const TYPE_LABELS = {
  CDI:            { label: 'CDI',           color: 'bg-green-100 text-green-700'   },
  CDD:            { label: 'CDD',           color: 'bg-amber-100 text-amber-700'   },
  Stage:          { label: 'Stage',         color: 'bg-purple-100 text-purple-700' },
  Freelance:      { label: 'Freelance',     color: 'bg-blue-100 text-blue-700'     },
  'Temps partiel':{ label: 'Temps partiel', color: 'bg-slate-100 text-slate-600'   },
};

const EMPLOYMENT_MAP = {
  '993': 'CDI', '994': 'CDD', '995': 'Stage',
  '996': 'Freelance', '997': 'Temps partiel',
};

const ScoreBar = ({ score }) => {
  const pct = Math.round((score || 0) * 100);
  const color =
    pct >= 70 ? "bg-emerald-500" : pct >= 45 ? "bg-amber-400" : "bg-slate-300";
  return (
    <div className="flex items-center gap-2 mt-2">
      <div className="flex-1 h-1.5 rounded-full bg-slate-100 overflow-hidden">
        <div
          className={`h-full rounded-full transition-all duration-700 ${color}`}
          style={{ width: `${pct}%` }}
        />
      </div>
      <span className="text-xs font-semibold text-slate-500 w-9 text-right">
        {pct}%
      </span>
    </div>
  );
};

const textOrNull = (val) =>
  val && typeof val === "string" && isNaN(Number(val.trim())) && val.trim().length > 1
    ? val.trim()
    : null;

function getCompanyName(job) {
  const snap = job.employer_snapshot || {};
  if (snap.company_name) return snap.company_name;
  if (job.CompanyName  && job.CompanyName  !== '0') return job.CompanyName;
  if (job.company_name && job.company_name !== '0') return job.company_name;
  if (job.Company      && job.Company      !== '0') return job.Company;
  // Extraire depuis EmploymentType : "Digital Ventures recherche un(e)..."
  const et = String(job.EmploymentType || '');
  const match = et.match(/^([^,\n]+?)\s+recherche/i);
  if (match) return match[1].trim();
  // Extraire depuis keywords : "Featured NomEntreprise Commerce..."
  const kw = typeof job.keywords === 'string' ? job.keywords : '';
  const kwMatch = kw.match(/^(?:Featured\s+)?(.+?)\s+(?:CDI|CDD|Stage|Freelance|Commerce|Informatique|Finance|Administration)/);
  if (kwMatch) return kwMatch[1].trim();
  return null;
}

function getContractType(job) {
  const jobData = job.job || {};
  if (jobData.employment_type && TYPE_LABELS[jobData.employment_type]) {
    return jobData.employment_type;
  }
  const et = String(job.EmploymentType || '');
  if (TYPE_LABELS[et]) return et;
  if (EMPLOYMENT_MAP[et]) return EMPLOYMENT_MAP[et];
  const expCode = String(job.id_Job_Experience || '');
  if (EMPLOYMENT_MAP[expCode]) return EMPLOYMENT_MAP[expCode];
  const kw = Array.isArray(job.keywords)
    ? job.keywords.join(' ')
    : String(job.keywords || '');
  for (const type of ['CDI', 'CDD', 'Stage', 'Freelance']) {
    if (kw.includes(type)) return type;
  }
  return null;
}

function getLocation(job) {
  const jobData = job.job || {};
  if (jobData.location) {
    const city    = textOrNull(jobData.location.city);
    const state   = textOrNull(jobData.location.state);
    const country = textOrNull(jobData.location.country);
    const result  = [city, state, country].filter(Boolean).join(', ');
    if (result) return result;
  }
  const city  = textOrNull(job.Location_City)  || textOrNull(job.location_city);
  const state = textOrNull(job.Location_State) || textOrNull(job.location_state);
  const result2 = [city, state].filter(Boolean).join(', ');
  if (result2) return result2;
  const otherPhone = textOrNull(job.OtherPhone);
  if (otherPhone) return otherPhone;
  const resume = textOrNull(job.Resume);
  if (resume) return resume;
  return textOrNull(job.GooglePlace) || '';
}

function getSkills(job) {
  const jobData = job.job || {};
  if (Array.isArray(jobData.skills) && jobData.skills.length) return jobData.skills;
  const raw = job.id_Job_MotsCls || job.Skills || '';
  if (raw && raw !== '0') {
    return String(raw).split(/[,;]/).map(s => s.trim()).filter(Boolean);
  }
  return [];
}

export default function RecommendedJobCard({ job, rank }) {
  if (!job) return null;

  const jobData = job.job || {};

  // ── Titre ──────────────────────────────────────────────────────────
  const title =
    textOrNull(jobData.title) ||
    textOrNull(job.title)     ||
    textOrNull(job.Title)     ||
    job.external_id           ||
    (typeof job.keywords === "string"
      ? job.keywords.split(/\s+/).slice(0, 4).join(" ")
      : null)                 ||
    "Offre sans titre";

  // ── Entreprise ─────────────────────────────────────────────────────
  const companyName = getCompanyName(job);

  // ── Description ────────────────────────────────────────────────────
  const rawDesc = jobData.description || job.JobDescription || null;
  const shortDesc = rawDesc
    ? rawDesc.replace(/<[^>]+>/g, " ").replace(/\s+/g, ' ').trim().slice(0, 120) + "…"
    : null;

  // ── Localisation ───────────────────────────────────────────────────
  const location = getLocation(job);

  // ── Type de contrat ────────────────────────────────────────────────
  const contractType = getContractType(job);
  const typeStyle    = contractType ? (TYPE_LABELS[contractType] ?? null) : null;

  // ── Skills ─────────────────────────────────────────────────────────
  const skills = getSkills(job);

  // ── Salaire ────────────────────────────────────────────────────────
  const salaryDisplay =
    job.salary &&
    typeof job.salary === "string" &&
    isNaN(Number(job.salary))
      ? job.salary
      : null;

  return (
    <Link
      to={`/jobs/${job._id}`}
      className="group relative flex flex-col gap-2 rounded-2xl border border-slate-100 bg-white p-5 shadow-sm hover:shadow-md hover:border-blue-200 transition-all duration-200"
    >
      {rank !== undefined && (
        <span className="absolute top-4 right-4 text-xs font-bold text-slate-300">
          #{rank}
        </span>
      )}

      {/* Titre */}
      <h3 className="font-semibold text-slate-800 text-[15px] leading-snug group-hover:text-blue-600 transition-colors pr-6 line-clamp-2">
        {title}
      </h3>

      {/* Entreprise */}
      {companyName && (
        <p className="text-xs font-medium text-blue-500">{companyName}</p>
      )}

      {/* Description */}
      {shortDesc && (
        <p className="text-xs text-slate-500 line-clamp-2 leading-relaxed">
          {shortDesc}
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

      {/* Localisation + contrat + salaire */}
      <div className="flex flex-wrap items-center gap-x-3 gap-y-1.5">
        {location && (
          <span className="flex items-center gap-1 text-xs text-slate-500">
            <svg className="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
              <path strokeLinecap="round" strokeLinejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path strokeLinecap="round" strokeLinejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            {location}
          </span>
        )}
        {typeStyle && (
          <span className={`text-xs font-medium px-2.5 py-0.5 rounded-full ${typeStyle.color}`}>
            {typeStyle.label}
          </span>
        )}
        {salaryDisplay && (
          <span className="text-emerald-600 font-medium text-xs">
            {salaryDisplay}
          </span>
        )}
      </div>

      {/* Score */}
      {job._score !== undefined && (
        <div>
          <p className="text-xs text-slate-400 mt-1">
            Correspondance avec votre profil
          </p>
          <ScoreBar score={job._score} />
        </div>
      )}
    </Link>
  );
}