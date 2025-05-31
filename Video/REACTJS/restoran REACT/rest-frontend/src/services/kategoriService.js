import api from "../api/axios";

export const getKategoris = async () => {
  try {
    const response = await api.get("/kategori");
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const createKategori = async (kategoriData) => {
  try {
    const response = await api.post("/kategori", kategoriData);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const getKategoriById = async (id) => {
  try {
    const response = await api.get(`/kategori/${id}`);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const updateKategori = async (id, kategoriData) => {
  try {
    const response = await api.put(`/kategori/${id}`, kategoriData);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const deleteKategori = async (id) => {
  try {
    const response = await api.delete(`/kategori/${id}`);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};
