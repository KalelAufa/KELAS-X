import React, { useState } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Header from "./components/Header";
import MainContent from "./components/MainContent";
import Footer from "./components/Footer";
import ProductCard from "./components/ProductCard";
import UserAvatar from "./components/UserAvatar";
import "bootstrap/dist/css/bootstrap.min.css";
import "./App.css";
import Menu from "./components/Menu";

// Sample data for products and users
const products = [
  {
    name: "React T-Shirt",
    price: 120000,
    image:
      "https://cdn.pixabay.com/photo/2016/03/31/19/56/t-shirt-1290564_1280.png",
  },
  {
    name: "React Mug",
    price: 50000,
    image: "https://cdn.pixabay.com/photo/2014/12/21/23/28/mug-579101_1280.png",
  },
  {
    name: "React Sticker",
    price: 15000,
    image:
      "https://cdn.pixabay.com/photo/2017/01/31/13/14/sticker-2029349_1280.png",
  },
];

const users = [
  {
    name: "Andi",
    avatar: "https://randomuser.me/api/portraits/men/32.jpg",
  },
  {
    name: "Budi",
    avatar: "https://randomuser.me/api/portraits/men/45.jpg",
  },
  {
    name: "Citra",
    avatar: "https://randomuser.me/api/portraits/women/65.jpg",
  },
];

// Sample data for menu and users
const menuItems = [
  {
    name: "Nasi Goreng",
    price: 15000,
    image:
      "https://cdn.pixabay.com/photo/2017/01/22/19/20/indonesian-2009594_1280.jpg",
  },
  {
    name: "Mie Ayam",
    price: 12000,
    image:
      "https://cdn.pixabay.com/photo/2016/03/05/19/02/hot-1239300_1280.jpg",
  },
  {
    name: "Sate Ayam",
    price: 20000,
    image:
      "https://cdn.pixabay.com/photo/2017/06/02/18/24/food-2367020_1280.jpg",
  },
  {
    name: "Es Teh Manis",
    price: 5000,
    image:
      "https://cdn.pixabay.com/photo/2017/07/28/14/28/tea-2545751_1280.jpg",
  },
  {
    name: "Jus Alpukat",
    price: 10000,
    image:
      "https://cdn.pixabay.com/photo/2017/01/20/15/06/smoothie-1998400_1280.jpg",
  },
];

function App() {
  // State sederhana untuk counter
  const [count, setCount] = useState(0);
  // State objek untuk form kontak
  const [form, setForm] = useState({ nama: "", pesan: "" });

  // Handler untuk form kontak
  const handleFormChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  return (
    <Router>
      <Header />
      <div className="container mt-4">
        <Routes>
          <Route
            path="/"
            element={
              <>
                <MainContent />
                {/* Contoh penggunaan state dan event */}
                <div className="card mb-4">
                  <h4>Contoh Counter dengan useState</h4>
                  <button
                    className="btn btn-success"
                    onClick={() => setCount(count + 1)}>
                    Klik Saya ({count})
                  </button>
                </div>
                {/* Contoh reuse komponen ProductCard */}
                <h4>Daftar Menu</h4>
                <div className="row">
                  {menuItems.map((item, idx) => (
                    <div className="col-md-4" key={idx}>
                      <ProductCard
                        name={item.name}
                        price={item.price}
                        image={item.image}
                      />
                    </div>
                  ))}
                </div>
                {/* Contoh reuse komponen UserAvatar */}
                <h4>Pengguna Aktif</h4>
                <div>
                  {users.map((user, idx) => (
                    <UserAvatar
                      key={idx}
                      name={user.name}
                      avatar={user.avatar}
                    />
                  ))}
                </div>
              </>
            }
          />
          <Route
            path="/tentang"
            element={
              <div className="card">
                <h2>Tentang Aplikasi</h2>
                <p>
                  Aplikasi ini dibuat berdasarkan tutorial React JS oleh SMK
                  Revit. Menampilkan contoh penggunaan komponen, props, state,
                  routing, dan Bootstrap.
                </p>
              </div>
            }
          />
          <Route
            path="/kontak"
            element={
              <div className="card">
                <h2>Kontak Kami</h2>
                <form>
                  <div className="mb-3">
                    <label htmlFor="nama" className="form-label">
                      Nama
                    </label>
                    <input
                      type="text"
                      className="form-control"
                      id="nama"
                      name="nama"
                      value={form.nama}
                      onChange={handleFormChange}
                    />
                  </div>
                  <div className="mb-3">
                    <label htmlFor="pesan" className="form-label">
                      Pesan
                    </label>
                    <textarea
                      className="form-control"
                      id="pesan"
                      name="pesan"
                      rows="3"
                      value={form.pesan}
                      onChange={handleFormChange}></textarea>
                  </div>
                  <button type="button" className="btn btn-primary">
                    Kirim
                  </button>
                </form>
                <div className="mt-3">
                  <strong>Preview Data State:</strong>
                  <pre>{JSON.stringify(form, null, 2)}</pre>
                </div>
              </div>
            }
          />
          <Route path="/menu" element={<Menu />} />
        </Routes>
      </div>
      <Footer />
    </Router>
  );
}

export default App;
