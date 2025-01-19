<?php
include '../../includes/koneksi.php';
include '../../includes/functions.php';
include '../../includes/sessions.php';

if (!isLoggedIn()) {
    header("Location: ../akun/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wishlist_id = validateInput($_POST['wishlist_id']);

    // Hapus item dari tabel wishlist berdasarkan ID
    $query = "DELETE FROM wishlist WHERE id = ?";
    executeQuery($koneksi, $query, [$wishlist_id], 'i');

    // Redirect kembali ke halaman wishlist
    header("Location: ./wishlist.php");
    exit();
}
?>