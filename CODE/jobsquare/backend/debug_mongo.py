# Script de debug MongoDB
import asyncio
import sys
sys.path.insert(0, ".")  # ajoute le dossier courant au path

from app.core.database import connect_db, get_db
from app.core.config import settings


async def test():
    await connect_db()
    db = get_db()

    print("=" * 50)
    print(f"DB utilisée     : {settings.MONGODB_DB}")
    print(f"MONGODB_URL     : {settings.MONGODB_URL}")

    collections = await db.list_collection_names()
    print(f"Collections     : {collections}")
    print("=" * 50)

    # Test 1 : compte total
    count = await db.listings.count_documents({})
    print(f"Total documents : {count}")

    # Test 2 : premier document
    doc = await db.listings.find_one({})
    if doc:
        print(f"Premier _id     : {doc.get('_id')} (type: {type(doc.get('_id')).__name__})")
        print(f"Premier sid     : {doc.get('sid')} (type: {type(doc.get('sid')).__name__})")
        print(f"Premier active  : {doc.get('active')}")
    else:
        print("⚠️  Collection listings VIDE !")

    # Test 3 : cherche 6010
    print("=" * 50)
    doc2 = await db.listings.find_one({"sid": 6010})
    print(f"find_one sid=6010     : {'✅ TROUVÉ' if doc2 else '❌ INTROUVABLE'}")

    doc3 = await db.listings.find_one({"_id": 6010})
    print(f"find_one _id=6010     : {'✅ TROUVÉ' if doc3 else '❌ INTROUVABLE'}")

    doc4 = await db.listings.find_one({"sid": "6010"})
    print(f"find_one sid='6010'   : {'✅ TROUVÉ' if doc4 else '❌ INTROUVABLE'}")

    print("=" * 50)


asyncio.run(test())