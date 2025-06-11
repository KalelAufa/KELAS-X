<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Ambil data kategori dari database
$query = "SELECT * FROM kategori ORDER BY id DESC";
$result = executeSelect($koneksi, $query, [], []);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Produk - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Header -->
<?php include_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4">Manajemen Kategori Produk</h2>

    <!-- Form Tambah Kategori -->
    <div class="bg-white shadow rounded p-4 mb-4">
        <h3 class="text-lg font-semibold">Tambah Kategori Baru</h3>
        <form action="./tambah_kategori_process.php" method="POST">
            <div class="mb-4">
                <label for="nama_kategori" class="block">Nama Kategori:</label>
                <input type="text" name="nama_kategori" id="nama_kategori" required class="border rounded px-4 py-2 w-full">
            </div>

            <button type='submit' name='tambah_kategori' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Tambah Kategori</button>
        </form>
    </div>

    <!-- Tabel Kategori -->
    <?php if ($result->num_rows > 0): ?>
        <table class="min-w-full bg-white border border-gray-300 mt-2">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID Kategori</th>
                    <th class="border px-4 py-2">Nama Kategori</th>                    
                    <!-- Button Hapus Kategori -->
                    <!-- Aksi di kolom ini bisa ditambahkan jika perlu -->
                </tr>                
            </thead>            
            <!-- Menampilkan data kategori -->
            <?php while ($row = $result->fetch_assoc()): ?>                
                <!-- Menampilkan setiap kategori dalam tabel -->
                <!-- Menyediakan opsi untuk menghapus kategori jika diperlukan -->                
                <?php endwhile; ?> 
        </table> 
     <?php else: ?> 
         <!-- Menampilkan pesan jika tidak ada kategori yang tersedia --> 
         Tidak ada kategori yang tersedia. 
     <?php endif; ?> 
     </div> 

     <!-- Footer --> 
     <?php include_once __DIR__ . '/../../includes/footer.ph p'; ?> 

     </body> 
     </html> 
