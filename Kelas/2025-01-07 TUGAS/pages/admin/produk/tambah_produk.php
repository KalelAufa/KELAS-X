<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Tambah Produk Baru</h2>

        <?php if (isset($_GET['error'])): ?>
            <p class="text-red-600"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <div class="bg-white shadow rounded p-4">
            <form action="./tambah_produk_process.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="nama_produk" class="block">Nama Produk:</label>
                    <input type="text" name="nama_produk" id="nama_produk" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="harga" class="block">Harga:</label>
                    <input type="number" name="harga" id="harga" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="gambar" class="block">Gambar:</label>
                    <input type="file" name="gambar" id="gambar" accept=".jpg,.jpeg,.png" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block">Deskripsi:</label>
                    <textarea name="deskripsi" id="deskripsi" rows="5" required class="border rounded px-4 py-2 w-full"></textarea>
                </div>
                <div class="mb-4">
                    <label for="kategori" class="block">Kategori:</label>
                    <input type="text" name="kategori" id="kategori" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="stok" class="block">Stok:</label>
                    <input type="number" name="stok" id="stok" required min="0" class="border rounded px-4 py-2 w-full">
                </div>

                <button type='submit' name='tambah_produk' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Tambah Produk</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>