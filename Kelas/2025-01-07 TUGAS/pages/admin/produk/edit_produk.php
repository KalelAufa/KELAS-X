<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Ambil ID produk dari parameter URL
if (!isset($_GET['id'])) {
    header("Location: ./produk.php"); // Redirect jika tidak ada ID produk
    exit();
}

$produk_id = $_GET['id'];

// Ambil data produk dari database
$query = "SELECT * FROM produk WHERE id = ?";
$result = executeSelect($koneksi, $query, [$produk_id], 'i');

if ($result->num_rows === 0) {
    header("Location: ./produk.php"); // Redirect jika produk tidak ditemukan
    exit();
}

$produk = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Produk</h2>

        <?php if (isset($_GET['error'])): ?>
            <p class="text-red-600"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <div class="bg-white shadow rounded p-4">
            <form action="./edit_produk_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($produk['id']); ?>">
                <div class="mb-4">
                    <label for="nama_produk" class="block">Nama Produk:</label>
                    <input type="text" name="nama_produk" id="nama_produk" value="<?php echo htmlspecialchars($produk['nama_produk']); ?>" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="harga" class="block">Harga:</label>
                    <input type="number" name="harga" id="harga" value="<?php echo htmlspecialchars($produk['harga']); ?>" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="gambar" class="block">Gambar Baru (Opsional):</label>
                    <input type="file" name="gambar" id="gambar" accept=".jpg,.jpeg,.png" class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block">Deskripsi:</label>
                    <textarea name="deskripsi" id="deskripsi" rows="5" required class="border rounded px-4 py-2 w-full"><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="kategori" class="block">Kategori:</label>
                    <input type="text" name="kategori" id="kategori" value="<?php echo htmlspecialchars($produk['kategori']); ?>" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="stok" class="block">Stok:</label>
                    <input type="number" name="stok" id="stok" value="<?php echo htmlspecialchars($produk['stok']); ?>" required min="0" class="border rounded px-4 py-2 w-full">
                </div>

                <button type='submit' name='edit_produk' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>