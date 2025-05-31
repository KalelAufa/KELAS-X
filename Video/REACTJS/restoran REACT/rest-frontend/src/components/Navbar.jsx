// src/components/Navbar.js
import React, { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { getCustomerProfile, customerLogout } from "../services/authService";
import { getCartItems } from "../services/cartService";

const Navbar = ({ onSearch }) => {
  const [customer, setCustomer] = useState(null);
  const [searchQuery, setSearchQuery] = useState("");
  const [cartItemCount, setCartItemCount] = useState(0);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchProfileAndCart = async () => {
      try {
        const token = localStorage.getItem("token");
        if (token) {
          const profile = await getCustomerProfile();
          setCustomer(profile);
          const cart = await getCartItems();
          setCartItemCount(cart.reduce((sum, item) => sum + item.quantity, 0));
        }
      } catch (error) {
        console.error("Error fetching data for Navbar:", error);
        localStorage.removeItem("token"); // Clear invalid token
        setCustomer(null);
        setCartItemCount(0);
        // Optionally redirect to login if 401
      }
    };
    fetchProfileAndCart();
  }, []);

  const handleLogout = async () => {
    try {
      await customerLogout();
      setCustomer(null);
      setCartItemCount(0);
      navigate("/");
      window.location.reload(); // Force a reload to update Navbar state
    } catch (error) {
      console.error("Error logging out:", error);
      alert("Failed to log out.");
    }
  };

  const handleSearchChange = (e) => {
    setSearchQuery(e.target.value);
  };

  const handleSearchSubmit = (e) => {
    e.preventDefault();
    if (onSearch) {
      onSearch(searchQuery);
    }
    // Optionally navigate to /menu page when searching from home
    if (window.location.pathname !== "/menu") {
      navigate("/menu");
    }
  };

  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
      <div className="container-fluid">
        <Link className="navbar-brand text-warning" to="/">
          My Restaurant
        </Link>
        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarNav">
          <ul className="navbar-nav me-auto mb-2 mb-lg-0">
            <li className="nav-item">
              <Link className="nav-link text-white" to="/">
                Home
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link text-white" to="/menu">
                Menu
              </Link>
            </li>
          </ul>
          <form className="d-flex me-3" onSubmit={handleSearchSubmit}>
            <input
              className="form-control me-2 bg-dark text-white border-secondary"
              type="search"
              placeholder="Search menu items..."
              aria-label="Search"
              value={searchQuery}
              onChange={handleSearchChange}
            />
            <button className="btn btn-outline-warning" type="submit">
              Search
            </button>
          </form>
          <ul className="navbar-nav align-items-center">
            <li className="nav-item me-3">
              <Link
                className="nav-link text-white position-relative"
                to="/cart">
                <i className="fas fa-shopping-cart"></i> Cart
                {cartItemCount > 0 && (
                  <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {cartItemCount}
                  </span>
                )}
              </Link>
            </li>
            {customer ? (
              <>
                <li className="nav-item">
                  <span className="nav-link text-info">
                    Hello, {customer.name}
                  </span>
                </li>
                <li className="nav-item">
                  <button
                    className="btn btn-danger ms-2"
                    onClick={handleLogout}>
                    Logout
                  </button>
                </li>
              </>
            ) : (
              <>
                <li className="nav-item">
                  <Link className="btn btn-outline-light me-2" to="/login">
                    Login
                  </Link>
                </li>
                <li className="nav-item">
                  <Link className="btn btn-warning" to="/register">
                    Register
                  </Link>
                </li>
              </>
            )}
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
