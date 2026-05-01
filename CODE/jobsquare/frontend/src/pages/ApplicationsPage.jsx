// src/pages/ApplicationsPage.jsx
import { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { CheckCircle, XCircle, Clock, Eye, Star, Briefcase, ChevronDown, MessageSquare } from 'lucide-react';
import { formatDistanceToNow } from 'date-fns';
import { fr } from 'date-fns/locale';
import toast from 'react-hot-toast';
import { applicationsAPI, listingsAPI } from '../services/api';
import useAuthStore from '../store/authStore';

const STATUS_CONFIG = {
  pending:     { label: 'En attente',  color: 'bg-amber-50 text-amber-700 border-amber-200',    icon: Clock },
  viewed:      { label: 'Vue',         color: 'bg-blue-50 text-blue-700 border-blue-200',        icon: Eye },
  shortlisted: { label: 'Présélectionné', color: 'bg-indigo-50 text-indigo-700 border-indigo-200', icon: Star },
  rejected:    { label: 'Refusé',      color: 'bg-red-50 text-red-700 border-red-200',            icon: XCircle },
  accepted:    { label: 'Accepté',     color: 'bg-green-50 text-green-700 border-green-200',      icon: CheckCircle },
};

function StatusBadge({ status }) {
  const cfg = STATUS_CONFIG[status] || STATUS_CONFIG.pending;
  const Icon = cfg.icon;
  return (
    <span className={`inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full border ${cfg.color}`}>
      <Icon size={11} /> {cfg.label}
    </span>
  );
}

// ── Jobseeker view ──────────────────────────────────────────────────────────
function JobseekerApplications() {
  const [applications, setApplications] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    applicationsAPI.getMy().then(r => setApplications(r.data || [])).finally(() => setLoading(false));
  }, []);

  if (loading) return <div className="space-y-3">{Array.from({ length: 4 }).map((_, i) => <div key={i} className="h-20 bg-slate-100 rounded-xl animate-pulse" />)}</div>;

  if (applications.length === 0) return (
    <div className="text-center py-20">
      <Briefcase size={40} className="mx-auto mb-3 text-slate-300" />
      <p className="font-semibold text-slate-700">Aucune candidature</p>
      <p className="text-sm text-slate-500 mt-1">Explorez les offres et postulez !</p>
      <Link to="/jobs" className="inline-block mt-4 px-5 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">Voir les offres</Link>
    </div>
  );

  return (
    <div className="space-y-3">
      {applications.map((app) => (
        <div key={app._id} className="bg-white rounded-xl border border-slate-200 p-5 flex items-center gap-4 hover:border-blue-200 transition">
          <div className="w-10 h-10 rounded-lg bg-blue-50 border border-blue-100 flex items-center justify-center text-sm font-bold text-blue-600 shrink-0">
            {app.listing_snapshot?.company_name?.[0] || 'E'}
          </div>
          <div className="flex-1 min-w-0">
            <h3 className="font-semibold text-slate-800 text-sm truncate">{app.listing_snapshot?.title || 'Offre'}</h3>
            <p className="text-xs text-slate-500 mt-0.5">{app.listing_snapshot?.company_name}</p>
            <p className="text-xs text-slate-400 mt-0.5">
              {app.created_at ? formatDistanceToNow(new Date(app.created_at), { locale: fr, addSuffix: true }) : ''}
            </p>
          </div>
          <div className="shrink-0"><StatusBadge status={app.status} /></div>
          <Link to={`/jobs/${app.listing_id}`} className="shrink-0 text-xs text-blue-600 hover:underline">Voir l'offre</Link>
        </div>
      ))}
    </div>
  );
}

// ── Employer view ────────────────────────────────────────────────────────────
function EmployerApplications() {
  const [myListings, setMyListings] = useState([]);
  const [selectedListing, setSelectedListing] = useState(null);
  const [applications, setApplications] = useState([]);
  const [loadingListings, setLoadingListings] = useState(true);
  const [loadingApps, setLoadingApps] = useState(false);
  const [updatingId, setUpdatingId] = useState(null);
  const [notes, setNotes] = useState({});

  useEffect(() => {
    listingsAPI.getMy({ listing_type: 'job_offer' })
      .then(r => setMyListings(r.data || []))
      .finally(() => setLoadingListings(false));
  }, []);

  const loadApplications = (listingId) => {
    setSelectedListing(listingId);
    setLoadingApps(true);
    applicationsAPI.getForListing(listingId)
      .then(r => setApplications(r.data || []))
      .finally(() => setLoadingApps(false));
  };

  const updateStatus = async (appId, status) => {
    setUpdatingId(appId);
    try {
      await applicationsAPI.updateStatus(appId, { status, notes: notes[appId] || undefined });
      setApplications(apps => apps.map(a => a._id === appId ? { ...a, status } : a));
      toast.success('Statut mis à jour');
    } catch { toast.error('Erreur'); }
    finally { setUpdatingId(null); }
  };

  const deleteListing = async (e, listingId) => {
    e.stopPropagation();
    if (!confirm('Supprimer cette offre ?')) return;
    try {
      await listingsAPI.delete(listingId);
      setMyListings(prev => prev.filter(l => l._id !== listingId));
      if (selectedListing === listingId) {
        setSelectedListing(null);
        setApplications([]);
      }
      toast.success('Offre supprimée');
    } catch {
      toast.error('Erreur lors de la suppression');
    }
  };

  if (loadingListings) return <div className="h-40 bg-slate-100 rounded-xl animate-pulse" />;

  return (
    <div className="space-y-5">
      {/* Listing selector */}
      <div>
        <label className="block text-sm font-medium text-slate-700 mb-2">Sélectionner une offre</label>
        <div className="grid gap-2 sm:grid-cols-2">
          {myListings.map((listing) => (
            <button
              key={listing._id}
              onClick={() => loadApplications(listing._id)}
              className={`text-left p-3 rounded-xl border transition text-sm ${
                selectedListing === listing._id
                  ? 'border-blue-400 bg-blue-50 text-blue-700 font-semibold'
                  : 'border-slate-200 hover:border-blue-200 text-slate-700'
              }`}
            >
              <div className="font-medium truncate">{listing.title}</div>
              <div className="text-xs text-slate-500 mt-0.5">
                
              </div>
              {/* Actions modifier / supprimer */}
              <div className="flex gap-2 mt-2" onClick={e => e.stopPropagation()}>
                <Link
                  to={`/post-job/edit/${listing._id}`}
                  className="text-xs text-blue-600 hover:underline"
                >
                  ✏️ Modifier
                </Link>
                <button
                  onClick={(e) => deleteListing(e, listing._id)}
                  className="text-xs text-red-500 hover:underline"
                >
                  🗑️ Supprimer
                </button>
              </div>
            </button>
          ))}
          {myListings.length === 0 && (
            <div className="col-span-2 text-center py-8 text-slate-500 text-sm">
              Vous n'avez pas encore d'offre publiée.
              <Link to="/jobs" className="text-blue-600 hover:underline ml-1">Publier une offre</Link>
            </div>
          )}
        </div>
      </div>

      {/* Applications list */}
      {selectedListing && (
        <div>
          <h3 className="font-semibold text-slate-800 mb-3">
            {loadingApps ? 'Chargement...' : `${applications.length} candidature${applications.length !== 1 ? 's' : ''}`}
          </h3>
          {loadingApps ? (
            <div className="space-y-3">{Array.from({ length: 3 }).map((_, i) => <div key={i} className="h-24 bg-slate-100 rounded-xl animate-pulse" />)}</div>
          ) : applications.length === 0 ? (
            <div className="text-center py-10 text-slate-500 text-sm border border-dashed border-slate-200 rounded-xl">Aucune candidature pour cette offre</div>
          ) : (
            <div className="space-y-3">
              {applications.map((app) => (
                <div key={app._id} className="bg-white rounded-xl border border-slate-200 p-5 space-y-3">
                  <div className="flex items-start justify-between gap-3">
                    <div>
                      <h4 className="font-semibold text-slate-800 text-sm">{app.jobseeker_snapshot?.full_name || app.jobseeker_snapshot?.username}</h4>
                      <div className="flex items-center gap-3 text-xs text-slate-500 mt-0.5">
                        <span>📧 {app.jobseeker_snapshot?.email}</span>
                        {app.jobseeker_snapshot?.phone && <span>📞 {app.jobseeker_snapshot.phone}</span>}
                      </div>
                      <p className="text-xs text-slate-400 mt-1">
                        {app.created_at ? formatDistanceToNow(new Date(app.created_at), { locale: fr, addSuffix: true }) : ''}
                      </p>
                    </div>
                    <StatusBadge status={app.status} />
                  </div>

                  {app.comments && (
                    <div className="bg-slate-50 rounded-lg p-3 text-sm text-slate-700 border border-slate-100">
                      <p className="text-xs font-medium text-slate-500 mb-1 flex items-center gap-1"><MessageSquare size={10} /> Lettre de motivation</p>
                      {app.comments}
                    </div>
                  )}

                  <div className="flex flex-wrap items-center gap-2">
                    {['viewed', 'shortlisted', 'rejected', 'accepted'].map(s => (
                      <button
                        key={s}
                        onClick={() => updateStatus(app._id, s)}
                        disabled={updatingId === app._id || app.status === s}
                        className={`text-xs font-medium px-3 py-1.5 rounded-lg border transition ${
                          app.status === s
                            ? `${STATUS_CONFIG[s]?.color} cursor-default`
                            : 'border-slate-200 text-slate-600 hover:bg-slate-50'
                        } disabled:opacity-50`}
                      >
                        {STATUS_CONFIG[s]?.label}
                      </button>
                    ))}

                    {app.resume && (
                      <a href={app.resume} target="_blank" rel="noreferrer" className="ml-auto text-xs font-medium text-blue-600 hover:underline">📄 Voir le CV</a>
                    )}
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      )}
    </div>
  );
}

// ── Main page ─────────────────────────────────────────────────────────────────
export default function ApplicationsPage() {
  const { user } = useAuthStore();
  const isEmployer = user?.role === 'employer';

  return (
    <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div className="mb-8">
        <h1 className="text-2xl font-bold text-slate-800">
          {isEmployer ? 'Gestion des candidatures' : 'Mes candidatures'}
        </h1>
        <p className="text-slate-500 text-sm mt-1">
          {isEmployer ? 'Gérez les candidats pour vos offres d\'emploi.' : 'Suivez l\'état de vos candidatures en temps réel.'}
        </p>
      </div>
      {isEmployer ? <EmployerApplications /> : <JobseekerApplications />}
    </div>
  );
}
