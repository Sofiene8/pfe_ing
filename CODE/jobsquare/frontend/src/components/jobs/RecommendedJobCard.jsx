// src/components/jobs/RecommendedJobCard.jsx
import { Link } from "react-router-dom";

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

export default function RecommendedJobCard({ job, rank }) {
  if (!job) return null;

  const jobData  = job.job || {};
  const snapshot = job.employer_snapshot || {};

  const legacyTitle = (job.Title && isNaN(Number(job.Title))) ? job.Title : null;
  const titleClean = (job.title && isNaN(Number(job.title))) ? job.title : null;
  const title =titleClean      ||
    job.title       ||
    job.external_id ||
    legacyTitle     ||
    (typeof job.keywords === "string"
      ? job.keywords.split(/\s+/).slice(0, 4).join(" ")
      : null)       ||
    "Offre sans titre";

  const companyName = snapshot.company_name || null;

  const rawDesc = jobData.description || job.JobDescription || null;
  const shortDesc = rawDesc
    ? rawDesc.replace(/<[^>]+>/g, "").trim().slice(0, 120) + "…"
    : null;

  const city    = jobData.location?.city    || (typeof job.Resume === "string" && isNaN(Number(job.Resume)) ? job.Resume : "") || job.Location_City    || "";
  const state   = jobData.location?.state   || job.Location_State   || "";
  const country = jobData.location?.country || job.Location_Country || "";
  const location = [city, state, country].filter(Boolean).join(", ");

  const employmentType =
    jobData.employment_type ||
    (job.EmploymentType && job.EmploymentType.length < 30 ? job.EmploymentType : null);

  const salaryDisplay =
    job.salary && typeof job.salary === "string" && isNaN(Number(job.salary))
      ? job.salary : null;

  const isFeatured = job.featured === 1 || job.featured === true;

  return (
    <Link
      to={`/jobs/${job._id}`}
      className="group relative flex flex-col gap-2 rounded-2xl border border-slate-100 bg-white p-5 shadow-sm hover:shadow-md hover:border-blue-200 transition-all duration-200"
    >
      {rank !== undefined && (
        <span className="absolute top-4 right-4 text-xs font-bold text-slate-300">#{rank}</span>
      )}

      {isFeatured && (
        <span className="self-start rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-600 border border-amber-200">
          ✦ Mise en avant
        </span>
      )}

      <h3 className="font-semibold text-slate-800 text-[15px] leading-snug group-hover:text-blue-600 transition-colors pr-6 line-clamp-2">
        {title}
      </h3>

      {companyName && (
        <p className="text-xs font-medium text-blue-500">{companyName}</p>
      )}

      {shortDesc && (
        <p className="text-xs text-slate-500 line-clamp-2 leading-relaxed">{shortDesc}</p>
      )}

      <div className="flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-slate-500">
        {location && (
          <span className="flex items-center gap-1">
            <svg className="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
              <path strokeLinecap="round" strokeLinejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path strokeLinecap="round" strokeLinejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            {location}
          </span>
        )}
        {employmentType && (
          <span className="rounded-full bg-blue-50 px-2 py-0.5 text-xs text-blue-600 border border-blue-100">
            {employmentType}
          </span>
        )}
        {salaryDisplay && (
          <span className="text-emerald-600 font-medium text-xs">{salaryDisplay}</span>
        )}
      </div>

      {job._score !== undefined && (
        <div>
          <p className="text-xs text-slate-400 mt-1">Correspondance avec votre profil</p>
          <ScoreBar score={job._score} />
        </div>
      )}
    </Link>
  );
}
