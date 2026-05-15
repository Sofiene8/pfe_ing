import { useMemo } from "react";

const SIZE = 300;
const CENTER = SIZE / 2;
const RADIUS = 95;
const LEVELS = 4;

const SHORT_LABELS = {
  introduction:         "Présentation",
  adaptabilite:         "Adaptabilité",
  intelligence_sociale: "Social",
  alignement:           "Alignement",
  hard_skills:          "Technique",
  maitrise_projet:      "Projet",
  mindset:              "Logique",
  maturite:             "Maturité",
};

function polarToXY(angle, radius) {
  const rad = (angle - 90) * (Math.PI / 180);
  return { x: CENTER + radius * Math.cos(rad), y: CENTER + radius * Math.sin(rad) };
}

function getScoreColor(score) {
  if (score >= 75) return "#22c55e";
  if (score >= 55) return "#3b82f6";
  if (score >= 40) return "#f59e0b";
  return "#ef4444";
}

export default function RadarChart({ data }) {
  const n = data.length;
  const angleStep = 360 / n;

  const axes = useMemo(() =>
    data.map((d, i) => {
      const angle = i * angleStep;
      const tip   = polarToXY(angle, RADIUS);
      const label = polarToXY(angle, RADIUS + 26);
      return { ...d, angle, tip, label };
    }), [data, angleStep]);

  const gridPolygons = useMemo(() =>
    Array.from({ length: LEVELS }, (_, lvl) => {
      const r = (RADIUS * (lvl + 1)) / LEVELS;
      return Array.from({ length: n }, (_, i) => {
        const { x, y } = polarToXY(i * angleStep, r);
        return `${x},${y}`;
      }).join(" ");
    }), [n, angleStep]);

  const dataPolygon = useMemo(() =>
    axes.map(({ angle, score }) => {
      const r = (score / 100) * RADIUS;
      const { x, y } = polarToXY(angle, r);
      return `${x},${y}`;
    }).join(" "), [axes]);

  return (
    <div className="flex flex-col items-center">
      <svg width={SIZE} height={SIZE} viewBox={`0 0 ${SIZE} ${SIZE}`}>
        {/* Grilles */}
        {gridPolygons.map((pts, i) => (
          <polygon key={i} points={pts} fill="none" stroke="#e5e7eb" strokeWidth="1" />
        ))}
        {/* Axes */}
        {axes.map(({ tip }, i) => (
          <line key={i} x1={CENTER} y1={CENTER} x2={tip.x} y2={tip.y} stroke="#e5e7eb" strokeWidth="1" />
        ))}
        {/* Données */}
        <polygon points={dataPolygon} fill="rgba(59,130,246,0.15)" stroke="#3b82f6" strokeWidth="2" />
        {/* Points */}
        {axes.map(({ angle, score }, i) => {
          const r = (score / 100) * RADIUS;
          const { x, y } = polarToXY(angle, r);
          return <circle key={i} cx={x} cy={y} r={5} fill={getScoreColor(score)} />;
        })}
        {/* Labels */}
        {axes.map(({ label, phase }, i) => (
          <text key={i} x={label.x} y={label.y} textAnchor="middle" dominantBaseline="middle" fontSize="9.5" fontWeight="600" fill="#374151">
            {SHORT_LABELS[phase] || phase}
          </text>
        ))}
      </svg>

      {/* Légende */}
      <div className="grid grid-cols-2 gap-x-6 gap-y-1.5 mt-1 w-full px-2">
        {data.map((d) => (
          <div key={d.phase} className="flex items-center gap-2 text-xs">
            <div className="w-2.5 h-2.5 rounded-full flex-shrink-0" style={{ backgroundColor: getScoreColor(d.score) }} />
            <span className="text-gray-500 truncate">{SHORT_LABELS[d.phase] || d.label}</span>
            <span className="ml-auto font-bold text-gray-700">{Math.round(d.score)}</span>
          </div>
        ))}
      </div>
    </div>
  );
}