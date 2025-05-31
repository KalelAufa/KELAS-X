import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8000/api", // Sesuaikan dengan URL Lumen Anda
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});

// Interceptor untuk menambahkan token ke header
api.interceptors.request.use(
  (config) => {
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

export default api;
