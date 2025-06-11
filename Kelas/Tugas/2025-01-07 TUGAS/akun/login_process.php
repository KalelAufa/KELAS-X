<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = validateInput($_POST['email']);
    $password = $_POST['password'];

    // Ambil data pengguna berdasarkan email
    $query = "SELECT * FROM users WHERE email = ?";
    $result = executeSelect($koneksi, $query, [$email], 's');

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Set session user_id
            $_SESSION['role'] = $user['role']; // Set session role

            // Redirect berdasarkan role
            if ($user['role'] === 'admin') {
                header("Location: ../admin/dashboard.php"); // Redirect ke dashboard admin
            } else {
                header("Location: ../produk/produk.php"); // Redirect ke halaman produk setelah login berhasil
            }
            exit();
        } else {
            header("Location: ./login.php?error=Email atau password salah.");
            exit();
        }
    } else {
        header("Location: ./login.php?error=Email tidak terdaftar.");
        exit();
    }
}
