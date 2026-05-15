// src/pages/AdminDashboardPage.jsx
import { useState, useEffect, useCallback } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  LayoutDashboard, Users, Briefcase, FileText,
  BarChart2, Trash2, Pencil, X, Check, ChevronLeft,
  ChevronRight, Search, AlertTriangle, RefreshCw,
  TrendingUp, UserCheck, Building2, ClipboardList,
} from 'lucide-react';
import useAuthStore from '../store/authStore';
import api from '../services/api';

// ── palette & helpers ──────────────────────────────────────────────────────
const STATUS_COLORS = {
  accepted:    'bg-emerald-100 text-emerald-700',
  preselected: 'bg-blue-100 text-blue-700',
  pending:     'bg-amber-100 text-amber-700',
  viewed:      'bg-slate-100 text-slate-600',
  rejected:    'bg-red-100 text-red-600',
};
const STATUS_LABELS = {
  accepted:    'Accepté',
  preselected: 'Présélectionné',
  pending:     'En attente',
  viewed:      'Vu',
  rejected:    'Refusé',
};
const ROLE_COLORS = {
  jobseeker: 'bg-blue-100 text-blue-700',
  employer:  'bg-violet-100 text-violet-700',
  admin:     'bg-rose-100 text-rose-700',
};

const Badge = ({ text, colorClass }) => (
  <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${colorClass}`}>{text}</span>
);

const Spinner = () => (
  <div className="flex items-center justify-center py-16">
    <RefreshCw size={24} className="animate-spin text-blue-500" />
  </div>
);

const Empty = ({ msg = 'Aucune donnée' }) => (
  <div className="flex flex-col items-center justify-center py-16 text-slate-400">
    <AlertTriangle size={32} className="mb-2" />
    <p className="text-sm">{msg}</p>
  </div>
);

// ── Bar chart (pure CSS/SVG) ───────────────────────────────────────────────
function BarChart({ data, xKey, yKey, color = '#3b82f6' }) {
  if (!data?.length) return <Empty />;
  const max = Math.max(...data.map(d => d[yKey]));
  return (
    <div className="overflow-x-auto">
      <div className="flex items-end gap-2 h-48 min-w-max px-2 pt-4">
        {data.map((d, i) => {
          const pct = max ? (d[yKey] / max) * 100 : 0;
          return (
            <div key={i} className="flex flex-col items-center gap-1 group cursor-default">
              <span className="text-xs text-slate-500 opacity-0 group-hover:opacity-100 transition-opacity">
                {d[yKey]}
              </span>
              <div
                className="rounded-t-md min-h-[4px] w-8 transition-all duration-500"
                style={{ height: `${pct}%`, backgroundColor: color }}
              />
              <span className="text-[10px] text-slate-500 w-14 text-center truncate" title={d[xKey]}>
                {d[xKey]}
              </span>
            </div>
          );
        })}
      </div>
    </div>
  );
}

// ── Donut chart (SVG) ─────────────────────────────────────────────────────
function DonutChart({ data }) {
  if (!data?.length) return <Empty />;
  const COLORS = ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#ef4444', '#06b6d4', '#ec4899'];
  const total = data.reduce((s, d) => s + d.count, 0);
  let cumAngle = -90;

  const slices = data.map((d, i) => {
    const angle = (d.count / total) * 360;
    const start = cumAngle;
    cumAngle += angle;
    const r = 60, cx = 80, cy = 80;
    const toRad = deg => (deg * Math.PI) / 180;
    const x1 = cx + r * Math.cos(toRad(start));
    const y1 = cy + r * Math.sin(toRad(start));
    const x2 = cx + r * Math.cos(toRad(start + angle));
    const y2 = cy + r * Math.sin(toRad(start + angle));
    const large = angle > 180 ? 1 : 0;
    return { path: `M${cx},${cy} L${x1},${y1} A${r},${r} 0 ${large},1 ${x2},${y2} Z`, color: COLORS[i % COLORS.length], ...d };
  });

  return (
    <div className="flex items-center gap-6 flex-wrap">
      <svg viewBox="0 0 160 160" className="w-36 h-36 shrink-0">
        {slices.map((s, i) => (
          <path key={i} d={s.path} fill={s.color} className="hover:opacity-80 transition-opacity" />
        ))}
        <circle cx="80" cy="80" r="36" fill="white" />
        <text x="80" y="84" textAnchor="middle" fontSize="14" fontWeight="bold" fill="#1e293b">{total}</text>
      </svg>
      <div className="flex flex-col gap-1.5 flex-1 min-w-0">
        {slices.map((s, i) => (
          <div key={i} className="flex items-center gap-2 text-sm">
            <div className="w-3 h-3 rounded-sm shrink-0" style={{ backgroundColor: s.color }} />
            <span className="text-slate-600 truncate flex-1">{s.sector || s.status || s._id || '—'}</span>
            <span className="font-semibold text-slate-800">{s.count}</span>
          </div>
        ))}
      </div>
    </div>
  );
}

// ── Stat card ─────────────────────────────────────────────────────────────
function StatCard({ icon: Icon, label, value, sub, color }) {
  return (
    <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex gap-4 items-start">
      <div className={`w-11 h-11 rounded-xl flex items-center justify-center ${color}`}>
        <Icon size={20} className="text-white" />
      </div>
      <div>
        <p className="text-xs text-slate-400 font-medium uppercase tracking-wide">{label}</p>
        <p className="text-2xl font-bold text-slate-800 leading-tight">{value ?? '—'}</p>
        {sub && <p className="text-xs text-slate-400 mt-0.5">{sub}</p>}
      </div>
    </div>
  );
}

// ── Pagination ────────────────────────────────────────────────────────────
function Pagination({ page, total, limit, onChange }) {
  const pages = Math.ceil(total / limit);
  if (pages <= 1) return null;
  return (
    <div className="flex items-center justify-between mt-4 text-sm text-slate-500">
      <span>{total} résultat{total > 1 ? 's' : ''}</span>
      <div className="flex items-center gap-1">
        <button onClick={() => onChange(page - 1)} disabled={page === 1}
          className="p-1.5 rounded-lg hover:bg-slate-100 disabled:opacity-30">
          <ChevronLeft size={16} />
        </button>
        <span className="px-2">{page}/{pages}</span>
        <button onClick={() => onChange(page + 1)} disabled={page === pages}
          className="p-1.5 rounded-lg hover:bg-slate-100 disabled:opacity-30">
          <ChevronRight size={16} />
        </button>
      </div>
    </div>
  );
}

// ── Confirm modal ─────────────────────────────────────────────────────────
function ConfirmModal({ message, onConfirm, onCancel }) {
  return (
    <div className="fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4">
      <div className="bg-white rounded-2xl shadow-2xl p-6 max-w-sm w-full">
        <div className="flex items-center gap-3 mb-4">
          <AlertTriangle className="text-rose-500" size={22} />
          <h3 className="font-semibold text-slate-800">Confirmer la suppression</h3>
        </div>
        <p className="text-sm text-slate-600 mb-6">{message}</p>
        <div className="flex gap-3 justify-end">
          <button onClick={onCancel} className="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-lg transition">Annuler</button>
          <button onClick={onConfirm} className="px-4 py-2 text-sm font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-lg transition">Supprimer</button>
        </div>
      </div>
    </div>
  );
}

// ── Edit modal (generic) ──────────────────────────────────────────────────
function EditModal({ title, fields, values, onSave, onClose }) {
  const [form, setForm] = useState(values);
  return (
    <div className="fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4">
      <div className="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md">
        <div className="flex items-center justify-between mb-5">
          <h3 className="font-semibold text-slate-800">{title}</h3>
          <button onClick={onClose} className="p-1 hover:bg-slate-100 rounded-lg"><X size={18} /></button>
        </div>
        <div className="space-y-3">
          {fields.map(f => (
            <div key={f.key}>
              <label className="text-xs font-medium text-slate-500 uppercase tracking-wide">{f.label}</label>
              {f.type === 'select' ? (
                <select
                  value={form[f.key] ?? ''}
                  onChange={e => setForm(prev => ({ ...prev, [f.key]: e.target.value }))}
                  className="mt-1 w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  {f.options.map(o => <option key={o.value} value={o.value}>{o.label}</option>)}
                </select>
              ) : (
                <input
                  type={f.type || 'text'}
                  value={form[f.key] ?? ''}
                  onChange={e => setForm(prev => ({ ...prev, [f.key]: e.target.value }))}
                  className="mt-1 w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
              )}
            </div>
          ))}
        </div>
        <div className="flex gap-3 justify-end mt-6">
          <button onClick={onClose} className="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-lg transition">Annuler</button>
          <button onClick={() => onSave(form)} className="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition flex items-center gap-1.5">
            <Check size={14} /> Enregistrer
          </button>
        </div>
      </div>
    </div>
  );
}

// ══════════════════════════════════════════════════════════════════════════
// SECTIONS
// ══════════════════════════════════════════════════════════════════════════

// ── Statistics section ────────────────────────────────────────────────────
function StatsSection() {
  const [stats, setStats]           = useState(null);
  const [bySector, setBySector]     = useState([]);
  const [byStatus, setByStatus]     = useState([]);
  const [byCategory, setByCategory] = useState([]);
  const [perJob, setPerJob]         = useState([]);
  const [loading, setLoading]       = useState(true);

  useEffect(() => {
    const load = async () => {
      setLoading(true);
      try {
        const [s, sec, st, cat, pj] = await Promise.all([
          api.get('/admin/stats').then(r => r.data),
          api.get('/admin/stats/employers-by-sector').then(r => r.data),
          api.get('/admin/stats/applications-by-status').then(r => r.data),
          api.get('/admin/stats/jobs-by-category').then(r => r.data),
          api.get('/admin/stats/candidates-per-job').then(r => r.data),
        ]);
        setStats(s); setBySector(sec); setByStatus(st); setByCategory(cat); setPerJob(pj);
      } catch (e) { console.error(e); }
      finally { setLoading(false); }
    };
    load();
  }, []);

  if (loading) return <Spinner />;

  return (
    <div className="space-y-6">
      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        <StatCard icon={Users}         label="Candidats"    value={stats?.users?.jobseekers} color="bg-blue-500" />
        <StatCard icon={Building2}     label="Employeurs"   value={stats?.users?.employers}  color="bg-violet-500" />
        <StatCard icon={Briefcase}     label="Offres"       value={stats?.jobs}              color="bg-emerald-500" />
        <StatCard icon={ClipboardList} label="Candidatures" value={stats?.applications}      color="bg-amber-500" />
      </div>

      <div className="grid md:grid-cols-2 gap-6">
        <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
          <h3 className="font-semibold text-slate-700 mb-4 flex items-center gap-2"><Users size={16} /> Répartition des utilisateurs</h3>
          <DonutChart data={stats ? [{sector:'Candidats',count:stats.users.jobseekers},{sector:'Employeurs',count:stats.users.employers}] : []} />
        </div>
        <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
          <h3 className="font-semibold text-slate-700 mb-4 flex items-center gap-2"><ClipboardList size={16} /> Candidatures par statut</h3>
          <DonutChart data={byStatus.map(d => ({ ...d, sector: d.status }))} />
        </div>
      </div>

      <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h3 className="font-semibold text-slate-700 mb-4 flex items-center gap-2"><BarChart2 size={16} /> Offres par catégorie</h3>
        <BarChart data={byCategory} xKey="category" yKey="count" color="#3b82f6" />
      </div>

      <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <h3 className="font-semibold text-slate-700 mb-4 flex items-center gap-2"><TrendingUp size={16} /> Candidats par offre</h3>
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="text-left text-xs text-slate-400 uppercase border-b border-slate-100">
                <th className="pb-2 pr-4">Offre</th>
                <th className="pb-2 px-2 text-center">Total</th>
                {['accepted','preselected','pending','viewed','rejected'].map(s => (
                  <th key={s} className="pb-2 px-2 text-center hidden sm:table-cell">{STATUS_LABELS[s]}</th>
                ))}
              </tr>
            </thead>
            <tbody>
              {perJob.slice(0, 10).map((row, i) => (
                <tr key={i} className="border-b border-slate-50 hover:bg-slate-50">
                  <td className="py-2 pr-4 font-medium text-slate-700 max-w-[200px] truncate">{row.title}</td>
                  <td className="py-2 px-2 text-center font-bold text-slate-800">{row.total}</td>
                  {['accepted','preselected','pending','viewed','rejected'].map(s => (
                    <td key={s} className="py-2 px-2 text-center hidden sm:table-cell">
                      <span className={`inline-block px-2 py-0.5 rounded-full text-xs font-medium ${STATUS_COLORS[s]}`}>{row[s]}</span>
                    </td>
                  ))}
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
}

// ── Users section ─────────────────────────────────────────────────────────
function UsersSection() {
  const [users, setUsers]           = useState([]);
  const [total, setTotal]           = useState(0);
  const [page, setPage]             = useState(1);
  const [search, setSearch]         = useState('');
  const [roleFilter, setRoleFilter] = useState('');
  const [loading, setLoading]       = useState(false);
  const [deleting, setDeleting]     = useState(null);
  const [editing, setEditing]       = useState(null);
  const LIMIT = 15;

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const params = new URLSearchParams({ page, limit: LIMIT });
      if (search) params.set('search', search);
      if (roleFilter) params.set('role', roleFilter);
      const { data } = await api.get(`/admin/users?${params}`);
      setUsers(data.users); setTotal(data.total);
    } catch (e) { console.error(e); }
    finally { setLoading(false); }
  }, [page, search, roleFilter]);

  useEffect(() => { load(); }, [load]);

  const handleDelete = async () => { await api.delete(`/admin/users/${deleting}`); setDeleting(null); load(); };
  const handleSave   = async (form) => {
    await api.patch(`/admin/users/${editing._id}`, { username: form.username, email: form.email, role: form.role });
    setEditing(null); load();
  };

  return (
    <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
      <div className="flex flex-wrap gap-3 mb-5">
        <div className="relative flex-1 min-w-[180px]">
          <Search size={14} className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" />
          <input placeholder="Rechercher un utilisateur..." value={search}
            onChange={e => { setSearch(e.target.value); setPage(1); }}
            className="w-full pl-8 pr-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <select value={roleFilter} onChange={e => { setRoleFilter(e.target.value); setPage(1); }}
          className="px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Tous les rôles</option>
          <option value="jobseeker">Candidat</option>
          <option value="employer">Employeur</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      {loading ? <Spinner /> : users.length === 0 ? <Empty /> : (
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="text-left text-xs text-slate-400 uppercase border-b border-slate-100">
                <th className="pb-2 pr-4">Nom</th>
                <th className="pb-2 pr-4">Email</th>
                <th className="pb-2 pr-4">Rôle</th>
                <th className="pb-2 pr-4">Inscrit le</th>
                <th className="pb-2 text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              {users.map(u => (
                <tr key={u._id} className="border-b border-slate-50 hover:bg-slate-50">
                  <td className="py-2.5 pr-4 font-medium text-slate-800">{u.profile?.full_name || u.username}</td>
                  <td className="py-2.5 pr-4 text-slate-500">{u.email}</td>
                  <td className="py-2.5 pr-4">
                    <Badge text={u.role} colorClass={ROLE_COLORS[u.role] || 'bg-slate-100 text-slate-600'} />
                  </td>
                  <td className="py-2.5 pr-4 text-slate-400 text-xs">
                    {u.created_at ? new Date(u.created_at).toLocaleDateString('fr-FR') : '—'}
                  </td>
                  <td className="py-2.5 text-right">
                    <div className="flex items-center justify-end gap-1">
                      <button onClick={() => setEditing(u)} className="p-1.5 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition"><Pencil size={14} /></button>
                      <button onClick={() => setDeleting(u._id)} className="p-1.5 hover:bg-red-50 hover:text-red-600 rounded-lg transition"><Trash2 size={14} /></button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
          <Pagination page={page} total={total} limit={LIMIT} onChange={setPage} />
        </div>
      )}

      {deleting && <ConfirmModal message="Supprimer cet utilisateur ? Cette action est irréversible." onConfirm={handleDelete} onCancel={() => setDeleting(null)} />}
      {editing && (
        <EditModal title="Modifier l'utilisateur"
          values={{ username: editing.username, email: editing.email, role: editing.role }}
          fields={[
            { key: 'username', label: "Nom d'utilisateur" },
            { key: 'email',    label: 'Email', type: 'email' },
            { key: 'role',     label: 'Rôle', type: 'select', options: [
              { value: 'jobseeker', label: 'Candidat' },
              { value: 'employer',  label: 'Employeur' },
              { value: 'admin',     label: 'Admin' },
            ]},
          ]}
          onSave={handleSave} onClose={() => setEditing(null)} />
      )}
    </div>
  );
}

// ── Jobs section ──────────────────────────────────────────────────────────
function JobsSection() {
  const [jobs, setJobs]         = useState([]);
  const [total, setTotal]       = useState(0);
  const [page, setPage]         = useState(1);
  const [search, setSearch]     = useState('');
  const [loading, setLoading]   = useState(false);
  const [deleting, setDeleting] = useState(null);
  const [editing, setEditing]   = useState(null);
  const LIMIT = 15;

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const params = new URLSearchParams({ page, limit: LIMIT });
      if (search) params.set('search', search);
      const { data } = await api.get(`/admin/jobs?${params}`);
      setJobs(data.jobs); setTotal(data.total);
    } catch (e) { console.error(e); }
    finally { setLoading(false); }
  }, [page, search]);

  useEffect(() => { load(); }, [load]);

  const handleDelete = async () => { await api.delete(`/admin/jobs/${deleting}`); setDeleting(null); load(); };
  const handleSave   = async (form) => { await api.patch(`/admin/jobs/${editing._id}`, form); setEditing(null); load(); };

  return (
    <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
      <div className="flex gap-3 mb-5">
        <div className="relative flex-1">
          <Search size={14} className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" />
          <input placeholder="Rechercher une offre..." value={search}
            onChange={e => { setSearch(e.target.value); setPage(1); }}
            className="w-full pl-8 pr-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
      </div>

      {loading ? <Spinner /> : jobs.length === 0 ? <Empty /> : (
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="text-left text-xs text-slate-400 uppercase border-b border-slate-100">
                <th className="pb-2 pr-4">Titre</th>
                <th className="pb-2 pr-4">Entreprise</th>
                <th className="pb-2 pr-4">Catégorie</th>
                <th className="pb-2 pr-4">Statut</th>
                <th className="pb-2 text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              {jobs.map(j => (
                <tr key={j._id} className="border-b border-slate-50 hover:bg-slate-50">
                  <td className="py-2.5 pr-4 font-medium text-slate-800 max-w-[180px] truncate">{j.title}</td>
                  <td className="py-2.5 pr-4 text-slate-500">{j.company || '—'}</td>
                  <td className="py-2.5 pr-4 text-slate-500">{j.category || '—'}</td>
                  <td className="py-2.5 pr-4">
                    <Badge text={j.status || 'active'} colorClass="bg-emerald-100 text-emerald-700" />
                  </td>
                  <td className="py-2.5 text-right">
                    <div className="flex items-center justify-end gap-1">
                      <button onClick={() => setEditing(j)} className="p-1.5 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition"><Pencil size={14} /></button>
                      <button onClick={() => setDeleting(j._id)} className="p-1.5 hover:bg-red-50 hover:text-red-600 rounded-lg transition"><Trash2 size={14} /></button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
          <Pagination page={page} total={total} limit={LIMIT} onChange={setPage} />
        </div>
      )}

      {deleting && <ConfirmModal message="Supprimer cette offre ?" onConfirm={handleDelete} onCancel={() => setDeleting(null)} />}
      {editing && (
        <EditModal title="Modifier l'offre"
          values={{ title: editing.title, company: editing.company, category: editing.category, status: editing.status }}
          fields={[
            { key: 'title',    label: 'Titre' },
            { key: 'company',  label: 'Entreprise' },
            { key: 'category', label: 'Catégorie' },
            { key: 'status',   label: 'Statut', type: 'select', options: [
              { value: 'active', label: 'Active' },
              { value: 'closed', label: 'Fermée' },
              { value: 'draft',  label: 'Brouillon' },
            ]},
          ]}
          onSave={handleSave} onClose={() => setEditing(null)} />
      )}
    </div>
  );
}

// ── Applications section ───────────────────────────────────────────────────
function ApplicationsSection() {
  const [apps, setApps]           = useState([]);
  const [total, setTotal]         = useState(0);
  const [page, setPage]           = useState(1);
  const [statusFilter, setStatus] = useState('');
  const [loading, setLoading]     = useState(false);
  const [deleting, setDeleting]   = useState(null);
  const [editing, setEditing]     = useState(null);
  const [aiReports, setAiReports] = useState({});
  const navigate = useNavigate();
  const LIMIT = 15;

  const HIRE_COLORS = {
    'Strong Hire': 'bg-emerald-100 text-emerald-700',
    'Hire':        'bg-blue-100 text-blue-700',
    'Lean Hire':   'bg-amber-100 text-amber-700',
    'No Hire':     'bg-red-100 text-red-700',
  };

  const load = useCallback(async () => {
    setLoading(true);
    try {
      const params = new URLSearchParams({ page, limit: LIMIT });
      if (statusFilter) params.set('status', statusFilter);
      const { data } = await api.get(`/admin/applications?${params}`);
      const appList = data.applications || [];
      setApps(appList);
      setTotal(data.total);
      appList.forEach(a => {
        api.get(`/analysis/application/${a._id}`)
          .then(r => setAiReports(prev => ({ ...prev, [a._id]: r.data })))
          .catch(() => {});
      });
    } catch (e) { console.error(e); }
    finally { setLoading(false); }
  }, [page, statusFilter]);

  useEffect(() => { load(); }, [load]);

  const handleDelete = async () => { await api.delete(`/admin/applications/${deleting}`); setDeleting(null); load(); };
  const handleSave   = async (form) => { await api.patch(`/admin/applications/${editing._id}`, form); setEditing(null); load(); };

  return (
    <div className="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
      <div className="flex gap-3 mb-5">
        <select value={statusFilter} onChange={e => { setStatus(e.target.value); setPage(1); }}
          className="px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Tous les statuts</option>
          <option value="En attente">En attente</option>
          <option value="Acceptee">Acceptee</option>
          <option value="Preselectionne">Preselectionne</option>
          <option value="Vu">Vu</option>
          <option value="Rejetee">Rejetee</option>
        </select>
      </div>

      {loading ? <Spinner /> : apps.length === 0 ? <Empty /> : (
        <div className="overflow-x-auto">
          <table className="w-full text-sm">
            <thead>
              <tr className="text-left text-xs text-slate-400 uppercase border-b border-slate-100">
                <th className="pb-2 pr-3">ID</th>
                <th className="pb-2 pr-3">Offre</th>
                <th className="pb-2 pr-3">Candidat</th>
                <th className="pb-2 pr-3">Statut</th>
                <th className="pb-2 pr-3">Analyse IA</th>
                <th className="pb-2 pr-3">Date</th>
                <th className="pb-2 text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              {apps.map(a => {
                const report = aiReports[a._id];
                return (
                  <tr key={a._id} className="border-b border-slate-50 hover:bg-slate-50">
                    <td className="py-2.5 pr-3 text-slate-400 font-mono text-xs">{a._id.slice(-6)}</td>
                    <td className="py-2.5 pr-3 text-slate-700 max-w-[130px] truncate">
                      {typeof a.listing_id === 'object' ? (a.listing_id.title || '-') : (a.listing_id || '-')}
                    </td>
                    <td className="py-2.5 pr-3 text-slate-700 max-w-[120px] truncate">
                      {typeof a.user_id === 'object' ? (a.user_id.username || '-') : (a.user_id || '-')}
                    </td>
                    <td className="py-2.5 pr-3">
                      <Badge text={a.status || '-'} colorClass={
                        a.status === 'Acceptee'       ? 'bg-emerald-100 text-emerald-700' :
                        a.status === 'Preselectionne' ? 'bg-blue-100 text-blue-700' :
                        a.status === 'En attente'     ? 'bg-amber-100 text-amber-700' :
                        a.status === 'Vu'             ? 'bg-slate-100 text-slate-600' :
                        a.status === 'Rejetee'        ? 'bg-red-100 text-red-600' :
                        'bg-slate-100 text-slate-500'
                      } />
                    </td>
                    <td className="py-2.5 pr-3">
                      {report ? (
                        <div className="flex flex-col gap-1">
                          <span className={`inline-flex items-center gap-1 text-xs font-semibold px-2 py-0.5 rounded-full ${HIRE_COLORS[report.hire_classification] || 'bg-gray-100 text-gray-700'}`}>
                            {Math.round(report.global_score)}/100
                          </span>
                          <button onClick={() => navigate(`/report/${a._id}`)}
                            className="text-xs text-purple-600 hover:underline flex items-center gap-1">
                            <BarChart2 size={11} /> Rapport IA
                          </button>
                        </div>
                      ) : (
                        <span className="text-xs text-slate-300 italic">Aucune vidéo</span>
                      )}
                    </td>
                    <td className="py-2.5 pr-3 text-slate-400 text-xs">
                      {a.created_at ? new Date(a.created_at).toLocaleDateString('fr-FR') : '-'}
                    </td>
                    <td className="py-2.5 text-right">
                      <div className="flex items-center justify-end gap-1">
                        <button onClick={() => setEditing(a)} className="p-1.5 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition"><Pencil size={14} /></button>
                        <button onClick={() => setDeleting(a._id)} className="p-1.5 hover:bg-red-50 hover:text-red-600 rounded-lg transition"><Trash2 size={14} /></button>
                      </div>
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
          <Pagination page={page} total={total} limit={LIMIT} onChange={setPage} />
        </div>
      )}

      {deleting && <ConfirmModal message="Supprimer cette candidature ?" onConfirm={handleDelete} onCancel={() => setDeleting(null)} />}
      {editing && (
        <EditModal title="Modifier la candidature"
          values={{ status: editing.status }}
          fields={[{ key: 'status', label: 'Statut', type: 'select', options: [
            { value: 'En attente',     label: 'En attente' },
            { value: 'Acceptee',       label: 'Acceptee' },
            { value: 'Preselectionne', label: 'Preselectionne' },
            { value: 'Vu',             label: 'Vu' },
            { value: 'Rejetee',        label: 'Rejetee' },
          ]}]}
          onSave={handleSave} onClose={() => setEditing(null)} />
      )}
    </div>
  );
}

// ══════════════════════════════════════════════════════════════════════════
// MAIN PAGE
// ══════════════════════════════════════════════════════════════════════════
const TABS = [
  { id: 'stats',        label: 'Statistiques', icon: BarChart2 },
  { id: 'users',        label: 'Utilisateurs', icon: Users },
  { id: 'jobs',         label: 'Offres',        icon: Briefcase },
  { id: 'applications', label: 'Candidatures',  icon: FileText },
];

export default function AdminDashboardPage() {
  const { user } = useAuthStore();
  const navigate  = useNavigate();
  const [tab, setTab] = useState('stats');

  useEffect(() => {
    if (!user || user.role !== 'admin') navigate('/');
  }, [user, navigate]);

  return (
    <div className="min-h-screen bg-slate-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="mb-8">
          <h1 className="text-2xl font-bold text-slate-900 flex items-center gap-2">
            <LayoutDashboard size={22} className="text-blue-600" />
            Dashboard Admin
          </h1>
          <p className="text-sm text-slate-400 mt-1">Gestion de la plateforme JobSquare</p>
        </div>

        <div className="flex gap-1 bg-white rounded-xl border border-slate-100 shadow-sm p-1 mb-6 overflow-x-auto">
          {TABS.map(({ id, label, icon: Icon }) => (
            <button key={id} onClick={() => setTab(id)}
              className={`flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition
                ${tab === id ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-100'}`}>
              <Icon size={15} />
              {label}
            </button>
          ))}
        </div>

        {tab === 'stats'        && <StatsSection />}
        {tab === 'users'        && <UsersSection />}
        {tab === 'jobs'         && <JobsSection />}
        {tab === 'applications' && <ApplicationsSection />}
      </div>
    </div>
  );
}