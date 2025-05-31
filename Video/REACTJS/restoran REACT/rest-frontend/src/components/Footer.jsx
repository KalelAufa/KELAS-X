// src/components/Footer.js
import React from "react";

const Footer = () => {
  return (
    <footer className="bg-dark text-white pt-5 pb-4 mt-auto border-top border-secondary">
      <div className="container text-center text-md-start">
        <div className="row text-center text-md-start">
          <div className="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h5 className="text-uppercase mb-4 font-weight-bold text-warning">
              About Us
            </h5>
            <p className="text-light">
              Welcome to Our Restaurant! We serve delicious food made with the
              freshest ingredients. Experience a culinary journey with us.
            </p>
          </div>

          <div className="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
            <h5 className="text-uppercase mb-4 font-weight-bold text-warning">
              Quick Links
            </h5>
            <p>
              <a
                href="#"
                className="text-light"
                style={{ textDecoration: "none" }}>
                {" "}
                Privacy Policy
              </a>
            </p>
            <p>
              <a
                href="#"
                className="text-light"
                style={{ textDecoration: "none" }}>
                {" "}
                Terms of Service
              </a>
            </p>
            <p>
              <a
                href="#"
                className="text-light"
                style={{ textDecoration: "none" }}>
                {" "}
                Contact Us
              </a>
            </p>
          </div>

          <div className="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h5 className="text-uppercase mb-4 font-weight-bold text-warning">
              Contact Info
            </h5>
            <p className="text-light">
              <i className="fas fa-home me-3 text-warning"></i> Jl. Contoh No.
              123, Surabaya, Indonesia
            </p>
            <p className="text-light">
              <i className="fas fa-envelope me-3 text-warning"></i>{" "}
              info@myrestaurant.com
            </p>
            <p className="text-light">
              <i className="fas fa-phone me-3 text-warning"></i> +62 123 4567
              890
            </p>
          </div>
        </div>

        <hr className="mb-4 bg-secondary" />

        <div className="row align-items-center">
          <div className="col-md-7 col-lg-8">
            <p className="text-center text-md-start text-muted">
              &copy; {new Date().getFullYear()} My Restaurant. All rights
              reserved.
            </p>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
