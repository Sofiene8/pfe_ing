"""app/api/v1/admin.py — Dashboard administrateur"""
from fastapi import APIRouter, Depends, Query
from typing import Optional

from app.core.security import require_admin
from app.core.database import get_db

router = APIRouter()


@router.get("/stats")
async def dashboard_stats(current_user=Depends(require_admin)):
    """Statistiques globales de la plateforme"""
    db = get_db()
    users_total = await db.users.count_documents({})
    employers = await db.users.count_documents({"role": "employer"})
    jobseekers = await db.users.count_documents({"role": "jobseeker"})
    listings_active = await db.listings.count_documents({"active": True, "listing_type": "job_offer"})
    listings_total = await db.listings.count_documents({"listing_type": "job_offer"})
    applications_total = await db.applications.count_documents({})
    applications_pending = await db.applications.count_documents({"status": "pending"})

    return {
        "users": {"total": users_total, "employers": employers, "jobseekers": jobseekers},
        "listings": {"total": listings_total, "active": listings_active},
        "applications": {"total": applications_total, "pending": applications_pending},
    }


@router.get("/users")
async def list_users(
    role: Optional[str] = Query(None),
    active: Optional[bool] = Query(None),
    skip: int = Query(0, ge=0),
    limit: int = Query(20, ge=1, le=100),
    current_user=Depends(require_admin),
):
    db = get_db()
    filter_: dict = {}
    if role:
        filter_["role"] = role
    if active is not None:
        filter_["active"] = active
    total = await db.users.count_documents(filter_)
    cursor = db.users.find(filter_, {"password": 0, "verification_key": 0}).skip(skip).limit(limit)
    users = []
    async for doc in cursor:
        doc["_id"] = str(doc["_id"])
        users.append(doc)
    return {"items": users, "total": total, "skip": skip, "limit": limit}


@router.patch("/users/{user_id}/toggle-active")
async def toggle_user_active(user_id: str, current_user=Depends(require_admin)):
    db = get_db()
    from bson import ObjectId
    user = await db.users.find_one({"_id": ObjectId(user_id)})
    if not user:
        from fastapi import HTTPException
        raise HTTPException(status_code=404, detail="Utilisateur introuvable")
    new_status = not user.get("active", False)
    await db.users.update_one({"_id": ObjectId(user_id)}, {"$set": {"active": new_status}})
    return {"user_id": user_id, "active": new_status}


@router.patch("/listings/{listing_id}/toggle-featured")
async def toggle_listing_featured(listing_id: str, current_user=Depends(require_admin)):
    db = get_db()
    from bson import ObjectId
    listing = await db.listings.find_one({"_id": ObjectId(listing_id)})
    if not listing:
        from fastapi import HTTPException
        raise HTTPException(status_code=404, detail="Offre introuvable")
    new_featured = not listing.get("featured", False)
    await db.listings.update_one({"_id": ObjectId(listing_id)}, {"$set": {"featured": new_featured}})
    return {"listing_id": listing_id, "featured": new_featured}


@router.delete("/listings/{listing_id}")
async def admin_delete_listing(listing_id: str, current_user=Depends(require_admin)):
    db = get_db()
    from bson import ObjectId
    result = await db.listings.delete_one({"_id": ObjectId(listing_id)})
    if result.deleted_count == 0:
        from fastapi import HTTPException
        raise HTTPException(status_code=404, detail="Offre introuvable")
    return {"message": "Offre supprimée"}