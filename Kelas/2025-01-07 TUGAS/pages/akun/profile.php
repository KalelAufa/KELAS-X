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

// Ambil data pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$result = executeSelect($koneksi, $query, [$user_id], 'i');
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Profil Pengguna</h2>

        <div class="bg-white shadow rounded p-4">
            <form action="./update_profile.php" method="POST">
                <div class="mb-4">
                    <label for="nama_depan" class="block">Nama Depan:</label>
                    <input type="text" name="nama_depan" id="nama_depan" value="<?php echo htmlspecialchars($user['nama_depan']); ?>" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="nama_belakang" class="block">Nama Belakang:</label>
                    <input type="text" name="nama_belakang" id="nama_belakang" value="<?php echo htmlspecialchars($user['nama_belakang']); ?>" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="email" class="block">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required class="border rounded px-4 py-2 w-full" readonly>
                </div>
                <div class="mb-4">
                    <label for="nomor_telepon" class="block">Nomor Telepon:</label>
                    <input type="text" name="nomor_telepon" id="nomor_telepon" value="<?php echo htmlspecialchars($user['nomor_telepon']); ?>" class="border rounded px-4 py-2 w-full">
                </div>
                <button type='submit' name='update' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Perbarui Profil</button>
            </form>
            <p class='mt-2'><a href="./forgot_password.php" class='text-blue-600 hover:underline'>Ganti Password?</a></p>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>