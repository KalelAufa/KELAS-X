<?php
session_start();
include '../../includes/koneksi.php';
include '../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Proses jika ID produk diterima untuk dihapus
if (isset($_POST['id'])) {
    $produk_id = validateInput($_POST['id']);

    // Hapus produk dari database
    $query = "DELETE FROM produk WHERE id = ?";

    if (executeQuery($koneksi, $query, [$produk_id], 'i')) {
        header("Location: ./produk.php?success=Produk berhasil dihapus.");
        exit();
    } else {
        header("Location: ./produk.php?error=Gagal menghapus produk. Silakan coba lagi.");
        exit();
    }
} else {
    header("Location: ./produk.php"); // Redirect jika tidak ada ID yang diterima
}
?>