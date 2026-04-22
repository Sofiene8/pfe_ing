"""
================================================================
  JobSquare.ma — Système de Recommandation Collaborative Filtering
================================================================
Approche : Matrix Factorization (SVD) + User-KNN sur la matrice
           jobseeker × offre construite depuis la table applications.

Signal implicite des candidatures :
  - Acceptée  → 3.0
  - En attente → 1.0
  - Rejetée   → 0.3

Fallback cold-start : offres les plus populaires.

Tables utilisées :
  - applications : jobseeker_id, listing_id, status
  - listings     : sid, Title, JobCategory, CompanyName, city, salary
  - users        : sid, FullName

Dépendances :
  pip install sqlalchemy mysql-connector-python pandas numpy scipy scikit-learn
"""

import pandas as pd
import numpy as np
from sqlalchemy import create_engine, text
from scipy.sparse import csr_matrix
from scipy.sparse.linalg import svds
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

STATUS_WEIGHTS = {"Acceptée": 3.0, "En attente": 1.0, "Rejetée": 0.3}


# ─────────────────────────────────────────────
# 2. CHARGEMENT DES DONNÉES
# ─────────────────────────────────────────────

def load_interactions() -> pd.DataFrame:
    """Charge toutes les candidatures et calcule le rating implicite."""
    query = text("""
        SELECT
            a.jobseeker_id,
            a.listing_id            AS job_id,
            a.status,
            a.date,
            l.Title                 AS job_title,
            l.JobCategory           AS category,
            l.Location_City         AS city,
            l.id_Job_Rmunrationpropose AS salary_range,
            u.CompanyName           AS company
        FROM applications a
        JOIN listings l ON l.sid = a.listing_id
        LEFT JOIN users u ON l.user_sid = u.sid
        WHERE l.listing_type_sid = 6
    """)
    with ENGINE.connect() as conn:
        df = pd.read_sql(query, conn)

    df["rating"] = df["status"].map(STATUS_WEIGHTS).fillna(1.0)

    # Dédoublonnage : si plusieurs candidatures même offre → max rating
    df = df.groupby(["jobseeker_id", "job_id"], as_index=False).agg(
        rating=("rating", "max"),
        job_title=("job_title", "first"),
        category=("category", "first"),
        city=("city", "first"),
        salary_range=("salary_range", "first"),
        company=("company", "first"),
    )
    return df


def load_all_jobs() -> pd.DataFrame:
    """Charge les métadonnées de toutes les offres actives."""
    query = text("""
        SELECT
            l.sid                       AS job_id,
            l.Title                     AS title,
            l.JobCategory               AS category,
            l.Location_City             AS city,
            l.Location_State            AS region,
            l.id_Job_Rmunrationpropose  AS salary_range,
            l.EmploymentType            AS contract_type,
            u.CompanyName               AS company
        FROM listings l
        LEFT JOIN users u ON l.user_sid = u.sid
        WHERE l.active = 1
          AND l.listing_type_sid = 6
          AND l.expiration_date > NOW()
    """)
    with ENGINE.connect() as conn:
        return pd.read_sql(query, conn)


# ─────────────────────────────────────────────
# 3. MATRICE D'INTERACTIONS
# ─────────────────────────────────────────────

class InteractionMatrix:
    def __init__(self, df: pd.DataFrame):
        self.df = df

        self.seekers    = sorted(df["jobseeker_id"].unique())
        self.jobs       = sorted(df["job_id"].unique())
        self.s2i        = {s: i for i, s in enumerate(self.seekers)}
        self.i2s        = {i: s for s, i in self.s2i.items()}
        self.j2i        = {j: i for i, j in enumerate(self.jobs)}
        self.i2j        = {i: j for j, i in self.j2i.items()}

        rows = df["jobseeker_id"].map(self.s2i).values
        cols = df["job_id"].map(self.j2i).values
        vals = df["rating"].values

        self.matrix = csr_matrix(
            (vals, (rows, cols)),
            shape=(len(self.seekers), len(self.jobs)),
            dtype=np.float32,
        )
        density = 100 * len(vals) / (len(self.seekers) * len(self.jobs))
        print(f"[CF] Matrice : {len(self.seekers)} seekers × "
              f"{len(self.jobs)} offres — densité {density:.2f}%")

    def applied_jobs(self, jobseeker_id: int) -> set:
        if jobseeker_id not in self.s2i:
            return set()
        idx = self.s2i[jobseeker_id]
        return set(self.matrix[idx].nonzero()[1])


# ─────────────────────────────────────────────
# 4. SVD + USER-KNN
# ─────────────────────────────────────────────

class SVDRecommender:
    def __init__(self, n_factors: int = 30):
        self.k = n_factors
        self.im = None
        self.U = self.S = self.Vt = None
        self.predicted = None

    def fit(self, im: InteractionMatrix):
        self.im = im
        R = im.matrix.toarray().astype(np.float64)

        # Centrage par jobseeker
        mean = np.where(R > 0, R, np.nan)
        self.mean_r = np.nan_to_num(np.nanmean(mean, axis=1, keepdims=True))
        R_c = R - self.mean_r * (R > 0)

        k = min(self.k, min(R.shape) - 1)
        U, S, Vt = svds(R_c, k=k)
        order = np.argsort(S)[::-1]
        self.U, self.S, self.Vt = U[:, order], S[order], Vt[order, :]
        self.predicted = np.dot(np.dot(self.U, np.diag(self.S)), self.Vt) + self.mean_r
        print(f"[CF/SVD] Décomposition SVD — k={k} facteurs latents")

    def recommend_svd(self, jobseeker_id: int, all_jobs: pd.DataFrame,
                      top_n: int = 10, exclude_applied: bool = True) -> pd.DataFrame:
        if jobseeker_id not in self.im.s2i:
            return self._cold_start(all_jobs, top_n)

        si = self.im.s2i[jobseeker_id]
        scores = self.predicted[si].copy()

        if exclude_applied:
            for ji in self.im.applied_jobs(jobseeker_id):
                scores[ji] = -np.inf

        known_ids = [self.im.i2j[i] for i in range(len(scores))]
        scored = pd.DataFrame({"job_id": known_ids, "cf_score": scores})
        result = scored.merge(all_jobs, on="job_id", how="inner")
        result = result[result["cf_score"] > -np.inf].sort_values(
            "cf_score", ascending=False).head(top_n)
        result["score_total"] = self._norm(result["cf_score"].values)
        result["methode"] = "SVD"
        return result.reset_index(drop=True)

    def recommend_knn(self, jobseeker_id: int, all_jobs: pd.DataFrame,
                      n_neighbors: int = 10, top_n: int = 10) -> pd.DataFrame:
        if jobseeker_id not in self.im.s2i:
            return self._cold_start(all_jobs, top_n)

        si = self.im.s2i[jobseeker_id]
        sims = cosine_similarity(self.U[si].reshape(1, -1), self.U).flatten()
        sims[si] = -1  # Exclure soi-même

        neighbor_idx = np.argsort(sims)[::-1][:n_neighbors]
        applied      = self.im.applied_jobs(jobseeker_id)
        job_scores: dict = {}

        for ni in neighbor_idx:
            w = sims[ni]
            if w <= 0:
                continue
            n_id = self.im.i2s[ni]
            for ji in self.im.applied_jobs(n_id):
                jid = self.im.i2j[ji]
                if ji in applied:
                    continue
                r = self.im.matrix[ni, ji]
                job_scores[jid] = job_scores.get(jid, 0) + w * r

        if not job_scores:
            return self._cold_start(all_jobs, top_n)

        scored = pd.DataFrame(list(job_scores.items()), columns=["job_id", "cf_score"])
        result = scored.merge(all_jobs, on="job_id", how="inner")
        result = result.sort_values("cf_score", ascending=False).head(top_n)
        result["score_total"] = self._norm(result["cf_score"].values)
        result["methode"] = "User-KNN"
        return result.reset_index(drop=True)

    def _cold_start(self, all_jobs: pd.DataFrame, top_n: int) -> pd.DataFrame:
        print("[CF] Cold-start — offres les plus populaires")
        pop = (self.im.df.groupby("job_id")["rating"]
               .sum().reset_index().rename(columns={"rating": "cf_score"}))
        result = pop.merge(all_jobs, on="job_id", how="inner")
        result = result.sort_values("cf_score", ascending=False).head(top_n)
        result["score_total"] = self._norm(result["cf_score"].values)
        result["methode"] = "Cold-Start"
        return result.reset_index(drop=True)

    @staticmethod
    def _norm(arr: np.ndarray) -> np.ndarray:
        mn, mx = arr.min(), arr.max()
        return ((arr - mn) / (mx - mn + 1e-9) * 100).round(1)


# ─────────────────────────────────────────────
# 5. POINT D'ENTRÉE
# ─────────────────────────────────────────────

def print_recs(title: str, recs: pd.DataFrame):
    print(f"\n{'─'*60}")
    print(f"  {title}")
    print(f"{'─'*60}")
    for i, row in recs.iterrows():
        job_title = row.get("title") or row.get("job_title", "N/A")
        print(f"\n  #{i+1:02d}  {job_title}")
        print(f"       Entreprise : {row.get('company','N/A')} — {row.get('city','')}")
        print(f"       Catégorie  : {row.get('category','N/A')}")
        print(f"       Salaire    : {row.get('salary_range','N/A')}")
        print(f"       Score CF   : {row['score_total']}%  [{row['methode']}]")


def main():
    JOBSEEKER_ID = 2000036
    N_FACTORS    = 30
    N_NEIGHBORS  = 15

    print("=" * 60)
    print("  JobSquare — Collaborative Filtering (SVD + KNN)")
    print("=" * 60)

    print("\n[1] Chargement des données...")
    interactions = load_interactions()
    all_jobs     = load_all_jobs()
    print(f"    → {len(interactions)} interactions | {len(all_jobs)} offres actives")

    print("\n[2] Construction de la matrice d'interactions...")
    im = InteractionMatrix(interactions)

    print(f"\n[3] Décomposition SVD (k={N_FACTORS})...")
    svd = SVDRecommender(n_factors=N_FACTORS)
    svd.fit(im)

    recs_svd = svd.recommend_svd(JOBSEEKER_ID, all_jobs, top_n=10)
    print_recs("Top 10 — SVD (Matrix Factorization)", recs_svd)

    recs_knn = svd.recommend_knn(JOBSEEKER_ID, all_jobs,
                                 n_neighbors=N_NEIGHBORS, top_n=10)
    print_recs(f"Top 10 — User-KNN (k={N_NEIGHBORS} voisins)", recs_knn)

    recs_svd.to_csv("recommendations_cf_svd.csv", index=False, encoding="utf-8-sig")
    recs_knn.to_csv("recommendations_cf_knn.csv", index=False, encoding="utf-8-sig")
    print("\n[✓] Exporté : recommendations_cf_svd.csv & recommendations_cf_knn.csv")


if __name__ == "__main__":
    main()
