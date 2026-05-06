# backend/app/api/v1/endpoints/admin.py
from fastapi import APIRouter, Depends, HTTPException, Query
from typing import Optional
from app.core.security import get_current_user
from app.core.database import get_db
from bson import ObjectId
from datetime import datetime

router = APIRouter(tags=["admin"])

# ── user_group_sid mapping (from db.user_groups) ──
# 36 = JobSeeker, 41 = Employer  (+ others possible)
JOBSEEKER_SIDS = [36, 37, 38]   # adjust if needed
EMPLOYER_SIDS  = [41, 42, 43]   # adjust if needed

# Status values as stored in applications collection (French)
STATUS_LABELS_FR = {
    "En attente":    "pending",
    "Acceptée":      "accepted",
    "Présélectionné":"preselected",
    "Vu":            "viewed",
    "Rejetée":       "rejected",
}


def require_admin(current_user=Depends(get_current_user)):
    if current_user.get("role") != "admin":
        raise HTTPException(status_code=403, detail="Admin access required")
    return current_user


# ─────────────────────────────────────────────
# STATISTICS
# ─────────────────────────────────────────────

@router.get("/stats")
async def get_stats(db=Depends(get_db), _=Depends(require_admin)):
    # Load all user_groups to build sid→role map
    groups = await db["user_groups"].find({}, {"sid": 1, "id": 1}).to_list(length=100)
    jobseeker_sids = [g["sid"] for g in groups if "jobseeker" in (g.get("id") or "").lower() or "job" in (g.get("id") or "").lower()]
    employer_sids  = [g["sid"] for g in groups if "employer" in (g.get("id") or "").lower()]

    total_users      = await db["users"].count_documents({})
    total_jobseekers = await db["users"].count_documents({"user_group_sid": {"$in": jobseeker_sids}})
    total_employers  = await db["users"].count_documents({"user_group_sid": {"$in": employer_sids}})
    total_jobs       = await db["listings"].count_documents({})
    total_apps       = await db["applications"].count_documents({})

    return {
        "users": {
            "total": total_users,
            "jobseekers": total_jobseekers,
            "employers": total_employers,
        },
        "jobs": total_jobs,
        "applications": total_apps,
    }


@router.get("/stats/employers-by-sector")
async def get_employers_by_sector(db=Depends(get_db), _=Depends(require_admin)):
    # Find employer group sids
    groups = await db["user_groups"].find({}, {"sid": 1, "id": 1}).to_list(length=100)
    employer_sids = [g["sid"] for g in groups if "employer" in (g.get("id") or "").lower()]

    pipeline = [
        {"$match": {"user_group_sid": {"$in": employer_sids}}},
        {"$group": {"_id": "$Secteur", "count": {"$sum": 1}}},
        {"$sort": {"count": -1}},
        {"$limit": 15},
    ]
    results = await db["users"].aggregate(pipeline).to_list(length=15)
    return [{"sector": r["_id"] or "Non renseigné", "count": r["count"]} for r in results]


@router.get("/stats/applications-by-status")
async def get_applications_by_status(db=Depends(get_db), _=Depends(require_admin)):
    pipeline = [
        {"$group": {"_id": "$status", "count": {"$sum": 1}}},
        {"$sort": {"count": -1}},
    ]
    results = await db["applications"].aggregate(pipeline).to_list(length=20)
    return [{"status": r["_id"] or "Inconnu", "count": r["count"]} for r in results]


@router.get("/stats/jobs-by-category")
async def get_jobs_by_category(db=Depends(get_db), _=Depends(require_admin)):
    pipeline = [
        {"$group": {"_id": "$JobCategory", "count": {"$sum": 1}}},
        {"$sort": {"count": -1}},
        {"$limit": 20},
    ]
    results = await db["listings"].aggregate(pipeline).to_list(length=20)
    return [{"category": r["_id"] or "Autre", "count": r["count"]} for r in results]


@router.get("/stats/candidates-per-job")
async def get_candidates_per_job(db=Depends(get_db), _=Depends(require_admin)):
    pipeline = [
        {"$group": {
            "_id": {"job_id": "$listing_id", "status": "$status"},
            "count": {"$sum": 1},
        }},
        {"$group": {
            "_id": "$_id.job_id",
            "statuses": {"$push": {"status": "$_id.status", "count": "$count"}},
            "total": {"$sum": "$count"},
        }},
        {"$sort": {"total": -1}},
        {"$limit": 50},
    ]
    raw = await db["applications"].aggregate(pipeline).to_list(length=50)

    results = []
    for item in raw:
        job_id = item["_id"]
        job = None
        try:
            # listing_id is an integer in this DB
            job = await db["listings"].find_one({"_id": int(job_id)}, {"Title": 1})
        except Exception:
            pass

        status_map = {s["status"]: s["count"] for s in item["statuses"]}
        results.append({
            "job_id":      str(job_id),
            "title":       job.get("Title", "Offre supprimée") if job else "Offre supprimée",
            "total":       item["total"],
            "accepted":    status_map.get("Acceptée", 0),
            "preselected": status_map.get("Présélectionné", 0),
            "pending":     status_map.get("En attente", 0),
            "viewed":      status_map.get("Vu", 0),
            "rejected":    status_map.get("Rejetée", 0),
        })
    return results


# ─────────────────────────────────────────────
# USERS MANAGEMENT
# ─────────────────────────────────────────────

async def _enrich_users(users: list, db) -> list:
    """Add normalized role field from user_groups lookup."""
    groups = await db["user_groups"].find({}, {"sid": 1, "id": 1, "name": 1}).to_list(length=100)
    sid_to_role = {}
    for g in groups:
        gid = (g.get("id") or "").lower()
        if "jobseeker" in gid or "job" in gid:
            sid_to_role[g["sid"]] = "jobseeker"
        elif "employer" in gid:
            sid_to_role[g["sid"]] = "employer"
        elif "admin" in gid:
            sid_to_role[g["sid"]] = "admin"
        else:
            sid_to_role[g["sid"]] = g.get("name", gid)

    for u in users:
        u["role"]       = sid_to_role.get(u.get("user_group_sid"), "—")
        u["full_name"]  = u.get("FullName") or u.get("username") or "—"
        u["created_at"] = u.get("registration_date")
        u["company"]    = u.get("CompanyName")
        u["city"]       = u.get("Location_City")
    return users


@router.get("/users")
async def list_users(
    page: int = Query(1, ge=1),
    limit: int = Query(20, ge=1, le=100),
    role: Optional[str] = None,
    search: Optional[str] = None,
    db=Depends(get_db),
    _=Depends(require_admin),
):
    # Build role filter using user_group_sid
    query = {}
    if role and role != "admin":
        groups = await db["user_groups"].find({}, {"sid": 1, "id": 1}).to_list(length=100)
        sids = [g["sid"] for g in groups if role in (g.get("id") or "").lower()]
        if sids:
            query["user_group_sid"] = {"$in": sids}
    elif role == "admin":
        # Admin users are stored separately (our own users collection with role field)
        query["role"] = "admin"

    if search:
        query["$or"] = [
            {"username":   {"$regex": search, "$options": "i"}},
            {"email":      {"$regex": search, "$options": "i"}},
            {"FullName":   {"$regex": search, "$options": "i"}},
            {"CompanyName":{"$regex": search, "$options": "i"}},
        ]

    skip = (page - 1) * limit
    total = await db["users"].count_documents(query)
    cursor = db["users"].find(query, {"password": 0, "verification_key": 0}).skip(skip).limit(limit)
    users = await cursor.to_list(length=limit)
    for u in users:
        u["_id"] = str(u["_id"])
    users = await _enrich_users(users, db)
    return {"total": total, "page": page, "limit": limit, "users": users}


@router.patch("/users/{user_id}")
async def update_user(
    user_id: str, payload: dict, db=Depends(get_db), _=Depends(require_admin)
):
    payload.pop("password", None)
    # Map normalized fields back to DB fields
    if "full_name" in payload: payload["FullName"] = payload.pop("full_name")
    if "company"   in payload: payload["CompanyName"] = payload.pop("company")
    payload["update_at"] = datetime.utcnow().strftime("%Y-%m-%d %H:%M:%S")
    try:
        result = await db["users"].update_one({"_id": ObjectId(user_id)}, {"$set": payload})
    except Exception:
        raise HTTPException(status_code=400, detail="Invalid user ID")
    if result.matched_count == 0:
        raise HTTPException(status_code=404, detail="User not found")
    return {"message": "User updated"}


@router.delete("/users/{user_id}")
async def delete_user(user_id: str, db=Depends(get_db), _=Depends(require_admin)):
    try:
        result = await db["users"].delete_one({"_id": ObjectId(user_id)})
    except Exception:
        raise HTTPException(status_code=400, detail="Invalid user ID")
    if result.deleted_count == 0:
        raise HTTPException(status_code=404, detail="User not found")
    return {"message": "User deleted"}


# ─────────────────────────────────────────────
# JOBS MANAGEMENT
# ─────────────────────────────────────────────

@router.get("/jobs")
async def list_jobs(
    page: int = Query(1, ge=1),
    limit: int = Query(20, ge=1, le=100),
    search: Optional[str] = None,
    category: Optional[str] = None,
    db=Depends(get_db),
    _=Depends(require_admin),
):
    query = {}
    if search:
        query["$or"] = [
            {"Title":       {"$regex": search, "$options": "i"}},
            {"JobCategory": {"$regex": search, "$options": "i"}},
        ]
    if category:
        query["JobCategory"] = category

    skip = (page - 1) * limit
    total = await db["listings"].count_documents(query)
    cursor = db["listings"].find(
        query,
        {"Title": 1, "JobCategory": 1, "Location_City": 1, "Location_Country": 1, "active": 1, "date_add": 1}
    ).skip(skip).limit(limit)
    jobs = await cursor.to_list(length=limit)
    for j in jobs:
        j["_id"]      = str(j["_id"])
        j["title"]    = j.pop("Title", "—") or "—"
        j["category"] = j.pop("JobCategory", "—") or "—"
        j["company"]  = j.pop("Location_City", "") or j.pop("Location_Country", "") or "—"
        j["status"]   = "active" if j.get("active") == 1 else "inactive"
    return {"total": total, "page": page, "limit": limit, "jobs": jobs}


@router.patch("/jobs/{job_id}")
async def update_job(
    job_id: str, payload: dict, db=Depends(get_db), _=Depends(require_admin)
):
    if "title"    in payload: payload["Title"]       = payload.pop("title")
    if "category" in payload: payload["JobCategory"] = payload.pop("category")
    if "status"   in payload:
        payload["active"] = 1 if payload.pop("status") == "active" else 0
    payload["update_date"] = datetime.utcnow().strftime("%Y-%m-%d %H:%M:%S")
    try:
        job_id_q = int(job_id) if job_id.isdigit() else ObjectId(job_id)
        result = await db["listings"].update_one({"_id": job_id_q}, {"$set": payload})
    except Exception:
        raise HTTPException(status_code=400, detail="Invalid job ID")
    if result.matched_count == 0:
        raise HTTPException(status_code=404, detail="Job not found")
    return {"message": "Job updated"}


@router.delete("/jobs/{job_id}")
async def delete_job(job_id: str, db=Depends(get_db), _=Depends(require_admin)):
    try:
        job_id_q = int(job_id) if job_id.isdigit() else ObjectId(job_id)
        result = await db["listings"].delete_one({"_id": job_id_q})
    except Exception:
        raise HTTPException(status_code=400, detail="Invalid job ID")
    if result.deleted_count == 0:
        raise HTTPException(status_code=404, detail="Job not found")
    return {"message": "Job deleted"}


# ─────────────────────────────────────────────
# APPLICATIONS MANAGEMENT
# ─────────────────────────────────────────────

@router.get("/applications")
async def list_applications(
    page: int = Query(1, ge=1),
    limit: int = Query(20, ge=1, le=100),
    status: Optional[str] = None,
    job_id: Optional[str] = None,
    db=Depends(get_db),
    _=Depends(require_admin),
):
    query = {}
    if status:
        query["status"] = status
    if job_id:
        try:
            query["listing_id"] = int(job_id)
        except Exception:
            query["listing_id"] = job_id

    skip = (page - 1) * limit
    total = await db["applications"].count_documents(query)
    cursor = db["applications"].find(query).skip(skip).limit(limit)
    apps = await cursor.to_list(length=limit)

    enriched = []
    for a in apps:
        a["_id"] = str(a["_id"])

        # ── Titre offre via listing_id (integer)
        job_title = "—"
        try:
            job = await db["listings"].find_one({"_id": int(a["listing_id"])}, {"Title": 1})
            if job:
                job_title = job.get("Title") or "—"
        except Exception:
            pass

        # ── Nom candidat via jobseeker_id → users.sid
        candidate_name = a.get("username") or a.get("email") or "—"
        if candidate_name == "—":
            try:
                user = await db["users"].find_one(
                    {"sid": int(a["jobseeker_id"])},
                    {"FullName": 1, "username": 1, "email": 1}
                )
                if user:
                    candidate_name = user.get("FullName") or user.get("username") or user.get("email") or "—"
            except Exception:
                pass

        enriched.append({
            **a,
            "listing_id": {"_id": str(a.get("listing_id", "")), "title": job_title},
            "user_id":    {"_id": str(a.get("jobseeker_id", "")), "username": candidate_name},
            "created_at": a.get("date"),
        })

    return {"total": total, "page": page, "limit": limit, "applications": enriched}


@router.patch("/applications/{app_id}")
async def update_application(
    app_id: str, payload: dict, db=Depends(get_db), _=Depends(require_admin)
):
    try:
        result = await db["applications"].update_one(
            {"_id": ObjectId(app_id)}, {"$set": payload}
        )
    except Exception:
        raise HTTPException(status_code=400, detail="Invalid application ID")
    if result.matched_count == 0:
        raise HTTPException(status_code=404, detail="Application not found")
    return {"message": "Application updated"}


@router.delete("/applications/{app_id}")
async def delete_application(
    app_id: str, db=Depends(get_db), _=Depends(require_admin)
):
    try:
        result = await db["applications"].delete_one({"_id": ObjectId(app_id)})
    except Exception:
        raise HTTPException(status_code=400, detail="Invalid application ID")
    if result.deleted_count == 0:
        raise HTTPException(status_code=404, detail="Application not found")
    return {"message": "Application deleted"}