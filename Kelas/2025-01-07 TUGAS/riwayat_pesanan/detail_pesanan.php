<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';
include_once __DIR__ . '/../../includes/session.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil ID transaksi dari parameter URL
if (!isset($_GET['id'])) {
    header("Location: ./riwayat_pesanan.php"); // Redirect jika tidak ada ID transaksi
    exit();
}

$transaksi_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Ambil detail pesanan dari database
$query = "SELECT dt.*, p.nama_produk, p.harga 
          FROM detail_transaksi dt 
          JOIN produk p ON dt.produk_id = p.id 
          WHERE dt.transaksi_id = ?";
$result = executeSelect($koneksi, $query, [$transaksi_id], 'i');

// Ambil informasi transaksi untuk ditampilkan
$query_transaksi = "SELECT total_harga, status, created_at FROM transaksi WHERE transaksi_id = ?";
$result_transaksi = executeSelect($koneksi, $query_transaksi, [$transaksi_id], 'i');
$transaksi_info = $result_transaksi->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Detail Pesanan #<?php echo htmlspecialchars($transaksi_id); ?></h2>

        <?php if ($result->num_rows > 0): ?>
            <h3 class="font-semibold">Informasi Transaksi:</h3>
            <p>Status: <?php echo htmlspecialchars($transaksi_info['status']); ?></p>
            <p>Total Harga: Rp <?php echo number_format($transaksi_info['total_harga'], 0, ',', '.'); ?></p>
            <p>Tanggal: <?php echo htmlspecialchars(date('d-m-Y H:i', strtotime($transaksi_info['created_at']))); ?></p>

            <h3 class="font-semibold mt-4">Rincian Produk:</h3>
            <table class="min-w-full bg-white border border-gray-300 mt-2">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Nama Produk</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Kuantitas</th>
                        <th class="border px-4 py-2">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                            <td class="border px-4 py-2">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['kuantitas']); ?></td>
                            <td class="border px-4 py-2">Rp <?php echo number_format($row['harga'] * $row['kuantitas'], 0, ',', '.'); ?></td> <!-- Subtotal -->
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>Tidak ada rincian untuk pesanan ini.</p>
            <a href="./riwayat_pesanan.php" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Kembali ke Riwayat Pesanan</a>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>