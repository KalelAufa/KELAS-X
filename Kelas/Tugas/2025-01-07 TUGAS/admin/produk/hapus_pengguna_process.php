<?php
session_start();
include '../../includes/koneksi.php';
include '../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Proses jika ID pengguna diterima untuk dihapus
if (isset($_POST['id'])) {
    $user_id = validateInput($_POST['id']);

    // Hapus pengguna dari database
    $query = "DELETE FROM users WHERE id = ?";

    if (executeQuery($koneksi, $query, [$user_id], 'i')) {
        header("Location: ./daftar_pengguna.php?success=Pengguna berhasil dihapus.");
        exit();
    } else {
        header("Location: ./daftar_pengguna.php?error=Gagal menghapus pengguna. Silakan coba lagi.");
        exit();
    }
} else {
    header("Location: ./daftar_pengguna.php"); // Redirect jika tidak ada ID yang diterima
}
?>