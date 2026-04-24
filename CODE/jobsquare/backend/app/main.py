"""
JobSquare Backend — FastAPI Application
Architecture: Controller → Service → Repository → MongoDB
"""

from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from fastapi.staticfiles import StaticFiles
from contextlib import asynccontextmanager
from pathlib import Path

from app.core.config import settings
from app.core.database import connect_db, close_db
from app.api.v1.endpoints import auth, users, listings, applications, recommendations, chatbot, admin, blog


@asynccontextmanager
async def lifespan(app: FastAPI):
    await connect_db()
    Path(settings.UPLOAD_DIR).mkdir(parents=True, exist_ok=True)
    yield
    await close_db()


app = FastAPI(
    title="JobSquare API",
    description="Plateforme d'emploi Tunisie — API REST complète",
    version="1.0.0",
    lifespan=lifespan,
    docs_url="/docs",
    redoc_url="/redoc",
)

app.add_middleware(
    CORSMiddleware,
    allow_origins=settings.CORS_ORIGINS,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

from app.core.middleware import RequestLoggingMiddleware, RateLimitMiddleware
app.add_middleware(RequestLoggingMiddleware)
app.add_middleware(RateLimitMiddleware, calls=200, period=60)

# Static files (uploads)
upload_path = Path(settings.UPLOAD_DIR)
upload_path.mkdir(parents=True, exist_ok=True)
app.mount("/uploads", StaticFiles(directory=str(upload_path)), name="uploads")

# ─── Routers ──────────────────────────────────────────────────────────────────
app.include_router(auth.router,            prefix="/api/v1/auth",            tags=["Auth"])
app.include_router(users.router,           prefix="/api/v1/users",           tags=["Users"])
app.include_router(listings.router,        prefix="/api/v1/listings",        tags=["Listings"])
app.include_router(applications.router,    prefix="/api/v1/applications",    tags=["Applications"])
app.include_router(recommendations.router, prefix="/api/v1/recommendations", tags=["Recommendations"])
app.include_router(chatbot.router,         prefix="/api/v1/chatbot",         tags=["Chatbot"])
app.include_router(blog.router,            prefix="/api/v1/blog",            tags=["Blog"])
app.include_router(admin.router,           prefix="/api/v1/admin",           tags=["Admin"])


@app.get("/health", tags=["System"])
async def health():
    return {"status": "ok", "service": "jobsquare-api", "version": "1.0.0"}


@app.get("/", tags=["System"])
async def root():
    return {"message": "JobSquare API", "docs": "/docs", "version": "1.0.0"}
