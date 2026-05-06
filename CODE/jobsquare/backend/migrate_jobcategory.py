"""
Migration MongoDB : JobCategory numérique → slug catégorie
Gère :
  - L'ID legacy "76" (200 docs)
  - Les IDs simples  "2003", "2018", etc.
  - Les IDs multiples concaténés "2001,2013,2026,2033"
    → le premier ID valide détermine le slug
"""

from pymongo import MongoClient, UpdateOne
from typing import Dict, List, Any

# ─── Configuration ────────────────────────────────────────────────────────────
MONGO_URI  = "mongodb://localhost:27017"
DB_NAME    = "jobsquare"
COLLECTION = "listings"

# ─── Mapping complet slug → IDs ───────────────────────────────────────────────
# Construit à partir des IDs réellement observés en base
CATEGORY_SLUG_TO_IDS: Dict[str, List[Any]] = {
    # ID legacy unique
    "Autre":       ["76", 76],

    # Plage 200x
    "IT":          ["2001","2002","2003","2004","2005","2006","2007","2008",
                    "2009","2010","2011","2012","2013","2014","2015","2016",
                    "2017","2018","2019","2020","2021","2022","2023","2024","2025",
                     2001,2002,2003,2004,2005,2006,2007,2008,
                     2009,2010,2011,2012,2013,2014,2015,2016,
                     2017,2018,2019,2020,2021,2022,2023,2024,2025],

    "Finance":     ["2026","2027","2028","2029","2030","2031","2032","2033","2034","2035",
                     2026,2027,2028,2029,2030,2031,2032,2033,2034,2035],

    "Marketing":   ["2041","2042","2043", 2041,2042,2043],
    "RH":          ["2051","2052",        2051,2052],
    "Commercial":  ["2061","2062","2063", 2061,2062,2063],
    "Juridique":   ["2071","2072",        2071,2072],
    "Ingenierie":  ["2081","2082","2083","2084", 2081,2082,2083,2084],
    "Sante":       ["2091","2092",        2091,2092],
    "Education":   ["2101","2102",        2101,2102],
    "BTP":         ["2111","2112","2113", 2111,2112,2113],
    "Transport":   ["2121","2122",        2121,2122],
    "Tourisme":    ["2131","2132",        2131,2132],
    "Agriculture": ["2141","2142",        2141,2142],
    "Design":      ["2151","2152",        2151,2152],
    "Admin":       ["2161","2162",        2161,2162],
}

# ─── Mapping inverse id → slug ────────────────────────────────────────────────
ID_TO_SLUG: Dict[str, str] = {}
for slug, ids in CATEGORY_SLUG_TO_IDS.items():
    for id_val in ids:
        ID_TO_SLUG[str(id_val)] = slug


def resolve_slug(raw_value: Any) -> str | None:
    """
    Gère trois cas :
      - valeur simple  : "76"  → "Autre"
      - valeur simple  : "2003" → "IT"
      - valeur multiple: "2001,2013,2026,2033" → slug du premier ID reconnu
    """
    if raw_value is None:
        return None
    parts = [p.strip() for p in str(raw_value).split(",")]
    for part in parts:
        slug = ID_TO_SLUG.get(part)
        if slug:
            return slug
    return None


def migrate():
    client = MongoClient(MONGO_URI)
    col    = client[DB_NAME][COLLECTION]

    # Récupère TOUS les docs qui ont un JobCategory (on filtre en Python)
    cursor = col.find(
        {"JobCategory": {"$exists": True, "$ne": None}},
        {"_id": 1, "JobCategory": 1}
    )

    operations = []
    stats: Dict[str, int] = {}
    skipped = 0

    for doc in cursor:
        old_val  = doc["JobCategory"]
        new_slug = resolve_slug(old_val)

        if not new_slug:
            skipped += 1
            continue

        # Déjà un slug texte non numérique → pas besoin de migrer
        if old_val == new_slug:
            continue

        operations.append(
            UpdateOne({"_id": doc["_id"]}, {"$set": {"JobCategory": new_slug}})
        )
        stats[new_slug] = stats.get(new_slug, 0) + 1

    if not operations:
        print("⚠️  Aucun document à migrer (JobCategory déjà à jour ou IDs inconnus).")
        print(f"   Documents ignorés (ID non mappé) : {skipped}")
        client.close()
        return

    result = col.bulk_write(operations, ordered=False)
    client.close()

    print(f"\n{'─'*50}")
    print(f"  ✅ Migration terminée")
    print(f"{'─'*50}")
    print(f"  Documents modifiés  : {result.modified_count}")
    print(f"  IDs non mappés      : {skipped}")
    print(f"\n  Répartition par catégorie :")
    for slug, count in sorted(stats.items(), key=lambda x: -x[1]):
        print(f"    {slug:<14} → {count} doc{'s' if count > 1 else ''}")
    print(f"{'─'*50}\n")


if __name__ == "__main__":
    migrate()