// src/services/recommendationService.js
import api from "./api";

export async function getRecommendedJobs(limit = 10) {
  const res = await api.get(`/recommendations/jobs`, { params: { limit } });
  console.log("🔍 Structure API:", JSON.stringify(res.data, null, 2)); // 👈
  return res.data;
}

export async function getRecommendationsFromCV(cvText, topN = 10) {
  const res = await api.post("/recommendations/jobs/from-cv", {
    cv_text: cvText,
    top_n: topN,
  });
  console.log("🔍 Structure CV API:", JSON.stringify(res.data, null, 2)); // 👈
  return res.data;
}

export async function getRecommendedCandidates(listingId, limit = 10) {
  const res = await api.get(`/recommendations/candidates/${listingId}`, { params: { limit } });
  return res.data;
}