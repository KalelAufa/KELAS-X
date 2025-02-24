<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($nama)) {
        $error = "Name cannot be empty.";
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (empty($password)) {
        $error = "Password cannot be empty.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Cek apakah email sudah terdaftar
        $query_check_email = "SELECT * FROM users WHERE email = ?";
        $stmt_check_email = $pdo->prepare($query_check_email);
        $stmt_check_email->execute([$email]);
        $existing_user = $stmt_check_email->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            $error = "Email is already registered.";
        } else {
            // Hash password sebelum menyimpan ke database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data pengguna ke database
            $query_register = "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, 'customer')";
            $stmt_register = $pdo->prepare($query_register);
            $stmt_register->execute([$nama, $email, $hashed_password]);

            // Simpan data pengguna ke session
            $_SESSION['user'] = [
                'id' => $pdo->lastInsertId(),
                'nama' => $nama,
                'email' => $email,
                'role' => 'customer'
            ];

            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: index.php");
            exit;
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Register</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Full Name" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>

    <div class="text-center mt-3">
        Already have an account? <a href="login.php">Login here</a>.
    </div>
</div>