// src/pages/RegisterPage.js
import React, { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import { customerRegister } from "../services/authService";
import Navbar from "../components/Navbar"; // Import Navbar for a full page layout
import Footer from "../components/Footer"; // Import Footer

const RegisterPage = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState("");
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await customerRegister({ name, email, password });
      alert("Registration successful! Please login.");
      navigate("/login");
    } catch (err) {
      setError(
        err.response?.data?.message || "Registration failed. Please try again."
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
                Customer Register
              </h2>
              <form onSubmit={handleSubmit}>
                <div className="mb-3">
                  <label htmlFor="nameInput" className="form-label">
                    Name
                  </label>
                  <input
                    type="text"
                    className="form-control bg-dark text-white border-secondary"
                    id="nameInput"
                    placeholder="Your Name"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    required
                  />
                </div>
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
                <button type="submit" className="btn btn-warning w-100">
                  Register
                </button>
                {error && <p className="text-danger mt-3">{error}</p>}
              </form>
              <p className="text-center mt-3 text-muted">
                Already have an account?{" "}
                <Link to="/login" className="text-warning">
                  Login here
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

export default RegisterPage;
