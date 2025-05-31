// src/components/Sidebar.js
import React from "react";

const Sidebar = ({ kategoris, onSelectCategory, selectedCategory }) => {
  return (
    <aside className="card p-3 shadow-sm bg-secondary text-white border-dark">
      <h3 className="card-title mb-3 text-warning">Categories</h3>
      <div className="list-group list-group-flush">
        <button
          type="button"
          className={`list-group-item list-group-item-action bg-dark text-white ${
            !selectedCategory
              ? "active text-warning border-warning"
              : "border-dark"
          }`}
          onClick={() => onSelectCategory(null)}>
          All
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
            onClick={() => onSelectCategory(kategori)}>
            {kategori.name}
          </button>
        ))}
      </div>
    </aside>
  );
};

export default Sidebar;
