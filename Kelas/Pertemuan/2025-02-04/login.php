<?php
require_once 'config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM pelanggan WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role']; // Simpan role di session

        if ($user['role'] === 'admin') {
            echo "Login berhasil! Selamat datang Admin.";
        } else {
            echo "Login berhasil! Selamat datang " . $user['nama_lengkap'];
        }
    } else {
        echo "Email atau Password salah.";
    }
}
?>