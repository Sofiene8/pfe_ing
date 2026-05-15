"""app/core/security.py — JWT + Password hashing"""
from datetime import datetime, timedelta
from typing import Optional
from jose import JWTError, jwt
from passlib.context import CryptContext
from fastapi import HTTPException, status, Depends
from fastapi.security import HTTPBearer, HTTPAuthorizationCredentials

from app.core.config import settings

pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")
bearer_scheme = HTTPBearer()
bearer_scheme_optional = HTTPBearer(auto_error=False)


def hash_password(password: str) -> str:
    return pwd_context.hash(password)


def verify_password(plain: str, hashed: str) -> bool:
    return pwd_context.verify(plain, hashed)


def create_access_token(data: dict, expires_delta: Optional[timedelta] = None) -> str:
    payload = data.copy()
    expire = datetime.utcnow() + (expires_delta or timedelta(minutes=settings.ACCESS_TOKEN_EXPIRE_MINUTES))
    payload["exp"] = expire
    payload["type"] = "access"
    return jwt.encode(payload, settings.SECRET_KEY, algorithm=settings.JWT_ALGORITHM)


def create_refresh_token(data: dict) -> str:
    payload = data.copy()
    expire = datetime.utcnow() + timedelta(days=settings.REFRESH_TOKEN_EXPIRE_DAYS)
    payload["exp"] = expire
    payload["type"] = "refresh"
    return jwt.encode(payload, settings.SECRET_KEY, algorithm=settings.JWT_ALGORITHM)


def decode_token(token: str) -> dict:
    try:
        payload = jwt.decode(token, settings.SECRET_KEY, algorithms=[settings.JWT_ALGORITHM])
        return payload
    except JWTError:
        raise HTTPException(
            status_code=status.HTTP_401_UNAUTHORIZED,
            detail="Token invalide ou expiré"
        )


async def get_current_user(
    credentials: HTTPAuthorizationCredentials = Depends(bearer_scheme),
) -> dict:
    payload = decode_token(credentials.credentials)
    if payload.get("type") != "access":
        raise HTTPException(status_code=401, detail="Token type invalide")

    user_id = payload.get("sub")
    if not user_id:
        raise HTTPException(status_code=401, detail="Token sans identifiant utilisateur")

    from app.dao.repositories.user_repository import UserRepository
    user_repo = UserRepository()
    user = await user_repo.find_by_id(user_id)  # ✅ await + bon nom de méthode

    if not user:
        raise HTTPException(status_code=401, detail="Utilisateur introuvable")
    if not user.get("active", True):
        raise HTTPException(status_code=403, detail="Compte désactivé")

    user["id"] = str(user.get("_id", user_id))
    return user


async def get_current_user_optional(
    credentials: Optional[HTTPAuthorizationCredentials] = Depends(bearer_scheme_optional),
) -> Optional[dict]:
    if not credentials:
        return None
    try:
        payload = decode_token(credentials.credentials)
        if payload.get("type") != "access":
            return None

        user_id = payload.get("sub")
        if not user_id:
            return None

        from app.dao.repositories.user_repository import UserRepository
        user_repo = UserRepository()
        user = await user_repo.find_by_id(user_id)  # ✅ await + bon nom de méthode
        if not user:
            return None

        user["id"] = str(user.get("_id", user_id))
        return user
    except HTTPException:
        return None


async def require_employer(current_user: dict = Depends(get_current_user)):
    if current_user.get("role") not in ("employer", "admin"):
        raise HTTPException(status_code=403, detail="Accès réservé aux employeurs")
    return current_user


async def require_jobseeker(current_user: dict = Depends(get_current_user)):
    if current_user.get("role") not in ("jobseeker", "admin"):
        raise HTTPException(status_code=403, detail="Accès réservé aux candidats")
    return current_user


async def require_admin(current_user: dict = Depends(get_current_user)):
    if current_user.get("role") != "admin":
        raise HTTPException(status_code=403, detail="Accès administrateur requis")
    return current_user