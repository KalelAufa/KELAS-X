// Fungsi untuk mengganti tema
function toggleTheme() {
  const body = document.body;
  const currentTheme = body.getAttribute("data-bs-theme");
  const newTheme = currentTheme === "dark" ? "light" : "dark";

  body.setAttribute("data-bs-theme", newTheme);
  localStorage.setItem("theme", newTheme);

  // Update ikon tema
  const themeIcon = document.getElementById("theme-icon");
  if (themeIcon) {
    themeIcon.className = newTheme === "dark" ? "fas fa-sun" : "fas fa-moon";
  }
}

// Fungsi untuk mengatur tema berdasarkan preferensi yang tersimpan
function setThemePreference() {
  const savedTheme = localStorage.getItem("theme");
  const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;

  const theme = savedTheme || (prefersDark ? "dark" : "light");
  document.body.setAttribute("data-bs-theme", theme);

  const themeIcon = document.getElementById("theme-icon");
  if (themeIcon) {
    themeIcon.className = theme === "dark" ? "fas fa-sun" : "fas fa-moon";
  }
}

// Jalankan saat halaman dimuat
document.addEventListener("DOMContentLoaded", setThemePreference);
