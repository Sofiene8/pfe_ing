"""app/api/v1/blog.py — Blog / articles"""
from fastapi import APIRouter, Depends, Query
from pydantic import BaseModel
from typing import Optional
import re

from app.dao.repositories.blog_repository import BlogRepository
from app.core.security import require_admin

router = APIRouter()
blog_repo = BlogRepository()


def slugify(text: str) -> str:
    text = text.lower().strip()
    text = re.sub(r'[^\w\s-]', '', text)
    text = re.sub(r'[\s_-]+', '-', text)
    return text


class PostCreate(BaseModel):
    title: str
    content: str
    category_name: Optional[str] = None
    active: bool = True


class PostUpdate(BaseModel):
    title: Optional[str] = None
    content: Optional[str] = None
    active: Optional[bool] = None


@router.get("")
async def list_posts(
    category: Optional[str] = Query(None),
    skip: int = Query(0, ge=0),
    limit: int = Query(10, ge=1, le=50),
):
    return await blog_repo.list_posts(category=category, skip=skip, limit=limit)


@router.get("/{slug_or_id}")
async def get_post(slug_or_id: str):
    from fastapi import HTTPException
    # Try by slug first
    post = await blog_repo.find_by_slug(slug_or_id)
    if not post:
        # Try by ID
        try:
            post = await blog_repo.find_by_id(slug_or_id)
        except Exception:
            pass
    if not post:
        raise HTTPException(status_code=404, detail="Article introuvable")
    return post


@router.post("", status_code=201)
async def create_post(body: PostCreate, current_user=Depends(require_admin)):
    data = {
        "title": body.title,
        "slug": slugify(body.title),
        "content": body.content,
        "category": {"name": body.category_name} if body.category_name else {},
        "author_id": current_user["sub"],
        "active": body.active,
    }
    return await blog_repo.create(data)


@router.put("/{post_id}")
async def update_post(post_id: str, body: PostUpdate, current_user=Depends(require_admin)):
    data = body.model_dump(exclude_none=True)
    if "title" in data:
        data["slug"] = slugify(data["title"])
    return await blog_repo.update(post_id, data)


@router.delete("/{post_id}")
async def delete_post(post_id: str, current_user=Depends(require_admin)):
    await blog_repo.delete(post_id)
    return {"message": "Article supprimé"}