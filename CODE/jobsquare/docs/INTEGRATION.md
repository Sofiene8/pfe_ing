# ─────────────────────────────────────────────────────────────────
# PATCH docker-compose.yml — Ajouter ce bloc "services:" à votre
# docker-compose.yml existant.
# ─────────────────────────────────────────────────────────────────

# À ajouter sous votre section "services:" existante :

  # ── Service d'analyse vidéo ──────────────────────────────────
  interview_engine:
    build:
      context: ./interview_engine
      dockerfile: Dockerfile
    ports:
      - "8001:8001"
    environment:
      - GROQ_API_KEY=${GROQ_API_KEY}
      - YOLO_MODEL_PATH=/models/yolov8n-pose.pt
      - MONGODB_URL=${MONGODB_URL}
      - VIDEO_UPLOAD_DIR=/app/uploads/videos
    volumes:
      - ./backend/uploads:/app/uploads        # partage le dossier uploads avec le backend
      - ./models:/models                       # modèles YOLO pré-téléchargés
    depends_on:
      - mongodb
    networks:
      - app_network
    restart: unless-stopped

# ─────────────────────────────────────────────────────────────────
# Variables à ajouter dans backend/.env :
# ─────────────────────────────────────────────────────────────────

# GROQ_API_KEY=gsk_xxxxxxxxxxxxxxxxxxxxxxxx
# YOLO_MODEL_PATH=yolov8n-pose.pt
# VIDEO_UPLOAD_DIR=uploads/videos

# ─────────────────────────────────────────────────────────────────
# Enregistrement des nouveaux routers dans backend/app/main.py :
# ─────────────────────────────────────────────────────────────────
#
# from app.api.v1.endpoints.video_upload import router as video_router
# from app.api.v1.endpoints.analysis_results import router as analysis_router
#
# app.include_router(video_router, prefix="/api/v1")
# app.include_router(analysis_router, prefix="/api/v1")

# ─────────────────────────────────────────────────────────────────
# Routes frontend à ajouter dans App.jsx / router :
# ─────────────────────────────────────────────────────────────────
#
# { path: "/video-upload",           element: <VideoUploadPage /> }
# { path: "/video-status/:submissionId", element: <VideoStatusPage /> }
# { path: "/report/:applicationId",  element: <CandidateReportPage /> }