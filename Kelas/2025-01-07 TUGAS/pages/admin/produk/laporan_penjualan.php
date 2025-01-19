<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Ambil data laporan penjualan
$query = "SELECT t.transaksi_id, t.total_harga, t.created_at 
          FROM transaksi t 
          ORDER BY t.created_at DESC";
$result = executeSelect($koneksi, $query, [], []);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Laporan Penjualan</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="min-w-full bg-white border border-gray-300 mt-2">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID Transaksi</th>
                        <th class="border px-4 py-2">Total Harga</th>
                        <th class="border px-4 py-2">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['transaksi_id']); ?></td>
                            <td class="border px-4 py-2">Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars(date('d-m-Y H:i', strtotime($row['created_at']))); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>Tidak ada data penjualan.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>