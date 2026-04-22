"""
============================================================
  JobSquare.ma — Système de Recommandation Content-Based
============================================================
Approche : TF-IDF + Cosine Similarity sur les champs textuels
           des offres d'emploi (listings) et du profil jobseeker.

Tables utilisées :
  - listings : Title, JobCategory, JobDescription, JobRequirements,
               id_Job_MotsCls, id_Job_Experience, id_Job_Niveaudtude,
               Location_State, id_Job_Rmunrationpropose
  - users    : CompanyDescription (compétences), Location_State,
               Location_City, FullName, Secteur

Dépendances :
  pip install sqlalchemy mysql-connector-python scikit-learn pandas numpy
"""

import re
import pandas as pd
import numpy as np
from sqlalchemy import create_engine, text
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity


# ─────────────────────────────────────────────
# 1. CONFIGURATION BASE DE DONNÉES
# ─────────────────────────────────────────────

DB_USER     = "root"
DB_PASSWORD = ""          # Mettez votre mot de passe ici
DB_HOST     = "127.0.0.1"
DB_PORT     = "3306"
DB_NAME     = "jobsquaremadb"

ENGINE = create_engine(
    f"mysql+mysqlconnector://{DB_USER}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_NAME}",
    connect_args={"charset": "utf8mb4"},
)


# ─────────────────────────────────────────────
# 2. CHARGEMENT DES DONNÉES
# ─────────────────────────────────────────────

def load_jobs() -> pd.DataFrame:
    """Charge les offres d'emploi actives."""
    query = text("""
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
    with ENGINE.connect() as conn:
        return pd.read_sql(query, conn)


def load_jobseeker_profile(jobseeker_id: int) -> dict:
    """Charge le profil d'un jobseeker (user_group_sid = 36)."""
    query = text("""
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
    with ENGINE.connect() as conn:
        result = conn.execute(query, {"sid": jobseeker_id})
        row = result.mappings().fetchone()
        return dict(row) if row else {}


# ─────────────────────────────────────────────
# 3. PRÉ-TRAITEMENT DU TEXTE
# ─────────────────────────────────────────────

def clean_text(val) -> str:
    if val is None or (isinstance(val, float) and np.isnan(val)):
        return ""
    t = re.sub(r"<[^>]+>", " ", str(val))
    t = re.sub(r"&[a-z]+;", " ", t)
    t = re.sub(r"[^a-zA-ZàâäéèêëîïôùûüçÀÂÄÉÈÊËÎÏÔÙÛÜÇ0-9\s,]", " ", t)
    return re.sub(r"\s+", " ", t).strip().lower()


def build_job_text(row: pd.Series) -> str:
    """Profil textuel d'une offre — répétition = pondération."""
    parts  = [clean_text(row.get("title"))]    * 3
    parts += [clean_text(row.get("keywords"))] * 2
    parts += [clean_text(row.get("category"))] * 2
    parts.append(clean_text(row.get("description")))
    parts.append(clean_text(row.get("requirements")))
    return " ".join(p for p in parts if p)


def build_seeker_text(profile: dict) -> str:
    """Profil textuel du jobseeker."""
    parts  = [clean_text(profile.get("competences"))]    * 3
    parts += [clean_text(profile.get("resume_keywords"))]* 2
    parts += [clean_text(profile.get("resume_title"))]   * 2
    parts.append(clean_text(profile.get("resume_description")))
    parts.append(clean_text(profile.get("secteur")))
    return " ".join(p for p in parts if p)


# ─────────────────────────────────────────────
# 4. SCORES STRUCTURÉS
# ─────────────────────────────────────────────

EXPERIENCE_ORDER = {
    "0 à 1 an": 0, "1 à 3 ans": 1, "3 à 5 ans": 2,
    "5 à 10 ans": 3, "Plus de 10 ans": 4,
}
EDUCATION_ORDER = {
    "Bac": 0, "DUT, BTS, Bac + 2": 1, "Bac + 3": 2,
    "Bac + 4": 3, "Bac + 5": 4, "Ingénieur": 4, "Doctorat": 5,
}


def region_score(job_region, seeker_region: str) -> float:
    if not job_region or not seeker_region:
        return 0.5
    return 1.0 if seeker_region.strip().lower() in str(job_region).lower() else 0.0


def experience_score(job_exp, seeker_exp: str) -> float:
    jl = EXPERIENCE_ORDER.get(str(job_exp).strip(), -1)
    sl = EXPERIENCE_ORDER.get(str(seeker_exp).strip(), -1)
    if jl < 0 or sl < 0:
        return 0.5
    diff = sl - jl
    return 1.0 if diff >= 0 else (0.5 if diff == -1 else 0.0)


def education_score(job_edu, seeker_edu: str) -> float:
    jl = EDUCATION_ORDER.get(str(job_edu).strip(), -1)
    sl = EDUCATION_ORDER.get(str(seeker_edu).strip(), -1)
    if jl < 0 or sl < 0:
        return 0.5
    diff = sl - jl
    return 1.0 if diff >= 0 else (0.4 if diff == -1 else 0.0)


# ─────────────────────────────────────────────
# 5. MOTEUR CONTENT-BASED
# ─────────────────────────────────────────────

class ContentBasedRecommender:
    """
    Score final =
        0.55 × cosine_TF-IDF
      + 0.20 × score_région
      + 0.15 × score_expérience
      + 0.10 × score_éducation
    """

    WEIGHTS = {"text": 0.55, "region": 0.20, "experience": 0.15, "education": 0.10}

    def __init__(self):
        self.vectorizer   = TfidfVectorizer(
            ngram_range=(1, 2), min_df=1, max_df=0.95, sublinear_tf=True
        )
        self.jobs_df      = None
        self.tfidf_matrix = None

    def fit(self, jobs_df: pd.DataFrame):
        self.jobs_df = jobs_df.copy().reset_index(drop=True)
        self.jobs_df["_text"] = self.jobs_df.apply(build_job_text, axis=1)
        self.tfidf_matrix = self.vectorizer.fit_transform(self.jobs_df["_text"])
        print(f"[CB] {len(self.jobs_df)} offres indexées — "
              f"{self.tfidf_matrix.shape[1]} features TF-IDF")

    def recommend(self, profile: dict, top_n: int = 10) -> pd.DataFrame:
        seeker_text = build_seeker_text(profile)
        if not seeker_text.strip():
            print("[AVERTISSEMENT] Profil vide — scores texte = 0")
            seeker_vec = np.zeros((1, self.tfidf_matrix.shape[1]))
        else:
            seeker_vec = self.vectorizer.transform([seeker_text])

        cos_scores = cosine_similarity(seeker_vec, self.tfidf_matrix).flatten()

        sk_region = str(profile.get("region") or "")
        sk_exp    = str(profile.get("experience_level") or "")
        sk_edu    = str(profile.get("education_level") or "")

        reg_sc = self.jobs_df["region"].apply(lambda r: region_score(r, sk_region)).values
        exp_sc = self.jobs_df["experience_level"].apply(lambda e: experience_score(e, sk_exp)).values
        edu_sc = self.jobs_df["education_level"].apply(lambda e: education_score(e, sk_edu)).values

        w = self.WEIGHTS
        final = (w["text"] * cos_scores + w["region"] * reg_sc
                 + w["experience"] * exp_sc + w["education"] * edu_sc)

        top_idx = np.argsort(final)[::-1][:top_n]

        out = self.jobs_df.iloc[top_idx][[
            "job_id", "title", "company", "city", "region",
            "salary_range", "contract_type", "category", "keywords"
        ]].copy()
        out["score_total"]      = (final[top_idx]      * 100).round(1)
        out["score_texte"]      = (cos_scores[top_idx] * 100).round(1)
        out["score_region"]     = (reg_sc[top_idx]     * 100).round(1)
        out["score_experience"] = (exp_sc[top_idx]     * 100).round(1)
        out["score_education"]  = (edu_sc[top_idx]     * 100).round(1)
        return out.reset_index(drop=True)


# ─────────────────────────────────────────────
# 6. POINT D'ENTRÉE
# ─────────────────────────────────────────────

def main():
    JOBSEEKER_ID = 2000036   # ← Changez par l'ID du jobseeker connecté

    print("=" * 60)
    print("  JobSquare — Recommandation Content-Based (TF-IDF)")
    print("=" * 60)

    print("\n[1] Chargement des données...")
    jobs_df = load_jobs()
    profile = load_jobseeker_profile(JOBSEEKER_ID)

    if jobs_df.empty:
        print("Aucune offre active trouvée."); return
    if not profile:
        print(f"Jobseeker {JOBSEEKER_ID} introuvable."); return

    print(f"    → {len(jobs_df)} offres chargées")
    print(f"    → Profil : {profile.get('name')}  |  "
          f"Région : {profile.get('region')}  |  "
          f"Exp : {profile.get('experience_level')}")

    print("\n[2] Construction de l'index TF-IDF...")
    rec = ContentBasedRecommender()
    rec.fit(jobs_df)

    print("\n[3] Calcul des recommandations...")
    recs = rec.recommend(profile, top_n=10)

    print(f"\n{'─'*60}")
    print(f"  Top 10 pour : {profile.get('name')}")
    print(f"{'─'*60}")
    for i, row in recs.iterrows():
        print(f"\n  #{i+1:02d}  {row['title']}")
        print(f"       Entreprise : {row['company']} — {row['city']}")
        print(f"       Catégorie  : {row['category']}")
        print(f"       Salaire    : {row['salary_range']}")
        print(f"       Score      : {row['score_total']}%  "
              f"(texte={row['score_texte']}%  "
              f"région={row['score_region']}%  "
              f"exp={row['score_experience']}%  "
              f"édu={row['score_education']}%)")

    out = "recommendations_content_based.csv"
    recs.to_csv(out, index=False, encoding="utf-8-sig")
    print(f"\n[✓] Exporté dans : {out}")


if __name__ == "__main__":
    main()
