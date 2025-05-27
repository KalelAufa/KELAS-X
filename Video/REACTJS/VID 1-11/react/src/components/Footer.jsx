import React from "react";
import "./Footer.css";

// Footer component for application footer
const Footer = () => {
  return (
    <footer className="footer">
      <p>&copy; {new Date().getFullYear()} SMK Revit. All rights reserved.</p>
    </footer>
  );
};

export default Footer;
