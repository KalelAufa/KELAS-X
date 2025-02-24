<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Proses jika formulir dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = validateInput($_POST['email']);

    // Cek apakah email terdaftar di database
    $query = "SELECT id FROM users WHERE email = ?";
    $result = executeSelect($koneksi, $query, [$email], 's');

    if ($result->num_rows > 0) {
        // Email ditemukan, buat token reset password
        $user = $result->fetch_assoc();
        $user_id = $user['id'];
        $token = bin2hex(random_bytes(32)); // Token unik
        $token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token berlaku selama 1 jam

        // Simpan token ke tabel reset_password (buat tabel ini jika belum ada)
        $query_insert_token = "INSERT INTO reset_password (user_id, token, expires_at) VALUES (?, ?, ?)
                               ON DUPLICATE KEY UPDATE token = ?, expires_at = ?";
        executeQuery($koneksi, $query_insert_token, [$user_id, $token, $token_expiry, $token, $token_expiry], 'issss');

        // Kirim email ke pengguna dengan link reset password
        $reset_link = "http://localhost/toko_online/pages/akun/reset_password.php?token=$token";
        $subject = "Reset Password Toko Online";
        $message = "Halo,\n\nKami menerima permintaan untuk mereset password Anda. Klik link berikut untuk mereset password Anda:\n\n$reset_link\n\nLink ini berlaku selama 1 jam.\n\nJika Anda tidak meminta reset password, abaikan email ini.";
        $headers = "From: no-reply@toko-online.com";

        if (mail($email, $subject, $message, $headers)) {
            header("Location: ./forgot_password.php?success=1");
            exit();
        } else {
            header("Location: ./forgot_password.php?error=Gagal mengirim email. Silakan coba lagi.");
            exit();
        }
    } else {
        header("Location: ./forgot_password.php?error=Email tidak ditemukan.");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Lupa Password</h2>

        <?php if (isset($_GET['error'])): ?>
            <p class="text-red-600"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="text-green-600">Link reset password telah dikirim ke email Anda.</p>
        <?php endif; ?>

        <div class="bg-white shadow rounded p-4">
            <form action="" method="POST">
                <div class="mb-4">
                    <label for="email" class="block">Email:</label>
                    <input type="email" name="email" id="email" required class="border rounded px-4 py-2 w-full">
                </div>
                <button type='submit' name='reset' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Kirim Link Reset Password</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>