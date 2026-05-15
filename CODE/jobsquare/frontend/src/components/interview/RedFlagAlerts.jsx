const PHASE_FR = {
  introduction:         "Présentation",
  adaptabilite:         "Adaptabilité",
  intelligence_sociale: "Intelligence sociale",
  alignement:           "Alignement",
  hard_skills:          "Compétences techniques",
  maitrise_projet:      "Maîtrise projet",
  mindset:              "Logique",
  maturite:             "Maturité",
};

function translateFlag(flag) {
  // Traduire "Authenticité douteuse — phase xxx" → "Authenticité douteuse — Maîtrise projet"
  return flag.replace(/— phase (\w+)/, (_, phase) =>
    `— ${PHASE_FR[phase] || phase}`
  );
}

export default function RedFlagAlerts({ flags }) {
  if (!flags || flags.length === 0) return null;
  return (
    <div className="bg-white rounded-2xl border border-red-100 shadow-sm p-5">
      <div className="flex items-center gap-2 mb-4">
        <span className="text-2xl">🚨</span>
        <h2 className="font-semibold text-red-800">
          Points d'attention détectés ({flags.length})
        </h2>
      </div>
      <div className="space-y-2">
        {flags.map((flag, i) => (
          <div key={i} className="flex items-start gap-3 bg-red-50 border border-red-100 rounded-xl px-4 py-3">
            <span className="text-red-500 mt-0.5 flex-shrink-0">⚠</span>
            <p className="text-sm text-red-700">{translateFlag(flag)}</p>
          </div>
        ))}
      </div>
      <p className="text-xs text-gray-400 mt-3">
        Ces signaux sont automatiquement détectés par l'IA et doivent être interprétés avec discernement par le recruteur.
      </p>
    </div>
  );
}