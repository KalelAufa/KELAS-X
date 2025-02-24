<?php
session_start();
include_once __DIR__ . '/../includes/koneksi.php';
include_once __DIR__ . '/../includes/functions.php';
include_once __DIR__ . '/../includes/session.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../akun/login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Proses jika formulir dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = validateInput($_POST['judul']);
    $isi = validateInput($_POST['isi']);
    $user_id = $_SESSION['user_id'];

    // Masukkan ulasan ke database
    $query = "INSERT INTO ulasan (judul, isi, pengguna, approved) VALUES (?, ?, ?, FALSE)";
    if (executeQuery($koneksi, $query, [$judul, $isi, $user_id], 'ssi')) {
        header("Location: ../produk/produk.php?success=Ulasan berhasil dikirim. Menunggu moderasi.");
        exit();
    } else {
        header("Location: ./submit_ulasan.php?error=Gagal mengirim ulasan. Silakan coba lagi.");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Ulasan - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Kirim Ulasan</h2>

        <?php if (isset($_GET['error'])): ?>
            <p class="text-red-600"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <div class="bg-white shadow rounded p-4">
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="judul" class="block">Judul:</label>
                    <input type="text" name="judul" id="judul" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="isi" class="block">Isi Ulasan:</label>
                    <textarea name="isi" id="isi" required rows="5" class="border rounded px-4 py-2 w-full"></textarea>
                </div>

                <button type='submit' name='submit' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Kirim Ulasan</button>
            </form>
        </div>

    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../includes/footer.php'; ?>

</body>

</html>
