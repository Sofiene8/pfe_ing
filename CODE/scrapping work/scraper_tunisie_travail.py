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
JOBS_PAR_PAGE = 14      # tunisietravail.net affiche ~14 offres par page
DELAY         = 1.5
MAX_JOBS      = 420
OUTPUT_CSV    = os.path.join(os.path.dirname(os.path.abspath(__file__)), "jobs_tunisietravail_420.csv")

HEADERS = {
    "User-Agent": (
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
        "AppleWebKit/537.36 (KHTML, like Gecko) "
        "Chrome/124.0.0.0 Safari/537.36"
    ),
    "Accept-Language": "fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7",
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.8,*/*;q=0.8",
    "Referer": "https://www.tunisietravail.net/",
    "DNT": "1",
}

# ============================================================
# SOURCES
#
# URL patterns tunisietravail.net :
#   Toutes offres          : /page/N/
#   Par catégorie          : /category/SLUG/page/N/
#   Par région Tunisie     : /category/pays/tunisie/VILLE/page/N/
#   Par pays étranger      : /category/pays/PAYS/page/N/
#   Concours fonc. pub.    : /category/concours-fonction-publiques/page/N/
#   Immigration/étranger   : /category/immigration-emploi-a-l-etranger/page/N/
#
# Structure détectée dans l'HTML fourni :
#   Chaque offre est un <article> contenant :
#     - <h2><a class="h1titleall" href="/SLUG-ID/">Titre</a></h2>
#     - <img src="...recruiter_logos/..." width="100px" height="100px">
#     - <div style="...font-family:Verdana...">Description courte...</div>
#     - <p class="PostDateIndex"><strong class="month">Mar, 2026</strong></p>
# ============================================================
SOURCES = [
    # ── Toutes offres ─────────────────────────────────────────
    ("Toutes offres Tunisie",
     "https://www.tunisietravail.net/page/{page}/"),

    # ── Par secteur / catégorie ───────────────────────────────
    ("IT - Informatique & Telecoms",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/it/page/{page}/"),

    ("Développeur",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/it/developpeur/page/{page}/"),

    ("Développeur Web / Intégrateur",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/it/developpeur-web/page/{page}/"),

    ("Ingénieur IT",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/it/ingenieur/page/{page}/"),

    ("Administrateur Réseaux",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/it/administrateur-reseaux/page/{page}/"),

    ("Administrateur Système",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/it/administrateur-systeme/page/{page}/"),

    ("Community Manager / Social Manager",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/it/community-manager-social-manager/page/{page}/"),

    ("Infographiste / Designer / Graphiste",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/it/infographiste-designer-graphiste/page/{page}/"),

    ("Administrative",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/administrative/page/{page}/"),

    ("Commercial / Marketing / Vente",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/administrative/commercial-marketing-vente/page/{page}/"),

    ("Comptabilité / Finance",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/administrative/comptabilite-finance/page/{page}/"),

    ("Ressources Humaines / RH",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/administrative/ressources-humaines-rh/page/{page}/"),

    ("Directeur / Manager",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/administrative/directeur-manager/page/{page}/"),

    ("Assistant / Secrétaire",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/assistante-de-direction-secretaire/page/{page}/"),

    ("Emploi Centre d'Appel",
     "https://www.tunisietravail.net/category/emploi-centre-d-appel/page/{page}/"),

    ("Téléconseillers",
     "https://www.tunisietravail.net/category/emploi-centre-d-appel/teleconseillers/page/{page}/"),

    ("Ingénieur",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/ingenieur-offres-d-emploi-et-recrutement-en-tunisie/page/{page}/"),

    ("Technicien",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/technicien-emploi/page/{page}/"),

    ("Médical / Paramédical",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/medical-paramedical/page/{page}/"),

    ("Restauration Hôtellerie",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/restauration-hotellerie/page/{page}/"),

    ("Vendeurs / Ouvrier / Chauffeur / Agent",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/vendeurs-ouvrier-chauffeur-agent-de-securite/page/{page}/"),

    ("Génie Civil",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/genie-civil/page/{page}/"),

    ("Architecte",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/architecte/page/{page}/"),

    ("Textile / Styliste / Modéliste",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/textile-styliste-modeliste/page/{page}/"),

    ("Freelance",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/freelance/page/{page}/"),

    ("Stages et PFE",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/stages-pfe/page/{page}/"),

    ("Masters / Bourses / Stages",
     "https://www.tunisietravail.net/category/master-et-bourse/page/{page}/"),

    ("Maîtrisard / Licence",
     "https://www.tunisietravail.net/category/offres-d-emploi-et-recrutement/maitrisard-licence/page/{page}/"),

    # ── Concours fonction publique ────────────────────────────
    ("Concours Fonction Publiques",
     "https://www.tunisietravail.net/category/concours-fonction-publiques/page/{page}/"),

    # ── Immigration / Emploi à l'étranger ─────────────────────
    ("Immigration Emploi à l'étranger",
     "https://www.tunisietravail.net/category/immigration-emploi-a-l-etranger/page/{page}/"),

    # ── Par région Tunisie ────────────────────────────────────
    ("Emploi Tunis",
     "https://www.tunisietravail.net/category/pays/tunisie/tunis/page/{page}/"),

    ("Emploi Ariana",
     "https://www.tunisietravail.net/category/pays/tunisie/ariana/page/{page}/"),

    ("Emploi Ben Arous",
     "https://www.tunisietravail.net/category/pays/tunisie/ben-arous/page/{page}/"),

    ("Emploi Sousse",
     "https://www.tunisietravail.net/category/pays/tunisie/sousse/page/{page}/"),

    ("Emploi Sfax",
     "https://www.tunisietravail.net/category/pays/tunisie/sfax/page/{page}/"),

    ("Emploi Bizerte",
     "https://www.tunisietravail.net/category/pays/tunisie/bizerte/page/{page}/"),

    ("Emploi Nabeul",
     "https://www.tunisietravail.net/category/pays/tunisie/nabeul/page/{page}/"),

    ("Emploi Monastir",
     "https://www.tunisietravail.net/category/pays/tunisie/monastir/page/{page}/"),

    ("Emploi Manouba",
     "https://www.tunisietravail.net/category/pays/tunisie/manouba/page/{page}/"),

    ("Emploi Toutes régions",
     "https://www.tunisietravail.net/category/pays/tunisie/toutes-les-regions/page/{page}/"),

    # ── Par pays étranger ─────────────────────────────────────
    ("Emploi France",
     "https://www.tunisietravail.net/category/pays/france/page/{page}/"),

    ("Emploi Canada",
     "https://www.tunisietravail.net/category/pays/canada/page/{page}/"),

    ("Emploi Émirats Arabes Unis",
     "https://www.tunisietravail.net/category/pays/emirats-arabes-unis-uae/page/{page}/"),

    ("Emploi Qatar",
     "https://www.tunisietravail.net/category/pays/qatar/page/{page}/"),

    ("Emploi Allemagne",
     "https://www.tunisietravail.net/category/pays/allemagne/page/{page}/"),

    # ── Entreprises à la une ──────────────────────────────────
    ("Entreprise à la une",
     "https://www.tunisietravail.net/category/entreprise-a-la-une/page/{page}/"),

    ("Offres des Secteurs Leaders",
     "https://www.tunisietravail.net/category/offres-des-secteurs-leaders/page/{page}/"),
]


# ============================================================
# UTILITAIRES
# ============================================================
def parse_date_tunisietravail(date_str):
    """
    tunisietravail.net affiche :
      'Mar, 2026'   (format court dans PostDateIndex)
      'mars 2026'
      '23 mars 2026'
      '23/03/2026'
    """
    MOIS_FR = {
        "jan":1, "fév":2, "feb":2, "mar":3, "avr":4, "apr":4,
        "mai":5, "may":5, "jun":6, "jui":6, "jul":7, "aoû":8, "aug":8,
        "sep":9, "oct":10, "nov":11, "déc":12, "dec":12,
        "janvier":1, "février":2, "mars":3, "avril":4,
        "juin":6, "juillet":7, "août":8, "septembre":9,
        "octobre":10, "novembre":11, "décembre":12,
    }
    s = re.sub(r'\s+', ' ', str(date_str)).strip()
    sl = s.lower().replace('é', 'e').replace('û', 'u').replace('î', 'i')

    # "23 mars 2026" ou "3 Jan 2026"
    m = re.match(r'(\d{1,2})\s+([a-z]+\.?)\s+(\d{4})', sl)
    if m:
        jour, mois_s, annee = int(m.group(1)), m.group(2).rstrip('.'), int(m.group(3))
        mois = MOIS_FR.get(mois_s) or MOIS_FR.get(mois_s[:3])
        if mois:
            try:
                return datetime(annee, mois, jour).strftime("%Y-%m-%d")
            except Exception:
                pass

    # "Mar, 2026" ou "mars 2026"  → on prend le 1er du mois
    m2 = re.match(r'([a-z]+),?\s+(\d{4})', sl)
    if m2:
        mois_s, annee = m2.group(1).rstrip('.'), int(m2.group(2))
        mois = MOIS_FR.get(mois_s) or MOIS_FR.get(mois_s[:3])
        if mois:
            try:
                return datetime(annee, mois, 1).strftime("%Y-%m-%d")
            except Exception:
                pass

    # "23/03/2026" ou "23-03-2026"
    m3 = re.match(r'(\d{1,2})[/\-](\d{1,2})[/\-](\d{4})', sl)
    if m3:
        try:
            return datetime(int(m3.group(3)), int(m3.group(2)), int(m3.group(1))).strftime("%Y-%m-%d")
        except Exception:
            pass

    # Relatif : "il y a 2 jours"
    m4 = re.search(r'(\d+)\s*(minute|heure|jour|semaine|mois)', sl)
    if m4:
        n, u = int(m4.group(1)), m4.group(2)
        deltas = {
            "minute": timedelta(minutes=n), "heure":  timedelta(hours=n),
            "jour":   timedelta(days=n),    "semaine": timedelta(weeks=n),
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
    t = re.sub(r'[\uf000-\uf8ff]', '', t).strip()
    t = t.rstrip('…').strip()
    return t if t else "N/A"


def extract_lieu_from_title(titre, desc):
    """
    tunisietravail.net inclut souvent la ville dans le titre ou la description.
    Ex: 'Mazzaro Milano recrute des Conseillers de Vente Sfax'
    """
    VILLES = [
        "Tunis", "Ariana", "Ben Arous", "Manouba", "Nabeul", "Zaghouan",
        "Bizerte", "Béja", "Beja", "Jendouba", "Kef", "Siliana", "Sousse",
        "Monastir", "Mahdia", "Sfax", "Kairouan", "Kasserine", "Sidi Bouzid",
        "Gabès", "Gabes", "Médenine", "Medenine", "Tataouine", "Gafsa",
        "Tozeur", "Kebili", "La Marsa", "La Soukra", "Soukra", "Charguia",
        "El Mourouj", "Hammam Lif", "Rades", "Megrine", "Mégrine",
        "Ennasr", "Lac", "Centre Urbain Nord",
    ]
    combined = f"{titre} {desc}"
    for v in VILLES:
        if re.search(r'\b' + re.escape(v) + r'\b', combined, re.I):
            return v
    return "N/A"


# ============================================================
# PARSING D'UNE CARTE D'OFFRE
#
# Structure HTML réelle tunisietravail.net (extrait du document fourni) :
#
# <article>
#   <div style="float:left;width:350px; border:solid 2px #e2e2e2; ...">
#     <div class="Post">
#       <div class="PostHead" style="margin-bottom:15px;">
#         <p class="PostDateIndex">
#           <strong class="month">Mar, 2026</strong>
#         </p>
#         <h2>
#           <a class="h1titleall" href="/SLUG-ID/" title="Titre">Titre</a>
#         </h2>
#       </div>
#       <div style="width:340px; margin-bottom:15px;">
#         <div style="float:left; margin-right:10px; ...">
#           <img src=".../recruiter_logos/ID.jpg" width="100px" height="100px" alt="Titre" title="Titre">
#         </div>
#         <div style="line-height:18px;font-size:12px;font-family:Verdana,...">
#           Société recrute Poste - Description courte... ...
#         </div>
#       </div>
#       <div style="width:347px;">
#         <div class="PostInfo"> </div>
#         <div class="PostDetail">
#           <a href="/SLUG-ID/" title="Titre">Détail ›› </a>
#         </div>
#       </div>
#     </div>
#   </div>
# </article>
# ============================================================
def parse_card(card, source_name=""):
    # ── Titre & lien ──────────────────────────────────────────
    title_tag = card.find("a", class_="h1titleall")
    if not title_tag:
        # Fallback : premier lien avec href non vide
        title_tag = card.find("a", href=re.compile(r"/\d+/$|/\d+/$"))
    if not title_tag:
        return None

    titre = clean(title_tag.get_text())
    if not titre or len(titre) < 3:
        return None

    href = title_tag.get("href", "")
    lien = ("https://www.tunisietravail.net" + href
            if href.startswith("/") else href)

    # ID numérique extrait du slug  ex: /mazzaro-milano-131071/
    id_m   = re.search(r'-(\d{4,7})/?$', href)
    job_id = id_m.group(1) if id_m \
             else hashlib.md5(lien.encode()).hexdigest()[:10].upper()

    # ── Date de publication ───────────────────────────────────
    date_tag = card.find("p", class_="PostDateIndex")
    date_raw = "N/A"
    if date_tag:
        strong = date_tag.find("strong", class_="month")
        date_raw = clean(strong.get_text()) if strong else clean(date_tag.get_text())

    date_pub = parse_date_tunisietravail(date_raw) if date_raw != "N/A" \
               else datetime.now().strftime("%Y-%m-%d")
    expire   = is_expired(date_pub)

    # ── Description courte ────────────────────────────────────
    # C'est le <div> avec style contenant font-family:Verdana
    desc = "N/A"
    verdana_div = card.find("div", style=re.compile(r"font-family:Verdana", re.I))
    if verdana_div:
        desc = clean(verdana_div.get_text())

    # ── Société ───────────────────────────────────────────────
    # tunisietravail.net ne sépare pas la société dans une balise dédiée.
    # La structure du titre est généralement :
    #   "Société recrute Poste [Ville]"
    # On l'extrait aussi depuis le alt de l'image ou du titre lui-même.
    societe = "N/A"

    # Essai 1 : alt de l'image logo recruiter
    img_logo = card.find("img", src=re.compile(r"recruiter_logos|uploads/", re.I))
    if img_logo:
        alt = clean(img_logo.get("alt", ""))
        # L'alt est souvent "Société recrute Poste" → extraire la société
        m_soc = re.match(r'^(.+?)\s+recrute?\s+', alt, re.I)
        if m_soc:
            societe = m_soc.group(1).strip()

    # Essai 2 : extraire depuis le titre
    if societe == "N/A":
        m_soc2 = re.match(r'^(.+?)\s+recrute?\s+', titre, re.I)
        if m_soc2:
            candidate = m_soc2.group(1).strip()
            # Éviter les faux positifs trop courts ou trop longs
            if 2 < len(candidate) < 60:
                societe = candidate

    # ── Catégorie / Secteur (depuis source_name) ─────────────
    categorie = source_name if source_name else "N/A"

    # Enrichissement depuis titre + description
    SECTEUR_KW = {
        "IT / Informatique": ["développeur", "developer", "informatique", "it", "web",
                               "python", "java", ".net", "réseau", "système", "data",
                               "ia", "machine learning", "devops", "cloud", "logiciel"],
        "Ingénierie": ["ingénieur", "ingenieur", "bureau d'études", "electrique",
                       "mécanique", "industriel", "énergie", "thermique", "génie"],
        "Commercial / Vente": ["commercial", "vente", "vendeur", "vendeuse",
                                "conseiller de vente", "technico-commercial"],
        "Comptabilité / Finance": ["comptable", "comptabilité", "finance", "audit",
                                    "fiscal", "trésorerie", "contrôle de gestion"],
        "Marketing / Communication": ["marketing", "communication", "community manager",
                                       "digital", "réseaux sociaux", "seo", "webmaster"],
        "Ressources Humaines": ["rh", "ressources humaines", "recrutement", "drh",
                                 "chargé rh", "gestionnaire rh"],
        "Médical / Paramédical": ["médecin", "infirmier", "infirmière", "pharmacien",
                                   "laboratoire", "bloc opératoire", "clinique",
                                   "réanimation", "paramédical", "instrumentiste"],
        "Hôtellerie / Restauration": ["hôtel", "restaurant", "cuisine", "cuisinier",
                                       "chef", "réception", "gouvernante", "tourisme"],
        "Centre d'Appel": ["call center", "centre d'appel", "réception d'appel",
                            "téléconseiller", "téléopérateur"],
        "BTP / Génie Civil": ["architecte", "génie civil", "btp", "travaux",
                               "plombier", "électricien", "chantier"],
        "Éducation / Formation": ["professeur", "enseignant", "formateur", "éducateur",
                                   "animateur", "stage", "école"],
        "Logistique / Transport": ["logistique", "transport", "chauffeur", "livreur",
                                    "magasinier", "gestionnaire de stock"],
        "Concours Fonction Publique": ["concours", "fonction publique", "ministère",
                                        "manaظرة", "recrutement public"],
    }

    titre_desc_low = (titre + " " + desc).lower()
    for secteur, keywords in SECTEUR_KW.items():
        if any(kw.lower() in titre_desc_low for kw in keywords):
            categorie = secteur
            break

    # ── Type de contrat ───────────────────────────────────────
    type_contrat = "N/A"
    CONTRATS = {
        "CDI":    r'\bcdi\b',
        "CDD":    r'\bcdd\b',
        "CIVP":   r'\bcivp\b',
        "SIVP":   r'\bsivp\b',
        "Stage":  r'\bstage\b|\bpfe\b',
        "Freelance": r'\bfreelance\b',
        "Temps partiel / Mi-temps": r'\bmi.temps\b|\btemps partiel\b|\bpart.time\b',
        "Télétravail": r'\btélétravail\b|\bremote\b|\bteletravail\b',
    }
    full_text_low = (titre + " " + desc).lower()
    for contrat, pattern in CONTRATS.items():
        if re.search(pattern, full_text_low, re.I):
            type_contrat = contrat
            break

    # ── Lieu ──────────────────────────────────────────────────
    lieu = extract_lieu_from_title(titre, desc)

    # Enrichissement depuis source_name (ex: "Emploi Sfax" → "Sfax")
    if lieu == "N/A":
        m_lieu = re.search(r'Emploi\s+(.+)$', source_name)
        if m_lieu:
            lieu = m_lieu.group(1).strip()

    # ── Mode de travail ───────────────────────────────────────
    mode_travail = "N/A"
    for kw, val in [
        ("teletravail", "Teletravail"), ("télétravail", "Teletravail"),
        ("remote",      "Teletravail"), ("hybride",     "Hybride"),
        ("hybrid",      "Hybride"),     ("sur site",    "Sur site"),
        ("présentiel",  "Sur site"),    ("presentiel",  "Sur site"),
    ]:
        if kw in full_text_low:
            mode_travail = val
            break

    # ── Expérience ────────────────────────────────────────────
    annees_exp = "N/A"
    niveau_exp = "N/A"
    if desc != "N/A":
        ym = re.search(
            r'(\d+\s*[-–à]\s*\d+\s*ans?|\d+\+?\s*ans?\s*(?:d.exp|minimum|expérience))',
            desc, re.I
        )
        if ym:
            annees_exp = ym.group(1).strip()

        lm = re.search(
            r'\b(débutant|junior|confirmé|confirme|senior|manager|directeur|stage|sans expérience|sans exp)',
            desc, re.I
        )
        if lm:
            niveau_exp = lm.group(1).capitalize()

    # ── Salaire ───────────────────────────────────────────────
    salaire = "N/A"
    if desc != "N/A":
        sm = re.search(
            r'(\d[\d\s]*(?:TND|DT|dinars?|€|EUR|USD|\$)[\w\s/]*)',
            desc, re.I
        )
        if sm:
            salaire = clean(sm.group(1))

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
        "Date_Relative":     date_raw,
        "Expire":            expire,
        "Source":            "TunisieTravail",
        "Lien":              lien,
    }


# ============================================================
# DÉTECTION DES CARTES
#
# Structure HTML confirmée :
#   <article> contenant <a class="h1titleall" href="...">
# ============================================================
def find_job_cards(soup):
    cards = []
    seen  = set()

    # Méthode 1 : <article> avec un lien class="h1titleall"
    for article in soup.find_all("article"):
        link = article.find("a", class_="h1titleall")
        if link:
            uid = str(id(article))
            if uid not in seen:
                seen.add(uid)
                cards.append(article)

    if cards:
        return cards

    # Méthode 2 : divs contenant "Post" class + h1titleall
    for div in soup.find_all("div", class_="Post"):
        link = div.find("a", class_="h1titleall")
        if link:
            uid = str(id(div))
            if uid not in seen:
                seen.add(uid)
                cards.append(div)

    if cards:
        return cards

    # Méthode 3 fallback : remonter depuis les liens h1titleall
    for link in soup.find_all("a", class_="h1titleall"):
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
# NOMBRE TOTAL DE PAGES / RÉSULTATS
# Tunisie Travail utilise une pagination numérotée :
#   <div class="custom-pagination-opt">
#     <span class="current-page">...</span>
#     <a href="/page/2/">2</a>
#     ...
#     <a href="/page/612/">612</a>
#   </div>
# ============================================================
def get_last_page(soup):
    pagination = soup.find("div", class_="custom-pagination-opt")
    if not pagination:
        return None
    # Trouver le plus grand numéro de page
    page_nums = []
    for a in pagination.find_all("a", href=re.compile(r'/page/(\d+)/')):
        m = re.search(r'/page/(\d+)/', a.get("href", ""))
        if m:
            page_nums.append(int(m.group(1)))
    return max(page_nums) if page_nums else None


# ============================================================
# REQUÊTE HTTP AVEC RETRY
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
            elif code == 404:
                print(f"  [404] Page non trouvée -> source suivante")
                return None
            else:
                print(f"  [HTTP {code}] Erreur -> source suivante")
                return None
        except requests.exceptions.RequestException as e:
            wait = min(30 * attempt, 300)
            print(f"  [Réseau] {type(e).__name__} -> pause {wait}s "
                  f"(tentative {attempt}/{max_retries})")
            time.sleep(wait)
    print("  [ABANDON] Trop d'erreurs réseau")
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
print(f"  TunisieTravail Scraper  |  Limite : {MAX_JOBS} jobs uniques")
print(f"  Output                  : {OUTPUT_CSV}")
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
        last_page = None
        empty_cnt = 0
        page_num  = 1

        while not done:
            url  = url_tpl.format(page=page_num)
            resp = fetch_with_retry(url)
            if resp is None:
                break

            soup = BeautifulSoup(resp.content, "lxml")

            # Détecter la dernière page (première page seulement)
            if page_num == 1:
                last_page = get_last_page(soup)

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
                    job = parse_card(card, source_name=src_name)
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
                f"src={src_new}/{last_page or '?'}p  "
                f"TOTAL={total_jobs:,}/{MAX_JOBS}"
            )

            if done:
                break

            # Arrêt si on a dépassé la dernière page
            if last_page and page_num >= last_page:
                break
            if new_jobs == 0 and page_num > 5:
                print("  -> Plus de nouveaux jobs, source suivante")
                break

            page_num += 1
            time.sleep(DELAY)

        print(f"  => {src_new} nouveaux jobs de '{src_name}' | TOTAL: {total_jobs:,}/{MAX_JOBS}")

print()
print("=" * 65)
print(f"  TERMINÉ  |  {total_jobs:,} jobs uniques  |  {OUTPUT_CSV}")
print("=" * 65)

# ============================================================
# APERÇU DU CSV
# ============================================================
try:
    import pandas as pd

    df = pd.read_csv(OUTPUT_CSV, encoding="utf-8-sig")

    print(f"\n{'=' * 65}")
    print(f"  APERÇU DU CSV  |  {len(df)} lignes  x  {len(df.columns)} colonnes")
    print(f"{'=' * 65}")

    print("\nColonnes :")
    for col in df.columns:
        non_na = (df[col] != "N/A").sum() if df[col].dtype == object else df[col].notna().sum()
        pct    = non_na / len(df) * 100 if len(df) > 0 else 0
        print(f"  {col:<22} {non_na:>4} renseignées ({pct:5.1f}%)")

    PREVIEW_COLS = ["Titre", "Societe", "Lieu", "Type_Contrat",
                    "Date_Publication", "Categories"]
    available = [c for c in PREVIEW_COLS if c in df.columns]

    print(f"\n--- 5 premiers jobs ---")
    pd.set_option("display.max_colwidth", 35)
    pd.set_option("display.width", 140)
    print(df[available].head(5).to_string(index=False))

    print(f"\n--- Répartition par Type_Contrat ---")
    print(df["Type_Contrat"].value_counts().head(10).to_string())

    print(f"\n--- Répartition par Mode_Travail ---")
    print(df["Mode_Travail"].value_counts().to_string())

    print(f"\n--- Top 10 villes ---")
    print(df["Lieu"].value_counts().head(10).to_string())

    print(f"\n--- Top 10 catégories ---")
    print(df["Categories"].value_counts().head(10).to_string())

    print(f"\n--- Répartition Salaire (non N/A) ---")
    sal = df[df["Salaire"] != "N/A"]["Salaire"]
    print(f"  {len(sal)} offres avec salaire ({len(sal)/len(df)*100:.1f}%)")
    if len(sal) > 0:
        print(sal.value_counts().head(10).to_string())

    print(f"\n--- Répartition Expire ---")
    print(df["Expire"].value_counts().to_string())

    print(f"\n--- Top 10 sociétés ---")
    soc = df[df["Societe"] != "N/A"]["Societe"]
    print(soc.value_counts().head(10).to_string())

except ImportError:
    print("\n[INFO] pandas non installé : pip install pandas")
    print(f"       Le CSV est prêt : {OUTPUT_CSV}")
except Exception as e:
    print(f"\n[ERREUR aperçu] {e}")
    print(f"  Le CSV est disponible : {OUTPUT_CSV}")