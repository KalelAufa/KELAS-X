<?php

include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';
include_once __DIR__ . '/../../includes/session.php';

// Ambil ID produk dari URL
$id = validateInput($_GET['id']);

// Ambil detail produk dari database
$query = "SELECT * FROM produk WHERE id = ?";
$result = executeSelect($koneksi, $query, [$id], 'i');
$product = $result->fetch_assoc();

if (!$product) {
    die("Produk tidak ditemukan.");
}
?>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($product['nama_produk']); ?></h2>
        <img src="<?php echo htmlspecialchars($product['gambar_url']); ?>" alt="<?php echo htmlspecialchars($product['nama_produk']); ?>" class="w-full h-64 object-cover mb-4">
        <p class="text-lg font-bold">Harga: Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
        <p><?php echo nl2br(htmlspecialchars($product['deskripsi'])); ?></p>

        <!-- Form untuk menambahkan ke keranjang -->
        <form action="../keranjang/update_keranjang.php" method="POST" class="mt-4">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"><i class="fas fa-shopping-cart"></i> Tambah ke Keranjang</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>