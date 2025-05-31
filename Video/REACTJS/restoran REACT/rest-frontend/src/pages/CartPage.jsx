// src/pages/CartPage.js
import React, { useState, useEffect } from "react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import {
  getCartItems,
  updateCartItem,
  removeCartItem,
  clearCart,
  checkoutCart,
} from "../services/cartService";

const CartPage = () => {
  const [cartItems, setCartItems] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchCart = async () => {
      try {
        setLoading(true);
        const items = await getCartItems();
        setCartItems(items);
        setLoading(false);
      } catch (err) {
        setError(
          err.response?.data?.message ||
            "Failed to load cart items. Please log in."
        );
        setLoading(false);
      }
    };
    fetchCart();
  }, []);

  const handleUpdateQuantity = async (id, newQuantity) => {
    if (newQuantity < 1) return;
    try {
      await updateCartItem(id, { quantity: newQuantity });
      setCartItems(
        cartItems.map((item) =>
          item.id === id ? { ...item, quantity: newQuantity } : item
        )
      );
    } catch (err) {
      console.error("Error updating cart item:", err);
      alert("Failed to update item quantity.");
    }
  };

  const handleRemoveItem = async (id) => {
    try {
      await removeCartItem(id);
      setCartItems(cartItems.filter((item) => item.id !== id));
      window.location.reload(); // To update Navbar cart count
    } catch (err) {
      console.error("Error removing cart item:", err);
      alert("Failed to remove item from cart.");
    }
  };

  const handleClearCart = async () => {
    if (window.confirm("Are you sure you want to clear your cart?")) {
      try {
        await clearCart();
        setCartItems([]);
        alert("Cart cleared successfully!");
        window.location.reload(); // To update Navbar cart count
      } catch (err) {
        console.error("Error clearing cart:", err);
        alert("Failed to clear cart.");
      }
    }
  };

  const handleCheckout = async () => {
    if (cartItems.length === 0) {
      alert("Your cart is empty. Please add items before checking out.");
      return;
    }
    if (window.confirm("Proceed to checkout?")) {
      try {
        await checkoutCart();
        alert(
          "Order placed successfully! You can view your order history (if implemented)."
        );
        setCartItems([]); // Clear cart after successful checkout
        window.location.reload(); // Refresh navbar cart count
      } catch (err) {
        console.error("Error during checkout:", err);
        alert(
          err.response?.data?.message || "Checkout failed. Please try again."
        );
      }
    }
  };

  const calculateTotal = () => {
    return cartItems.reduce(
      (total, item) => total + item.menu.price * item.quantity,
      0
    );
  };

  if (loading) {
    return (
      <div className="d-flex flex-column min-vh-100 bg-dark text-white">
        <Navbar />
        <div className="container flex-grow-1 py-4 text-center">
          <h2 className="text-warning">Loading Cart...</h2>
        </div>
        <Footer />
      </div>
    );
  }

  return (
    <div className="d-flex flex-column min-vh-100 bg-dark text-white">
      <Navbar />
      <div className="container flex-grow-1 py-4">
        <main className="p-3 bg-secondary rounded shadow-sm">
          <h2 className="mb-4 text-warning text-center">Your Shopping Cart</h2>

          {error && (
            <div className="alert alert-danger text-center">{error}</div>
          )}

          {cartItems.length === 0 && !error ? (
            <p className="text-center text-muted">Your cart is empty.</p>
          ) : (
            <>
              <ul className="list-group mb-4">
                {cartItems.map((item) => (
                  <li
                    key={item.id}
                    className="list-group-item d-flex justify-content-between align-items-center bg-dark text-white border-secondary mb-2">
                    <div className="d-flex align-items-center">
                      <img
                        src={
                          item.menu.image_url ||
                          "https://via.placeholder.com/50x50/343a40/ffffff?text=Item"
                        }
                        alt={item.menu.name}
                        className="rounded-circle me-3"
                        style={{
                          width: "50px",
                          height: "50px",
                          objectFit: "cover",
                        }}
                      />
                      <div>
                        <h5 className="mb-1 text-light">{item.menu.name}</h5>
                        <small className="text-muted">
                          $
                          {item.menu.price ? item.menu.price.toFixed(2) : "N/A"}{" "}
                          each
                        </small>
                      </div>
                    </div>
                    <div className="d-flex align-items-center">
                      <div
                        className="input-group input-group-sm me-3"
                        style={{ width: "120px" }}>
                        <button
                          className="btn btn-outline-warning"
                          type="button"
                          onClick={() =>
                            handleUpdateQuantity(item.id, item.quantity - 1)
                          }>
                          -
                        </button>
                        <input
                          type="text"
                          className="form-control text-center bg-dark text-white border-secondary"
                          value={item.quantity}
                          readOnly
                        />
                        <button
                          className="btn btn-outline-warning"
                          type="button"
                          onClick={() =>
                            handleUpdateQuantity(item.id, item.quantity + 1)
                          }>
                          +
                        </button>
                      </div>
                      <span className="fw-bold me-3 text-info">
                        ${((item.menu.price || 0) * item.quantity).toFixed(2)}
                      </span>
                      <button
                        className="btn btn-danger btn-sm"
                        onClick={() => handleRemoveItem(item.id)}>
                        <i className="fas fa-trash"></i>
                      </button>
                    </div>
                  </li>
                ))}
              </ul>
              <div className="d-flex justify-content-between align-items-center border-top border-secondary pt-3">
                <h4 className="text-warning">
                  Total:{" "}
                  <span className="text-info">
                    ${calculateTotal().toFixed(2)}
                  </span>
                </h4>
                <div>
                  <button
                    className="btn btn-outline-danger me-2"
                    onClick={handleClearCart}>
                    Clear Cart
                  </button>
                  <button className="btn btn-success" onClick={handleCheckout}>
                    Checkout
                  </button>
                </div>
              </div>
            </>
          )}
        </main>
      </div>
      <Footer />
    </div>
  );
};

export default CartPage;
