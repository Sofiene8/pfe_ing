// src/hooks/useRecommendations.js
import { useState, useEffect, useCallback } from "react";
import {
  getRecommendedJobs,
  getRecommendationsFromCV,
} from "../services/recommendationService";

export function useRecommendedJobs(limit = 10) {
  const [jobs, setJobs] = useState([]);
  const [loading, setLoading] = useState(false); // ← false par défaut
  const [error, setError] = useState(null);

  const fetch = useCallback(async () => {
    //  Ne pas appeler si pas de token
    const token = localStorage.getItem("token") 
               || localStorage.getItem("access_token")
               || sessionStorage.getItem("token");
    if (!token) {
      setJobs([]);
      setLoading(false);
      return;
    }

    setLoading(true);
    setError(null);
    try {
      const data = await getRecommendedJobs(limit);
      setJobs(data);
    } catch (e) {
      const status = e?.response?.status;
      if (status === 401 || status === 403) {
        setJobs([]); // silencieux si non connecté
      } else {
        setError(e?.response?.data?.detail || "Erreur de chargement");
      }
    } finally {
      setLoading(false);
    }
  }, [limit]);

  useEffect(() => {
    fetch();
  }, [fetch]);

  return { jobs, loading, error, refetch: fetch };
}

// useRecommendFromCV reste identique
export function useRecommendFromCV() {
  const [jobs, setJobs] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const recommend = useCallback(async (cvText, topN = 10) => {
    if (!cvText?.trim()) return;
    setLoading(true);
    setError(null);
    try {
      const data = await getRecommendationsFromCV(cvText, topN);
      setJobs(data);
    } catch (e) {
      setError(e?.response?.data?.detail || "Erreur de recommandation");
    } finally {
      setLoading(false);
    }
  }, []);

  return { jobs, loading, error, recommend };
}