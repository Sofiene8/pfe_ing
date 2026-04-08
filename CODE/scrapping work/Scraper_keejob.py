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
JOBS_PAR_PAGE = 15      # Keejob affiche 15 offres par page
DELAY         = 1.5
MAX_JOBS      = 420
OUTPUT_CSV    = os.path.join(os.path.dirname(os.path.abspath(__file__)), "jobs_keejob_420.csv")

HEADERS = {
    "User-Agent": (
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
        "AppleWebKit/537.36 (KHTML, like Gecko) "
        "Chrome/124.0.0.0 Safari/537.36"
    ),
    "Accept-Language": "fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7",
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.8,*/*;q=0.8",
    "Referer": "https://www.keejob.com/",
    "DNT": "1",
}

# ============================================================
# SOURCES
# URL pattern Keejob confirme :
#   /offres-emploi/?page=N
#   /offres-emploi/?industries=%5BID%5D&page=N   (%5B=%5D = [])
#   /offres-emploi/?contract_types=%5BTYPE%5D&page=N
#
# IDs industries confirmes depuis le HTML :
#   agriculture / agro-alimentaire
#   banque / finance / assurances
#   commerce / vente / distribution
#   communication / publicite / media
#   electronique / electricite / energie
#   informatique / telecoms
#   recrutement / ressources humaines
#   tourisme / hotellerie / restauration / loisirs
# ============================================================
SOURCES = [
    # ── Toutes offres ─────────────────────────────────────────
    ("Toutes offres Tunisie",
     "https://www.keejob.com/offres-emploi/?page={page}"),

    # ── Par secteur ───────────────────────────────────────────
    ("Informatique & Telecoms",
     "https://www.keejob.com/offres-emploi/?industries=%5B5%5D&page={page}"),

    ("Banque & Finance & Assurances",
     "https://www.keejob.com/offres-emploi/?industries=%5B1%5D&page={page}"),

    ("Commerce & Vente & Distribution",
     "https://www.keejob.com/offres-emploi/?industries=%5B2%5D&page={page}"),

    ("Communication & Marketing & Media",
     "https://www.keejob.com/offres-emploi/?industries=%5B3%5D&page={page}"),

    ("Recrutement & Ressources Humaines",
     "https://www.keejob.com/offres-emploi/?industries=%5B9%5D&page={page}"),

    ("Electronique & Electricite & Energie",
     "https://www.keejob.com/offres-emploi/?industries=%5B21%5D&page={page}"),

    ("Tourisme & Hotellerie & Restauration",
     "https://www.keejob.com/offres-emploi/?industries=%5B11%5D&page={page}"),

    ("Agriculture & Agro-alimentaire",
     "https://www.keejob.com/offres-emploi/?industries=%5B15%5D&page={page}"),

    ("BTP & Architecture & Immobilier",
     "https://www.keejob.com/offres-emploi/?industries=%5B12%5D&page={page}"),

    ("Sante & Paramedical",
     "https://www.keejob.com/offres-emploi/?industries=%5B10%5D&page={page}"),

    ("Education & Enseignement",
     "https://www.keejob.com/offres-emploi/?industries=%5B14%5D&page={page}"),

    ("Logistique & Transport",
     "https://www.keejob.com/offres-emploi/?industries=%5B7%5D&page={page}"),

    ("Production & Industrie",
     "https://www.keejob.com/offres-emploi/?industries=%5B8%5D&page={page}"),

    ("Administration & Secretariat",
     "https://www.keejob.com/offres-emploi/?industries=%5B19%5D&page={page}"),

    ("Ingenierie & Technique",
     "https://www.keejob.com/offres-emploi/?industries=%5B17%5D&page={page}"),

    ("Direction & Management",
     "https://www.keejob.com/offres-emploi/?industries=%5B13%5D&page={page}"),

    ("Comptabilite & Audit",
     "https://www.keejob.com/offres-emploi/?industries=%5B4%5D&page={page}"),

    ("Achats & Approvisionnement",
     "https://www.keejob.com/offres-emploi/?industries=%5B18%5D&page={page}"),

    # ── Par type de contrat ───────────────────────────────────
    ("Contrat CDI",
     "https://www.keejob.com/offres-emploi/?contract_types=%5BCDI%5D&page={page}"),

    ("Contrat CDD",
     "https://www.keejob.com/offres-emploi/?contract_types=%5BCDD%5D&page={page}"),

    ("Contrat SIVP",
     "https://www.keejob.com/offres-emploi/?contract_types=%5BSIVP%5D&page={page}"),

    ("Stage",
     "https://www.keejob.com/offres-emploi/?contract_types=%5BStage%5D&page={page}"),
]

# ============================================================
# UTILITAIRES
# ============================================================
def parse_date_keejob(date_str):
    """
    Keejob affiche les dates au format :
      '23 mars 2026'  ou  'il y a 2 jours'  ou  '23/03/2026'
    """
    MOIS = {
        "janvier":1,"fevrier":2,"mars":3,"avril":4,"mai":5,"juin":6,
        "juillet":7,"aout":8,"septembre":9,"octobre":10,"novembre":11,"decembre":12
    }
    s = re.sub(r'\s+', ' ', str(date_str)).strip().lower()

    # Format "23 mars 2026"
    m = re.match(r'(\d{1,2})\s+([a-z]+)\s+(\d{4})', s)
    if m:
        jour = int(m.group(1))
        mois_str = m.group(2).replace('\xe9','e').replace('\xfb','u')
        mois = MOIS.get(mois_str)
        annee = int(m.group(3))
        if mois:
            try:
                return datetime(annee, mois, jour).strftime("%Y-%m-%d")
            except Exception:
                pass

    # Format "23/03/2026" ou "23-03-2026"
    m2 = re.match(r'(\d{1,2})[/\-](\d{1,2})[/\-](\d{4})', s)
    if m2:
        try:
            return datetime(int(m2.group(3)), int(m2.group(2)), int(m2.group(1))).strftime("%Y-%m-%d")
        except Exception:
            pass

    # Relatif
    m3 = re.search(r'(\d+)\s*(heure|jour|semaine|mois|minute)', s, re.I)
    if m3:
        n, u = int(m3.group(1)), m3.group(2).lower()
        deltas = {
            "minute": timedelta(minutes=n), "heure":  timedelta(hours=n),
            "jour":   timedelta(days=n),    "semaine":timedelta(weeks=n),
            "mois":   timedelta(days=n*30),
        }
        return (datetime.now() - deltas.get(u, timedelta())).strftime("%Y-%m-%d")

    return datetime.now().strftime("%Y-%m-%d")


def is_expired(date_str):
    try:
        d = datetime.strptime(date_str, "%Y-%m-%d")
        return "Oui" if (datetime.now() - d).days > 60 else "Non"
    except Exception:
        return "N/A"


def clean(text):
    if not text:
        return "N/A"
    t = re.sub(r'\s+', ' ', str(text)).strip().rstrip(" -").strip()
    # Supprimer les caracteres d icones font-awesome qui peuvent s infiltrer
    t = re.sub(r'[\uf000-\uf8ff]', '', t).strip()
    return t if t else "N/A"


# ============================================================
# PARSING D UNE CARTE D OFFRE
#
# Structure HTML reelle Keejob (confirmee) :
#
# <article class="bg-white ... rounded-lg ...">
#   <div class="flex flex-col sm:flex-row">
#     <!-- Logo -->
#     <div class="w-28 h-28 ...">...</div>
#     <!-- Details -->
#     <div class="flex-1 min-w-0">
#       <h2 ...>
#         <a href="/offres-emploi/237571/technicien-.../">Titre</a>
#       </h2>
#       <p ...>
#         <a href="/offres-emploi/companies/1228/">Societe</a>
#         OU <span>Entreprise Anonyme</span>
#       </p>
#       <!-- Tags : secteur (fa-industry), contrat (fa-briefcase), salaire (fa-money-bill-wave) -->
#       <div class="flex flex-wrap ...">
#         <span ...><i class="fas fa-industry ..."></i> secteur</span>
#         <span ...><i class="fas fa-briefcase ..."></i> CDI</span>
#         <span ...><i class="fas fa-money-bill-wave ..."></i> 1000-1500 TND</span>
#       </div>
#       <!-- Description courte -->
#       <p class="text-sm text-gray-700 ...">Description...</p>
#       <!-- Lieu + Date -->
#       <div class="flex flex-wrap ...">
#         <div ...><i class="fas fa-map-marker-alt ..."></i><span>Ville, Gouvernorat</span></div>
#         <div ...><i class="fas fa-clock ..."></i><span>23 mars 2026</span></div>
#       </div>
#     </div>
#   </div>
#   <div class="mt-3 flex justify-end">
#     <a href="/offres-emploi/237571/.../">Voir l offre</a>
#   </div>
# </article>
# ============================================================
def parse_card(card):
    # ── Titre & lien ──────────────────────────────────────────
    title_tag = card.find("a", href=re.compile(r"^/offres-emploi/\d+/", re.I))
    if not title_tag:
        return None

    titre = clean(title_tag.get_text())
    if len(titre) < 2:
        return None

    href  = title_tag.get("href", "")
    lien  = "https://www.keejob.com" + href if href.startswith("/") else href

    # ID numerique extrait du slug /offres-emploi/237571/titre/
    id_m   = re.search(r"/offres-emploi/(\d+)/", href)
    job_id = id_m.group(1) if id_m \
             else hashlib.md5(lien.encode()).hexdigest()[:10].upper()

    # ── Societe ───────────────────────────────────────────────
    # La societe est dans le <p> juste apres le <h2>
    # Soit un <a href="/offres-emploi/companies/..."> soit un <span>
    societe = "N/A"
    h2 = card.find("h2")
    if h2:
        p_soc = h2.find_next_sibling("p")
        if p_soc:
            soc_link = p_soc.find("a", href=re.compile(r"/offres-emploi/companies/"))
            if soc_link:
                societe = clean(soc_link.get_text())
            else:
                span = p_soc.find("span")
                if span:
                    societe = clean(span.get_text())

    # ── Tags : secteur, contrat, salaire ─────────────────────
    # Les tags sont des <span> avec icones fa-industry / fa-briefcase / fa-money-bill-wave
    secteurs      = []
    contrats      = []
    salaire       = "N/A"

    for span in card.select("span.inline-flex"):
        icon = span.find("i", class_=re.compile(r"fa-"))
        if not icon:
            continue
        icon_classes = " ".join(icon.get("class", []))
        # Recuperer le texte sans l icone
        for i in span.find_all("i"):
            i.decompose()
        txt = clean(span.get_text())
        if not txt or txt == "N/A":
            continue

        if "fa-industry" in icon_classes:
            secteurs.append(txt)
        elif "fa-briefcase" in icon_classes:
            contrats.append(txt)
        elif "fa-money-bill-wave" in icon_classes:
            salaire = txt

    categorie    = " | ".join(secteurs) if secteurs else "N/A"
    type_contrat = " | ".join(contrats) if contrats else "N/A"

    # ── Lieu ──────────────────────────────────────────────────
    # Structure : <i class="fas fa-map-marker-alt ..."></i><span>Ville, Gouvernorat</span>
    lieu = "N/A"
    loc_icon = card.find("i", class_=re.compile(r"fa-map-marker-alt"))
    if loc_icon:
        loc_span = loc_icon.find_next_sibling("span")
        if loc_span:
            lieu = clean(loc_span.get_text())

    # ── Date ──────────────────────────────────────────────────
    # Structure : <i class="fas fa-clock ..."></i><span>23 mars 2026</span>
    date_rel = "N/A"
    clock_icon = card.find("i", class_=re.compile(r"fa-clock"))
    if clock_icon:
        date_span = clock_icon.find_next_sibling("span")
        if date_span:
            date_rel = clean(date_span.get_text())

    date_pub = parse_date_keejob(date_rel) if date_rel != "N/A" \
               else datetime.now().strftime("%Y-%m-%d")
    expire   = is_expired(date_pub)

    # ── Description courte ────────────────────────────────────
    desc_p = card.select_one("div.mb-3 p.text-sm")
    desc   = clean(desc_p.get_text()) if desc_p else "N/A"

    # ── Mode de travail ───────────────────────────────────────
    mode_travail = "N/A"
    full_text = (desc + " " + type_contrat + " " + categorie).lower()
    for kw, val in [
        ("teletravail", "Teletravail"), ("remote",      "Teletravail"),
        ("hybride",     "Hybride"),     ("hybrid",      "Hybride"),
        ("sur site",    "Sur site"),    ("presentiel",  "Sur site"),
        ("on-site",     "Sur site"),
    ]:
        if kw in full_text:
            mode_travail = val
            break

    # ── Experience (extraite de la description) ───────────────
    annees_exp = "N/A"
    niveau_exp = "N/A"
    if desc != "N/A":
        ym = re.search(r'(\d+\s*[-–]\s*\d+\s*ans?|\d+\+?\s*ans?\s*d.exp)', desc, re.I)
        if ym:
            annees_exp = ym.group(1).strip()
        lm = re.search(
            r'\b(debutant|junior|confirme|senior|manager|directeur|stage|sans exp)',
            desc, re.I
        )
        if lm:
            niveau_exp = lm.group(1).capitalize()

    return {
        "Job_ID":            job_id,
        "Titre":             titre,
        "Societe":           societe,
        "Description":       desc,
        "Categories":        categorie,
        "Annees_Experience": annees_exp,
        "Niveau_Experience": niveau_exp,
        "Salaire":           salaire,
        "Lieu":              lieu,
        "Type_Contrat":      type_contrat,
        "Mode_Travail":      mode_travail,
        "Date_Publication":  date_pub,
        "Date_Relative":     date_rel,
        "Expire":            expire,
        "Source":            "Keejob",
        "Lien":              lien,
    }


# ============================================================
# DETECTION DES CARTES
# Keejob utilise des <article> avec classes Tailwind dynamiques.
# Le selecteur fiable est : article contenant un lien /offres-emploi/ID/
# ============================================================
def find_job_cards(soup):
    cards = []
    seen  = set()

    # Methode 1 : tous les <article> qui contiennent un lien /offres-emploi/ID/
    for article in soup.find_all("article"):
        if article.find("a", href=re.compile(r"^/offres-emploi/\d+/", re.I)):
            uid = str(id(article))
            if uid not in seen:
                seen.add(uid)
                cards.append(article)

    if cards:
        return cards

    # Methode 2 fallback : remonter depuis les liens
    for link in soup.find_all("a", href=re.compile(r"^/offres-emploi/\d+/", re.I)):
        parent = link.parent
        for _ in range(15):
            if not parent or parent.name in ("html", "body"):
                break
            if parent.name in ("article", "div", "li"):
                if len(parent.get_text()) > 50:
                    uid = str(id(parent))
                    if uid not in seen:
                        seen.add(uid)
                        cards.append(parent)
                    break
            parent = parent.parent

    return cards


# ============================================================
# NOMBRE TOTAL DE RESULTATS
# ============================================================
def get_src_total(soup):
    # "Affichage de 1 à 15 sur 864 résultats"
    m = re.search(r'sur\s+([\d\s,]+)\s*r.sultats?', soup.get_text(), re.I)
    if m:
        try:
            return int(re.sub(r'[\s,]', '', m.group(1)))
        except Exception:
            pass
    # "864 offres d emploi trouvees"
    m2 = re.search(r'([\d\s,]+)\s*offres?\s*d.emploi', soup.get_text(), re.I)
    if m2:
        try:
            return int(re.sub(r'[\s,]', '', m2.group(1)))
        except Exception:
            pass
    return None


# ============================================================
# REQUETE HTTP AVEC RETRY
# ============================================================
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
                print(f"  [HTTP {code}] Erreur fatale -> source suivante")
                return None
        except requests.exceptions.RequestException as e:
            wait = min(30 * attempt, 300)
            print(f"  [Reseau] {type(e).__name__} -> pause {wait}s "
                  f"(tentative {attempt}/{max_retries})")
            time.sleep(wait)
    print("  [ABANDON] Trop d erreurs reseau")
    return None


# ============================================================
# COLONNES DU CSV
# ============================================================
FIELDS = [
    "Job_ID", "Titre", "Societe", "Description", "Categories",
    "Annees_Experience", "Niveau_Experience", "Salaire",
    "Lieu", "Type_Contrat", "Mode_Travail",
    "Date_Publication", "Date_Relative", "Expire",
    "Source", "Lien",
]

# ============================================================
# SCRAPING PRINCIPAL
# ============================================================
print("=" * 65)
print(f"  Keejob Scraper  |  Limite : {MAX_JOBS} jobs uniques")
print(f"  Output          : {OUTPUT_CSV}")
print("=" * 65)

total_jobs = 0
seen_ids   = set()
done       = False

with open(OUTPUT_CSV, "w", newline="", encoding="utf-8-sig") as csv_file:
    writer = csv.DictWriter(csv_file, fieldnames=FIELDS)
    writer.writeheader()

    for src_idx, (src_name, url_tpl) in enumerate(SOURCES):
        if done:
            break

        print(f"\n[{src_idx+1:02d}/{len(SOURCES)}] Source : {src_name}")

        src_new   = 0
        src_total = None
        empty_cnt = 0
        page_num  = 1

        while not done:
            url  = url_tpl.format(page=page_num)
            resp = fetch_with_retry(url)
            if resp is None:
                break

            soup = BeautifulSoup(resp.content, "lxml")

            # Detecter le total (premiere page uniquement)
            if page_num == 1:
                src_total = get_src_total(soup)

            cards = find_job_cards(soup)

            if not cards:
                empty_cnt += 1
                if empty_cnt >= 3:
                    break
                page_num += 1
                time.sleep(DELAY)
                continue

            empty_cnt = 0
            new_jobs  = 0

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

            pct = total_jobs / MAX_JOBS * 100
            bar = "#" * min(20, int(pct / 5)) + "-" * max(0, 20 - int(pct / 5))
            print(
                f"  [{bar}] {pct:5.1f}%  "
                f"p{page_num:3d}  "
                f"+{new_jobs:2d} nouveaux  "
                f"src={src_new}/{src_total or '?'}  "
                f"TOTAL={total_jobs:,}/{MAX_JOBS}"
            )

            if done:
                break

            # Arret si on a depasse le total
            if src_total and (page_num * JOBS_PAR_PAGE) >= src_total:
                break
            if new_jobs == 0 and page_num > 5:
                print("  -> Plus de nouveaux jobs, source suivante")
                break

            page_num += 1
            time.sleep(DELAY)

        print(f"  => {src_new} nouveaux jobs de '{src_name}' | TOTAL: {total_jobs:,}/{MAX_JOBS}")

print()
print("=" * 65)
print(f"  TERMINE  |  {total_jobs:,} jobs uniques  |  {OUTPUT_CSV}")
print("=" * 65)

# ============================================================
# APERCU DU CSV
# ============================================================
try:
    import pandas as pd

    df = pd.read_csv(OUTPUT_CSV, encoding="utf-8-sig")

    print(f"\n{'=' * 65}")
    print(f"  APERCU DU CSV  |  {len(df)} lignes  x  {len(df.columns)} colonnes")
    print(f"{'=' * 65}")

    print("\nColonnes :")
    for col in df.columns:
        non_na = (df[col] != "N/A").sum() if df[col].dtype == object else df[col].notna().sum()
        pct    = non_na / len(df) * 100 if len(df) > 0 else 0
        print(f"  {col:<22} {non_na:>4} renseignees ({pct:5.1f}%)")

    PREVIEW_COLS = ["Titre", "Societe", "Lieu", "Type_Contrat",
                    "Salaire", "Date_Publication", "Categories"]
    available = [c for c in PREVIEW_COLS if c in df.columns]

    print(f"\n--- 5 premiers jobs ---")
    pd.set_option("display.max_colwidth", 30)
    pd.set_option("display.width", 130)
    print(df[available].head(5).to_string(index=False))

    print(f"\n--- Repartition par Type_Contrat ---")
    print(df["Type_Contrat"].value_counts().head(10).to_string())

    print(f"\n--- Repartition par Mode_Travail ---")
    print(df["Mode_Travail"].value_counts().to_string())

    print(f"\n--- Top 10 villes ---")
    print(df["Lieu"].value_counts().head(10).to_string())

    print(f"\n--- Top 10 secteurs ---")
    print(df["Categories"].value_counts().head(10).to_string())

    print(f"\n--- Repartition Salaire (non N/A) ---")
    sal = df[df["Salaire"] != "N/A"]["Salaire"]
    print(f"  {len(sal)} offres avec salaire ({len(sal)/len(df)*100:.1f}%)")
    print(sal.value_counts().head(10).to_string())

    print(f"\n--- Repartition Expire ---")
    print(df["Expire"].value_counts().to_string())

except ImportError:
    print("\n[INFO] pandas non installe : pip install pandas")
    print(f"       Le CSV est pret : {OUTPUT_CSV}")
except Exception as e:
    print(f"\n[ERREUR apercu] {e}")
    print(f"  Le CSV est disponible : {OUTPUT_CSV}")