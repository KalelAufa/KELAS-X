<?php
session_start();
include '../../includes/koneksi.php';
include '../../includes/functions.php';

if (!isLoggedIn()) {
    header("Location: ../akun/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = validateInput($_POST['item_id']);
    $kuantitas = validateInput($_POST['kuantitas']);

    // Update kuantitas di tabel item_keranjang
    $query = "UPDATE item_keranjang SET kuantitas = ? WHERE item_id = ?";
    executeQuery($koneksi, $query, [$kuantitas, $item_id], 'ii');

    // Redirect kembali ke halaman keranjang
    header("Location: ./keranjang.php");
    exit();
}
?>