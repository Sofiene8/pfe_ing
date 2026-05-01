// src/pages/EditProfilePage.jsx
import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useForm, useFieldArray } from 'react-hook-form';
import toast from 'react-hot-toast';
import { Plus, Trash2, Save, ArrowLeft, Upload } from 'lucide-react';
import useAuthStore from '../store/authStore';
import { usersAPI } from '../services/api';

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

const SKILL_SUGGESTIONS = ['JavaScript', 'Python', 'React', 'Node.js', 'Java', 'PHP', 'SQL', 'MongoDB',
  'Git', 'Docker', 'AWS', 'Comptabilité', 'Marketing Digital', 'Vente', 'Management', 'Anglais'];

export default function EditProfilePage() {
  const { user, refreshUser } = useAuthStore();
  const navigate = useNavigate();
  const [saving, setSaving] = useState(false);
  const [skillInput, setSkillInput] = useState('');
  const [skills, setSkills] = useState([]);
  const [languages, setLanguages] = useState([]);
  const [langInput, setLangInput] = useState('');
  const [uploadingAvatar, setUploadingAvatar] = useState(false);
  const [uploadingCV, setUploadingCV] = useState(false);

  const isEmployer = user?.role === 'employer';
  const profile = user?.profile || {};
  const company = user?.company || {};
  const cv = user?.cv || {};

  const { register, handleSubmit, control, formState: { errors } } = useForm({
    defaultValues: {
      full_name: profile.full_name || '',
      phone: profile.phone || '',
      location_state: profile.location?.state || '',
      location_city: profile.location?.city || '',
      website: profile.website || '',
      gender: profile.gender || '',
      company_name: company.name || '',
      company_description: company.description || '',
      company_sector: company.sector || '',
      company_register: company.commercial_register || '',
      experiences: cv.experiences || [],
      education: cv.education || [],
    }
  });

  const { fields: expFields, append: addExp, remove: removeExp } = useFieldArray({ control, name: 'experiences' });
  const { fields: eduFields, append: addEdu, remove: removeEdu } = useFieldArray({ control, name: 'education' });

  useEffect(() => {
    setSkills(cv.skills || []);
    setLanguages(cv.languages || []);
  }, [user]);

  const addSkill = (skill) => {
    const s = skill.trim();
    if (s && !skills.includes(s)) setSkills([...skills, s]);
    setSkillInput('');
  };

  const addLang = () => {
    const l = langInput.trim();
    if (l && !languages.includes(l)) setLanguages([...languages, l]);
    setLangInput('');
  };

  const onSubmit = async (data) => {
    setSaving(true);
    try {
      // Update profile
      await usersAPI.updateProfile({
        full_name: data.full_name,
        phone: data.phone,
        location_state: data.location_state,
        location_city: data.location_city,
        website: data.website,
        gender: data.gender,
      });

      // Update company (employers)
      if (isEmployer) {
        await usersAPI.updateCompany({
          name: data.company_name,
          description: data.company_description,
          sector: data.company_sector,
          commercial_register: data.company_register,
        });
      }

      // Update CV (jobseekers)
      if (!isEmployer) {
        await usersAPI.updateCV({
          skills,
          languages,
          experiences: data.experiences,
          education: data.education,
        });
      }

      await refreshUser();
      toast.success('Profil mis à jour avec succès');
      navigate('/profile');
    } catch (err) {
      toast.error(err.response?.data?.detail || 'Erreur lors de la sauvegarde');
    } finally {
      setSaving(false);
    }
  };

  const handleAvatarUpload = async (e) => {
    const file = e.target.files?.[0];
    if (!file) return;
    setUploadingAvatar(true);
    try {
      await usersAPI.uploadAvatar(file);
      await refreshUser();
      toast.success('Photo mise à jour');
    } catch { toast.error('Erreur upload photo'); }
    finally { setUploadingAvatar(false); }
  };

  const handleCVUpload = async (e) => {
    const file = e.target.files?.[0];
    if (!file) return;
    setUploadingCV(true);
    try {
      await usersAPI.uploadCvFile(file);
      toast.success('CV téléchargé avec succès');
    } catch { toast.error('Erreur upload CV'); }
    finally { setUploadingCV(false); }
  };

  return (
    <div className="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <button onClick={() => navigate('/profile')} className="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-blue-600 mb-6 transition">
        <ArrowLeft size={14} /> Retour au profil
      </button>
      <h1 className="text-2xl font-bold text-slate-800 mb-6">Modifier mon profil</h1>

      <form onSubmit={handleSubmit(onSubmit)} className="space-y-6">
        {/* Photo */}
        <div className="bg-white rounded-xl border border-slate-200 p-6">
          <h2 className="font-semibold text-slate-800 mb-4">Photo de profil</h2>
          <div className="flex items-center gap-4">
            <div className="w-16 h-16 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-2xl font-bold text-blue-600 overflow-hidden">
              {profile.logo ? <img src={profile.logo} alt="" className="w-full h-full object-cover" /> : (profile.full_name?.[0] || 'U').toUpperCase()}
            </div>
            <label className="cursor-pointer flex items-center gap-2 px-4 py-2 border border-slate-200 text-sm font-medium text-slate-700 rounded-lg hover:bg-slate-50 transition">
              <Upload size={14} /> {uploadingAvatar ? 'Envoi...' : 'Changer la photo'}
              <input type="file" accept="image/*" className="hidden" onChange={handleAvatarUpload} />
            </label>
          </div>
        </div>

        {/* Personal info */}
        <div className="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
          <h2 className="font-semibold text-slate-800">Informations personnelles</h2>
          <div className="grid sm:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1">Nom complet</label>
              <input {...register('full_name')} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1">Téléphone</label>
              <input {...register('phone')} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1">Gouvernorat</label>
              <select {...register('location_state')} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner...</option>
                {GOUVERNORATS.map(g => <option key={g} value={g}>{g}</option>)}
              </select>
            </div>
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1">Ville</label>
              <input {...register('location_city')} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1">Site web</label>
              <input {...register('website')} type="url" className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1">Genre</label>
              <select {...register('gender')} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">—</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
              </select>
            </div>
          </div>
        </div>

        {/* Company info */}
        {isEmployer && (
          <div className="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 className="font-semibold text-slate-800">Informations entreprise</h2>
            <div className="grid sm:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">Nom de l'entreprise</label>
                <input {...register('company_name')} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
              </div>
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">Secteur</label>
                <input {...register('company_sector')} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
              </div>
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">Registre commercial</label>
                <input {...register('company_register')} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
              </div>
            </div>
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1">Description</label>
              <textarea {...register('company_description')} rows={4} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" />
            </div>
          </div>
        )}

        {/* Skills */}
        {!isEmployer && (
          <div className="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <h2 className="font-semibold text-slate-800">Compétences</h2>
            <div className="flex gap-2">
              <input
                value={skillInput}
                onChange={(e) => setSkillInput(e.target.value)}
                onKeyDown={(e) => e.key === 'Enter' && (e.preventDefault(), addSkill(skillInput))}
                placeholder="Ajouter une compétence..."
                className="flex-1 px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
              <button type="button" onClick={() => addSkill(skillInput)} className="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"><Plus size={16} /></button>
            </div>
            <div className="flex flex-wrap gap-1.5">
              {SKILL_SUGGESTIONS.filter(s => !skills.includes(s)).map(s => (
                <button key={s} type="button" onClick={() => addSkill(s)} className="text-xs px-2.5 py-1 border border-dashed border-slate-300 text-slate-500 rounded-full hover:border-blue-400 hover:text-blue-600 transition">+ {s}</button>
              ))}
            </div>
            <div className="flex flex-wrap gap-2">
              {skills.map((s) => (
                <span key={s} className="flex items-center gap-1 text-sm px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full">
                  {s}
                  <button type="button" onClick={() => setSkills(skills.filter(x => x !== s))} className="hover:text-red-500 transition"><Trash2 size={11} /></button>
                </span>
              ))}
            </div>

            <h3 className="font-medium text-slate-700 text-sm pt-2">Langues</h3>
            <div className="flex gap-2">
              <input value={langInput} onChange={(e) => setLangInput(e.target.value)} onKeyDown={(e) => e.key === 'Enter' && (e.preventDefault(), addLang())} placeholder="Arabe, Français, Anglais..." className="flex-1 px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
              <button type="button" onClick={addLang} className="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"><Plus size={16} /></button>
            </div>
            <div className="flex flex-wrap gap-2">
              {languages.map((l) => (
                <span key={l} className="flex items-center gap-1 text-sm px-3 py-1 bg-green-50 text-green-700 rounded-full">
                  {l}
                  <button type="button" onClick={() => setLanguages(languages.filter(x => x !== l))}><Trash2 size={11} /></button>
                </span>
              ))}
            </div>
          </div>
        )}

        {/* Experiences */}
        {!isEmployer && (
          <div className="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <div className="flex items-center justify-between">
              <h2 className="font-semibold text-slate-800">Expériences</h2>
              <button type="button" onClick={() => addExp({ title: '', company: '', start_date: '', end_date: '', description: '' })} className="flex items-center gap-1 text-sm text-blue-600 hover:underline"><Plus size={14} /> Ajouter</button>
            </div>
            {expFields.map((field, i) => (
              <div key={field.id} className="border border-slate-200 rounded-xl p-4 space-y-3 relative">
                <button type="button" onClick={() => removeExp(i)} className="absolute top-3 right-3 text-slate-400 hover:text-red-500 transition"><Trash2 size={14} /></button>
                <div className="grid sm:grid-cols-2 gap-3">
                  <div><label className="block text-xs font-medium text-slate-600 mb-1">Poste</label><input {...register(`experiences.${i}.title`)} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" /></div>
                  <div><label className="block text-xs font-medium text-slate-600 mb-1">Entreprise</label><input {...register(`experiences.${i}.company`)} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" /></div>
                  <div><label className="block text-xs font-medium text-slate-600 mb-1">Date début</label><input {...register(`experiences.${i}.start_date`)} type="month" className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" /></div>
                  <div><label className="block text-xs font-medium text-slate-600 mb-1">Date fin</label><input {...register(`experiences.${i}.end_date`)} type="month" className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" /></div>
                </div>
                <div><label className="block text-xs font-medium text-slate-600 mb-1">Description</label><textarea {...register(`experiences.${i}.description`)} rows={2} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" /></div>
              </div>
            ))}
            {expFields.length === 0 && <p className="text-sm text-slate-400 italic text-center py-4">Aucune expérience. Cliquez sur "Ajouter".</p>}
          </div>
        )}

        {/* Education */}
        {!isEmployer && (
          <div className="bg-white rounded-xl border border-slate-200 p-6 space-y-4">
            <div className="flex items-center justify-between">
              <h2 className="font-semibold text-slate-800">Formation</h2>
              <button type="button" onClick={() => addEdu({ degree: '', institution: '', year: '' })} className="flex items-center gap-1 text-sm text-blue-600 hover:underline"><Plus size={14} /> Ajouter</button>
            </div>
            {eduFields.map((field, i) => (
              <div key={field.id} className="border border-slate-200 rounded-xl p-4 space-y-3 relative">
                <button type="button" onClick={() => removeEdu(i)} className="absolute top-3 right-3 text-slate-400 hover:text-red-500 transition"><Trash2 size={14} /></button>
                <div className="grid sm:grid-cols-3 gap-3">
                  <div className="sm:col-span-2"><label className="block text-xs font-medium text-slate-600 mb-1">Diplôme</label><input {...register(`education.${i}.degree`)} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" /></div>
                  <div><label className="block text-xs font-medium text-slate-600 mb-1">Année</label><input {...register(`education.${i}.year`)} type="number" className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" /></div>
                  <div className="sm:col-span-3"><label className="block text-xs font-medium text-slate-600 mb-1">Établissement</label><input {...register(`education.${i}.institution`)} className="w-full px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" /></div>
                </div>
              </div>
            ))}
          </div>
        )}

        {/* CV file upload */}
        {!isEmployer && (
          <div className="bg-white rounded-xl border border-slate-200 p-6">
            <h2 className="font-semibold text-slate-800 mb-3">Fichier CV</h2>
            <label className="cursor-pointer flex items-center gap-3 p-4 border-2 border-dashed border-slate-200 rounded-xl hover:border-blue-400 transition">
              <Upload size={20} className="text-slate-400" />
              <div>
                <p className="text-sm font-medium text-slate-700">{uploadingCV ? 'Envoi en cours...' : 'Déposer votre CV (PDF ou Word)'}</p>
                <p className="text-xs text-slate-500">Max 10 MB</p>
              </div>
              <input type="file" accept=".pdf,.doc,.docx" className="hidden" onChange={handleCVUpload} />
            </label>
          </div>
        )}

        {/* Save */}
        <div className="flex gap-3 pb-6">
          <button type="button" onClick={() => navigate('/profile')} className="flex-1 py-3 border border-slate-200 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition">
            Annuler
          </button>
          <button type="submit" disabled={saving} className="flex-1 py-3 bg-blue-600 hover:bg-blue-700 disabled:opacity-60 text-white font-semibold rounded-xl transition flex items-center justify-center gap-2">
            <Save size={16} /> {saving ? 'Sauvegarde...' : 'Sauvegarder'}
          </button>
        </div>
      </form>
    </div>
  );
}
