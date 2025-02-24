<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = validateInput($_POST['token']);
    $password_baru = password_hash(validateInput($_POST['password']), PASSWORD_DEFAULT);

    // Cek apakah token valid dan belum kedaluwarsa
    $query = "SELECT user_id FROM reset_password WHERE token = ? AND expires_at > NOW()";
    $result = executeSelect($koneksi, $query, [$token], 's');

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];

        // Update password pengguna
        $query_update_password = "UPDATE users SET password = ? WHERE id = ?";
        executeQuery($koneksi, $query_update_password, [$password_baru, $user_id], 'si');

        // Hapus token setelah digunakan
        $query_delete_token = "DELETE FROM reset_password WHERE token = ?";
        executeQuery($koneksi, $query_delete_token, [$token], 's');

        header("Location: ./login.php?success=Password berhasil direset.");
        exit();
    } else {
        header("Location: ./reset_password.php?error=Token tidak valid atau sudah kedaluwarsa.");
        exit();
    }
} elseif (isset($_GET['token'])) {
    // Menampilkan form reset password jika ada token dalam URL
    $token = $_GET['token'];
} else {
    header("Location: ./forgot_password.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Toko Online</title>
</head>

<body>

    <h2>Reset Password</h2>

    <?php if (isset($_GET['error'])): ?>
        <p><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <label for="password">Password Baru:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Reset Password</button>
    </form>

</body>

</html>