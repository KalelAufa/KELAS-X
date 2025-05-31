// src/pages/MenuPage.js
import React, { useState, useEffect } from "react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import MenuItemCard from "../components/MenuItemCard";
import { getMenus } from "../services/menuService";
import { getKategoris } from "../services/kategoriService";

const MenuPage = () => {
  const [menus, setMenus] = useState([]);
  const [kategoris, setKategoris] = useState([]); // State for categories for filter
  const [filteredMenus, setFilteredMenus] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [selectedCategory, setSelectedCategory] = useState(null); // State for selected category filter
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchMenusAndCategories = async () => {
      try {
        setLoading(true);
        const menusData = await getMenus();
        setMenus(menusData);
        setFilteredMenus(menusData); // Initialize filtered menus with all menus
        const kategorisData = await getKategoris();
        setKategoris(kategorisData);
        setLoading(false);
      } catch (err) {
        setError(err.message || "Failed to fetch menu items.");
        setLoading(false);
        console.error("Error fetching menu items:", err);
      }
    };
    fetchMenusAndCategories();
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

  const handleSearch = (term) => {
    setSearchTerm(term);
  };

  const handleCategorySelect = (category) => {
    setSelectedCategory(category);
  };

  return (
    <div className="d-flex flex-column min-vh-100 bg-dark text-white">
      <Navbar onSearch={handleSearch} />
      <div className="container-fluid flex-grow-1 py-4">
        <div className="row">
          {/* Sidebar for Categories */}
          <div className="col-md-3">
            <aside className="card p-3 shadow-sm bg-secondary text-white border-dark">
              <h3 className="card-title mb-3 text-warning">
                Filter by Category
              </h3>
              <div className="list-group list-group-flush">
                <button
                  type="button"
                  className={`list-group-item list-group-item-action bg-dark text-white ${
                    !selectedCategory
                      ? "active text-warning border-warning"
                      : "border-dark"
                  }`}
                  onClick={() => handleCategorySelect(null)}>
                  All Categories
                </button>
                {kategoris.map((kategori) => (
                  <button
                    type="button"
                    key={kategori.id}
                    className={`list-group-item list-group-item-action bg-dark text-white ${
                      selectedCategory && selectedCategory.id === kategori.id
                        ? "active text-warning border-warning"
                        : "border-dark"
                    }`}
                    onClick={() => handleCategorySelect(kategori)}>
                    {kategori.name}
                  </button>
                ))}
              </div>
            </aside>
          </div>

          {/* Main Content for Menu Items */}
          <div className="col-md-9">
            <main className="p-3 bg-secondary rounded shadow-sm">
              <h2 className="mb-4 text-warning text-center">Our Full Menu</h2>
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
                  No menu items found matching your criteria.
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

export default MenuPage;
