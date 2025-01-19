<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Ambil ID pengguna dari parameter URL
if (!isset($_GET['id'])) {
    header("Location: ./daftar_pengguna.php"); // Redirect jika tidak ada ID pengguna
    exit();
}

$user_id = $_GET['id'];

// Ambil data pengguna dari database
$query = "SELECT * FROM users WHERE id = ?";
$result = executeSelect($koneksi, $query, [$user_id], 'i');

if ($result->num_rows === 0) {
    header("Location: ./daftar_pengguna.php"); // Redirect jika pengguna tidak ditemukan
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Header -->
<?php include_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4">Edit Pengguna</h2>

    <?php if (isset($_GET['error'])): ?>
        <p class="text-red-600"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    
    <div class="bg-white shadow rounded p-4">
        <form action="./edit_pengguna_process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
            <div class="mb-4">
                <label for="nama_depan" class="block">Nama Depan:</label>
                <input type="text" name="nama_depan" id="nama_depan" value="<?php echo htmlspecialchars($user['nama_depan']); ?>" required class="border rounded px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="nama_belakang" class="block">Nama Belakang:</label> 
                <input type ="text"name ="nama_belakang"id ="nama_belakang"value ="<?php echo htmlspecialchars($user['nama_belakang']); ?>"requiredclass ="borderroundedpx - 4py - 2w-full"> 
            </div> 
            <!-- Email field (read-only) --> 
             <!-- Role field --> 
             <!-- Submit button --> 
             <!-- Footer --> 
             <?php include_once __DIR__ . '/../../includes/footer.ph p'; ?> 

             </body> 
             </html> 
