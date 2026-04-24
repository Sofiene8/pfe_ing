// src/components/layout/Footer.jsx
import { Link } from 'react-router-dom';
import { Briefcase, Mail, Phone, MapPin, Facebook, Linkedin, Twitter } from 'lucide-react';

export default function Footer() {
  return (
    <footer className="bg-slate-900 text-slate-400 mt-16">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">

          {/* Brand */}
          <div className="col-span-1 md:col-span-2">
            <Link to="/" className="flex items-center gap-2 mb-3">
              <div className="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
                <Briefcase size={16} className="text-white" />
              </div>
              <span className="font-bold text-xl text-white">Job<span className="text-blue-400">Square</span></span>
            </Link>
            <p className="text-sm leading-relaxed max-w-xs">
              La plateforme d'emploi de référence en Tunisie. Trouvez votre prochaine opportunité ou recrutez les meilleurs talents.
            </p>
            <div className="flex items-center gap-3 mt-4">
              <a href="#" className="p-2 hover:text-white hover:bg-slate-700 rounded-lg transition"><Facebook size={16} /></a>
              <a href="#" className="p-2 hover:text-white hover:bg-slate-700 rounded-lg transition"><Linkedin size={16} /></a>
              <a href="#" className="p-2 hover:text-white hover:bg-slate-700 rounded-lg transition"><Twitter size={16} /></a>
            </div>
          </div>

          {/* Links */}
          <div>
            <h4 className="text-white font-semibold mb-3 text-sm">Plateforme</h4>
            <ul className="space-y-2 text-sm">
              <li><Link to="/jobs" className="hover:text-white transition">Offres d'emploi</Link></li>
              <li><Link to="/cv" className="hover:text-white transition">Déposer un CV</Link></li>
              <li><Link to="/register" className="hover:text-white transition">Créer un compte</Link></li>
              <li><Link to="/register?role=employer" className="hover:text-white transition">Espace employeur</Link></li>
            </ul>
          </div>

          {/* Contact */}
          <div>
            <h4 className="text-white font-semibold mb-3 text-sm">Contact</h4>
            <ul className="space-y-2 text-sm">
              <li className="flex items-center gap-2"><MapPin size={14} className="shrink-0" /> Tunis, Tunisie</li>
              <li className="flex items-center gap-2"><Phone size={14} className="shrink-0" /> +216 XX XXX XXX</li>
              <li className="flex items-center gap-2"><Mail size={14} className="shrink-0" /> contact@jobsquare.tn</li>
            </ul>
          </div>
        </div>

        <div className="border-t border-slate-800 mt-8 pt-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs">
          <p>© {new Date().getFullYear()} JobSquare. Tous droits réservés.</p>
          <div className="flex gap-4">
            <a href="#" className="hover:text-white transition">Confidentialité</a>
            <a href="#" className="hover:text-white transition">CGU</a>
            <a href="#" className="hover:text-white transition">Aide</a>
          </div>
        </div>
      </div>
    </footer>
  );
}
