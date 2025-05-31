import api from "../api/axios";

export const getCartItems = async () => {
  try {
    const response = await api.get("/cart");
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const addToCart = async (itemData) => {
  try {
    const response = await api.post("/cart", itemData);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const updateCartItem = async (id, itemData) => {
  try {
    const response = await api.put(`/cart/${id}`, itemData);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const removeCartItem = async (id) => {
  try {
    const response = await api.delete(`/cart/${id}`);
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const clearCart = async () => {
  try {
    const response = await api.delete("/cart/clear");
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};

export const checkoutCart = async () => {
  try {
    const response = await api.post("/cart/checkout");
    return response.data;
  } catch (error) {
    throw (
      error.response?.data || {
        message: error.message || "Terjadi kesalahan koneksi/server",
      }
    );
  }
};
