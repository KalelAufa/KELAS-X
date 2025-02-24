<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validasi input
    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
    } else {
        // Query untuk mencari pengguna berdasarkan email
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $error = "Invalid email or password.";
        } elseif (!password_verify($password, $user['password'])) {
            $error = "Invalid email or password.";
        } else {
            // Simpan data pengguna ke session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            // Redirect ke halaman utama
            header("Location: index.php");
            exit;
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Login</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        Don't have an account? <a href="register.php">Register here</a>.
    </div>
</div>