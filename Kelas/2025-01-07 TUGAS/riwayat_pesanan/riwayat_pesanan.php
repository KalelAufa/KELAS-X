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

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'];

// Ambil riwayat pesanan pengguna dari database
$query = "SELECT t.transaksi_id, t.total_harga, t.status, t.created_at 
          FROM transaksi t 
          WHERE t.user_id = ? 
          ORDER BY t.created_at DESC";
$result = executeSelect($koneksi, $query, [$user_id], 'i');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Riwayat Pesanan Anda</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID Transaksi</th>
                        <th class="border px-4 py-2">Total Harga</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['transaksi_id']); ?></td>
                            <td class="border px-4 py-2">Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['status']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars(date('d-m-Y H:i', strtotime($row['created_at']))); ?></td>
                            <td class="border px-4 py-2">
                                <a href="./detail_pesanan.php?id=<?php echo $row['transaksi_id']; ?>" class="text-blue-600 hover:underline">Detail</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>Tidak ada riwayat pesanan.</p>
            <a href="../produk/produk.php" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Lanjutkan Belanja</a>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>