import api from "../api/axios";

export const getPelanggans = async () => {
  try {
    const response = await api.get("/pelanggan");
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const createPelanggan = async (pelangganData) => {
  try {
    const response = await api.post("/pelanggan", pelangganData);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const getPelangganById = async (id) => {
  try {
    const response = await api.get(`/pelanggan/${id}`);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const updatePelanggan = async (id, pelangganData) => {
  try {
    const response = await api.put(`/pelanggan/${id}`, pelangganData);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const deletePelanggan = async (id) => {
  try {
    const response = await api.delete(`/pelanggan/${id}`);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const restorePelanggan = async (id) => {
  try {
    const response = await api.post(`/pelanggan/${id}/restore`);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};
