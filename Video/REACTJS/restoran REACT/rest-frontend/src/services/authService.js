import api from "../api/axios";

// Customer Auth
export const customerRegister = async (userData) => {
  try {
    const response = await api.post("/auth/register", userData);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const customerLogin = async (credentials) => {
  try {
    const response = await api.post("/auth/login", credentials);
    localStorage.setItem("token", response.data.token);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const customerLogout = async () => {
  try {
    const response = await api.post("/auth/logout");
    localStorage.removeItem("token");
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const getCustomerProfile = async () => {
  try {
    const response = await api.get("/auth/me");
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

// Staff Auth
export const staffRegister = async (staffData) => {
  try {
    const response = await api.post("/staff/auth/register", staffData);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const staffLogin = async (credentials) => {
  try {
    const response = await api.post("/staff/auth/login", credentials);
    localStorage.setItem("token", response.data.token);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const staffLogout = async () => {
  try {
    const response = await api.post("/staff/auth/logout");
    localStorage.removeItem("token");
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const getStaffProfile = async () => {
  try {
    const response = await api.get("/staff/auth/me");
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};
