import api from "../api/axios";

export const getStaffs = async () => {
  try {
    const response = await api.get("/staff");
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const createStaff = async (staffData) => {
  try {
    const response = await api.post("/staff", staffData);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const getStaffById = async (id) => {
  try {
    const response = await api.get(`/staff/${id}`);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const updateStaff = async (id, staffData) => {
  try {
    const response = await api.put(`/staff/${id}`, staffData);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const deleteStaff = async (id) => {
  try {
    const response = await api.delete(`/staff/${id}`);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const restoreStaff = async (id) => {
  try {
    const response = await api.post(`/staff/${id}/restore`);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};
