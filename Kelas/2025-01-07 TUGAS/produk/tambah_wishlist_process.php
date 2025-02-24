<?php
include '../../includes/koneksi.php';
include '../../includes/functions.php';
include '../../includes/sessions.php';

if (!isLoggedIn()) {
    header("Location: ../akun/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produk_id = validateInput($_POST['produk_id']);
    $user_id = $_SESSION['user_id'];

    // Cek apakah produk sudah ada di wishlist
    $checkQuery = "SELECT * FROM wishlist WHERE user_id = ? AND produk_id = ?";
    $checkResult = executeSelect($koneksi, $checkQuery, [$user_id, $produk_id], 'ii');

    if ($checkResult->num_rows == 0) {
        // Tambahkan produk ke wishlist
        $query = "INSERT INTO wishlist (user_id, produk_id) VALUES (?, ?)";
        executeQuery($koneksi, $query, [$user_id, $produk_id], 'ii');
        header("Location: ../pages/produk/wishlist.php");
        exit();
    } else {
        // Produk sudah ada di wishlist
        header("Location: ../pages/produk/wishlist.php?error=already_exists");
        exit();
    }
}
?>