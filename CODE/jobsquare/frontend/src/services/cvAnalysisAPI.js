// frontend/src/services/cvAnalysisAPI.js
/**
 * Service API pour l'analyse intelligente de CV (backend Groq).
 * Utilise l'instance Axios configurée dans api.js (baseURL + JWT injecté automatiquement).
 *
 * Import dans vos composants :
 *   import { cvAnalysisAPI } from '../services/cvAnalysisAPI';
 */

import api from './api'; // instance Axios avec interceptors JWT

export const cvAnalysisAPI = {
  /**
   * Analyse le CV déjà uploadé dans le profil utilisateur.
   * → POST /api/v1/cv/analyze
   */
  analyzeExistingCV: () =>
    api.post('/cv/analyze'),

  /**
   * Upload un fichier CV et l'analyse immédiatement via Groq.
   * → POST /api/v1/cv/analyze-upload
   *
   * @param {File}     file       - Fichier PDF/DOCX à analyser
   * @param {Function} onProgress - Callback progression upload (optionnel)
   */
  uploadAndAnalyze: (file, onProgress) => {
    const formData = new FormData();
    formData.append('file', file);
    return api.post('/cv/analyze-upload', formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
      timeout: 120000, // 2 min — Groq est rapide mais le PDF peut être lourd
      onUploadProgress: onProgress
        ? (e) => onProgress(Math.round((e.loaded * 100) / e.total))
        : undefined,
    });
  },

  /**
   * Récupère la dernière analyse Groq sauvegardée dans le profil.
   * → GET /api/v1/cv/analysis
   */
  getSavedAnalysis: () =>
    api.get('/cv/analysis'),

  /**
   * Supprime l'analyse Groq sauvegardée.
   * → DELETE /api/v1/cv/analysis
   */
  deleteAnalysis: () =>
    api.delete('/cv/analysis'),
};

export default cvAnalysisAPI;