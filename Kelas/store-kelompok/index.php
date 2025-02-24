<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Query untuk menampilkan semua produk
$query_produk = "SELECT p.*, k.nama_kategori 
                 FROM produk p 
                 LEFT JOIN kategori k ON p.kategori_id = k.id 
                 ORDER BY p.created_at DESC";
$stmt_produk = $pdo->prepare($query_produk);
$stmt_produk->execute();
$produk_list = $stmt_produk->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <style>
        /* Efek Hover pada Produk */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
            /* Memastikan konten tidak keluar dari batas kartu */
        }

        .product-card:hover {
            transform: scale(1.05);
            /* Memperbesar kartu sedikit saat dihover */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            /* Menambah bayangan untuk efek 3D */
        }
    </style>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide mb-5 mt-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner rounded shadow-sm">
            <div class="carousel-item active">
                <img src="assets/images/banner1.jpg" class="d-block w-100" alt="Banner 1" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Welcome to Our Store</h5>
                    <p>Discover the best products at affordable prices.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/banner2.jpg" class="d-block w-100" alt="Banner 2" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>New Arrivals</h5>
                    <p>Check out our latest collection of products.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/banner3.jpg" class="d-block w-100" alt="Banner 3" style="height: 400px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Special Offers</h5>
                    <p>Enjoy exclusive discounts on selected items.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Daftar Produk -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if (!empty($produk_list)): ?>
            <?php foreach ($produk_list as $produk): ?>
                <div class="col">
                    <a href="detail_produk.php?id=<?= $produk['id'] ?>" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm product-card">
                            <img src="assets/images/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($produk['nama_produk']) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($produk['nama_kategori']) ?></p>
                                <p class="card-text text-primary fw-bold">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></p>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span class="btn btn-outline-primary disabled">View Details</span>
                                <form method="POST" action="add_to_cart.php" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $produk['id'] ?>">
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning text-center w-100">No products available.</div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>