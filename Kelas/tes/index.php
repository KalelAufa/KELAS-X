<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya tambahan untuk membuat produk lebih modern */
        .product-card {
            max-width: 220px;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .product-card .card-body {
            padding: 15px;
        }

        .product-card .card-title {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-card .card-text {
            font-size: 0.9rem;
            color: #333;
            margin-bottom: 12px;
        }

        .product-card .btn {
            font-size: 0.85rem;
            padding: 6px 12px;
        }

        /* Header styling */
        header .navbar-brand {
            font-weight: bold;
            font-size: 1.2rem;
        }

        header .search input {
            width: 250px;
        }

        header .auth a {
            font-size: 0.9rem;
        }

        /* Cart badge */
        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        /* Banner Styling */
        .banner-image {
            height: 400px;
            /* Tinggi banner diperbesar */
            object-fit: cover;
        }

        .banner-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
        }

        .banner-content h3 {
            font-size: 2rem;
            font-weight: bold;
        }

        .banner-content p {
            font-size: 1.2rem;
        }

        /* Spacing for products */
        .product-spacing {
            margin-bottom: 30px;
            /* Jarak vertikal antar produk */
        }

        @media (max-width: 768px) {
            .product-spacing {
                margin-bottom: 20px;
                /* Jarak lebih kecil untuk layar kecil */
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="brand">
                <a href="#" class="navbar-brand text-white">Toko Online</a>
            </div>
            <div class="search">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Cari produk..." aria-label="Search">
                </form>
            </div>
            <div class="auth d-flex align-items-center">
                <a href="#" class="btn btn-outline-light btn-sm me-2">Register</a>
                <a href="#" class="btn btn-outline-light btn-sm me-3">Login</a>
                <div class="cart-icon">
                    <a href="#cartModal" data-bs-toggle="modal" class="text-white text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        <span id="cartCount" class="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Banner -->
    <div class="container mt-4">
        <div class="row">
            <!-- Banner Statis (Carousel with Auto Slide) -->
            <div class="col-md-6 position-relative">
                <div id="staticBannerCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://via.placeholder.com/600x400?text=Banner+Statis+1" class="d-block w-100 banner-image" alt="Banner Statis 1">
                            <div class="banner-content">
                                <h3>Banner Statis 1</h3>
                                <p>Promosi Produk Terbaik</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://via.placeholder.com/600x400?text=Banner+Statis+2" class="d-block w-100 banner-image" alt="Banner Statis 2">
                            <div class="banner-content">
                                <h3>Banner Statis 2</h3>
                                <p>Diskon Hingga 50%</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://via.placeholder.com/600x400?text=Banner+Statis+3" class="d-block w-100 banner-image" alt="Banner Statis 3">
                            <div class="banner-content">
                                <h3>Banner Statis 3</h3>
                                <p>Gratis Ongkir Seluruh Indonesia</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#staticBannerCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#staticBannerCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- Banner Dinamis -->
            <div class="col-md-6">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card bg-primary text-white text-center h-100">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <h3>Banner Statis 1</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card bg-success text-white text-center h-100">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <h3>Banner Statis 2</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk -->
    <div class="container mt-4">
        <h2 class="text-center mb-4">Produk Kami</h2>
        <div class="row row-cols-2 row-cols-md-4 g-4">
            <div class="col product-spacing">
                <div class="card product-card">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rblx-lo6voeidra2847.webp" class="card-img-top" alt="Produk 1">
                    <div class="card-body">
                        <h6 class="card-title">Nama Produk 1</h6>
                        <p class="card-text">Rp 100.000</p>
                        <button class="btn btn-primary w-100 add-to-cart" data-name="Nama Produk 1" data-price="100000">Tambah ke Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col product-spacing">
                <div class="card product-card">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rdy5-m0k3zkv8v2ha8d@resize_w450_nl.webp" class="card-img-top" alt="Produk 2">
                    <div class="card-body">
                        <h6 class="card-title">Nama Produk 2</h6>
                        <p class="card-text">Rp 200.000</p>
                        <button class="btn btn-primary w-100 add-to-cart" data-name="Nama Produk 2" data-price="200000">Tambah ke Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col product-spacing">
                <div class="card product-card">
                    <img src="https://down-id.img.susercontent.com/file/sg-11134201-7rbm6-lo7vv9v0dtf773.webp" class="card-img-top" alt="Produk 3">
                    <div class="card-body">
                        <h6 class="card-title">Nama Produk 3</h6>
                        <p class="card-text">Rp 300.000</p>
                        <button class="btn btn-primary w-100 add-to-cart" data-name="Nama Produk 3" data-price="300000">Tambah ke Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col product-spacing">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Produk 4">
                    <div class="card-body">
                        <h6 class="card-title">Nama Produk 4</h6>
                        <p class="card-text">Rp 400.000</p>
                        <button class="btn btn-primary w-100 add-to-cart" data-name="Nama Produk 4" data-price="400000">Tambah ke Keranjang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Keranjang -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Keranjang Belanja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="cartItems" class="list-group"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Checkout</button>
                </div>
            </div>
        </div>
    </div>
                <!-- Footer -->
                <footer class="bg-dark text-white mt-5 py-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Menu</h5>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Beranda</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Produk</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Tentang Kami</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Kontak</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h5>Pembayaran</h5>
                                <ul class="list-unstyled">
                                    <li>Transfer Bank</li>
                                    <li>e-Wallet</li>
                                    <li>COD</li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h5>Media Sosial</h5>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white text-decoration-none">Facebook</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Instagram</a></li>
                                    <li><a href="#" class="text-white text-decoration-none">Twitter</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h5>Kontak</h5>
                                <ul class="list-unstyled">
                                    <li>Email: info@tokoonline.com</li>
                                    <li>Telp: 08123456789</li>
                                </ul>
                            </div>
                        </div>
                        <hr class="my-4">
                        <p class="text-center">&copy; 2023 Toko Online. All rights reserved.</p>
                    </div>
                </footer>

                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    // JavaScript untuk fitur keranjang
                    document.addEventListener("DOMContentLoaded", function() {
                        const cart = [];
                        const cartCount = document.getElementById("cartCount");
                        const cartItemsList = document.getElementById("cartItems");

                        // Fungsi untuk memperbarui jumlah item di keranjang
                        function updateCartCount() {
                            cartCount.textContent = cart.length;
                        }

                        // Event listener untuk tombol "Tambah ke Keranjang"
                        document.querySelectorAll(".add-to-cart").forEach(button => {
                            button.addEventListener("click", function() {
                                const productName = this.getAttribute("data-name");
                                const productPrice = this.getAttribute("data-price");

                                // Tambahkan produk ke keranjang
                                cart.push({
                                    name: productName,
                                    price: productPrice
                                });

                                // Perbarui tampilan keranjang
                                updateCartCount();
                                renderCart();
                            });
                        });

                        // Fungsi untuk merender isi keranjang
                        function renderCart() {
                            cartItemsList.innerHTML = ""; // Kosongkan daftar sebelumnya
                            cart.forEach(item => {
                                const listItem = document.createElement("li");
                                listItem.className = "list-group-item";
                                listItem.textContent = `${item.name} - Rp ${parseInt(item.price).toLocaleString("id-ID")}`;
                                cartItemsList.appendChild(listItem);
                            });
                        }
                    });
                </script>
</body>

</html>