<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Proses jika formulir dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = validateInput($_POST['id']);
    $nama_depan = validateInput($_POST['nama_depan']);
    $nama_belakang = validateInput($_POST['nama_belakang']);

    // Update data pengguna di database
    $query = "UPDATE users SET nama_depan=?, nama_belakang=? WHERE id=?";

    if (executeQuery($koneksi, $query, [$nama_depan, $nama_belakang, $user_id], 'ssi')) {
        header("Location: ./daftar_pengguna.php?success=Pengguna berhasil diperbarui.");
        exit();
    } else {
        header("Location: ./edit_pengguna.php?id=$user_id&error=Gagal memperbarui pengguna. Silakan coba lagi.");
        exit();
    }
}
