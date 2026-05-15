# backend/app/api/v1/endpoints/admin.py
from fastapi import APIRouter, Depends, HTTPException, Query
from typing import Optional
from app.core.security import get_current_user
from app.core.database import get_db
from bson import ObjectId
from datetime import datetime

router = APIRouter(tags=["admin"])

# ── Status normalization ───────────────────────────────────────────────────

# Mapping anglais (nouveau format DB) → français (affiché dans l'UI)
STATUS_MAP = {
    "pending":     "En attente",
    "accepted":    "Acceptée",
    "preselected": "Présélectionné",
    "viewed":      "Vu",
    "rejected":    "Rejetée",
}
# Inverse : français → anglais (pour filtrer dans la DB)
STATUS_MAP_REVERSE = {v: k for k, v in STATUS_MAP.items()}


def normalize_status(raw: str) -> str:
    """Retourne le statut en français, quelle que soit la langue stockée."""
    if not raw:
        return "—"
    return STATUS_MAP.get(raw, raw)


# ── Helpers ────────────────────────────────────────────────────────────────

def parse_any_id(id_str: str):
    """
    Retourne (int_id, object_id) selon ce qui est valide.
    listings._id peut être un entier OU un ObjectId.
    """
    try:
        return int(id_str), None
    except (ValueError, TypeError):
        pass
    try:
        return None, ObjectId(id_str)
    except Exception:
        return None, None


def build_id_query(id_str: str) -> dict:
    """Construit un filtre $or qui matche int _id OU ObjectId _id."""
    int_id, obj_id = parse_any_id(id_str)
    candidates = []
    if int_id is not None:
        candidates.append({"_id": int_id})
    if obj_id is not None:
        candidates.append({"_id": obj_id})
    if not candidates:
        return {}
    if len(candidates) == 1:
        return candidates[0]
    return {"$or": candidates}


def normalize_listing(j: dict) -> dict:
    """
    Normalise un document listings qui peut avoir deux formats :
    ── Format ancien : Title, JobCategory, CompanyName, active (int 0/1)
    ── Format nouveau : title, job.category, employer_snapshot.company_name, active (bool)
    """
    raw_id = j.get("_id")
    j["_id"] = str(raw_id)

    j["title"] = (
        j.get("title")
        or j.get("Title")
        or "—"
    )

    job_sub = j.get("job") or {}
    j["category"] = (
        job_sub.get("category")
        or j.get("JobCategory")
        or "—"
    )

    snap = j.get("employer_snapshot") or {}
    j["company"] = (
        snap.get("company_name")
        or j.get("CompanyName")
        or j.get("Location_City")
        or "—"
    )

    active = j.get("active")
    j["status"] = "active" if (active is True or active == 1) else "inactive"

    j["created_at"] = j.get("created_at") or j.get("date_add")

    return j


def require_admin(current_user=Depends(get_current_user)):
    if current_user.get("role") != "admin":
        raise HTTPException(status_code=403, detail="Admin access required")
    return current_user


# ── user_groups cache helper ───────────────────────────────────────────────

async def get_sid_to_role(db) -> dict:
    groups = await db["user_groups"].find({}, {"sid": 1, "id": 1, "name": 1}).to_list(length=200)
    seen = {}
    for g in groups:
        sid = g.get("sid")
        if sid in seen:
            continue
        gid = (g.get("id") or "").lower()
        name = (g.get("name") or "").lower()
        if "jobseeker" in gid or "job seeker" in name:
            seen[sid] = "jobseeker"
        elif "employer" in gid or "employer" in name:
            seen[sid] = "employer"
        elif "admin" in gid:
            seen[sid] = "admin"
        else:
            seen[sid] = g.get("name") or gid or "—"
    return seen


# ─────────────────────────────────────────────────────────────────────────
# STATISTICS
# ─────────────────────────────────────────────────────────────────────────

@router.get("/stats")
async def get_stats(db=Depends(get_db), _=Depends(require_admin)):
    sid_to_role = await get_sid_to_role(db)

    jobseeker_sids = [sid for sid, role in sid_to_role.items() if role == "jobseeker"]
    employer_sids  = [sid for sid, role in sid_to_role.items() if role == "employer"]

    total_users      = await db["users"].count_documents({})
    total_jobseekers = await db["users"].count_documents({"user_group_sid": {"$in": jobseeker_sids}})
    total_employers  = await db["users"].count_documents({"user_group_sid": {"$in": employer_sids}})
    total_jobs       = await db["listings"].count_documents({})
    total_apps       = await db["applications"].count_documents({})

    return {
        "users": {
            "total":      total_users,
            "jobseekers": total_jobseekers,
            "employers":  total_employers,
        },
        "jobs":         total_jobs,
        "applications": total_apps,
    }


@router.get("/stats/employers-by-sector")
async def get_employers_by_sector(db=Depends(get_db), _=Depends(require_admin)):
    sid_to_role = await get_sid_to_role(db)
    employer_sids = [sid for sid, role in sid_to_role.items() if role == "employer"]

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
    # Normaliser les statuts en français pour l'affichage
    return [{"status": normalize_status(r["_id"]) or "Inconnu", "count": r["count"]} for r in results]


@router.get("/stats/jobs-by-category")
async def get_jobs_by_category(db=Depends(get_db), _=Depends(require_admin)):
    pipeline = [
        {"$addFields": {
            "_cat": {"$ifNull": ["$JobCategory", "$job.category"]}
        }},
        {"$group": {"_id": "$_cat", "count": {"$sum": 1}}},
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
            "_id":      "$_id.job_id",
            "statuses": {"$push": {"status": "$_id.status", "count": "$count"}},
            "total":    {"$sum": "$count"},
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
            job = await db["listings"].find_one(
                build_id_query(str(job_id)), {"Title": 1, "title": 1}
            )
        except Exception:
            pass

        # Agréger les deux formats de statut (EN + FR)
        status_map = {}
        for s in item["statuses"]:
            normalized = normalize_status(s["status"])
            status_map[normalized] = status_map.get(normalized, 0) + s["count"]

        title = (job.get("title") or job.get("Title") if job else None) or "Offre supprimée"
        results.append({
            "job_id":      str(job_id),
            "title":       title,
            "total":       item["total"],
            "accepted":    status_map.get("Acceptée", 0),
            "preselected": status_map.get("Présélectionné", 0),
            "pending":     status_map.get("En attente", 0),
            "viewed":      status_map.get("Vu", 0),
            "rejected":    status_map.get("Rejetée", 0),
        })
    return results


# ─────────────────────────────────────────────────────────────────────────
# USERS MANAGEMENT
# ─────────────────────────────────────────────────────────────────────────

async def _enrich_users(users: list, db) -> list:
    sid_to_role = await get_sid_to_role(db)

    for u in users:
        role = u.get("role")
        if not role or role == "—":
            role = sid_to_role.get(u.get("user_group_sid"), "—")
        u["role"] = role

        raw_date = (
            u.get("created_at")
            or u.get("registration_date")
            or u.get("RegistrationDate")
            or u.get("date_add")
            or None
        )
        if raw_date and hasattr(raw_date, 'isoformat'):
            raw_date = raw_date.isoformat()
        u["created_at"] = raw_date

        full_name = u.get("FullName") or u.get("username") or "—"
        u["full_name"] = full_name
        u["profile"] = {"full_name": full_name}

        u["company"] = u.get("CompanyName")
        u["city"]    = u.get("Location_City")

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
    query = {}

    if role:
        if role == "admin":
            query["role"] = "admin"
        else:
            sid_to_role = await get_sid_to_role(db)
            sids = [sid for sid, r in sid_to_role.items() if r == role]
            if sids:
                query["user_group_sid"] = {"$in": sids}

    if search:
        query["$or"] = [
            {"username":    {"$regex": search, "$options": "i"}},
            {"email":       {"$regex": search, "$options": "i"}},
            {"FullName":    {"$regex": search, "$options": "i"}},
            {"CompanyName": {"$regex": search, "$options": "i"}},
        ]

    skip  = (page - 1) * limit
    total = await db["users"].count_documents(query)
    cursor = db["users"].find(
        query, {"password": 0, "verification_key": 0}
    ).skip(skip).limit(limit)
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
    if "full_name" in payload: payload["FullName"]    = payload.pop("full_name")
    if "company"   in payload: payload["CompanyName"] = payload.pop("company")
    payload["update_at"] = datetime.utcnow().strftime("%Y-%m-%d %H:%M:%S")
    try:
        result = await db["users"].update_one(
            {"_id": ObjectId(user_id)}, {"$set": payload}
        )
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


# ─────────────────────────────────────────────────────────────────────────
# JOBS MANAGEMENT
# ─────────────────────────────────────────────────────────────────────────

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
            {"title":                          {"$regex": search, "$options": "i"}},
            {"job.category":                   {"$regex": search, "$options": "i"}},
            {"employer_snapshot.company_name": {"$regex": search, "$options": "i"}},
            {"Title":       {"$regex": search, "$options": "i"}},
            {"JobCategory": {"$regex": search, "$options": "i"}},
            {"CompanyName": {"$regex": search, "$options": "i"}},
        ]
    if category:
        query["$or"] = [
            {"job.category": category},
            {"JobCategory":  category},
        ]

    skip  = (page - 1) * limit
    total = await db["listings"].count_documents(query)
    cursor = db["listings"].find(query).skip(skip).limit(limit)
    jobs   = await cursor.to_list(length=limit)

    result = [normalize_listing(j) for j in jobs]
    return {"total": total, "page": page, "limit": limit, "jobs": result}


@router.patch("/jobs/{job_id}")
async def update_job(
    job_id: str, payload: dict, db=Depends(get_db), _=Depends(require_admin)
):
    if "title"    in payload: payload["Title"]       = payload.pop("title")
    if "category" in payload: payload["JobCategory"] = payload.pop("category")
    if "company"  in payload: payload["CompanyName"] = payload.pop("company")
    if "status"   in payload:
        payload["active"] = 1 if payload.pop("status") == "active" else 0
    payload["update_date"] = datetime.utcnow().strftime("%Y-%m-%d %H:%M:%S")

    id_query = build_id_query(job_id)
    if not id_query:
        raise HTTPException(status_code=400, detail="Invalid job ID")
    result = await db["listings"].update_one(id_query, {"$set": payload})
    if result.matched_count == 0:
        raise HTTPException(status_code=404, detail="Job not found")
    return {"message": "Job updated"}


@router.delete("/jobs/{job_id}")
async def delete_job(job_id: str, db=Depends(get_db), _=Depends(require_admin)):
    id_query = build_id_query(job_id)
    if not id_query:
        raise HTTPException(status_code=400, detail="Invalid job ID")
    result = await db["listings"].delete_one(id_query)
    if result.deleted_count == 0:
        raise HTTPException(status_code=404, detail="Job not found")
    return {"message": "Job deleted"}


# ─────────────────────────────────────────────────────────────────────────
# APPLICATIONS MANAGEMENT
# ─────────────────────────────────────────────────────────────────────────

async def _resolve_job_title(listing_id, db) -> str:
    """
    Fallback : résoudre le titre de l'offre depuis la collection listings.
    Utilisé uniquement si listing_snapshot est absent.
    listing_id peut être un entier (ancien format) ou une string ObjectId (nouveau).
    """
    if listing_id is None:
        return "—"
    job = await db["listings"].find_one(
        build_id_query(str(listing_id)), {"Title": 1, "title": 1}
    )
    if not job:
        return "—"
    return job.get("title") or job.get("Title") or "—"


async def _resolve_candidate_name(jobseeker_id, db) -> str:
    """
    Fallback : résoudre le nom du candidat depuis la collection users.
    Utilisé uniquement si jobseeker_snapshot est absent.
    jobseeker_id peut être un entier (users.sid) ou une string ObjectId.
    """
    if jobseeker_id is None:
        return "—"
    user = None
    # 1. Chercher par users.sid (entier, ancien format)
    try:
        user = await db["users"].find_one(
            {"sid": int(jobseeker_id)},
            {"FullName": 1, "username": 1, "email": 1}
        )
    except (ValueError, TypeError):
        pass
    # 2. Fallback : chercher par ObjectId (nouveau format)
    if not user:
        try:
            user = await db["users"].find_one(
                {"_id": ObjectId(str(jobseeker_id))},
                {"FullName": 1, "username": 1, "email": 1}
            )
        except Exception:
            pass
    if user:
        return user.get("FullName") or user.get("username") or user.get("email") or "—"
    return "—"


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

    # ── Filtre par statut ─────────────────────────────────────────────────
    # Accepter "En attente" (UI) ou "pending" (DB) — matcher les deux
    if status:
        en_form = STATUS_MAP_REVERSE.get(status, None)  # FR → EN
        fr_form = STATUS_MAP.get(status, None)           # EN → FR
        status_values = list({status, en_form, fr_form} - {None})
        query["status"] = {"$in": status_values} if len(status_values) > 1 else status_values[0]

    # ── Filtre par job_id ─────────────────────────────────────────────────
    # listing_id peut être stocké comme int, ObjectId ou string
    if job_id:
        int_id, obj_id = parse_any_id(job_id)
        candidates = []
        if int_id is not None:
            candidates.append({"listing_id": int_id})
        if obj_id is not None:
            candidates.append({"listing_id": obj_id})
        # Aussi matcher le string brut (cas nouveau format)
        candidates.append({"listing_id": job_id})
        if len(candidates) == 1:
            query["listing_id"] = candidates[0]["listing_id"]
        else:
            existing_or = query.pop("$or", None)
            if existing_or:
                query["$and"] = [{"$or": existing_or}, {"$or": candidates}]
            else:
                query["$or"] = candidates

    skip  = (page - 1) * limit
    total = await db["applications"].count_documents(query)
    cursor = db["applications"].find(query).skip(skip).limit(limit)
    apps   = await cursor.to_list(length=limit)

    enriched = []
    for a in apps:
        a["_id"] = str(a["_id"])

        # ── Titre de l'offre ──────────────────────────────────────────────
        # Priorité au snapshot embarqué, fallback sur la collection listings
        listing_snap = a.get("listing_snapshot") or {}
        job_title = (
            listing_snap.get("title")
            or await _resolve_job_title(a.get("listing_id"), db)
        )

        # ── Nom du candidat ───────────────────────────────────────────────
        # Priorité au snapshot embarqué, fallback sur la collection users
        jobseeker_snap = a.get("jobseeker_snapshot") or {}
        candidate_name = (
            jobseeker_snap.get("full_name")
            or jobseeker_snap.get("username")
            or a.get("username")
            or a.get("email")
            or await _resolve_candidate_name(a.get("jobseeker_id"), db)
        )

        # ── Normalisation du statut EN → FR ───────────────────────────────
        normalized_status = normalize_status(a.get("status", ""))

        enriched.append({
            **a,
            "status": normalized_status,
            "listing_id": {
                "_id":   str(a.get("listing_id", "")),
                "title": job_title,
            },
            "user_id": {
                "_id":      str(a.get("jobseeker_id", "")),
                "username": candidate_name,
            },
            # 'date' (ancien format) ou 'created_at' (nouveau format)
            "created_at": a.get("created_at") or a.get("date"),
        })

    return {"total": total, "page": page, "limit": limit, "applications": enriched}


@router.patch("/applications/{app_id}")
async def update_application(
    app_id: str, payload: dict, db=Depends(get_db), _=Depends(require_admin)
):
    # Si le frontend envoie un statut en français, le stocker tel quel
    # (ou le convertir en anglais si tu veux uniformiser la DB)
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