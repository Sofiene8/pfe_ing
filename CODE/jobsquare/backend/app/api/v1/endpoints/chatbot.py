# backend/app/api/v1/endpoints/chatbot.py
import logging
from fastapi import APIRouter, Depends, HTTPException
from fastapi.responses import JSONResponse
from pydantic import BaseModel

from app.core.security import get_current_user
from app.services.chatbot_service import ChatbotService

logger = logging.getLogger(__name__)
router = APIRouter(prefix="/chatbot", tags=["Chatbot"])

_service = None

def get_service() -> ChatbotService:
    global _service
    if _service is None:
        _service = ChatbotService()
    return _service


class SearchRequest(BaseModel):
    query: str
    top_k: int = 5

class InterviewRequest(BaseModel):
    job_description: str

class MessageRequest(BaseModel):
    message: str
    mode: str = "search"


@router.post("/search")
async def chatbot_search(req: SearchRequest, current_user=Depends(get_current_user)):
    if not req.query or len(req.query.strip()) < 3:
        raise HTTPException(status_code=422, detail="La requête est trop courte.")
    try:
        result = await get_service().search_jobs_by_text(req.query.strip(), req.top_k)
        return JSONResponse(content=result)
    except Exception as e:
        import traceback; traceback.print_exc()
        raise HTTPException(status_code=500, detail=str(e))


@router.post("/interview")
async def chatbot_interview(req: InterviewRequest, current_user=Depends(get_current_user)):
    if not req.job_description or len(req.job_description.strip()) < 2:
        raise HTTPException(status_code=422, detail="Veuillez décrire le poste.")
    try:
        result = await get_service().get_interview_advice(req.job_description.strip())
        return JSONResponse(content=result)
    except Exception as e:
        import traceback; traceback.print_exc()
        raise HTTPException(status_code=500, detail=str(e))


@router.post("/message")
async def chatbot_message(req: MessageRequest, current_user=Depends(get_current_user)):
    """
    Route unifiée — toute la logique métier est dans chatbot_service.py.
    Ce endpoint ne fait QUE dispatcher selon le mode, sans aucun filtre.
    """
    try:
        if req.mode == "interview":
            result = await get_service().get_interview_advice(req.message.strip())
        else:
            result = await get_service().search_jobs_by_text(req.message.strip())
        return JSONResponse(content=result)
    except Exception as e:
        import traceback; traceback.print_exc()
        raise HTTPException(status_code=500, detail=str(e))