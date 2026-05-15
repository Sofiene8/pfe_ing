// frontend/src/components/ui/ChatbotWidget.jsx
import { useState, useRef, useEffect } from 'react';
import {
  MessageCircle, X, Send, Search, Briefcase, MapPin, Building2,
  ChevronDown, ChevronUp, CheckCircle, XCircle, Lightbulb,
  ArrowRight, Loader2, RotateCcw, Sparkles,
} from 'lucide-react';
import axios from 'axios';

// ── API ────────────────────────────────────────────────────────────────────────
const api = axios.create({ baseURL: '/api/v1', timeout: 60000 });
api.interceptors.request.use(cfg => {
  const token =
    localStorage.getItem('access_token') ||
    (() => {
      try { return JSON.parse(localStorage.getItem('auth-storage') || '{}')?.state?.token; }
      catch { return null; }
    })();
  if (token) cfg.headers.Authorization = `Bearer ${token}`;
  return cfg;
});

// ── Normalize (accents + apostrophes) ────────────────────────────────────────
function norm(text) {
  return text
    .toLowerCase()
    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
    .replace(/['\u2018\u2019`´]/g, ' ')
    .replace(/[^a-z0-9\s]/g, ' ')
    .replace(/\s+/g, ' ').trim();
}

// ── Interview detection ───────────────────────────────────────────────────────
const INTERVIEW_KW = [
  'entretien','ntretien','entretient','interview',
  'preparer','preparation','prepare',
  'comment reussir','comment passer','comment convaincre','comment preparer',
  'conseils','conseil','tips','astuce',
  'recruteur','recrutement',
  'soft skills','softskills','competence',
  'comportemental','comportement',
  'salaire','negocier','negociation',
  'lettre motivation','reussir','candidature','methode star',
];
function detectMode(text) {
  const n = norm(text);
  return INTERVIEW_KW.some(kw => n.includes(kw)) ? 'interview' : 'search';
}

// ── Render italic *text* ──────────────────────────────────────────────────────
function Msg({ text }) {
  if (!text) return null;
  const parts = text.split(/\*([^*]+)\*/g);
  return <>{parts.map((p, i) => i % 2 === 1
    ? <em key={i} className="not-italic font-semibold text-indigo-600">{p}</em>
    : p
  )}</>;
}

// ── JobCard ───────────────────────────────────────────────────────────────────
function JobCard({ job }) {
  if (!job.title) return null;
  const sc = job.score >= 70 ? 'bg-emerald-100 text-emerald-700'
           : job.score >= 50 ? 'bg-amber-100 text-amber-700'
           : 'bg-slate-100 text-slate-500';
  return (
    <a href={job.id ? `/jobs/${job.id}` : '#'}
      className="block bg-white rounded-xl border border-slate-100 p-3 hover:border-indigo-200 hover:shadow-sm transition-all group">
      <div className="flex items-start justify-between gap-2 mb-1">
        <p className="font-semibold text-slate-800 text-sm line-clamp-1 group-hover:text-indigo-600">{job.title}</p>
        {job.score > 0 && <span className={`text-xs font-bold px-2 py-0.5 rounded-full shrink-0 ${sc}`}>{job.score}%</span>}
      </div>
      <div className="flex flex-wrap gap-x-3 gap-y-0.5 text-xs text-slate-400">
        {job.company  && <span className="flex items-center gap-1"><Building2 size={10}/>{job.company}</span>}
        {job.location && <span className="flex items-center gap-1"><MapPin size={10}/>{job.location}</span>}
        {job.contract && <span className="flex items-center gap-1"><Briefcase size={10}/>{job.contract}</span>}
      </div>
    </a>
  );
}

// ── InterviewAdvice ───────────────────────────────────────────────────────────
function InterviewAdvice({ data }) {
  const [open, setOpen] = useState('technical');
  if (!data?.technical) return null;
  const toggle = k => setOpen(p => p === k ? null : k);
  const Sec = ({ id, emoji, title, children }) => (
    <div className="border border-slate-100 rounded-xl overflow-hidden mb-2">
      <button onClick={() => toggle(id)}
        className="w-full flex items-center justify-between px-3 py-2.5 bg-slate-50 hover:bg-slate-100 transition text-left">
        <span className="text-xs font-semibold text-slate-700 flex items-center gap-1.5"><span>{emoji}</span>{title}</span>
        {open === id ? <ChevronUp size={13} className="text-slate-400"/> : <ChevronDown size={13} className="text-slate-400"/>}
      </button>
      {open === id && <div className="p-3 bg-white text-xs">{children}</div>}
    </div>
  );
  return (
    <div className="space-y-0.5 text-xs">
      {data.resume && <div className="bg-indigo-50 rounded-xl p-2.5 mb-2 border border-indigo-100"><p className="text-indigo-700 font-medium">{data.resume}</p></div>}
      <Sec id="technical" emoji="🛠️" title={data.technical.title||'Technique'}>
        <ul className="space-y-1 mb-2">{data.technical.tips?.map((t,i)=><li key={i} className="flex gap-1.5 text-slate-600"><span className="text-indigo-400 shrink-0">▸</span>{t}</li>)}</ul>
        {data.technical.likely_questions?.length>0&&<div className="space-y-1 mt-2">
          <p className="font-semibold text-slate-500 mb-1">Questions probables :</p>
          {data.technical.likely_questions.map((q,i)=><p key={i} className="text-slate-500 bg-slate-50 rounded px-2 py-1 italic">"{q}"</p>)}
        </div>}
      </Sec>
      {data.softskills&&<Sec id="softskills" emoji="🤝" title={data.softskills.title||'Soft Skills'}>
        <div className="space-y-1.5">{data.softskills.skills?.map((s,i)=><div key={i} className="bg-amber-50 rounded p-2 border border-amber-100"><p className="font-semibold text-amber-700">{s.name}</p><p className="text-amber-600">{s.how}</p></div>)}</div>
      </Sec>}
      {data.communication&&<Sec id="communication" emoji="💬" title={data.communication.title||'Communication'}>
        <ul className="space-y-1 mb-2">{data.communication.tips?.map((t,i)=><li key={i} className="flex gap-1.5 text-slate-600"><span className="text-blue-400">▸</span>{t}</li>)}</ul>
        <div className="grid grid-cols-2 gap-2 mt-2">
          <div><p className="font-semibold text-green-600 mb-1 flex items-center gap-1"><CheckCircle size={10}/>À faire</p>{data.communication.dos?.map((d,i)=><p key={i} className="text-slate-500 mb-0.5">✓ {d}</p>)}</div>
          <div><p className="font-semibold text-red-500 mb-1 flex items-center gap-1"><XCircle size={10}/>À éviter</p>{data.communication.donts?.map((d,i)=><p key={i} className="text-slate-500 mb-0.5">✗ {d}</p>)}</div>
        </div>
      </Sec>}
      {data.behavioral&&<Sec id="behavioral" emoji="⭐" title={data.behavioral.title||'STAR'}>
        {data.behavioral.intro&&<p className="text-indigo-600 bg-indigo-50 rounded px-2 py-1.5 mb-2">{data.behavioral.intro}</p>}
        <div className="space-y-1.5">{data.behavioral.questions?.map((q,i)=><div key={i} className="border border-slate-100 rounded p-2"><p className="font-medium text-slate-700 mb-0.5">"{q.question}"</p><p className="text-slate-500 flex gap-1"><Lightbulb size={10} className="text-amber-400 shrink-0 mt-0.5"/>{q.hint}</p></div>)}</div>
      </Sec>}
      {data.final_tips?.length>0&&<div className="bg-green-50 rounded-xl p-2.5 border border-green-100 mt-1">
        <p className="font-semibold text-green-700 mb-1">💪 Conseils finaux</p>
        {data.final_tips.map((t,i)=><p key={i} className="text-green-600 flex gap-1 mb-0.5"><ArrowRight size={10} className="shrink-0 mt-0.5"/>{t}</p>)}
      </div>}
    </div>
  );
}

// ── ModeNotice ────────────────────────────────────────────────────────────────
function ModeNotice({ mode }) {
  return (
    <div className="flex justify-center my-2">
      <span className="text-[10px] text-slate-400 bg-slate-100 rounded-full px-3 py-1 flex items-center gap-1.5">
        <Sparkles size={9}/>
        {mode === 'interview' ? '🎯 Mode entretien' : '🔍 Mode recherche'}
      </span>
    </div>
  );
}

// ── Message ───────────────────────────────────────────────────────────────────
function Message({ msg }) {
  if (msg.role === 'notice') return <ModeNotice mode={msg.mode}/>;
  if (msg.role === 'user') return (
    <div className="flex justify-end mb-3">
      <div className="bg-indigo-600 text-white text-sm rounded-2xl rounded-tr-sm px-3.5 py-2 max-w-[80%] break-words">{msg.content}</div>
    </div>
  );
  return (
    <div className="flex gap-2 mb-3">
      <div className="w-6 h-6 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-xs shrink-0 mt-0.5">🤖</div>
      <div className="flex-1 min-w-0 space-y-2">
        {msg.content && (
          <div className="bg-slate-100 text-slate-800 text-sm rounded-2xl rounded-tl-sm px-3.5 py-2 max-w-[92%] leading-relaxed break-words">
            <Msg text={msg.content}/>
          </div>
        )}
        {msg.jobs?.length > 0 && <div className="space-y-1.5">{msg.jobs.map((j,i)=><JobCard key={j.id||i} job={j}/>)}</div>}
        {msg.advice?.technical && <InterviewAdvice data={msg.advice}/>}
      </div>
    </div>
  );
}

// ── WIDGET ────────────────────────────────────────────────────────────────────
const WELCOME = {
  search:    "👋 Décrivez le type d'emploi que vous cherchez, vos compétences ou votre secteur. Je trouverai les offres les plus adaptées.",
  interview: "🎯 Décrivez le poste pour lequel vous passez un entretien. Je génèrerai des conseils personnalisés.",
};

export default function ChatbotWidget() {
  const [open,    setOpen]    = useState(false);
  const [mode,    setMode]    = useState(() => {
    try { return sessionStorage.getItem('chatbot_mode') || 'search'; } catch { return 'search'; }
  });
  const [msgs,    setMsgs]    = useState(() => {
    try {
      const saved = sessionStorage.getItem('chatbot_msgs');
      if (saved) return JSON.parse(saved);
    } catch {}
    return [{ role:'bot', content: WELCOME.search }];
  });
  const [input,   setInput]   = useState('');
  const [loading, setLoading] = useState(false);
  // KEY STATE: remembers that bot asked for job clarification
  const [waitingJob, setWaitingJob] = useState(() => {
    try { return sessionStorage.getItem('chatbot_waiting') === 'true'; } catch { return false; }
  });

  const bottomRef = useRef(null);
  const inputRef  = useRef(null);

  useEffect(() => { bottomRef.current?.scrollIntoView({ behavior:'smooth' }); }, [msgs, loading]);
  useEffect(() => { if (open) setTimeout(() => inputRef.current?.focus(), 150); }, [open]);

  // Persist conversation to sessionStorage (survives widget close/reopen, clears on tab close)
  useEffect(() => {
    try {
      // Only save last 50 messages to avoid bloat
      const toSave = msgs.slice(-50);
      sessionStorage.setItem('chatbot_msgs', JSON.stringify(toSave));
      sessionStorage.setItem('chatbot_mode', mode);
      sessionStorage.setItem('chatbot_waiting', String(waitingJob));
    } catch {}
  }, [msgs, mode, waitingJob]);

  const send = async () => {
    const text = input.trim();
    if (!text || loading) return;

    // CRITICAL: if bot asked for job clarification, force interview mode
    // This prevents "Data Analyst" from being sent as a search query
    const detectedMode = waitingJob ? 'interview' : detectMode(text);
    const modeChanged  = detectedMode !== mode && !waitingJob;

    const toAdd = [{ role:'user', content:text }];
    if (modeChanged) toAdd.push({ role:'notice', mode:detectedMode });
    if (modeChanged) setMode(detectedMode);

    setMsgs(prev => [...prev, ...toAdd]);
    setInput('');
    setLoading(true);

    try {
      const { data } = await api.post('/chatbot/message', { message:text, mode:detectedMode });

      if (detectedMode === 'interview') {
        if (data.needs_clarification) {
          // Bot asked for clarification → set waitingJob=true
          setWaitingJob(true);
          setMsgs(prev => [...prev, { role:'bot', content: data.message }]);
        } else if (data.technical) {
          // Got real advice → clear waiting state
          setWaitingJob(false);
          setMsgs(prev => [...prev, { role:'bot', content:'Voici vos conseils personnalisés :', advice:data }]);
        } else {
          setWaitingJob(false);
          setMsgs(prev => [...prev, { role:'bot', content: data.message || 'Précisez le poste visé.' }]);
        }
      } else {
        setWaitingJob(false);
        setMsgs(prev => [...prev, { role:'bot', content:data.message||'', jobs:data.jobs||[] }]);
      }
    } catch (err) {
      setWaitingJob(false);
      setMsgs(prev => [...prev, { role:'bot', content:`❌ ${err.response?.data?.detail||'Erreur réseau. Réessayez.'}` }]);
    } finally {
      setLoading(false);
      setTimeout(() => inputRef.current?.focus(), 100);
    }
  };

  const reset = () => {
    setMode('search');
    setInput('');
    setWaitingJob(false);
    setMsgs([{ role:'bot', content: WELCOME.search }]);
    try {
      sessionStorage.removeItem('chatbot_msgs');
      sessionStorage.removeItem('chatbot_mode');
      sessionStorage.removeItem('chatbot_waiting');
    } catch {}
  };

  const switchMode = newMode => {
    if (newMode === mode) return;
    setMode(newMode);
    setWaitingJob(false);
    // Preserve history, just add notice + welcome
    setMsgs(prev => [...prev,
      { role:'notice', mode:newMode },
      { role:'bot', content: WELCOME[newMode] },
    ]);
  };

  return (
    <>
      <button onClick={() => setOpen(o=>!o)}
        className="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 text-white shadow-lg hover:scale-105 transition-all flex items-center justify-center"
        aria-label="Assistant JobSquare">
        {open ? <X size={22}/> : <MessageCircle size={22}/>}
        {!open && <span className="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"/>}
      </button>

      {open && (
        <div className="fixed bottom-24 right-6 z-50 w-[380px] max-w-[calc(100vw-24px)] bg-white rounded-2xl shadow-2xl border border-slate-200 flex flex-col overflow-hidden"
          style={{ height:'580px' }}>

          {/* Header */}
          <div className="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-3 flex items-center justify-between shrink-0">
            <div className="flex items-center gap-2.5">
              <div className="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">🤖</div>
              <div>
                <p className="text-white font-semibold text-sm">Assistant JobSquare</p>
                <p className="text-indigo-200 text-xs flex items-center gap-1"><Sparkles size={10}/>IA · RAG · Groq</p>
              </div>
            </div>
            <button onClick={reset} title="Réinitialiser" className="text-white/70 hover:text-white transition">
              <RotateCcw size={15}/>
            </button>
          </div>

          {/* Tabs */}
          <div className="flex border-b border-slate-100 shrink-0">
            {[
              { key:'search',    icon:<Search size={12}/>,    label:'Recherche emploi'   },
              { key:'interview', icon:<Briefcase size={12}/>, label:'Préparer entretien'  },
            ].map(({key,icon,label}) => (
              <button key={key} onClick={() => switchMode(key)}
                className={`flex-1 flex items-center justify-center gap-1.5 py-2.5 text-xs font-semibold transition-all
                  ${mode===key ? 'text-indigo-600 border-b-2 border-indigo-600 bg-indigo-50/40' : 'text-slate-400 hover:text-slate-600'}`}>
                {icon}{label}
              </button>
            ))}
          </div>

          {/* Messages */}
          <div className="flex-1 overflow-y-auto px-3 py-3">
            {msgs.map((msg,i) => <Message key={i} msg={msg}/>)}
            {loading && (
              <div className="flex gap-2 mb-3">
                <div className="w-6 h-6 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-xs shrink-0">🤖</div>
                <div className="bg-slate-100 rounded-2xl rounded-tl-sm px-3.5 py-2 flex items-center gap-2">
                  <Loader2 size={13} className="animate-spin text-indigo-500"/>
                  <span className="text-xs text-slate-500">{mode==='interview' ? 'Génération des conseils...' : 'Recherche en cours...'}</span>
                </div>
              </div>
            )}
            <div ref={bottomRef}/>
          </div>

          {/* Input */}
          <div className="border-t border-slate-100 px-3 py-2.5 flex gap-2 items-end shrink-0">
            <textarea ref={inputRef} value={input}
              onChange={e => setInput(e.target.value)}
              onKeyDown={e => { if (e.key==='Enter' && !e.shiftKey) { e.preventDefault(); send(); } }}
              placeholder={waitingJob
                ? 'Ex: Data Analyst, Développeur React, Comptable...'
                : mode==='search'
                  ? 'Ex: développeur React, comptable senior...'
                  : 'Ex: Data Analyst, Développeur Full Stack...'}
              rows={2}
              className="flex-1 resize-none text-sm border border-slate-200 rounded-xl px-3 py-2 focus:outline-none focus:border-indigo-400 placeholder-slate-300 max-h-20 min-h-[44px] leading-relaxed"/>
            <button onClick={send} disabled={!input.trim()||loading}
              className="w-9 h-9 rounded-xl bg-indigo-600 text-white flex items-center justify-center hover:bg-indigo-700 disabled:opacity-40 disabled:cursor-not-allowed transition shrink-0">
              {loading ? <Loader2 size={15} className="animate-spin"/> : <Send size={15}/>}
            </button>
          </div>
        </div>
      )}
    </>
  );
}