<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $confirm_password = $_POST['confirm_password'];

    if ($_POST['password'] !== $_POST['confirm_password']) {
        die("Password dan Confirm Password tidak cocok.");
    }

    $stmt = $pdo->prepare("INSERT INTO pelanggan (nama_lengkap, email, password, role) VALUES (?, ?, ?, 'user')");
    $stmt->execute([$nama_lengkap, $email, $password]);

    echo "Registrasi berhasil!";
}
?>