import requests
from bs4 import BeautifulSoup
import csv
import time
import re
import sys
import os
import hashlib
from datetime import datetime, timedelta

sys.stdout.reconfigure(encoding="utf-8")

# ============================================================
# CONFIGURATION
# ============================================================
JOBS_PAR_PAGE = 15
DELAY         = 1.5
MAX_JOBS      = 420   # <-- Limite : arrêt après 420 jobs uniques
OUTPUT_CSV    = os.path.join(os.path.dirname(os.path.abspath(__file__)), "jobs_wuzzuf_420.csv")

HEADERS = {
    "User-Agent": (
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
        "AppleWebKit/537.36 (KHTML, like Gecko) "
        "Chrome/124.0.0.0 Safari/537.36"
    ),
    "Accept-Language": "en-US,en;q=0.9",
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.8,*/*;q=0.8",
    "Referer": "https://wuzzuf.net/",
    "DNT": "1",
}

SOURCES = [
    ("Tous jobs Egypte",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&start={start}"),

    ("Jobs Cairo",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[city][0]=Cairo&start={start}"),

    ("Jobs Giza",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[city][0]=Giza&start={start}"),

    ("Jobs Alexandria",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[city][0]=Alexandria&start={start}"),

    ("IT & Software",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=16&start={start}"),

    ("Sales & Retail",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=27&start={start}"),

    ("Engineering Construction",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=6&start={start}"),

    ("Customer Service",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=9&start={start}"),

    ("Human Resources",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=14&start={start}"),

    ("Marketing & PR",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=21&start={start}"),

    ("Accounting & Finance",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=2&start={start}"),

    ("Medical & Healthcare",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=22&start={start}"),

    ("Operations & Management",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=19&start={start}"),

    ("Administration",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=3&start={start}"),

    ("Logistics & Supply Chain",
     "https://wuzzuf.net/search/jobs/?filters[country][0]=Egypt&filters[roles][0]=18&start={start}"),
]

# ============================================================
# UTILITAIRES
# ============================================================
def rel2date(rel):
    today = datetime.now()
    m = re.search(r'(\d+)\s*(hour|day|week|month)', str(rel), re.I)
    if not m:
        return today.strftime("%Y-%m-%d")
    n, u = int(m.group(1)), m.group(2).lower()
    deltas = {
        "hour":  timedelta(hours=n),
        "day":   timedelta(days=n),
        "week":  timedelta(weeks=n),
        "month": timedelta(days=n * 30),
    }
    return (today - deltas[u]).strftime("%Y-%m-%d")

def is_expired(date_str):
    try:
        d = datetime.strptime(date_str, "%Y-%m-%d")
        return "Yes" if (datetime.now() - d).days > 60 else "No"
    except Exception:
        return "N/A"

def clean(text):
    if not text:
        return "N/A"
    t = text.strip().rstrip(" -\u2013").strip()
    return t if t else "N/A"

def parse_card(card):
    title_tag = card.select_one("h2.css-193uk2c a")
    if not title_tag:
        title_tag = card.find("a", href=re.compile(r"/(jobs/p|internship)/"))
    if not title_tag:
        return None

    titre = clean(title_tag.get_text())
    href  = title_tag.get("href", "")
    lien  = ("https://wuzzuf.net" + href) if href.startswith("/") else href

    id_m   = re.search(r"/(jobs/p|internship)/([a-z0-9]+)-", href)
    job_id = id_m.group(2).upper() if id_m else hashlib.md5(lien.encode()).hexdigest()[:10].upper()

    soc_tag  = card.select_one("a.css-ipsyv7")
    societe  = clean(soc_tag.get_text()) if soc_tag else "N/A"

    loc_tag  = card.select_one("span.css-16x61xq")
    lieu     = clean(loc_tag.get_text()) if loc_tag else "N/A"

    date_tag = card.select_one("div.css-1jldrig")
    date_rel = clean(date_tag.get_text()) if date_tag else "N/A"
    date_pub = rel2date(date_rel) if date_rel != "N/A" else "N/A"
    expire   = is_expired(date_pub)

    CONTRACT_KW  = ["Full Time", "Part Time", "Freelance / Project", "Internship", "Shift Based"]
    WORK_KW      = ["On-site", "Remote", "Hybrid"]
    type_contrat = "N/A"
    mode_travail = "N/A"

    for badge in card.select("span.css-uc9rga, span.css-uofntu"):
        txt = badge.get_text(strip=True)
        if type_contrat == "N/A":
            for kw in CONTRACT_KW:
                if kw.lower() in txt.lower():
                    type_contrat = kw
                    break
        if mode_travail == "N/A":
            for kw in WORK_KW:
                if kw.lower() in txt.lower():
                    mode_travail = kw
                    break

    detail_div = card.select_one("div.css-1rhj4yg")
    niveau = "N/A"
    annees_exp = "N/A"
    skills_list = []
    cats_list   = []

    if detail_div:
        full_text = detail_div.get_text(separator=" ")
        lm = re.search(r'\b(Entry Level|Experienced|Manager|Senior Management|Student)\b', full_text)
        if lm:
            niveau = lm.group(1)
        ym = re.search(r'(\d+\s*[-\u2013+]\s*\d*\s*Yrs?\s*of\s*Exp|\d+\+?\s*Yrs?\s*of\s*Exp)', full_text)
        if ym:
            annees_exp = ym.group(1).strip()

        CAT_KW = [
            "IT/Software", "Engineering", "Accounting", "Analyst/Research",
            "Marketing", "Medical", "Business Development", "Human Resources",
            "Finance", "Sales", "Logistics", "Operations", "Legal",
            "Education", "Hospitality", "Tourism", "Administration",
            "Customer Service", "Manufacturing", "Pharmaceutical", "Quality",
            "R&D", "Strategy", "Training", "Banking", "Fashion",
        ]
        META_SKIP = {
            "Full Time", "Part Time", "On-site", "Remote", "Hybrid",
            "Entry Level", "Experienced", "Freelance", "Internship",
            "Shift Based", "Manager", "Student", "Senior Management",
        }
        for a in detail_div.find_all("a"):
            txt = a.get_text(strip=True)
            if not txt or txt in META_SKIP or re.search(r'\d+.*Yrs', txt):
                continue
            if any(c in txt for c in CAT_KW):
                if txt not in cats_list:
                    cats_list.append(txt)
            elif 1 < len(txt) < 50:
                if txt not in skills_list:
                    skills_list.append(txt)

    return {
        "Job_ID":            job_id,
        "Titre":             titre,
        "Societe":           societe,
        "Description":       "N/A",
        "Skills":            " | ".join(skills_list),
        "Categories":        " | ".join(cats_list),
        "Annees_Experience": annees_exp,
        "Niveau_Experience": niveau,
        "Salaire":           "N/A",
        "Lieu":              lieu,
        "Type_Contrat":      type_contrat,
        "Mode_Travail":      mode_travail,
        "Date_Publication":  date_pub,
        "Date_Relative":     date_rel,
        "Expire":            expire,
        "Source":            "Wuzzuf",
        "Lien":              lien,
    }

def find_job_cards(soup):
    cards = soup.select("div.css-ghe2tq")
    if not cards:
        seen, cards = set(), []
        for link in soup.find_all("a", href=re.compile(r"/(jobs/p|internship)/[a-z0-9]+-")):
            parent = link.parent
            for _ in range(10):
                if not parent:
                    break
                if parent.name == "div":
                    if re.search(r"\d+\s*(day|hour|week|month)s?\s*ago|just now",
                                 parent.get_text(), re.I):
                        uid = str(id(parent))
                        if uid not in seen:
                            seen.add(uid)
                            cards.append(parent)
                        break
                parent = parent.parent
    return cards

def fetch_with_retry(url, max_retries=10):
    for attempt in range(1, max_retries + 1):
        try:
            resp = requests.get(url, headers=HEADERS, timeout=30)
            resp.raise_for_status()
            return resp
        except requests.exceptions.HTTPError as e:
            code = e.response.status_code
            if code == 429:
                wait = 90
                print(f"  [Rate-limit] Attente {wait}s... (tentative {attempt})")
                time.sleep(wait)
            else:
                print(f"  [HTTP {code}] Erreur fatale -> passage a la source suivante")
                return None
        except requests.exceptions.RequestException as e:
            wait = min(30 * attempt, 300)
            print(f"  [Reseau] Erreur: {type(e).__name__} -> Reconnexion dans {wait}s (tentative {attempt}/{max_retries})")
            time.sleep(wait)
    print(f"  [ABANDON] Trop d'erreurs reseau pour cette page")
    return None

# ============================================================
# SCRAPING PRINCIPAL
# ============================================================
FIELDS = [
    "Job_ID", "Titre", "Societe", "Description", "Skills", "Categories",
    "Annees_Experience", "Niveau_Experience", "Salaire", "Lieu",
    "Type_Contrat", "Mode_Travail", "Date_Publication", "Date_Relative",
    "Expire", "Source", "Lien",
]

print("=" * 65)
print(f"  Wuzzuf Scraper  |  Limite : {MAX_JOBS} jobs uniques")
print(f"  Output          : {OUTPUT_CSV}")
print("=" * 65)

total_jobs = 0
seen_ids   = set()
done       = False   # flag d'arrêt global

with open(OUTPUT_CSV, "w", newline="", encoding="utf-8-sig") as csv_file:
    writer = csv.DictWriter(csv_file, fieldnames=FIELDS)
    writer.writeheader()

    for src_idx, (src_name, url_tpl) in enumerate(SOURCES):
        if done:
            break

        print(f"\n[{src_idx+1:02d}/{len(SOURCES)}] Source : {src_name}")

        src_new    = 0
        src_total  = None
        empty_cnt  = 0
        page_num   = 0

        while not done:
            start = page_num * JOBS_PAR_PAGE
            url   = url_tpl.format(start=start)

            resp = fetch_with_retry(url)
            if resp is None:
                break

            soup = BeautifulSoup(resp.content, "lxml")

            tm = re.search(r"([\d,]+)\s*[Jj]obs?\s*found", soup.get_text())
            if tm:
                src_total = int(tm.group(1).replace(",", ""))
                empty_cnt = 0
            else:
                empty_cnt += 1
                if empty_cnt >= 3:
                    break
                page_num += 1
                time.sleep(DELAY)
                continue

            cards = find_job_cards(soup)
            if not cards:
                empty_cnt += 1
                if empty_cnt >= 3:
                    break
                page_num += 1
                time.sleep(DELAY)
                continue

            new_jobs = 0
            for card in cards:
                if total_jobs >= MAX_JOBS:
                    done = True
                    break
                try:
                    job = parse_card(card)
                except Exception:
                    continue
                if not job or job["Job_ID"] in seen_ids:
                    continue
                seen_ids.add(job["Job_ID"])
                writer.writerow(job)
                new_jobs   += 1
                src_new    += 1
                total_jobs += 1
                if total_jobs >= MAX_JOBS:
                    done = True
                    break

            csv_file.flush()

            pct = (total_jobs / MAX_JOBS * 100)
            bar = "#" * min(20, int(pct / 5)) + "-" * max(0, 20 - int(pct / 5))
            print(
                f"  [{bar}] {pct:5.1f}%  "
                f"p{page_num+1:3d}  "
                f"+{new_jobs:2d} nouveaux  "
                f"src={src_new}/{src_total or '?'}  "
                f"TOTAL={total_jobs:,}/{MAX_JOBS}"
            )

            if done:
                break

            if src_total and start + JOBS_PAR_PAGE >= src_total:
                break
            if new_jobs == 0 and page_num > 5:
                print(f"  -> Plus de nouveaux jobs, source suivante")
                break

            page_num += 1
            time.sleep(DELAY)

        print(f"  => {src_new} nouveaux jobs de '{src_name}' | TOTAL: {total_jobs:,}/{MAX_JOBS}")

print()
print("=" * 65)
print(f"  TERMINE  |  {total_jobs:,} jobs uniques  |  {OUTPUT_CSV}")
print("=" * 65)

# ============================================================
# APERÇU DU CSV
# ============================================================
import pandas as pd

try:
    df = pd.read_csv(OUTPUT_CSV, encoding="utf-8-sig")

    print(f"\n{'=' * 65}")
    print(f"  APERÇU DU CSV  |  {len(df)} lignes  x  {len(df.columns)} colonnes")
    print(f"{'=' * 65}")

    # Colonnes disponibles
    print("\nColonnes :")
    for col in df.columns:
        non_na = df[col].notna().sum()
        pct    = non_na / len(df) * 100
        print(f"  {col:<22} {non_na:>4} renseignées ({pct:5.1f}%)")

    # Aperçu des 5 premières lignes (colonnes lisibles)
    PREVIEW_COLS = ["Titre", "Societe", "Lieu", "Type_Contrat",
                    "Mode_Travail", "Niveau_Experience", "Date_Publication"]
    available = [c for c in PREVIEW_COLS if c in df.columns]

    print(f"\n--- 5 premiers jobs ---")
    pd.set_option("display.max_colwidth", 30)
    pd.set_option("display.width", 120)
    print(df[available].head(5).to_string(index=False))

    # Statistiques rapides
    print(f"\n--- Répartition par Type_Contrat ---")
    print(df["Type_Contrat"].value_counts().to_string())

    print(f"\n--- Répartition par Mode_Travail ---")
    print(df["Mode_Travail"].value_counts().to_string())

    print(f"\n--- Top 10 villes ---")
    print(df["Lieu"].value_counts().head(10).to_string())

except ImportError:
    print("\n[INFO] pandas non installé — installe-le avec : pip install pandas")
    print("       Le CSV est prêt à être ouvert dans Excel ou tout autre outil.")
except Exception as e:
    print(f"\n[ERREUR aperçu] {e}")
    print(f"  Le CSV est néanmoins disponible : {OUTPUT_CSV}")