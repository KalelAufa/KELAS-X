import React from "react";
import reactLogo from "../assets/react.svg";
import "./MainContent.css";

// MainContent component displays a welcome message and an image
const MainContent = () => {
  return (
    <div className="main-content">
      <h2>Selamat Datang di Tutorial React JS SMK Revit!</h2>
      {/* Menampilkan gambar React */}
      <img src={reactLogo} alt="React Logo" className="main-logo" />
      <p>Belajar React JS itu mudah dan menyenangkan!</p>
    </div>
  );
};

export default MainContent;
