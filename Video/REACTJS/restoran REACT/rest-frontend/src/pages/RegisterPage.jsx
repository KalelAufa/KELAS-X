// src/pages/RegisterPage.js
import React, { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import { customerRegister } from "../services/authService";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

const RegisterPage = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordConfirmation, setPasswordConfirmation] = useState("");
  const [error, setError] = useState("");
  const [formErrors, setFormErrors] = useState({});
  const navigate = useNavigate();

  const validateForm = () => {
    const errors = {};

    if (!name) errors.name = "Name is required";
    if (!email) errors.email = "Email is required";
    if (!password) errors.password = "Password is required";
    if (password.length < 8)
      errors.password = "Password must be at least 8 characters";
    if (password !== passwordConfirmation)
      errors.passwordConfirmation = "Passwords do not match";

    setFormErrors(errors);
    return Object.keys(errors).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!validateForm()) return;

    try {
      await customerRegister({
        name,
        email,
        password,
        password_confirmation: passwordConfirmation,
      });
      alert("Registration successful! Please login.");
      navigate("/login");
    } catch (err) {
      setError(err.message || "Registration failed. Please try again.");
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
              {error && <div className="alert alert-danger">{error}</div>}
              <form onSubmit={handleSubmit}>
                <div className="mb-3">
                  <label htmlFor="nameInput" className="form-label">
                    Name
                  </label>
                  <input
                    type="text"
                    className={`form-control bg-dark text-white border-secondary ${
                      formErrors.name ? "is-invalid" : ""
                    }`}
                    id="nameInput"
                    placeholder="Your Name"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    required
                  />
                  {formErrors.name && (
                    <div className="invalid-feedback">{formErrors.name}</div>
                  )}
                </div>
                <div className="mb-3">
                  <label htmlFor="emailInput" className="form-label">
                    Email address
                  </label>
                  <input
                    type="email"
                    className={`form-control bg-dark text-white border-secondary ${
                      formErrors.email ? "is-invalid" : ""
                    }`}
                    id="emailInput"
                    placeholder="name@example.com"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                  />
                  {formErrors.email && (
                    <div className="invalid-feedback">{formErrors.email}</div>
                  )}
                </div>
                <div className="mb-3">
                  <label htmlFor="passwordInput" className="form-label">
                    Password
                  </label>
                  <input
                    type="password"
                    className={`form-control bg-dark text-white border-secondary ${
                      formErrors.password ? "is-invalid" : ""
                    }`}
                    id="passwordInput"
                    placeholder="Password (min 8 characters)"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                  />
                  {formErrors.password && (
                    <div className="invalid-feedback">
                      {formErrors.password}
                    </div>
                  )}
                </div>
                <div className="mb-3">
                  <label
                    htmlFor="passwordConfirmationInput"
                    className="form-label">
                    Confirm Password
                  </label>
                  <input
                    type="password"
                    className={`form-control bg-dark text-white border-secondary ${
                      formErrors.passwordConfirmation ? "is-invalid" : ""
                    }`}
                    id="passwordConfirmationInput"
                    placeholder="Confirm Password"
                    value={passwordConfirmation}
                    onChange={(e) => setPasswordConfirmation(e.target.value)}
                    required
                  />
                  {formErrors.passwordConfirmation && (
                    <div className="invalid-feedback">
                      {formErrors.passwordConfirmation}
                    </div>
                  )}
                </div>
                <button type="submit" className="btn btn-warning w-100">
                  Register
                </button>
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
