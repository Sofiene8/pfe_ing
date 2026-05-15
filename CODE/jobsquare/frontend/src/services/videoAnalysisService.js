import api from "./api";

/**
 * Service frontend — Module d'analyse vidéo comportementale
 */
const videoAnalysisService = {
  /**
   * Upload d'une vidéo candidat.
   * @param {File} file
   * @param {string} listingId
   * @param {string} applicationId
   * @param {Function} onProgress — callback(percent)
   */
  async uploadVideo(file, listingId, applicationId, onProgress) {
    const formData = new FormData();
    formData.append("file", file);
    formData.append("listing_id", listingId);
    formData.append("application_id", applicationId);

    const response = await api.post("/videos/upload", formData, {
      headers: { "Content-Type": "multipart/form-data" },
      onUploadProgress: (e) => {
        if (onProgress && e.total) {
          onProgress(Math.round((e.loaded / e.total) * 100));
        }
      },
    });
    return response.data;
  },

  /**
   * Polling du statut d'analyse.
   */
  async getStatus(submissionId) {
    const response = await api.get(`/videos/${submissionId}/status`);
    return response.data;
  },

  /**
   * Rapport complet par applicationId.
   */
  async getReportByApplication(applicationId) {
    const response = await api.get(`/analysis/application/${applicationId}`);
    return response.data;
  },

  /**
   * Rapport complet par submissionId.
   */
  async getReportBySubmission(submissionId) {
    const response = await api.get(`/analysis/submission/${submissionId}`);
    return response.data;
  },

  /**
   * Dashboard recruteur : tous les candidats pour une offre.
   */
  async getListingDashboard(listingId) {
    const response = await api.get(`/analysis/listing/${listingId}`);
    return response.data;
  },

  /**
   * Polling avec callback — arrête automatiquement quand terminé.
   * @returns {Function} cancel — appeler pour arrêter le polling
   */
  pollStatus(submissionId, onUpdate, intervalMs = 3000) {
    let active = true;
    const poll = async () => {
      if (!active) return;
      try {
        const data = await this.getStatus(submissionId);
        onUpdate(data);
        if (data.status !== "completed" && data.status !== "failed") {
          setTimeout(poll, intervalMs);
        }
      } catch (err) {
        onUpdate({ status: "failed", error_message: err.message });
      }
    };
    poll();
    return () => { active = false; };
  },
};

export default videoAnalysisService;