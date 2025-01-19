<?php
// Memulai sesi hanya jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once __DIR__ . '/../../includes/session.php';

// Cek apakah pengguna sudah login
if (isLoggedIn()) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: ../admin/dashboard.php"); // Redirect ke dashboard admin jika admin
    } else {
        header("Location: ../produk/produk.php"); // Redirect ke halaman produk jika user biasa
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Login</h2>

        <?php if (isset($_GET['error'])): ?>
            <p class="text-red-600"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <div class="bg-white shadow rounded p-4">
            <form action="./login_process.php" method="POST">
                <div class="mb-4">
                    <label for="email" class="block">Email:</label>
                    <input type="email" name="email" id="email" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="password" class="block">Password:</label>
                    <input type="password" name="password" id="password" required class="border rounded px-4 py-2 w-full">
                </div>
                <button type="submit" name="login" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</button>
            </form>
            <p class='mt-2'>Belum punya akun? <a href="./register.php" class='text-blue-600 hover:underline'>Daftar di sini</a>.</p>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>