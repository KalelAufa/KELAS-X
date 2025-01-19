<?php
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

// Ambil keranjang pengguna dari database berdasarkan user_id
$query = "SELECT ik.item_id, p.nama_produk, p.harga, ik.kuantitas 
          FROM item_keranjang ik 
          JOIN keranjang k ON ik.cart_id = k.cart_id 
          JOIN produk p ON ik.produk_id = p.id 
          WHERE k.user_id = ?";
$result = executeSelect($koneksi, $query, [$user_id], 'i');

// Hitung total harga
$total_harga = 0;
while ($row = $result->fetch_assoc()) {
    $total_harga += $row['harga'] * $row['kuantitas'];
}

// Ambil alamat pengguna (jika ada)
$alamat_query = "SELECT * FROM alamat WHERE user_id = ? LIMIT 1";
$alamat_result = executeSelect($koneksi, $alamat_query, [$user_id], 'i');
$alamat = $alamat_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/7b7ea8cc33.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Checkout</h2>

        <?php if ($total_harga > 0): ?>
            <div class="bg-white shadow rounded p-4 mb-4">
                <h3 class="text-lg font-semibold">Ringkasan Pesanan</h3>
                <table class="min-w-full border border-gray-300 mt-2">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Produk</th>
                            <th class="border px-4 py-2">Harga</th>
                            <th class="border px-4 py-2">Kuantitas</th>
                            <th class="border px-4 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Reset pointer hasil query ke awal
                        $result->data_seek(0);
                        while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="border px-4 py-2"><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                                <td class="border px-4 py-2">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td class="border px-4 py-2"><?php echo htmlspecialchars($row['kuantitas']); ?></td>
                                <td class="border px-4 py-2">Rp <?php echo number_format($row['harga'] * $row['kuantitas'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <h3 class="mt-4 font-semibold">Total Harga: Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></h3>
            </div>

            <!-- Alamat Pengiriman -->
            <div class="bg-white shadow rounded p-4 mb-4">
                <h3 class="text-lg font-semibold">Alamat Pengiriman</h3>
                <?php if ($alamat): ?>
                    <p><?php echo htmlspecialchars($alamat['jalan']); ?></p>
                    <p><?php echo htmlspecialchars($alamat['kota']) . ', ' . htmlspecialchars($alamat['provinsi']); ?></p>
                    <p><?php echo htmlspecialchars($alamat['negara']); ?></p>
                    <p>Kode Pos: <?php echo htmlspecialchars($alamat['kode_pos']); ?></p>
                <?php else: ?>
                    <p>Anda belum menambahkan alamat pengiriman.</p>
                <?php endif; ?>
            </div>

            <!-- Tombol untuk menyelesaikan pembelian -->
            <form action="./proses_checkout.php" method="POST">
                <input type="hidden" name="total_harga" value="<?php echo $total_harga; ?>">
                <!-- Jika alamat ada, tampilkan tombol checkout -->
                <?php if ($alamat): ?>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Selesaikan Pembelian
                    </button>
                <?php else: ?>
                    <a href="../akun/profile.php" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Tambah Alamat Pengiriman
                    </a>
                <?php endif; ?>
            </form>

        <?php else: ?>
            <p>Tidak ada item dalam keranjang Anda. Silakan tambahkan produk sebelum checkout.</p>
            <a href="../produk/produk.php" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lanjutkan Belanja</a>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>