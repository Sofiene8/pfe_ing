# backend/app/api/v1/endpoints/cv_analysis.py

import os
import uuid
import logging
from pathlib import Path
from typing import Annotated

from fastapi import APIRouter, Depends, HTTPException, UploadFile, File, status
from fastapi.responses import JSONResponse

from app.core.security import get_current_user
from app.dao.repositories.user_repository import UserRepository
from app.services.cv_analysis_service import analyze_cv_with_llm, save_analysis_to_user

logger = logging.getLogger(__name__)
router = APIRouter(prefix="/cv", tags=["CV Analysis"])

BASE_DIR = Path(__file__).resolve().parents[4]   # racine projet
UPLOAD_DIR = BASE_DIR / "uploads" / "cvs"

ALLOWED_TYPES = {
    "application/pdf",
    "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
}
MAX_SIZE_MB = 10


def get_user_repo() -> UserRepository:
    return UserRepository()


@router.post("/analyze")
async def analyze_existing_cv(
    current_user: Annotated[dict, Depends(get_current_user)],
    user_repo: UserRepository = Depends(get_user_repo),
):
    cv_path = current_user.get("cv", {}).get("uploaded_cv_path")
    if not cv_path:
        raise HTTPException(
            status_code=status.HTTP_404_NOT_FOUND,
            detail="Aucun CV trouvé. Veuillez d'abord déposer votre CV."
        )

    relative = cv_path.lstrip("/")
    file_path = BASE_DIR / relative

    if not file_path.exists():
        file_path = UPLOAD_DIR / Path(cv_path).name
        if not file_path.exists():
            raise HTTPException(
                status_code=status.HTTP_404_NOT_FOUND,
                detail=f"Fichier CV introuvable sur le serveur : {cv_path}"
            )

    filename = Path(cv_path).name
    logger.info(f"Analyse CV: {file_path} pour user {current_user['id']}")

    try:
        analysis = await analyze_cv_with_llm(str(file_path), filename)
        try:
            await save_analysis_to_user(user_repo, current_user["id"], analysis)  # ✅ await
        except Exception as save_err:
            logger.warning(f"Impossible de sauvegarder l'analyse: {save_err}")

        return JSONResponse(content={"success": True, "analysis": analysis})

    except FileNotFoundError as e:
        raise HTTPException(status_code=404, detail=str(e))
    except ValueError as e:
        raise HTTPException(status_code=422, detail=str(e))
    except Exception as e:
        logger.error(f"Erreur analyse CV: {e}", exc_info=True)
        raise HTTPException(status_code=500, detail=f"Erreur lors de l'analyse IA: {str(e)}")


@router.post("/analyze-upload")
async def upload_and_analyze_cv(
    file: UploadFile = File(...),
    current_user: Annotated[dict, Depends(get_current_user)] = None,
    user_repo: UserRepository = Depends(get_user_repo),
):
    if (
        file.content_type not in ALLOWED_TYPES
        and not file.filename.endswith((".pdf", ".doc", ".docx"))
    ):
        raise HTTPException(
            status_code=status.HTTP_415_UNSUPPORTED_MEDIA_TYPE,
            detail="Format invalide. Utilisez PDF, DOC ou DOCX."
        )

    content = await file.read()
    if len(content) > MAX_SIZE_MB * 1024 * 1024:
        raise HTTPException(
            status_code=status.HTTP_413_REQUEST_ENTITY_TOO_LARGE,
            detail=f"Fichier trop volumineux (max {MAX_SIZE_MB} Mo)"
        )

    UPLOAD_DIR.mkdir(parents=True, exist_ok=True)
    ext = Path(file.filename).suffix.lower()
    temp_filename = f"tmp_{uuid.uuid4().hex}{ext}"
    temp_path = UPLOAD_DIR / temp_filename

    try:
        with open(temp_path, "wb") as f:
            f.write(content)

        analysis = await analyze_cv_with_llm(str(temp_path), file.filename)

        if current_user:
            try:
                await save_analysis_to_user(user_repo, current_user["id"], analysis)  # ✅ await
            except Exception as e:
                logger.warning(f"Sauvegarde analyse impossible: {e}")

        return JSONResponse(content={"success": True, "analysis": analysis})

    except ValueError as e:
        raise HTTPException(status_code=422, detail=str(e))
    except Exception as e:
        logger.error(f"Erreur upload+analyse: {e}", exc_info=True)
        raise HTTPException(status_code=500, detail=f"Erreur analyse IA: {str(e)}")
    finally:
        if temp_path.exists():
            temp_path.unlink()


@router.get("/analysis")
async def get_saved_analysis(
    current_user: Annotated[dict, Depends(get_current_user)],
):
    analysis = current_user.get("cv", {}).get("ai_analysis")
    if not analysis:
        return JSONResponse(content={"success": True, "analysis": None})
    return JSONResponse(content={"success": True, "analysis": analysis})


@router.delete("/analysis")
async def delete_saved_analysis(
    current_user: Annotated[dict, Depends(get_current_user)],
    user_repo: UserRepository = Depends(get_user_repo),
):
    try:
        await user_repo.update(current_user["id"], {"cv.ai_analysis": None})  # ✅ await + bon nom
        return JSONResponse(content={"success": True, "message": "Analyse supprimée"})
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))