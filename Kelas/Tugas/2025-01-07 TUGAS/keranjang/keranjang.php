<?php
// Memulai sesi hanya jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../includes/koneksi.php';
include_once __DIR__ . '/../includes/functions.php';
include_once __DIR__ . '/../includes/session.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../akun/login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'];

// Ambil keranjang pengguna dari database berdasarkan user_id
$query = "SELECT k.cart_id, ik.*, p.nama_produk, p.harga, p.gambar_url 
          FROM keranjang k 
          JOIN item_keranjang ik ON k.cart_id = ik.cart_id 
          JOIN produk p ON ik.produk_id = p.id 
          WHERE k.user_id = ?";
$result = executeSelect($koneksi, $query, [$user_id], 'i');
?>
<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Keranjang Belanja Anda</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $total_harga = 0; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php $total_harga += $row['harga'] * $row['kuantitas']; ?>
                    <div class="bg-white shadow rounded overflow-hidden">
                        <img src="<?php echo htmlspecialchars($row['gambar_url']); ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($row['nama_produk']); ?></h3>
                            <p class="text-gray-600">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                            <p class="text-gray-600">Kuantitas:
                            <form action="./update_keranjang.php" method="POST" class="inline-block">
                                <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                                <input type="number" name="kuantitas" value="<?php echo $row['kuantitas']; ?>" min="1" class="w-16 text-center border rounded">
                                <button type="submit" class="ml-2 bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">Update</button>
                            </form>
                            </p>

                            <!-- Tombol Hapus dari Keranjang -->
                            <form action="./hapus_keranjang_process.php" method="POST" class="inline-block">
                                <input type="hidden" name="item_id" value="<?php echo $row['item_id']; ?>">
                                <button type="submit" class="mt-2 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Total Harga -->
            <div class="mt-4">
                <h3 class="text-lg font-semibold">Total Harga: Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></h3>
                <a href="../checkout/checkout.php" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Checkout</a>
            </div>

        <?php else: ?>
            <p>Tidak ada item di keranjang Anda.</p>
            <a href="../produk/produk.php" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lanjutkan Belanja</a>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>

</html>
