import time
import logging
from collections import defaultdict
from starlette.middleware.base import BaseHTTPMiddleware
from starlette.requests import Request

logger = logging.getLogger(__name__)


class RequestLoggingMiddleware(BaseHTTPMiddleware):
    async def dispatch(self, request: Request, call_next):
        start = time.time()
        response = await call_next(request)
        duration = round((time.time() - start) * 1000, 2)
        logger.info(f"{request.method} {request.url.path} → {response.status_code} ({duration}ms)")
        return response


class RateLimitMiddleware(BaseHTTPMiddleware):
    def __init__(self, app, calls: int = 100, period: int = 60):
        super().__init__(app)
        self.calls = calls
        self.period = period
        self._records: dict = defaultdict(list)

    async def dispatch(self, request: Request, call_next):
        client_ip = request.client.host
        now = time.time()

        # Nettoyer les anciens appels
        self._records[client_ip] = [
            t for t in self._records[client_ip] if now - t < self.period
        ]

        if len(self._records[client_ip]) >= self.calls:
            from starlette.responses import JSONResponse
            return JSONResponse(
                {"detail": "Too many requests"},
                status_code=429
            )

        self._records[client_ip].append(now)
        return await call_next(request)