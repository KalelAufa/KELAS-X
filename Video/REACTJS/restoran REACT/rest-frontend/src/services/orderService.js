import api from "../api/axios";

export const getOrders = async () => {
  try {
    const response = await api.get("/orders");
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const createOrder = async (orderData) => {
  try {
    const response = await api.post("/orders", orderData);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const getOrderById = async (id) => {
  try {
    const response = await api.get(`/orders/${id}`);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const updateOrder = async (id, orderData) => {
  try {
    const response = await api.put(`/orders/${id}`, orderData);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const updateOrderStatus = async (id, statusData) => {
  try {
    const response = await api.put(`/orders/${id}/status`, statusData);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const deleteOrder = async (id) => {
  try {
    const response = await api.delete(`/orders/${id}`);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

// Order Details
export const getOrderDetails = async (orderId) => {
  try {
    const response = await api.get(`/orders/${orderId}/details`);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const createOrderDetail = async (orderId, detailData) => {
  try {
    const response = await api.post(`/orders/${orderId}/details`, detailData);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const getOrderDetailById = async (orderId, detailId) => {
  try {
    const response = await api.get(`/orders/${orderId}/details/${detailId}`);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const updateOrderDetail = async (orderId, detailId, detailData) => {
  try {
    const response = await api.put(
      `/orders/${orderId}/details/${detailId}`,
      detailData
    );
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};

export const deleteOrderDetail = async (orderId, detailId) => {
  try {
    const response = await api.delete(`/orders/${orderId}/details/${detailId}`);
    return response.data;
  } catch (error) {
    throw error.response.data;
  }
};
