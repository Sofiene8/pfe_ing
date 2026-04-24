// src/components/layout/Header.jsx — Version finale
import { useState } from 'react';
import { Link, useNavigate, useLocation } from 'react-router-dom';
import { Search, Menu, X, Briefcase, LogOut, ShieldCheck, PlusCircle } from 'lucide-react';
import useAuthStore from '../../store/authStore';

export default function Header() {
  const [menuOpen, setMenuOpen]       = useState(false);
  const [searchQuery, setSearchQuery] = useState('');
  const { isAuthenticated, user, logout } = useAuthStore();
  const navigate = useNavigate();
  const location = useLocation();

  const handleSearch = (e) => {
    e.preventDefault();
    if (searchQuery.trim()) { navigate(`/jobs?q=${encodeURIComponent(searchQuery.trim())}`); setMenuOpen(false); }
  };
  const isActive = (path) => location.pathname.startsWith(path);
  const letter   = (user?.profile?.full_name?.[0] || user?.username?.[0] || 'U').toUpperCase();

  const navLinks = [
    { to: '/jobs', label: "Offres d'emploi" },
    ...(isAuthenticated && user?.role === 'jobseeker' ? [{ to: '/cv', label: 'Mon CV' }, { to: '/applications', label: 'Candidatures' }] : []),
    ...(isAuthenticated && user?.role === 'employer'  ? [{ to: '/applications', label: 'Candidatures' }] : []),
    ...(isAuthenticated && user?.role === 'admin'     ? [{ to: '/admin', label: 'Admin', icon: ShieldCheck }] : []),
  ];

  return (
    <header className="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-slate-200 shadow-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16 gap-4">
          <Link to="/" className="flex items-center gap-2 shrink-0">
            <div className="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center">
              <Briefcase size={16} className="text-white" />
            </div>
            <span className="font-bold text-xl text-slate-800 tracking-tight">Job<span className="text-blue-600">Square</span></span>
          </Link>

          <form onSubmit={handleSearch} className="hidden md:flex flex-1 max-w-md">
            <div className="relative w-full">
              <Search size={15} className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" />
              <input type="text" placeholder="Poste, entreprise, compétence..." value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
                className="w-full pl-9 pr-4 py-2 text-sm border border-slate-200 rounded-lg bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition" />
            </div>
          </form>

          <nav className="hidden md:flex items-center gap-0.5">
            {navLinks.map(({ to, label, icon: Icon }) => (
              <Link key={to} to={to}
                className={`flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg transition ${isActive(to) ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-100'}`}>
                {Icon && <Icon size={13} />}{label}
              </Link>
            ))}
          </nav>

          <div className="hidden md:flex items-center gap-2 shrink-0">
            {isAuthenticated ? (
              <>
                {user?.role === 'employer' && (
                  <Link to="/post-job" className="flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
                    <PlusCircle size={14} /> Publier
                  </Link>
                )}
                <Link to="/profile" className="flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">
                  <div className="w-7 h-7 rounded-full bg-gradient-to-br from-blue-500 to-indigo-500 flex items-center justify-center text-xs font-bold text-white">{letter}</div>
                  <span className="max-w-[120px] truncate">{user?.profile?.full_name || user?.username}</span>
                </Link>
                <button onClick={() => { logout(); navigate('/'); }} className="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Déconnexion">
                  <LogOut size={15} />
                </button>
              </>
            ) : (
              <>
                <Link to="/login" className="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition">Connexion</Link>
                <Link to="/register" className="px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">S'inscrire</Link>
              </>
            )}
          </div>

          <button onClick={() => setMenuOpen(!menuOpen)} className="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
            {menuOpen ? <X size={20} /> : <Menu size={20} />}
          </button>
        </div>
      </div>

      {menuOpen && (
        <div className="md:hidden border-t border-slate-100 bg-white px-4 py-3 space-y-1">
          <form onSubmit={handleSearch} className="relative mb-3">
            <Search size={14} className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" />
            <input type="text" placeholder="Rechercher..." value={searchQuery} onChange={e => setSearchQuery(e.target.value)}
              className="w-full pl-8 pr-4 py-2 text-sm border border-slate-200 rounded-lg bg-slate-50" />
          </form>
          {navLinks.map(({ to, label }) => (
            <Link key={to} to={to} onClick={() => setMenuOpen(false)} className="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-100 rounded-lg">{label}</Link>
          ))}
          {isAuthenticated ? (
            <>
              {user?.role === 'employer' && <Link to="/post-job" onClick={() => setMenuOpen(false)} className="block px-3 py-2 text-sm font-semibold text-blue-600 hover:bg-blue-50 rounded-lg">+ Publier une offre</Link>}
              <Link to="/profile" onClick={() => setMenuOpen(false)} className="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-100 rounded-lg">Mon profil</Link>
              <button onClick={() => { logout(); navigate('/'); setMenuOpen(false); }} className="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg">Déconnexion</button>
            </>
          ) : (
            <>
              <Link to="/login" onClick={() => setMenuOpen(false)} className="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-100 rounded-lg">Connexion</Link>
              <Link to="/register" onClick={() => setMenuOpen(false)} className="block px-3 py-2 text-sm text-center font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg">S'inscrire</Link>
            </>
          )}
        </div>
      )}
    </header>
  );
}
