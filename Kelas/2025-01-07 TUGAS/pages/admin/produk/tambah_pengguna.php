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
    <title>Tambah Pengguna - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Header -->
<?php include_once __DIR__ . '/../../includes/header.php'; ?>

<div class="container mx-auto p-6">
    <h2 class="text-xl font-semibold mb-4">Tambah Pengguna Baru</h2>

    <?php if (isset($_GET['error'])): ?>
        <p class="text-red-600"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    
    <div class="bg-white shadow rounded p-4">
        <form action="./tambah_pengguna_process.php" method="POST">
            <div class="mb-4">
                <label for="nama_depan" class="block">Nama Depan:</label>
                <input type="text" name="nama_depan" id="nama_depan" required class="border rounded px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="nama_belakang" class="block">Nama Belakang:</label>
                <input type="text" name="nama_belakang" id="nama_belakang" required class="border rounded px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="email" class="block">Email:</label>
                <input type="email" name="email" id="email" required class="border rounded px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="password" class="block">Password:</label>
                <input type="password" name="password" id="password" required class="border rounded px-4 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="role" class="block">Role:</label>
                <select name="role" id="role" required class="border rounded px-4 py-2 w-full">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type='submit' name='tambah_pengguna' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Tambah Pengguna</button>
        </form>
    </div>
</div>

<!-- Footer -->
<?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>
</html>
