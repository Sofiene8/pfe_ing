"""app/core/database.py — Connexion MongoDB avec Motor"""
from motor.motor_asyncio import AsyncIOMotorClient, AsyncIOMotorDatabase
from app.core.config import settings

_client: AsyncIOMotorClient = None
_db: AsyncIOMotorDatabase = None


async def connect_db():
    global _client, _db
    _client = AsyncIOMotorClient(settings.MONGODB_URL)
    _db = _client[settings.MONGODB_DB]
    await _create_indexes()
    print(f" MongoDB connecté : {settings.MONGODB_DB}")


async def close_db():
    global _client
    if _client:
        _client.close()


def get_db() -> AsyncIOMotorDatabase:
    return _db


def get_search_repository():
    from app.dao.repositories.search_repository import SearchRepository
    return SearchRepository(_db)  # ✅ utilise _db directement, pas besoin de paramètre


async def _create_indexes():
    db = get_db()
    await db.users.create_index("email")
    await db.users.create_index("role")
    await db.users.create_index("profile.location.state")
    await db.listings.create_index("user_id")
    await db.listings.create_index("active")
    await db.listings.create_index([("title", "text"), ("job.description", "text")])
    await db.listings.create_index("job.category")
    await db.listings.create_index("job.location.state")
    await db.applications.create_index("listing_id")
    await db.applications.create_index("jobseeker_id")
    await db.applications.create_index([("listing_id", 1), ("jobseeker_id", 1)])
    #  Index pour search_users
    await db.search_users.create_index("user_id")
    await db.search_users.create_index("searched_at")