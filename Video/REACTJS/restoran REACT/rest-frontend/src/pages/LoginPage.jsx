// src/pages/LoginPage.js
import React, { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import { customerLogin } from "../services/authService";
import Navbar from "../components/Navbar"; // Import Navbar for a full page layout
import Footer from "../components/Footer"; // Import Footer

const LoginPage = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await customerLogin({ email, password });
      navigate("/");
      window.location.reload(); // Force a reload to update Navbar state (e.g., cart count)
    } catch (err) {
      setError(
        err.response?.data?.message ||
          "Login failed. Please check your credentials."
      );
    }
  };

  return (
    <div className="d-flex flex-column min-vh-100 bg-dark text-white">
      <Navbar />
      <div className="container flex-grow-1 d-flex align-items-center justify-content-center py-4">
        <div className="row justify-content-center w-100">
          <div className="col-md-6 col-lg-4">
            <div className="card shadow-lg p-4 bg-secondary text-white border-dark">
              <h2 className="card-title text-center mb-4 text-warning">
                Customer Login
              </h2>
              <form onSubmit={handleSubmit}>
                <div className="mb-3">
                  <label htmlFor="emailInput" className="form-label">
                    Email address
                  </label>
                  <input
                    type="email"
                    className="form-control bg-dark text-white border-secondary"
                    id="emailInput"
                    placeholder="name@example.com"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="passwordInput" className="form-label">
                    Password
                  </label>
                  <input
                    type="password"
                    className="form-control bg-dark text-white border-secondary"
                    id="passwordInput"
                    placeholder="Password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                  />
                </div>
                <button type="submit" className="btn btn-primary w-100">
                  Login
                </button>
                {error && <p className="text-danger mt-3">{error}</p>}
              </form>
              <p className="text-center mt-3 text-muted">
                Don't have an account?{" "}
                <Link to="/register" className="text-warning">
                  Register here
                </Link>
              </p>
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </div>
  );
};

export default LoginPage;
