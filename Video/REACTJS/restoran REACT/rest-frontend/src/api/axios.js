import axios from "axios";

const api = axios.create({
  baseURL: "/api", // Gunakan proxy Vite agar bebas CORS saat dev
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});

// Interceptor untuk request
api.interceptors.request.use(
  (config) => {
    // Tambahkan token jika ada
    const token = localStorage.getItem("token");
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Interceptor untuk response
api.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    // Handle error
    if (error.response) {
      if (error.response.status === 401) {
        // Redirect ke login jika unauthorized
        window.location = "/login";
      }
    } else {
      // Network/server error
      alert("Tidak dapat terhubung ke server. Cek koneksi atau backend.");
    }
    return Promise.reject(error);
  }
);

export default api;
