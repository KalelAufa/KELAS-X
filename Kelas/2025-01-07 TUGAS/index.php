<?php
session_start();
include_once __DIR__ . '/includes/koneksi.php';
include_once __DIR__ . '/includes/functions.php'; // Pastikan file ini di-include
include_once __DIR__ . '/includes/session.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Toko Online</title>
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Ganti dengan stylesheet Anda -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/includes/header.php'; ?>

    <!-- Konten Utama -->
    <main class="container mx-auto px-4 py-6">

        <!-- Daftar Produk -->
        <section>
            <?php include_once 'produk/produk.php'; ?>
        </section>

    </main>

    <!-- Footer -->
    <?php include_once __DIR__ . '/includes/footer.php'; ?>

</body>

</html>
