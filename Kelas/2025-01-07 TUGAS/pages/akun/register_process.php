<?php
session_start();
include '../../includes/koneksi.php';
include '../../includes/functions.php';

// Proses registrasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_depan = validateInput($_POST['nama_depan']);
    $nama_belakang = validateInput($_POST['nama_belakang']);
    $email = validateInput($_POST['email']);

    // Role default adalah user
    $role = 'user';

    // Cek apakah email sudah terdaftar
    $query_check_email = "SELECT * FROM users WHERE email = ?";
    $result_check_email = executeSelect($koneksi, $query_check_email, [$email], 's');

    if ($result_check_email->num_rows > 0) {
        header("Location: ./register.php?error=Email sudah digunakan.");
        exit();
    }

    // Hash password dan masukkan data ke database
    $password = password_hash(validateInput($_POST['password']), PASSWORD_DEFAULT);

    $query = "INSERT INTO users (nama_depan, nama_belakang, email, password, role) VALUES (?, ?, ?, ?, ?)";

    if (executeQuery($koneksi, $query, [$nama_depan, $nama_belakang, $email, $password, $role], 'sssss')) {
        header("Location: ./register.php?success=1");
        exit();
    } else {
        header("Location: ./register.php?error=Registrasi gagal. Silakan coba lagi.");
        exit();
    }
}
?>