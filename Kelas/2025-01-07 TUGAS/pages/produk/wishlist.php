<?php
// Memulai sesi hanya jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';
include_once __DIR__ . '/../../includes/session.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../akun/login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'];

// Ambil wishlist pengguna dari database berdasarkan user_id
$query = "SELECT w.id AS wishlist_id, p.* FROM wishlist w JOIN produk p ON w.produk_id = p.id WHERE w.user_id = ?";
$result = executeSelect($koneksi, $query, [$user_id], 'i');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/7b7ea8cc33.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Wishlist Anda</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white shadow rounded overflow-hidden">
                        <img src="<?php echo htmlspecialchars($row['gambar_url']); ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($row['nama_produk']); ?></h3>
                            <p class="text-gray-600">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>

                            <!-- Tombol Tambah ke Keranjang -->
                            <form action="../keranjang/update_keranjang.php" method="POST" class="inline-block">
                                <input type="hidden" name="produk_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                                </button>
                            </form>

                            <!-- Tombol Hapus dari Wishlist -->
                            <form action="./hapus_wishlist_process.php" method="POST" class="inline-block">
                                <input type="hidden" name="wishlist_id" value="<?php echo $row['wishlist_id']; ?>">
                                <button type="submit" class="mt-2 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Tidak ada item di wishlist Anda.</p>
            <a href="../index.php" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lanjutkan Belanja</a>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>