// src/App.jsx — Router complet
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import { Toaster } from 'react-hot-toast';
import Layout from './components/layout/Layout';
import HomePage           from './pages/HomePage';
import LoginPage          from './pages/LoginPage';
import RegisterPage       from './pages/RegisterPage';
import JobsPage           from './pages/JobsPage';
import JobDetailPage      from './pages/JobDetailPage';
import CVDepotPage        from './pages/CVDepotPage';
import ProfilePage        from './pages/ProfilePage';
import EditProfilePage    from './pages/EditProfilePage';
import ApplicationsPage   from './pages/ApplicationsPage';
import PostJobPage        from './pages/PostJobPage';
import AdminDashboardPage from './pages/AdminDashboardPage';
import NotFoundPage       from './pages/NotFoundPage';
import useAuthStore       from './store/authStore';
import CVRecommendPage from "./pages/CVRecommendPage";

function ProtectedRoute({ children, roles }) {
  const { isAuthenticated, user } = useAuthStore();
  if (!isAuthenticated) return <Navigate to="/login" replace />;
  if (roles && !roles.includes(user?.role)) return <Navigate to="/" replace />;
  return children;
}

function GuestRoute({ children }) {
  const { isAuthenticated } = useAuthStore();
  if (isAuthenticated) return <Navigate to="/" replace />;
  return children;
}

export default function App() {
  return (
    <BrowserRouter>
      <Toaster
        position="top-right"
        toastOptions={{
          duration: 4000,
          style: { borderRadius: '12px', fontSize: '14px', fontWeight: '500' },
          success: { style: { background: '#f0fdf4', border: '1px solid #bbf7d0', color: '#166534' } },
          error:   { style: { background: '#fef2f2', border: '1px solid #fecaca', color: '#991b1b' } },
        }}
      />
      <Routes>
        <Route path="/" element={<Layout />}>
          <Route index             element={<HomePage />} />
          <Route path="jobs"       element={<JobsPage />} />
          <Route path="jobs/:id"   element={<JobDetailPage />} />
          <Route path="login"      element={<GuestRoute><LoginPage /></GuestRoute>} />
          <Route path="register"   element={<GuestRoute><RegisterPage /></GuestRoute>} />
          <Route path="cv"         element={<ProtectedRoute roles={['jobseeker']}><CVDepotPage /></ProtectedRoute>} />
          <Route path="post-job"   element={<ProtectedRoute roles={['employer']}><PostJobPage /></ProtectedRoute>} />
          <Route path="post-job/edit/:id" element={<ProtectedRoute roles={['employer']}><PostJobPage /></ProtectedRoute>} />
          <Route path="profile"    element={<ProtectedRoute><ProfilePage /></ProtectedRoute>} />
          <Route path="profile/edit" element={<ProtectedRoute><EditProfilePage /></ProtectedRoute>} />
          <Route path="applications" element={<ProtectedRoute><ApplicationsPage /></ProtectedRoute>} />
          <Route path="admin"      element={<ProtectedRoute roles={['admin']}><AdminDashboardPage /></ProtectedRoute>} />
          <Route path="*"          element={<NotFoundPage />} />
          <Route path="/recommend" element={<CVRecommendPage />} /> 
        </Route>
      </Routes>
    </BrowserRouter>
  );
}