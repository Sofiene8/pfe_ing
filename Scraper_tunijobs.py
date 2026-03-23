import sys, os, re, csv, time, random, hashlib
from datetime import datetime, timedelta

sys.stdout.reconfigure(encoding="utf-8")

try:
    import requests
    from bs4 import BeautifulSoup
    import pandas as pd
except ImportError as e:
    print(f"[ERREUR] Module manquant : {e}")
    print("Installez : pip install requests beautifulsoup4 lxml pandas")
    sys.exit(1)

# ============================================================
# CONFIGURATION
# ============================================================
MAX_JOBS   = 150
DELAY_MIN  = 2.0
DELAY_MAX  = 5.0
BASE_URL   = "https://www.tunijobs.com"
OUTPUT_CSV = os.path.join(os.path.dirname(os.path.abspath(__file__)), "jobs_tunijobs_420.csv")

HEADERS = {
    "User-Agent": (
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
        "AppleWebKit/537.36 (KHTML, like Gecko) "
        "Chrome/124.0.0.0 Safari/537.36"
    ),
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
    "Accept-Language": "fr-FR,fr;q=0.9,en;q=0.8",
    "Accept-Encoding": "gzip, deflate, br",
    "Connection": "keep-alive",
    "Referer": "https://www.tunijobs.com/",
}

# ============================================================
# SOURCES
# URL pattern : /jobs?page=N  ou  /jobs?contractType=CDI&page=N
# ============================================================
SOURCES = [
    # ── Toutes offres ─────────────────────────────────────────
    ("Toutes offres",
     f"{BASE_URL}/jobs?page={{page}}"),

    # ── Types de contrat ──────────────────────────────────────
    ("CDI",
     f"{BASE_URL}/jobs?contractType=CDI&page={{page}}"),

    ("CDD",
     f"{BASE_URL}/jobs?contractType=CDD&page={{page}}"),

    ("Stage / SIVP",
     f"{BASE_URL}/jobs?contractType=Stage&page={{page}}"),

    ("Freelance",
     f"{BASE_URL}/jobs?contractType=Freelance&page={{page}}"),

    # ── Mode de travail ───────────────────────────────────────
    ("Télétravail",
     f"{BASE_URL}/jobs?workMode=remote&page={{page}}"),

    ("Présentiel",
     f"{BASE_URL}/jobs?workMode=onsite&page={{page}}"),

    # ── Gouvernorats ─────────────────────────────────────────
    ("Gouvernorat Tunis",
     f"{BASE_URL}/jobs?governorate=Tunis&page={{page}}"),

    ("Gouvernorat Sousse",
     f"{BASE_URL}/jobs?governorate=Sousse&page={{page}}"),

    ("Gouvernorat Sfax",
     f"{BASE_URL}/jobs?governorate=Sfax&page={{page}}"),

    ("Gouvernorat Nabeul",
     f"{BASE_URL}/jobs?governorate=Nabeul&page={{page}}"),

    ("Gouvernorat Monastir",
     f"{BASE_URL}/jobs?governorate=Monastir&page={{page}}"),

    ("Gouvernorat Bizerte",
     f"{BASE_URL}/jobs?governorate=Bizerte&page={{page}}"),

    # ── Spécialités / mots-clés ───────────────────────────────
    ("Informatique & Dev",
     f"{BASE_URL}/jobs?search=informatique+developpeur&page={{page}}"),

    ("Comptabilite & Finance",
     f"{BASE_URL}/jobs?search=comptable+finance&page={{page}}"),

    ("Commercial & Ventes",
     f"{BASE_URL}/jobs?search=commercial+vente&page={{page}}"),

    ("Marketing",
     f"{BASE_URL}/jobs?search=marketing+communication&page={{page}}"),

    ("Centre appel",
     f"{BASE_URL}/jobs?search=centre+appel&page={{page}}"),

    ("Ingenierie",
     f"{BASE_URL}/jobs?search=ingenieur&page={{page}}"),

    ("RH",
     f"{BASE_URL}/jobs?search=ressources+humaines&page={{page}}"),

    ("Logistique",
     f"{BASE_URL}/jobs?search=logistique&page={{page}}"),
]

# ============================================================
# UTILITAIRES
# ============================================================
def rel2date(rel_text):
    """Convertit 'il y a 18 jours' / 'il y a 9 mois' en date absolue."""
    today = datetime.now()
    m = re.search(r"(\d+)\s+(jour|jours|mois|semaine|semaines|an|ans)", rel_text, re.I)
    if not m:
        return today.strftime("%Y-%m-%d")
    n, unit = int(m.group(1)), m.group(2).lower()
    if "jour" in unit:
        d = today - timedelta(days=n)
    elif "semaine" in unit:
        d = today - timedelta(weeks=n)
    elif "mois" in unit:
        d = today - timedelta(days=n * 30)
    else:
        d = today - timedelta(days=n * 365)
    return d.strftime("%Y-%m-%d")

def slug_to_id(href):
    """Génère un ID unique à partir du slug d'URL."""
    # href = /company/backoff-solutions/jobs/backoff-solutions-web-marketing-...
    slug = href.rstrip("/").split("/")[-1]
    return slug if slug else hashlib.md5(href.encode()).hexdigest()[:12]

def fetch_page(session, url, retries=8):
    for attempt in range(retries):
        try:
            resp = session.get(url, headers=HEADERS, timeout=20)
            if resp.status_code == 200:
                return resp.text
            elif resp.status_code == 429:
                wait = 15 + attempt * 10
                print(f"  [429] Rate limit — pause {wait}s")
                time.sleep(wait)
            elif resp.status_code in (403, 404):
                print(f"  [{resp.status_code}] {url}")
                return None
            else:
                time.sleep(3 + attempt * 2)
        except Exception as e:
            print(f"  [ERR] {e} — tentative {attempt+1}/{retries}")
            time.sleep(5)
    return None

# ============================================================
# EXTRACTION D'UNE CARTE
# ============================================================
def parse_card(card, source_name):
    """
    Structure d'une carte TuniJobs :
    - h3 > a[href]          → titre + lien
    - p.text-gray-700       → société
    - div.bg-gray-50 (x4)   → Expérience / Type d'emploi / Mode / Rémunération
    - div.bg-blue-100.text-xs (skills bleues) → compétences
    - span contenant "Publié:" → date relative
    """
    job = {}

    # ── Lien & titre ──────────────────────────────────────────
    a_tag = card.find("a", href=re.compile(r"/company/.+/jobs/.+"))
    if not a_tag:
        return None
    href = a_tag.get("href", "")
    job["Lien"] = BASE_URL + href if href.startswith("/") else href
    job["Job_ID"] = slug_to_id(href)

    h3 = a_tag.find("h3") or card.find("h3")
    job["Titre"] = h3.get_text(strip=True) if h3 else ""
    if not job["Titre"]:
        return None

    # ── Société ───────────────────────────────────────────────
    societe_p = card.find("p", class_=re.compile(r"text-gray-700"))
    job["Societe"] = societe_p.get_text(strip=True) if societe_p else ""

    # ── Grille infos (bg-gray-50) ─────────────────────────────
    info_blocks = card.find_all("div", class_=re.compile(r"bg-gray-50"))
    info_map = {}
    for blk in info_blocks:
        label_p = blk.find("p", class_=re.compile(r"text-xs"))
        value_p = blk.find("p", class_=re.compile(r"font-medium"))
        if label_p and value_p:
            label = label_p.get_text(strip=True).lower()
            value = value_p.get_text(strip=True)
            info_map[label] = value

    job["Annees_Experience"] = info_map.get("expérience", info_map.get("experience", ""))
    job["Type_Contrat"]      = info_map.get("type d'emploi", "")
    job["Mode_Travail"]      = info_map.get("mode de travail", "")
    job["Salaire"]           = info_map.get("rémunération", info_map.get("remuneration", ""))

    # ── Compétences ───────────────────────────────────────────
    skill_divs = card.find_all("div", class_=re.compile(r"bg-blue-100.*text-blue-700"))
    skills = [s.get_text(strip=True) for s in skill_divs if "de plus" not in s.get_text()]
    job["Skills"] = " | ".join(skills)

    # ── Date de publication ───────────────────────────────────
    date_span = card.find("span", string=re.compile(r"Publié"))
    if not date_span:
        # chercher dans tous les spans
        for sp in card.find_all("span"):
            if "publié" in sp.get_text(strip=True).lower():
                date_span = sp
                break
    date_text = date_span.get_text(strip=True) if date_span else ""
    job["Date_Relative"] = date_text
    job["Date_Publication"] = rel2date(date_text) if date_text else datetime.now().strftime("%Y-%m-%d")

    # ── Champs fixes ──────────────────────────────────────────
    job["Source"]            = source_name
    job["Description"]       = ""
    job["Categories"]        = source_name
    job["Niveau_Experience"] = ""
    job["Education"]         = ""
    job["Lieu"]              = ""
    job["Expire"]            = ""

    return job

# ============================================================
# SCRAPING D'UNE SOURCE
# ============================================================
def scrape_source(session, source_name, url_tpl, seen_ids, max_per_source):
    jobs = []
    page = 1
    consecutive_empty = 0

    print(f"\n{'='*60}")
    print(f"Source : {source_name}")
    print(f"{'='*60}")

    while len(jobs) < max_per_source:
        url = url_tpl.format(page=page)
        print(f"  Page {page} → {url}")

        html = fetch_page(session, url)
        if not html:
            print(f"  [STOP] Impossible de charger la page {page}")
            break

        soup = BeautifulSoup(html, "lxml")

        # Trouver toutes les cartes d'offres
        # Les cartes ont class contenant "rounded-lg shadow-md border"
        cards = soup.find_all("div", class_=re.compile(r"rounded-lg.*shadow-md.*border|shadow-md.*border.*rounded-lg"))

        # Filtrer : garder uniquement celles qui ont un lien /company/.../jobs/...
        job_cards = []
        for c in cards:
            if c.find("a", href=re.compile(r"/company/.+/jobs/.+")):
                job_cards.append(c)

        if not job_cards:
            consecutive_empty += 1
            print(f"  [0 offres] page {page} (vide x{consecutive_empty})")
            if consecutive_empty >= 2:
                print(f"  [STOP] 2 pages vides consécutives")
                break
            page += 1
            time.sleep(random.uniform(DELAY_MIN, DELAY_MAX))
            continue

        consecutive_empty = 0
        new_on_page = 0

        for card in job_cards:
            if len(jobs) >= max_per_source:
                break
            job = parse_card(card, source_name)
            if not job:
                continue
            if job["Job_ID"] in seen_ids:
                continue
            seen_ids.add(job["Job_ID"])
            jobs.append(job)
            new_on_page += 1

        print(f"  → {new_on_page} nouvelles offres (total source: {len(jobs)})")

        if new_on_page == 0:
            consecutive_empty += 1
            if consecutive_empty >= 3:
                break
        
        page += 1
        time.sleep(random.uniform(DELAY_MIN, DELAY_MAX))

    print(f"  ✓ {len(jobs)} offres collectées pour '{source_name}'")
    return jobs

# ============================================================
# MAIN
# ============================================================
def main():
    print("=" * 60)
    print("SCRAPER TUNIJOBS — MAX", MAX_JOBS, "offres")
    print("=" * 60)

    all_jobs = []
    seen_ids = set()
    session  = requests.Session()

    # Visite de la page d'accueil pour obtenir les cookies
    print("\n[INIT] Visite page d'accueil...")
    fetch_page(session, BASE_URL)
    time.sleep(2)

    max_per_source = max(30, MAX_JOBS // len(SOURCES) + 20)

    for source_name, url_tpl in SOURCES:
        if len(all_jobs) >= MAX_JOBS:
            print(f"\n[LIMITE] {MAX_JOBS} offres atteintes — arrêt")
            break
        remaining = MAX_JOBS - len(all_jobs)
        jobs = scrape_source(session, source_name, url_tpl, seen_ids,
                             min(max_per_source, remaining))
        all_jobs.extend(jobs)
        print(f"\n[TOTAL] {len(all_jobs)}/{MAX_JOBS} offres collectées")

    if not all_jobs:
        print("\n[ERREUR] Aucune offre collectée.")
        print("TuniJobs bloque peut-être les requêtes automatiques.")
        print("Essayez de changer l'User-Agent ou d'utiliser Playwright.")
        return

    # ── Écriture CSV ─────────────────────────────────────────
    FIELDNAMES = [
        "Job_ID", "Titre", "Societe", "Description", "Skills",
        "Categories", "Annees_Experience", "Niveau_Experience",
        "Education", "Salaire", "Lieu", "Type_Contrat", "Mode_Travail",
        "Date_Publication", "Date_Relative", "Expire", "Source", "Lien",
    ]

    all_jobs = all_jobs[:MAX_JOBS]

    with open(OUTPUT_CSV, "w", newline="", encoding="utf-8-sig") as f:
        writer = csv.DictWriter(f, fieldnames=FIELDNAMES, extrasaction="ignore")
        writer.writeheader()
        writer.writerows(all_jobs)

    print(f"\n{'='*60}")
    print(f"✅ CSV enregistré : {OUTPUT_CSV}")
    print(f"   {len(all_jobs)} offres uniques")
    print(f"{'='*60}")

    # ── Aperçu pandas ────────────────────────────────────────
    try:
        df = pd.read_csv(OUTPUT_CSV, encoding="utf-8-sig")
        print(f"\n{'='*60}")
        print("APERÇU DU FICHIER CSV")
        print(f"{'='*60}")
        print(df[["Titre", "Societe", "Type_Contrat", "Salaire",
                   "Mode_Travail", "Date_Publication"]].head(10).to_string(index=False))
        print(f"\nDistribution Type_Contrat :\n{df['Type_Contrat'].value_counts().head(8)}")
        print(f"\nDistribution Mode_Travail :\n{df['Mode_Travail'].value_counts().head(5)}")
        print(f"\nTop Sources :\n{df['Source'].value_counts().head(6)}")
    except Exception as e:
        print(f"[Aperçu] {e}")

if __name__ == "__main__":
    main()