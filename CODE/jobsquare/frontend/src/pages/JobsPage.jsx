// src/pages/JobsPage.jsx
import { useState, useEffect } from 'react';
import { useSearchParams } from 'react-router-dom';
import { SlidersHorizontal, X, Search } from 'lucide-react';
import { listingsAPI } from '../services/api';
import JobCard from '../components/jobs/JobCard';

const EMPLOYMENT_TYPES = ['CDI', 'CDD', 'Stage', 'Freelance', 'Temps partiel'];
const EXPERIENCES = ['Débutant', '1-2 ans', '2-5 ans', '5-10 ans', '+10 ans'];
const STUDY_LEVELS = ['Bac', 'Bac+2', 'Bac+3', 'Bac+5', 'Doctorat', 'Formation professionnelle'];
const GOUVERNORATS = [
  'Casablanca-Settat',
  'Rabat-Salé-Kénitra',
  'Marrakech-Safi',
  'Fès-Meknès',
  'Tanger-Tétouan-Al Hoceïma',
  'Souss-Massa',
  'Oriental',
  'Béni Mellal-Khénifra',
  'Drâa-Tafilalet',
  'Laâyoune-Sakia El Hamra',
  'Dakhla-Oued Ed-Dahab',
  'Guelmim-Oued Noun'
];

export default function JobsPage() {
  const [searchParams, setSearchParams] = useSearchParams();
  const [listings, setListings] = useState([]);
  const [total, setTotal] = useState(0);
  const [loading, setLoading] = useState(true);
  const [page, setPage] = useState(0);
  const [filtersOpen, setFiltersOpen] = useState(false);

  const limit = 12;
  const q = searchParams.get('q') || '';
  const state = searchParams.get('state') || '';
  const category = searchParams.get('category') || '';
  const employment_type = searchParams.get('employment_type') || '';
  const experience = searchParams.get('experience') || '';
  const study_level = searchParams.get('study_level') || '';

  useEffect(() => {
    setLoading(true);
    listingsAPI.search({
      listing_type: 'job_offer',
      q: q || undefined,
      state: state || undefined,
      category: category || undefined,
      employment_type: employment_type || undefined,
      experience: experience || undefined,
      study_level: study_level || undefined,
      skip: page * limit,
      limit,
    }).then(r => {
      setListings(r.data.items || []);
      setTotal(r.data.total || 0);
    }).catch(() => {}).finally(() => setLoading(false));
  }, [q, state, category, employment_type, experience, study_level, page]);

  const setFilter = (key, value) => {
    const params = new URLSearchParams(searchParams);
    if (value) params.set(key, value);
    else params.delete(key);
    params.delete('page');
    setPage(0);
    setSearchParams(params);
  };

  const clearFilters = () => {
    setSearchParams(q ? { q } : {});
    setPage(0);
  };

  const activeFilters = [state, category, employment_type, experience, study_level].filter(Boolean);

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div className="flex flex-col lg:flex-row gap-6">

        {/* Sidebar filters */}
        <aside className={`lg:w-64 shrink-0 ${filtersOpen ? 'block' : 'hidden lg:block'}`}>
          <div className="bg-white rounded-xl border border-slate-200 p-4 sticky top-24 space-y-5">
            <div className="flex items-center justify-between">
              <h3 className="font-semibold text-slate-800">Filtres</h3>
              {activeFilters.length > 0 && (
                <button onClick={clearFilters} className="text-xs text-red-500 hover:underline flex items-center gap-1">
                  <X size={12} /> Effacer
                </button>
              )}
            </div>

            {/* Gouvernorat */}
            <div>
              <label className="text-xs font-semibold text-slate-500 uppercase tracking-wide block mb-2">Gouvernorat</label>
              <select
                value={state}
                onChange={(e) => setFilter('state', e.target.value)}
                className="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                <option value="">Tous</option>
                {GOUVERNORATS.map(g => <option key={g} value={g}>{g}</option>)}
              </select>
            </div>

            {/* Type de contrat */}
            <div>
              <label className="text-xs font-semibold text-slate-500 uppercase tracking-wide block mb-2">Type de contrat</label>
              <div className="space-y-1">
                {EMPLOYMENT_TYPES.map(type => (
                  <label key={type} className="flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
                    <input
                      type="radio"
                      name="employment_type"
                      checked={employment_type === type}
                      onChange={() => setFilter('employment_type', employment_type === type ? '' : type)}
                      className="accent-blue-600"
                    />
                    {type}
                  </label>
                ))}
              </div>
            </div>

            {/* Expérience */}
            <div>
              <label className="text-xs font-semibold text-slate-500 uppercase tracking-wide block mb-2">Expérience</label>
              <div className="space-y-1">
                {EXPERIENCES.map(exp => (
                  <label key={exp} className="flex items-center gap-2 text-sm text-slate-700 cursor-pointer">
                    <input
                      type="radio"
                      name="experience"
                      checked={experience === exp}
                      onChange={() => setFilter('experience', experience === exp ? '' : exp)}
                      className="accent-blue-600"
                    />
                    {exp}
                  </label>
                ))}
              </div>
            </div>

            {/* Niveau d'études */}
            <div>
              <label className="text-xs font-semibold text-slate-500 uppercase tracking-wide block mb-2">Niveau d'études</label>
              <select
                value={study_level}
                onChange={(e) => setFilter('study_level', e.target.value)}
                className="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                <option value="">Tous</option>
                {STUDY_LEVELS.map(l => <option key={l} value={l}>{l}</option>)}
              </select>
            </div>
          </div>
        </aside>

        {/* Main content */}
        <div className="flex-1 min-w-0">
          {/* Toolbar */}
          <div className="flex items-center justify-between mb-5 gap-3">
            <div>
              <h1 className="text-xl font-bold text-slate-800">
                {q ? `Résultats pour "${q}"` : 'Toutes les offres'}
              </h1>
              {!loading && <p className="text-sm text-slate-500">{total.toLocaleString()} offre{total !== 1 ? 's' : ''}</p>}
            </div>
            <button
              onClick={() => setFiltersOpen(!filtersOpen)}
              className="lg:hidden flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 border border-slate-200 rounded-lg hover:bg-slate-50"
            >
              <SlidersHorizontal size={14} />
              Filtres {activeFilters.length > 0 && <span className="bg-blue-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">{activeFilters.length}</span>}
            </button>
          </div>

          {/* Active filter chips */}
          {activeFilters.length > 0 && (
            <div className="flex flex-wrap gap-2 mb-4">
              {[['state', state], ['employment_type', employment_type], ['experience', experience], ['study_level', study_level]]
                .filter(([, v]) => v)
                .map(([key, value]) => (
                  <button
                    key={key}
                    onClick={() => setFilter(key, '')}
                    className="flex items-center gap-1.5 text-xs font-medium bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full hover:bg-blue-100 transition"
                  >
                    {value} <X size={11} />
                  </button>
                ))
              }
            </div>
          )}

          {/* Grid */}
          {loading ? (
            <div className="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
              {Array.from({ length: 6 }).map((_, i) => (
                <div key={i} className="bg-white rounded-xl border border-slate-200 p-5 animate-pulse h-48" />
              ))}
            </div>
          ) : listings.length > 0 ? (
            <>
              <div className="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                {listings.map((job) => <JobCard key={job._id} job={job} />)}
              </div>
              {/* Pagination */}
              {total > limit && (
                <div className="flex items-center justify-center gap-2 mt-8">
                  <button
                    disabled={page === 0}
                    onClick={() => setPage(p => p - 1)}
                    className="px-4 py-2 text-sm font-medium text-slate-700 border border-slate-200 rounded-lg disabled:opacity-40 hover:bg-slate-50 transition"
                  >
                    Précédent
                  </button>
                  <span className="text-sm text-slate-600">
                    Page {page + 1} / {Math.ceil(total / limit)}
                  </span>
                  <button
                    disabled={(page + 1) * limit >= total}
                    onClick={() => setPage(p => p + 1)}
                    className="px-4 py-2 text-sm font-medium text-slate-700 border border-slate-200 rounded-lg disabled:opacity-40 hover:bg-slate-50 transition"
                  >
                    Suivant
                  </button>
                </div>
              )}
            </>
          ) : (
            <div className="text-center py-20 text-slate-500">
              <Search size={40} className="mx-auto mb-3 opacity-30" />
              <p className="font-medium">Aucune offre trouvée</p>
              <p className="text-sm mt-1">Essayez de modifier vos filtres</p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}
