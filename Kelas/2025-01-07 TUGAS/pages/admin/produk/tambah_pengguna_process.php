<?php
session_start();
include '../../includes/koneksi.php';
include '../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Proses jika formulir dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_depan = validateInput($_POST['nama_depan']);
    $nama_belakang = validateInput($_POST['nama_belakang']);
    $email = validateInput($_POST['email']);
    $password = password_hash(validateInput($_POST['password']), PASSWORD_DEFAULT);
    $role = validateInput($_POST['role']);

    // Masukkan pengguna baru ke database
    $query = "INSERT INTO users (nama_depan, nama_belakang, email, password, role) VALUES (?, ?, ?, ?, ?)";

    if (executeQuery($koneksi, $query, [$nama_depan, $nama_belakang, $email, $password, $role], 'sssss')) {
        header("Location: ./daftar_pengguna.php?success=Pengguna berhasil ditambahkan.");
        exit();
    } else {
        header("Location: ./tambah_pengguna.php?error=Gagal menambahkan pengguna. Silakan coba lagi.");
        exit();
    }
}
?>