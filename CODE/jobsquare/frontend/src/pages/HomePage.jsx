// src/pages/HomePage.jsx
import { useState, useEffect } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { Search, Briefcase, Users, TrendingUp, ArrowRight, MapPin, Star } from 'lucide-react';
import { listingsAPI } from '../services/api';
import useAuthStore from '../store/authStore';
import JobCard from '../components/jobs/JobCard';
import RecommendedJobs from '../components/jobs/RecommendedJobs';

const CATEGORIES = [
  { label: 'Informatique', icon: '💻', value: 'IT' },
  { label: 'Commerce', icon: '📊', value: 'Commerce' },
  { label: 'Comptabilité', icon: '💰', value: 'Comptabilite' },
  { label: 'Marketing', icon: '📣', value: 'Marketing' },
  { label: 'Ingénierie', icon: '⚙️', value: 'Ingenierie' },
  { label: 'Santé', icon: '🏥', value: 'Sante' },
  { label: 'Éducation', icon: '📚', value: 'Education' },
  { label: 'Autres', icon: '✨', value: '' },
];

export default function HomePage() {
  const [searchQuery, setSearchQuery] = useState('');
  const [searchLocation, setSearchLocation] = useState('');
  const [latestJobs, setLatestJobs] = useState([]);
  const [stats, setStats] = useState({ jobs: 0 });
  const { isAuthenticated, user } = useAuthStore(state => ({
  isAuthenticated: state.isAuthenticated,
  user: state.user,
}));
  const navigate = useNavigate();

  useEffect(() => {
    listingsAPI
      .search({ listing_type: 'job_offer', limit: 6 })
      .then((r) => {
        setLatestJobs(r.data.items || []);
        setStats({ jobs: r.data.total || 0 });
      })
      .catch(() => {});
  }, []);

  const handleSearch = (e) => {
    e.preventDefault();
    const params = new URLSearchParams();
    if (searchQuery) params.set('q', searchQuery);
    if (searchLocation) params.set('state', searchLocation);
    navigate(`/jobs?${params.toString()}`);
  };

  const isJobseeker = isAuthenticated && user?.role === 'jobseeker';

  return (
    <div>
      {/* ── Hero ─────────────────────────────────────────────────────── */}
      <section className="relative bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-700 text-white overflow-hidden">
        <div className="absolute inset-0 opacity-10">
          <div className="absolute -top-24 -right-24 w-96 h-96 bg-white rounded-full" />
          <div className="absolute -bottom-32 -left-16 w-80 h-80 bg-white rounded-full" />
        </div>

        <div className="relative max-w-5xl mx-auto px-4 py-20 text-center">
          <div className="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white text-sm px-4 py-1.5 rounded-full mb-5 border border-white/30">
            <Star size={12} className="fill-yellow-300 text-yellow-300" />
            <span>{stats.jobs.toLocaleString()}+ offres actives en Tunisie</span>
          </div>

          <h1 className="text-4xl md:text-6xl font-extrabold mb-4 leading-tight">
            Trouvez l'emploi<br />
            <span className="text-yellow-300">qui vous correspond</span>
          </h1>
          <p className="text-blue-100 text-lg mb-10 max-w-xl mx-auto">
            La plateforme n°1 pour connecter les talents tunisiens avec les meilleures entreprises.
          </p>

         
        </div>
      </section>

      {/* ── Stats ─────────────────────────────────────────────────────── */}
      <section className="bg-white border-b border-slate-100">
        <div className="max-w-5xl mx-auto px-4 py-6 grid grid-cols-3 gap-4 text-center">
          {[
            { label: 'Offres actives', value: stats.jobs.toLocaleString(), icon: Briefcase },
            { label: 'Employeurs', value: '500+', icon: Users },
            { label: 'Embauches / mois', value: '1 200+', icon: TrendingUp },
          ].map(({ label, value }) => (
            <div key={label}>
              <div className="text-2xl font-extrabold text-slate-800">{value}</div>
              <div className="text-xs text-slate-500 mt-0.5">{label}</div>
            </div>
          ))}
        </div>
      </section>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-14">

        {/* ── Catégories ─────────────────────────────────────────────── */}
        <section>
          <h2 className="text-2xl font-bold text-slate-800 mb-6">Parcourir par secteur</h2>
          <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
            {CATEGORIES.map((cat) => (
              <Link
                key={cat.label}
                to={`/jobs?category=${cat.value}`}
                className="flex items-center gap-3 p-4 bg-white rounded-xl border border-slate-200 hover:border-blue-300 hover:shadow-md transition group"
              >
                <span className="text-2xl">{cat.icon}</span>
                <span className="text-sm font-medium text-slate-700 group-hover:text-blue-600 transition">
                  {cat.label}
                </span>
              </Link>
            ))}
          </div>
        </section>

        {/* ── Recommandations IA (candidat connecté uniquement) ──────── */}
        {isJobseeker && (
          <section>
            <RecommendedJobs limit={6} />
          </section>
        )}

        {/* ── Dernières offres ───────────────────────────────────────── */}
        <section>
          <div className="flex items-center justify-between mb-6">
            <h2 className="text-2xl font-bold text-slate-800">Dernières offres</h2>
            <Link
              to="/jobs"
              className="text-sm text-blue-600 hover:underline flex items-center gap-1"
            >
              Toutes les offres <ArrowRight size={14} />
            </Link>
          </div>

          {latestJobs.length > 0 ? (
            <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
              {latestJobs.map((job) => (
                <JobCard key={job._id} job={job} />
              ))}
            </div>
          ) : (
            <div className="text-center py-12 text-slate-500">
              Chargement des offres...
            </div>
          )}
        </section>

        
      </div>
    </div>
  );
}
