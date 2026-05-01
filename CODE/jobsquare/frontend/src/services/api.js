// src/services/api.js — Axios instance + interceptors
import axios from 'axios';

const API_BASE = import.meta.env.VITE_API_URL || 'http://localhost:8000/api/v1';

const api = axios.create({
  baseURL: API_BASE,
  headers: { 'Content-Type': 'application/json' },
  timeout: 120000,
});

// Request interceptor — injecte le JWT
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('access_token');
  if (token) config.headers.Authorization = `Bearer ${token}`;
  return config;
});

// Response interceptor — refresh token automatique
api.interceptors.response.use(
  (res) => res,
  async (error) => {
    const original = error.config;
    if (error.response?.status === 401 && !original._retry) {
      original._retry = true;
      const refreshToken = localStorage.getItem('refresh_token');
      if (refreshToken) {
        try {
          const { data } = await axios.post(`${API_BASE}/auth/refresh`, { refresh_token: refreshToken });
          localStorage.setItem('access_token', data.access_token);
          original.headers.Authorization = `Bearer ${data.access_token}`;
          return api(original);
        } catch {
          localStorage.clear();
          window.location.href = '/login';
        }
      }
    }
    return Promise.reject(error);
  }
);

// ─── Auth ────────────────────────────────────────────────────────────────────
export const authAPI = {
  register: (data) => api.post('/auth/register', data),
  login: (data) => api.post('/auth/login', data),
  me: () => api.get('/auth/me'),
  changePassword: (data) => api.put('/auth/change-password', data),
  verifyEmail: (key) => api.get(`/auth/verify/${key}`),
};

// ─── Listings ────────────────────────────────────────────────────────────────
export const listingsAPI = {
  search: (params) => api.get('/listings', { params }),
  getOne: (id) => api.get(`/listings/${id}`),
  getSimilar: (id) => api.get(`/listings/${id}/similar`),
  getMy: (params) => api.get('/listings/my', { params }),
  create: (data) => api.post('/listings', data),
  update: (id, data) => api.put(`/listings/${id}`, data),
  delete: (id) => api.delete(`/listings/${id}`),
};

// ─── Applications ────────────────────────────────────────────────────────────
export const applicationsAPI = {
  apply: (listingId, data) => api.post(`/applications/${listingId}`, data),
  getMy: () => api.get('/applications/my'),
  getForListing: (listingId) => api.get(`/applications/listing/${listingId}`),
  updateStatus: (appId, data) => api.patch(`/applications/${appId}/status`, data),
};

// ─── Users ───────────────────────────────────────────────────────────────────
export const usersAPI = {
  getOne: (id) => api.get(`/users/${id}`),
  updateProfile: (data) => api.put('/users/me/profile', data),
  updateCompany: (data) => api.put('/users/me/company', data),
  updateCV: (data) => api.put('/users/me/cv', data),
  uploadAvatar: (file) => {
    const fd = new FormData(); fd.append('file', file);
    return api.post('/users/me/avatar', fd, { headers: { 'Content-Type': 'multipart/form-data' } });
  },
  uploadCvFile: (file) => {
    const fd = new FormData(); fd.append('file', file);
    return api.post('/users/me/cv-file', fd, { headers: { 'Content-Type': 'multipart/form-data' } });
  },
};

// ─── Recommendations ─────────────────────────────────────────────────────────
export const recommendationsAPI = {
  getJobs: (limit = 10) => api.get('/recommendations/jobs', { params: { limit } }),
  getCandidates: (listingId, limit = 10) =>
    api.get(`/recommendations/candidates/${listingId}`, { params: { limit } }),
};

// ─── Chatbot ─────────────────────────────────────────────────────────────────
export const chatbotAPI = {
  chat: (data) => api.post('/chatbot/chat', data),
  analyzeCV: () => api.post('/chatbot/analyze-cv'),
};

export default api;