// src/components/MenuItemCard.js
import React from "react";
import { addToCart } from "../services/cartService";

const MenuItemCard = ({ menu }) => {
  const handleAddToCart = async () => {
    try {
      await addToCart({ menu_id: menu.id, quantity: 1 });
      alert(`${menu.name} added to cart!`);
      // A simple reload to update Navbar cart count.
      // In a real app, consider using Context API or Redux for global state.
      window.location.reload();
    } catch (error) {
      console.error("Error adding to cart:", error);
      alert("Failed to add item to cart. Please make sure you are logged in.");
    }
  };

  return (
    <div className="card h-100 shadow-sm bg-dark text-white border-secondary">
      <img
        src={
          menu.image_url ||
          "https://via.placeholder.com/200x150/343a40/ffffff?text=No+Image"
        }
        className="card-img-top"
        alt={menu.name}
        style={{ height: "180px", objectFit: "cover" }}
      />
      <div className="card-body d-flex flex-column">
        <h5 className="card-title text-warning">{menu.name}</h5>
        <p className="card-text text-muted flex-grow-1">{menu.description}</p>
        <p className="card-text fw-bold fs-5 text-danger">
          ${menu.price ? menu.price.toFixed(2) : "N/A"}
        </p>
        <button className="btn btn-success mt-auto" onClick={handleAddToCart}>
          Add to Cart
        </button>
      </div>
    </div>
  );
};

export default MenuItemCard;
