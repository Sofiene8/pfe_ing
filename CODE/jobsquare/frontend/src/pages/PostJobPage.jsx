// src/pages/PostJobPage.jsx
import { useState, useEffect } from "react";
import { useNavigate, useParams } from "react-router-dom";
import { toast } from "react-hot-toast";
import api, { listingsAPI } from "../services/api";

const MOROCCAN_STATES = [
  "Casablanca-Settat","Rabat-Salé-Kénitra","Marrakech-Safi","Fès-Meknès",
  "Tanger-Tétouan-Al Hoceïma","Souss-Massa","Béni Mellal-Khénifra",
  "L'Oriental","Drâa-Tafilalet","Laâyoune-Sakia El Hamra",
  "Dakhla-Oued Ed-Dahab","Guelmim-Oued Noun",
];

const ALL_STATES = [...MOROCCAN_STATES];

const CATEGORIES = [
  "Informatique & Technologies","Marketing & Communication","Finance & Comptabilité",
  "Commerce & Vente","Ressources Humaines","Juridique & Droit","Santé & Médical",
  "Éducation & Formation","Ingénierie & Industrie","Architecture & BTP",
  "Arts & Médias","Transport & Logistique","Tourisme & Hôtellerie","Autre",
];

const EMPLOYMENT_TYPES = ["CDI","CDD","Freelance","Stage","Alternance","Temps partiel"];
const EXPERIENCE_LEVELS = ["Débutant","1-2 ans","3-5 ans","5-10 ans","10 ans et plus"];
const STUDY_LEVELS = ["Bac","Bac+2","Bac+3","Bac+4","Bac+5","Doctorat","Sans diplôme"];
const CURRENCIES = ["TND","MAD","EUR","USD"];

const SKILL_SUGGESTIONS = [
  "JavaScript","Python","React","Node.js","Java","PHP","SQL","MongoDB",
  "Git","Docker","AWS","Excel","Marketing Digital","Management","Anglais",
];

const EMPTY_FORM = {
  title: "",
  keywords: [],
  expiration_date: "",
  job: {
    category: "",
    employment_type: "",
    description: "",
    requirements: "",
    skills: [],
    study_level: "",
    experience: "",
    salary_min: "",
    salary_max: "",
    salary_currency: "TND",
    location_state: "",
    location_city: "",
    location_country: "",
  },
};

const Section = ({ title, children }) => (
  <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-5">
    <h2 className="text-base font-semibold text-slate-800 border-b border-slate-100 pb-3">{title}</h2>
    {children}
  </div>
);

const Field = ({ label, required, children, hint }) => (
  <div className="space-y-1.5">
    <label className="block text-sm font-medium text-slate-700">
      {label}{required && <span className="text-red-400 ml-0.5">*</span>}
    </label>
    {children}
    {hint && <p className="text-xs text-slate-400">{hint}</p>}
  </div>
);

const inputCls = "w-full px-3 py-2.5 text-sm border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-slate-50 focus:bg-white";
const selectCls = inputCls;

export default function PostJobPage() {
  const navigate = useNavigate();
  const { id } = useParams(); // undefined = création, string = édition
  const isEdit = Boolean(id);

  const [loading, setLoading] = useState(false);
  const [loadingData, setLoadingData] = useState(isEdit);
  const [skillInput, setSkillInput] = useState("");
  const [form, setForm] = useState(EMPTY_FORM);

  // ── Pré-remplissage en mode édition ──────────────────────────────────────
  useEffect(() => {
    if (!isEdit) return;
    listingsAPI.getOne(id)
      .then(({ data }) => {
        const job = data.job || {};
        setForm({
          title: data.title || "",
          keywords: data.keywords || [],
          expiration_date: data.expiration_date
            ? new Date(data.expiration_date).toISOString().split("T")[0]
            : "",
          job: {
            category:         job.category || "",
            employment_type:  job.employment_type || "",
            description:      job.description || "",
            requirements:     job.requirements || "",
            skills:           job.skills || [],
            study_level:      job.study_level || "",
            experience:       job.experience || "",
            salary_min:       job.salary_min ?? "",
            salary_max:       job.salary_max ?? "",
            salary_currency:  job.salary_currency || "TND",
            location_state:   job.location?.state || "",
            location_city:    job.location?.city || "",
            location_country: job.location?.country || "",
          },
        });
      })
      .catch(() => toast.error("Impossible de charger l'offre"))
      .finally(() => setLoadingData(false));
  }, [id, isEdit]);

  const setJob = (field, value) =>
    setForm((f) => ({ ...f, job: { ...f.job, [field]: value } }));

  const addSkill = (skill) => {
    const s = skill.trim();
    if (!s || form.job.skills.includes(s)) return;
    setJob("skills", [...form.job.skills, s]);
    setSkillInput("");
  };

  const removeSkill = (s) =>
    setJob("skills", form.job.skills.filter((x) => x !== s));

  const addKeyword = (kw) => {
    const k = kw.trim();
    if (!k || form.keywords.includes(k)) return;
    setForm((f) => ({ ...f, keywords: [...f.keywords, k] }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!form.title.trim()) return toast.error("Le titre est requis");
    if (!form.job.description.trim()) return toast.error("La description est requise");

    setLoading(true);
    try {
      const payload = {
        listing_type: "job_offer",
        title: form.title,
        keywords: form.keywords,
        expiration_date: form.expiration_date || null,
        job: {
          ...form.job,
          salary_min: form.job.salary_min ? Number(form.job.salary_min) : null,
          salary_max: form.job.salary_max ? Number(form.job.salary_max) : null,
        },
      };

      if (isEdit) {
        await listingsAPI.update(id, payload);
        toast.success("Offre mise à jour !");
      } else {
        await api.post("/listings", payload);
        toast.success("Offre publiée avec succès !");
      }
      navigate("/applications");
    } catch (err) {
      toast.error(err?.response?.data?.detail || "Erreur lors de la publication");
    } finally {
      setLoading(false);
    }
  };

  // ── Skeleton pendant le chargement en mode édition ───────────────────────
  if (loadingData) return (
    <div className="max-w-3xl mx-auto px-4 py-10 space-y-5">
      {Array.from({ length: 4 }).map((_, i) => (
        <div key={i} className="h-40 bg-slate-100 rounded-2xl animate-pulse" />
      ))}
    </div>
  );

  return (
    <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      {/* Header */}
      <div className="mb-8">
        <button
          onClick={() => navigate(-1)}
          className="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 mb-4 transition"
        >
          <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
            <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          Retour
        </button>
        <h1 className="text-2xl font-bold text-slate-800">
          {isEdit ? "Modifier l'offre" : "Publier une offre d'emploi"}
        </h1>
        <p className="text-slate-500 text-sm mt-1">
          {isEdit
            ? "Modifiez les informations de votre offre."
            : "Remplissez les informations pour trouver le candidat idéal."}
        </p>
      </div>

      <form onSubmit={handleSubmit} className="space-y-5">

        {/* Informations principales */}
        <Section title="Informations principales">
          <Field label="Titre du poste" required>
            <input
              className={inputCls}
              placeholder="ex : Développeur Full Stack React/Node.js"
              value={form.title}
              onChange={(e) => setForm((f) => ({ ...f, title: e.target.value }))}
              required
            />
          </Field>

          <div className="grid sm:grid-cols-2 gap-4">
            <Field label="Catégorie">
              <select className={selectCls} value={form.job.category} onChange={(e) => setJob("category", e.target.value)}>
                <option value="">Sélectionner...</option>
                {CATEGORIES.map((c) => <option key={c} value={c}>{c}</option>)}
              </select>
            </Field>
            <Field label="Type de contrat">
              <select className={selectCls} value={form.job.employment_type} onChange={(e) => setJob("employment_type", e.target.value)}>
                <option value="">Sélectionner...</option>
                {EMPLOYMENT_TYPES.map((t) => <option key={t} value={t}>{t}</option>)}
              </select>
            </Field>
            <Field label="Expérience requise">
              <select className={selectCls} value={form.job.experience} onChange={(e) => setJob("experience", e.target.value)}>
                <option value="">Sélectionner...</option>
                {EXPERIENCE_LEVELS.map((x) => <option key={x} value={x}>{x}</option>)}
              </select>
            </Field>
            <Field label="Niveau d'études">
              <select className={selectCls} value={form.job.study_level} onChange={(e) => setJob("study_level", e.target.value)}>
                <option value="">Sélectionner...</option>
                {STUDY_LEVELS.map((s) => <option key={s} value={s}>{s}</option>)}
              </select>
            </Field>
          </div>

          <Field label="Date d'expiration" hint="Laissez vide pour une durée indéterminée">
            <input
              type="date"
              className={inputCls}
              value={form.expiration_date}
              onChange={(e) => setForm((f) => ({ ...f, expiration_date: e.target.value }))}
            />
          </Field>
        </Section>

        {/* Description */}
        <Section title="Description du poste">
          <Field label="Description" required>
            <textarea
              className={inputCls + " resize-none"}
              rows={6}
              placeholder="Décrivez les missions, responsabilités, l'environnement de travail..."
              value={form.job.description}
              onChange={(e) => setJob("description", e.target.value)}
              required
            />
          </Field>
          <Field label="Profil recherché">
            <textarea
              className={inputCls + " resize-none"}
              rows={4}
              placeholder="Diplômes, expériences, qualités attendues..."
              value={form.job.requirements}
              onChange={(e) => setJob("requirements", e.target.value)}
            />
          </Field>
        </Section>

        {/* Compétences */}
        <Section title="Compétences requises">
          <Field label="Ajouter des compétences">
            <div className="flex gap-2">
              <input
                className={inputCls}
                placeholder="ex : React, Python, SQL..."
                value={skillInput}
                onChange={(e) => setSkillInput(e.target.value)}
                onKeyDown={(e) => { if (e.key === "Enter") { e.preventDefault(); addSkill(skillInput); } }}
              />
              <button
                type="button"
                onClick={() => addSkill(skillInput)}
                className="px-4 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition text-sm font-medium shrink-0"
              >
                Ajouter
              </button>
            </div>
          </Field>

          <div className="flex flex-wrap gap-1.5">
            {SKILL_SUGGESTIONS.filter((s) => !form.job.skills.includes(s)).map((s) => (
              <button
                key={s}
                type="button"
                onClick={() => addSkill(s)}
                className="text-xs px-2.5 py-1 border border-dashed border-slate-300 text-slate-500 rounded-full hover:border-blue-400 hover:text-blue-600 transition"
              >
                + {s}
              </button>
            ))}
          </div>

          {form.job.skills.length > 0 && (
            <div className="flex flex-wrap gap-2">
              {form.job.skills.map((s) => (
                <span key={s} className="flex items-center gap-1 text-sm px-3 py-1 bg-blue-50 text-blue-700 rounded-full border border-blue-100">
                  {s}
                  <button type="button" onClick={() => removeSkill(s)} className="hover:text-red-500 transition ml-0.5">
                    <svg className="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2.5}>
                      <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </span>
              ))}
            </div>
          )}
        </Section>

        {/* Localisation */}
        <Section title="Localisation">
          <div className="grid sm:grid-cols-3 gap-4">
            <Field label="Région / État">
              <select className={selectCls} value={form.job.location_state} onChange={(e) => setJob("location_state", e.target.value)}>
                <option value="">Sélectionner...</option>
                {ALL_STATES.map((s) => <option key={s} value={s}>{s}</option>)}
              </select>
            </Field>
            <Field label="Ville">
              <input
                className={inputCls}
                placeholder="ex : Tunis, Casablanca..."
                value={form.job.location_city}
                onChange={(e) => setJob("location_city", e.target.value)}
              />
            </Field>
            <Field label="Pays">
              <select className={selectCls} value={form.job.location_country} onChange={(e) => setJob("location_country", e.target.value)}>
                <option value="">Sélectionner...</option>
                <option value="Tunisie">Tunisie</option>
                <option value="Maroc">Maroc</option>
                <option value="Algérie">Algérie</option>
                <option value="France">France</option>
                <option value="Autre">Autre</option>
              </select>
            </Field>
          </div>
        </Section>

        {/* Salaire */}
        <Section title="Rémunération (optionnel)">
          <div className="grid sm:grid-cols-3 gap-4">
            <Field label="Salaire min">
              <input
                type="number"
                className={inputCls}
                placeholder="ex : 1500"
                value={form.job.salary_min}
                onChange={(e) => setJob("salary_min", e.target.value)}
              />
            </Field>
            <Field label="Salaire max">
              <input
                type="number"
                className={inputCls}
                placeholder="ex : 2500"
                value={form.job.salary_max}
                onChange={(e) => setJob("salary_max", e.target.value)}
              />
            </Field>
            <Field label="Devise">
              <select className={selectCls} value={form.job.salary_currency} onChange={(e) => setJob("salary_currency", e.target.value)}>
                {CURRENCIES.map((c) => <option key={c} value={c}>{c}</option>)}
              </select>
            </Field>
          </div>
        </Section>

        {/* Mots-clés */}
        <Section title="Mots-clés (optionnel)">
          <Field label="Mots-clés pour améliorer la visibilité" hint="Appuyez sur Entrée pour ajouter">
            <div className="flex gap-2">
              <input
                className={inputCls}
                placeholder="ex : remote, startup, agile..."
                onKeyDown={(e) => {
                  if (e.key === "Enter") {
                    e.preventDefault();
                    addKeyword(e.target.value);
                    e.target.value = "";
                  }
                }}
              />
            </div>
          </Field>
          {form.keywords.length > 0 && (
            <div className="flex flex-wrap gap-2">
              {form.keywords.map((k) => (
                <span key={k} className="flex items-center gap-1 text-sm px-3 py-1 bg-slate-100 text-slate-600 rounded-full">
                  {k}
                  <button type="button" onClick={() => setForm((f) => ({ ...f, keywords: f.keywords.filter((x) => x !== k) }))} className="hover:text-red-500 transition">
                    <svg className="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2.5}>
                      <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </span>
              ))}
            </div>
          )}
        </Section>

        {/* Actions */}
        <div className="flex gap-3 pb-8">
          <button
            type="button"
            onClick={() => navigate(-1)}
            className="flex-1 py-3 border border-slate-200 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition"
          >
            Annuler
          </button>
          <button
            type="submit"
            disabled={loading}
            className="flex-1 py-3 bg-blue-600 hover:bg-blue-700 disabled:opacity-60 text-white font-semibold rounded-xl transition flex items-center justify-center gap-2"
          >
            {loading ? (
              <>
                <svg className="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                  <circle cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="3" strokeOpacity="0.25" />
                  <path d="M12 2a10 10 0 019.78 7.84" stroke="currentColor" strokeWidth="3" strokeLinecap="round" />
                </svg>
                {isEdit ? "Mise à jour..." : "Publication..."}
              </>
            ) : (
              <>
                <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                  <path strokeLinecap="round" strokeLinejoin="round" d={isEdit ? "M5 13l4 4L19 7" : "M12 4v16m8-8H4"} />
                </svg>
                {isEdit ? "Enregistrer les modifications" : "Publier l'offre"}
              </>
            )}
          </button>
        </div>
      </form>
    </div>
  );
}
