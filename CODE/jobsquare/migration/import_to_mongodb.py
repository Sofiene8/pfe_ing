#!/usr/bin/env python3
"""
Script d'import Python pour MongoDB
Nécessite: pip install pymongo
"""

import json
import os
from pymongo import MongoClient


# -----------------------------
# IMPORT COLLECTION SAFE
# -----------------------------
def import_collection(db, collection_name, json_file):
    """Importe une collection depuis un fichier JSON"""

    print(f"📥 Import de {collection_name}...")

    try:
        with open(json_file, 'r', encoding='utf-8') as f:
            documents = json.load(f)
    except json.JSONDecodeError:
        print(f"❌ JSON invalide: {json_file}")
        return
    except Exception as e:
        print(f"❌ Erreur lecture fichier {json_file}: {e}")
        return

    if not documents:
        print(f"⚠ Aucun document à importer pour {collection_name}")
        return

    if not isinstance(documents, list):
        print(f"❌ Format invalide (doit être une liste): {json_file}")
        return

    try:
        collection = db[collection_name]

        result = collection.insert_many(documents)

        print(f"  ✔ {len(result.inserted_ids)} documents importés dans {collection_name}")

    except Exception as e:
        print(f"❌ Erreur insertion Mongo ({collection_name}): {e}")


# -----------------------------
# MAIN
# -----------------------------
def main():

    # Configuration MongoDB
    MONGO_URI = "mongodb://localhost:27017/"
    DB_NAME = "jobsquaremadb"

    print("🚀 Connexion à MongoDB...")

    try:
        client = MongoClient(MONGO_URI)
        db = client[DB_NAME]
    except Exception as e:
        print(f"❌ Erreur connexion MongoDB: {e}")
        return

    print(f"📊 Base de données: {DB_NAME}\n")

    # Collections à importer
    collections = [
        "admins",
        "applications",
        "banner_groups",
        "blog",
        "blog_category",
        "breadcrumbs_structure",
        "countries",
        "jobg8_mapping",
        "listings_active_period",
        "listings_properties",
        "listing_complex_fields",
        "listing_fields",
        "listing_field_list",
        "listing_types",
        "messages",
        "navigation_menu",
        "pages",
        "payment_gateways",
        "payment_gateways_properties",
        "permissions",
        "posting_pages",
        "refine_search",
        "relations_listing_fields_posting_pages",
        "resume_colors",
        "resume_models",
        "secteurs",
        "settings",
        "states",
        "uploaded_files",
        "users",
        "users_featured",
        "user_groups",
        "user_groups_properties",
        "user_profile_fields",
        "user_profile_field_list",
    ]

    # Import
    for collection_name in collections:

        json_file = f"{collection_name}.json"

        if os.path.exists(json_file):
            import_collection(db, collection_name, json_file)
        else:
            print(f"⚠ Fichier non trouvé: {json_file}")

    # -----------------------------
    # SUMMARY
    # -----------------------------
    print("\n✅ Migration terminée!\n")

    print("📊 Collections dans la base:")

    try:
        for col_name in db.list_collection_names():
            count = db[col_name].count_documents({})
            print(f"  - {col_name}: {count} documents")
    except Exception as e:
        print(f"❌ Erreur listing collections: {e}")


if __name__ == "__main__":
    main()