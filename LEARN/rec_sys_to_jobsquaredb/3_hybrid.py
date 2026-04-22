"""
=================================================================
  JobSquare.ma — Système de Recommandation Hybride Adaptatif
=================================================================
Combinaison pondérée de Content-Based (TF-IDF) et Collaborative
Filtering (SVD). Les poids s'ajustent selon l'activité du jobseeker.

  Cold-start  (< 5 candidatures)  → α_cb=0.90  α_cf=0.10
  Warm        (5–20 candidatures) → α_cb=0.45  α_cf=0.55
  Expert      (≥ 20 candidatures) → α_cb=0.25  α_cf=0.75

Bonus : recence des offres, featured, pénalité deja_vu.

Dépendances :
  pip install sqlalchemy mysql-connector-python scikit-learn pandas numpy scipy
"""

import re
from datetime import datetime
import numpy as np
import pandas as pd
from sqlalchemy import create_engine, text
from scipy.sparse import csr_matrix
from scipy.sparse.linalg import svds
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity


# ─────────────────────────────────────────────
# 1. CONFIGURATION
# ─────────────────────────────────────────────

DB_USER     = "root"
DB_PASSWORD = ""
DB_HOST     = "127.0.0.1"
DB_PORT     = "3306"
DB_NAME     = "jobsquaremadb"

ENGINE = create_engine(
    f"mysql+mysqlconnector://{DB_USER}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_NAME}",
    connect_args={"charset": "utf8mb4"},
)

COLD_THRESHOLD = 5
WARM_THRESHOLD = 20
WEIGHTS_COLD   = {"cb": 0.90, "cf": 0.10}
WEIGHTS_WARM   = {"cb": 0.45, "cf": 0.55}
WEIGHTS_EXPERT = {"cb": 0.25, "cf": 0.75}

STATUS_WEIGHTS = {"Acceptée": 3.0, "En attente": 1.0, "Rejetée": 0.3}

CB_W = {"text": 0.55, "region": 0.20, "experience": 0.15, "education": 0.10}

EXPERIENCE_ORDER = {
    "0 à 1 an": 0, "1 à 3 ans": 1, "3 à 5 ans": 2,
    "5 à 10 ans": 3, "Plus de 10 ans": 4,
}
EDUCATION_ORDER = {
    "Bac": 0, "DUT, BTS, Bac + 2": 1, "Bac + 3": 2,
    "Bac + 4": 3, "Bac + 5": 4, "Ingénieur": 4, "Doctorat": 5,
}


# ─────────────────────────────────────────────
# 2. CHARGEMENT DES DONNÉES
# ─────────────────────────────────────────────

def load_all_data(jobseeker_id: int) -> dict:
    """Charge offres, profil et candidatures en une passe."""

    jobs_q = text("""
        SELECT
            l.sid                       AS job_id,
            l.Title                     AS title,
            l.JobCategory               AS category,
            l.JobDescription            AS description,
            l.JobRequirements           AS requirements,
            l.id_Job_MotsCls            AS keywords,
            l.id_Job_Experience         AS experience_level,
            l.id_Job_Niveaudtude        AS education_level,
            l.Location_State            AS region,
            l.Location_City             AS city,
            l.id_Job_Rmunrationpropose  AS salary_range,
            l.EmploymentType            AS contract_type,
            l.activation_date           AS activation_date,
            l.featured                  AS featured,
            u.CompanyName               AS company
        FROM listings l
        LEFT JOIN users u ON l.user_sid = u.sid
        WHERE l.active = 1
          AND l.listing_type_sid = 6
          AND l.expiration_date > NOW()
    """)

    seeker_q = text("""
        SELECT
            u.sid,
            u.FullName                  AS name,
            u.CompanyDescription        AS competences,
            u.Location_State            AS region,
            u.Location_City             AS city,
            u.Secteur                   AS secteur,
            l.Title                     AS resume_title,
            l.JobDescription            AS resume_description,
            l.id_Job_MotsCls            AS resume_keywords,
            l.id_Job_Experience         AS experience_level,
            l.id_Job_Niveaudtude        AS education_level
        FROM users u
        LEFT JOIN listings l
            ON l.user_sid = u.sid
            AND l.listing_type_sid = 7
            AND l.active = 1
        WHERE u.sid = :sid
        LIMIT 1
    """)

    apps_q = text("""
        SELECT
            a.jobseeker_id,
            a.listing_id    AS job_id,
            a.status,
            a.deja_vu
        FROM applications a
        JOIN listings l ON l.sid = a.listing_id AND l.listing_type_sid = 6
    """)

    with ENGINE.connect() as conn:
        jobs_df = pd.read_sql(jobs_q, conn)
        result  = conn.execute(seeker_q, {"sid": jobseeker_id})
        row     = result.mappings().fetchone()
        profile = dict(row) if row else {}
        apps_df = pd.read_sql(apps_q, conn)

    return {"jobs": jobs_df, "profile": profile, "applications": apps_df}


# ─────────────────────────────────────────────
# 3. UTILITAIRES TEXTE
# ─────────────────────────────────────────────

def clean(val) -> str:
    if val is None or (isinstance(val, float) and np.isnan(val)):
        return ""
    t = re.sub(r"<[^>]+>", " ", str(val))
    t = re.sub(r"&[a-z]+;", " ", t)
    t = re.sub(r"[^a-zA-ZàâäéèêëîïôùûüçÀÂÄÉÈÊËÎÏÔÙÛÜÇ0-9\s,]", " ", t)
    return re.sub(r"\s+", " ", t).strip().lower()


def job_text(row) -> str:
    parts  = [clean(row.get("title"))]    * 3
    parts += [clean(row.get("keywords"))] * 2
    parts += [clean(row.get("category"))] * 2
    parts.append(clean(row.get("description")))
    parts.append(clean(row.get("requirements")))
    return " ".join(p for p in parts if p)


def seeker_text(p: dict) -> str:
    parts  = [clean(p.get("competences"))]    * 3
    parts += [clean(p.get("resume_keywords"))]* 2
    parts += [clean(p.get("resume_title"))]   * 2
    parts.append(clean(p.get("resume_description")))
    parts.append(clean(p.get("secteur")))
    return " ".join(p for p in parts if p)


# ─────────────────────────────────────────────
# 4. COMPOSANT CONTENT-BASED
# ─────────────────────────────────────────────

def compute_cb_scores(jobs: pd.DataFrame, profile: dict) -> np.ndarray:
    """Vecteur de scores content-based normalisés [0, 1]."""

    texts  = jobs.apply(job_text, axis=1).tolist()
    sk_txt = seeker_text(profile)
    vec    = TfidfVectorizer(ngram_range=(1, 2), min_df=1, max_df=0.95, sublinear_tf=True)
    mat    = vec.fit_transform(texts + [sk_txt])
    cos    = cosine_similarity(mat[-1], mat[:-1]).flatten()

    sk_reg = str(profile.get("region") or "")
    sk_exp = str(profile.get("experience_level") or "")
    sk_edu = str(profile.get("education_level") or "")

    def r_sc(v):
        return 1.0 if sk_reg and sk_reg.lower() in str(v).lower() else 0.0

    def e_sc(v):
        jl = EXPERIENCE_ORDER.get(str(v).strip(), -1)
        sl = EXPERIENCE_ORDER.get(sk_exp.strip(), -1)
        if jl < 0 or sl < 0: return 0.5
        d = sl - jl
        return 1.0 if d >= 0 else (0.5 if d == -1 else 0.0)

    def edu_sc(v):
        jl = EDUCATION_ORDER.get(str(v).strip(), -1)
        sl = EDUCATION_ORDER.get(sk_edu.strip(), -1)
        if jl < 0 or sl < 0: return 0.5
        d = sl - jl
        return 1.0 if d >= 0 else (0.4 if d == -1 else 0.0)

    reg = jobs["region"].apply(r_sc).values
    exp = jobs["experience_level"].apply(e_sc).values
    edu = jobs["education_level"].apply(edu_sc).values

    raw = CB_W["text"]*cos + CB_W["region"]*reg + CB_W["experience"]*exp + CB_W["education"]*edu
    mn, mx = raw.min(), raw.max()
    return (raw - mn) / (mx - mn + 1e-9)


# ─────────────────────────────────────────────
# 5. COMPOSANT COLLABORATIVE FILTERING (SVD)
# ─────────────────────────────────────────────

def compute_cf_scores(jobs: pd.DataFrame, apps: pd.DataFrame,
                      jobseeker_id: int, n_factors: int = 30) -> np.ndarray:
    """Vecteur de scores CF normalisés [0, 1] aligné sur jobs."""

    df = apps.copy()
    df["rating"] = df["status"].map(STATUS_WEIGHTS).fillna(1.0)
    df = df.groupby(["jobseeker_id", "job_id"], as_index=False).agg(
        rating=("rating", "max")
    )

    seekers = sorted(df["jobseeker_id"].unique())
    job_ids = sorted(df["job_id"].unique())
    if len(seekers) < 2 or len(job_ids) < 2 or jobseeker_id not in seekers:
        return np.zeros(len(jobs))

    s2i = {s: i for i, s in enumerate(seekers)}
    j2i = {j: i for i, j in enumerate(job_ids)}
    i2j = {i: j for j, i in j2i.items()}

    R = csr_matrix(
        (df["rating"].values,
         (df["jobseeker_id"].map(s2i).values, df["job_id"].map(j2i).values)),
        shape=(len(seekers), len(job_ids)), dtype=np.float32
    ).toarray().astype(np.float64)

    mean_r = np.nan_to_num(np.nanmean(np.where(R > 0, R, np.nan), axis=1, keepdims=True))
    R_c = R - mean_r * (R > 0)

    k = min(n_factors, min(R.shape) - 1)
    U, S, Vt = svds(R_c, k=k)
    order = np.argsort(S)[::-1]
    U, S, Vt = U[:, order], S[order], Vt[order, :]
    pred = np.dot(np.dot(U, np.diag(S)), Vt) + mean_r

    si  = s2i[jobseeker_id]
    pv  = pred[si]

    result = np.zeros(len(jobs))
    for pos, jid in enumerate(jobs["job_id"].tolist()):
        if jid in j2i:
            result[pos] = pv[j2i[jid]]

    mn, mx = result.min(), result.max()
    return (result - mn) / (mx - mn + 1e-9)


# ─────────────────────────────────────────────
# 6. BONUS / PÉNALITÉS
# ─────────────────────────────────────────────

def recency_boost(jobs: pd.DataFrame, decay_days: float = 30.0) -> np.ndarray:
    now = datetime.now()
    def age(dt):
        try:
            d = max(0, (now - pd.to_datetime(dt).to_pydatetime()).days)
            return np.exp(-d / decay_days)
        except Exception:
            return 0.5
    return jobs["activation_date"].apply(age).values


def deja_vu_penalty(jobs: pd.DataFrame, apps: pd.DataFrame,
                    jobseeker_id: int, penalty: float = 0.6) -> np.ndarray:
    seen = set(apps.loc[(apps["jobseeker_id"] == jobseeker_id) &
                        (apps["deja_vu"] == 1), "job_id"])
    return np.where(jobs["job_id"].isin(seen), penalty, 1.0)


def applied_mask(jobs: pd.DataFrame, apps: pd.DataFrame,
                 jobseeker_id: int) -> np.ndarray:
    done = set(apps.loc[apps["jobseeker_id"] == jobseeker_id, "job_id"])
    return np.where(jobs["job_id"].isin(done), 0.0, 1.0)


# ─────────────────────────────────────────────
# 7. MOTEUR HYBRIDE
# ─────────────────────────────────────────────

class HybridRecommender:

    def recommend(self, jobs: pd.DataFrame, profile: dict, apps: pd.DataFrame,
                  jobseeker_id: int, n_factors: int = 30, top_n: int = 10) -> pd.DataFrame:

        n_apps = len(apps[apps["jobseeker_id"] == jobseeker_id])

        if n_apps < COLD_THRESHOLD:
            w, regime = WEIGHTS_COLD, f"Cold-start (n={n_apps})"
        elif n_apps < WARM_THRESHOLD:
            w, regime = WEIGHTS_WARM, f"Warm (n={n_apps})"
        else:
            w, regime = WEIGHTS_EXPERT, f"Expert (n={n_apps})"

        print(f"[Hybride] Régime : {regime} | α_cb={w['cb']} α_cf={w['cf']}")

        print("[Hybride] Scores content-based...")
        cb = compute_cb_scores(jobs, profile)

        print("[Hybride] Scores collaborative filtering (SVD)...")
        cf = compute_cf_scores(jobs, apps, jobseeker_id, n_factors)

        hybrid = w["cb"] * cb + w["cf"] * cf

        # Bonus recence + featured
        rec  = recency_boost(jobs)
        feat = pd.to_numeric(jobs["featured"], errors="coerce").fillna(0).values
        hybrid = hybrid * (0.7 + 0.3 * rec) * (1.0 + 0.08 * feat)

        # Pénalités
        hybrid = hybrid * deja_vu_penalty(jobs, apps, jobseeker_id)
        hybrid = hybrid * applied_mask(jobs, apps, jobseeker_id)

        top_idx = np.argsort(hybrid)[::-1][:top_n]
        out = jobs.iloc[top_idx].copy()
        out["score_hybride"] = (hybrid[top_idx] * 100).round(1)
        out["score_cb"]      = (cb[top_idx]     * 100).round(1)
        out["score_cf"]      = (cf[top_idx]     * 100).round(1)
        out["recence"]       = (rec[top_idx]    * 100).round(1)
        out["regime"]        = regime
        out["alpha_cb"]      = w["cb"]
        out["alpha_cf"]      = w["cf"]
        return out.reset_index(drop=True)


# ─────────────────────────────────────────────
# 8. POINT D'ENTRÉE
# ─────────────────────────────────────────────

def main():
    JOBSEEKER_ID = 2000036
    N_FACTORS    = 30
    TOP_N        = 10

    print("=" * 65)
    print("  JobSquare — Recommandation Hybride Adaptative")
    print("  (TF-IDF Content-Based  ×  SVD Collaborative Filtering)")
    print("=" * 65)

    print("\n[1] Chargement des données...")
    data = load_all_data(JOBSEEKER_ID)
    jobs, profile, apps = data["jobs"], data["profile"], data["applications"]

    if jobs.empty:
        print("[ERREUR] Aucune offre active."); return
    if not profile:
        print(f"[ERREUR] Jobseeker {JOBSEEKER_ID} introuvable."); return

    print(f"    → {len(jobs)} offres | {len(apps)} interactions")
    print(f"    → Profil : {profile.get('name')} | "
          f"Région : {profile.get('region')} | "
          f"Exp : {profile.get('experience_level')}")

    print("\n[2] Calcul hybride...")
    engine = HybridRecommender()
    recs = engine.recommend(jobs, profile, apps, JOBSEEKER_ID,
                            n_factors=N_FACTORS, top_n=TOP_N)

    print(f"\n{'═'*65}")
    print(f"  Top {TOP_N} recommandations — {profile.get('name')}")
    print(f"  Régime : {recs['regime'].iloc[0]}  |  "
          f"α_cb={recs['alpha_cb'].iloc[0]}  α_cf={recs['alpha_cf'].iloc[0]}")
    print(f"{'═'*65}")

    for i, row in recs.iterrows():
        print(f"\n  #{i+1:02d}  {row['title']}")
        print(f"       Entreprise  : {row.get('company','N/A')} — {row['city']}")
        print(f"       Catégorie   : {row['category']}")
        print(f"       Salaire     : {row['salary_range']}")
        print(f"       Score hybr. : {row['score_hybride']}%  "
              f"(CB={row['score_cb']}%  CF={row['score_cf']}%  "
              f"recence={row['recence']}%)")

    # Tableau comparatif
    print(f"\n{'─'*65}")
    print(f"  {'Offre':<36} {'CB':>6} {'CF':>6} {'Hybride':>8}")
    print(f"  {'─'*36} {'─'*6} {'─'*6} {'─'*8}")
    for _, row in recs.head(5).iterrows():
        t = str(row['title'])[:35]
        print(f"  {t:<36} {row['score_cb']:>5.1f}% {row['score_cf']:>5.1f}% "
              f"{row['score_hybride']:>7.1f}%")

    cols = ["job_id", "title", "company", "city", "region", "salary_range",
            "contract_type", "category", "score_hybride", "score_cb",
            "score_cf", "recence", "regime", "alpha_cb", "alpha_cf"]
    recs[cols].to_csv("recommendations_hybride.csv", index=False, encoding="utf-8-sig")
    print(f"\n[✓] Exporté : recommendations_hybride.csv")


if __name__ == "__main__":
    main()
