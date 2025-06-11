<?php
include '../../includes/koneksi.php';
include '../../includes/functions.php';
include '../../includes/session.php'; // Corrected include statement

if (!isLoggedIn()) {
    header("Location: ../akun/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = validateInput($_POST['item_id']);

    // Hapus item dari tabel item_keranjang berdasarkan ID
    $query = "DELETE FROM item_keranjang WHERE item_id = ?";
    executeQuery($koneksi, $query, [$item_id], 'i');

    // Redirect kembali ke halaman keranjang
    header("Location: ./keranjang.php");
    exit();
}
