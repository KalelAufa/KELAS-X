import api from "../api/axios";

export const getMenus = async () => {
  try {
    const response = await api.get("/menu");
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const createMenu = async (menuData) => {
  try {
    const response = await api.post("/menu", menuData);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const getMenuById = async (id) => {
  try {
    const response = await api.get(`/menu/${id}`);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const updateMenu = async (id, menuData) => {
  try {
    const response = await api.put(`/menu/${id}`, menuData);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const deleteMenu = async (id) => {
  try {
    const response = await api.delete(`/menu/${id}`);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const getMenuKategoris = async () => {
  try {
    const response = await api.get("/menu/kategoris");
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};
