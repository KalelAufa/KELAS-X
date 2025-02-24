<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Ambil ID produk dari URL
$produk_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$produk_id) {
    $_SESSION['error'] = "Invalid product ID.";
    header("Location: index.php");
    exit;
}

// Query untuk menampilkan detail produk
$query_produk = "SELECT p.*, k.nama_kategori 
                 FROM produk p 
                 LEFT JOIN kategori k ON p.kategori_id = k.id 
                 WHERE p.id = ?";
$stmt_produk = $pdo->prepare($query_produk);
$stmt_produk->execute([$produk_id]);
$produk = $stmt_produk->fetch(PDO::FETCH_ASSOC);

if (!$produk) {
    $_SESSION['error'] = "Product not found.";
    header("Location: index.php");
    exit;
}
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4"><?= htmlspecialchars($produk['nama_produk']) ?></h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Detail Produk -->
    <div class="row g-4">
        <!-- Gambar Produk -->
        <div class="col-md-6">
            <img src="assets/images/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
        </div>

        <!-- Informasi Produk -->
        <div class="col-md-6">
            <h3 class="text-primary">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h3>
            <p><strong>Category:</strong> <?= htmlspecialchars($produk['nama_kategori']) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($produk['deskripsi']) ?></p>

            <!-- Form Add to Cart -->
            <form method="POST" action="add_to_cart.php">
                <input type="hidden" name="id" value="<?= $produk['id'] ?>">
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" required>
                </div>
                <form method="POST" action="add_to_cart.php" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $produk['id'] ?>">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </form>
        </div>
    </div>

    <!-- Kembali ke Halaman Utama -->
    <div class="mt-4 text-center">
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>