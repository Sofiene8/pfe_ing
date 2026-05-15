const LABELS = {
  "Strong Hire": "Fortement recommande",
  "Hire":        "Recommande",
  "Lean Hire":   "Plutot recommande",
  "No Hire":     "Non recommande",
};

const CONFIG = {
  "Strong Hire": { bg: "bg-emerald-100", text: "text-emerald-800", border: "border-emerald-300", dot: "bg-emerald-500", emoji: "🚀" },
  "Hire":        { bg: "bg-blue-100",    text: "text-blue-800",    border: "border-blue-300",    dot: "bg-blue-500",    emoji: "✅" },
  "Lean Hire":   { bg: "bg-amber-100",   text: "text-amber-800",   border: "border-amber-300",   dot: "bg-amber-500",   emoji: "🤔" },
  "No Hire":     { bg: "bg-red-100",     text: "text-red-800",     border: "border-red-300",     dot: "bg-red-500",     emoji: "❌" },
};

export default function HireDecisionBadge({ classification, large = false }) {
  const c = CONFIG[classification] || CONFIG["Lean Hire"];
  const label = LABELS[classification] || classification;
  return (
    <div className={`inline-flex items-center gap-2 border rounded-2xl font-semibold ${c.bg} ${c.text} ${c.border} ${large ? "px-6 py-3 text-base" : "px-4 py-2 text-sm"}`}>
      <span className={`w-2.5 h-2.5 rounded-full ${c.dot}`} />
      <span>{c.emoji}</span>
      <span>{label}</span>
    </div>
  );
}