<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Ambil data statistik untuk dashboard
$query_users = "SELECT COUNT(*) AS total_users FROM users";
$query_products = "SELECT COUNT(*) AS total_products FROM produk";
$query_reviews = "SELECT COUNT(*) AS total_reviews FROM ulasan WHERE approved IS FALSE";

$total_users = executeSelect($koneksi, $query_users, [], []);
$total_products = executeSelect($koneksi, $query_products, [], []);
$total_reviews = executeSelect($koneksi, $query_reviews, [], []);

// Ambil hasil dari query
$total_users_count = $total_users->fetch_assoc()['total_users'];
$total_products_count = $total_products->fetch_assoc()['total_products'];
$total_reviews_count = $total_reviews->fetch_assoc()['total_reviews'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Dashboard Admin</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Statistik Pengguna -->
            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-semibold">Total Pengguna</h3>
                <p class="text-2xl"><?php echo htmlspecialchars($total_users_count); ?></p>
            </div>

            <!-- Statistik Produk -->
            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-semibold">Total Produk</h3>
                <p class="text-2xl"><?php echo htmlspecialchars($total_products_count); ?></p>
            </div>

            <!-- Statistik Ulasan -->
            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-semibold">Ulasan Menunggu Moderasi</h3>
                <p class="text-2xl"><?php echo htmlspecialchars($total_reviews_count); ?></p>
            </div>
        </div>

        <div class="mt-6 bg-white shadow rounded p-4">
            <h3 class="text-lg font-semibold">Aksi Cepat</h3>
            <ul class="list-disc pl-5">
                <li><a href="./produk/tambah_produk.php" class="text-blue-600 hover:underline">Tambah Produk</a></li>
                <li><a href="./moderasi_ulasan.php" class="text-blue-600 hover:underline">Moderasi Ulasan</a></li>
                <li><a href="./daftar_pengguna.php" class="text-blue-600 hover:underline">Kelola Pengguna</a></li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>