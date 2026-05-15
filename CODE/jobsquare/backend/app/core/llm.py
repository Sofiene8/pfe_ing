"""Client LLM — Groq (gratuit)"""
from groq import Groq
import os

_client = None

def get_llm_client() -> Groq:
    global _client
    if _client is None:
        _client = Groq(api_key=os.getenv("GROQ_API_KEY"))
    return _client