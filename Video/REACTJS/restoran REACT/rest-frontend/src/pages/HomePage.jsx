// src/pages/HomePage.js
import React, { useState, useEffect } from "react";
import Navbar from "../components/Navbar";
import Sidebar from "../components/Sidebar";
import Footer from "../components/Footer";
import MenuItemCard from "../components/MenuItemCard";
import { getMenus } from "../services/menuService";
import { getKategoris } from "../services/kategoriService";

const HomePage = () => {
  const [menus, setMenus] = useState([]);
  const [kategoris, setKategoris] = useState([]);
  const [filteredMenus, setFilteredMenus] = useState([]);
  const [selectedCategory, setSelectedCategory] = useState(null);
  const [searchTerm, setSearchTerm] = useState("");
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchInitialData = async () => {
      try {
        setLoading(true);
        const menusData = await getMenus();
        setMenus(menusData);
        setFilteredMenus(menusData);
        const kategorisData = await getKategoris();
        setKategoris(kategorisData);
        setLoading(false);
      } catch (err) {
        setError(err.message || "Failed to fetch initial data.");
        setLoading(false);
        console.error("Error fetching initial data:", err);
      }
    };
    fetchInitialData();
  }, []);

  useEffect(() => {
    let currentMenus = menus;

    if (selectedCategory) {
      currentMenus = currentMenus.filter(
        (menu) => menu.kategori_id === selectedCategory.id
      );
    }

    if (searchTerm) {
      currentMenus = currentMenus.filter((menu) =>
        menu.name.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }

    setFilteredMenus(currentMenus);
  }, [selectedCategory, searchTerm, menus]);

  const handleCategorySelect = (category) => {
    setSelectedCategory(category);
  };

  const handleSearch = (term) => {
    setSearchTerm(term);
  };

  return (
    <div className="d-flex flex-column min-vh-100 bg-dark text-white">
      <Navbar onSearch={handleSearch} />
      <div className="container-fluid flex-grow-1 py-4">
        <div className="row">
          <div className="col-md-3">
            <Sidebar
              kategoris={kategoris}
              onSelectCategory={handleCategorySelect}
              selectedCategory={selectedCategory}
            />
          </div>
          <div className="col-md-9">
            <main className="p-3 bg-secondary rounded shadow-sm">
              <h2 className="mb-4 text-warning">Featured Menu Items</h2>
              {loading ? (
                <p className="text-center w-100 text-info">
                  Loading menu items...
                </p>
              ) : error ? (
                <p className="text-center w-100 text-danger">Error: {error}</p>
              ) : filteredMenus.length > 0 ? (
                <div className="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                  {filteredMenus.map((menu) => (
                    <div className="col" key={menu.id}>
                      <MenuItemCard menu={menu} />
                    </div>
                  ))}
                </div>
              ) : (
                <p className="text-center w-100 text-muted">
                  No menu items found for this selection.
                </p>
              )}
            </main>
          </div>
        </div>
      </div>
      <Footer />
    </div>
  );
};

export default HomePage;
