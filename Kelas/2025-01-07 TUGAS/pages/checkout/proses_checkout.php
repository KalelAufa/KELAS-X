<?php
include '../../includes/koneksi.php';
include '../../includes/functions.php';
include '../../includes/session.php';

if (!isLoggedIn()) {
    header("Location: ../akun/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $total_harga = validateInput($_POST['total_harga']);

    // Insert transaksi ke tabel transaksi
    $query_transaksi = "INSERT INTO transaksi (user_id, total_harga) VALUES (?, ?)";
    executeQuery($koneksi, $query_transaksi, [$user_id, $total_harga], 'di');

    // Ambil ID transaksi yang baru saja dibuat
    $transaksi_id = $koneksi->insert_id;

    // Ambil semua item dari keranjang pengguna
    $query_item_keranjang = "SELECT ik.produk_id, ik.kuantitas, ik.harga_saat_pembelian 
                              FROM item_keranjang ik 
                              JOIN keranjang k ON ik.cart_id = k.cart_id 
                              WHERE k.user_id = ?";

    $items_result = executeSelect($koneksi, $query_item_keranjang, [$user_id], 'i');

    // Insert detail transaksi untuk setiap item di keranjang
    while ($item_row = $items_result->fetch_assoc()) {
        $produk_id = $item_row['produk_id'];
        $kuantitas = $item_row['kuantitas'];
        $harga = $item_row['harga_saat_pembelian'];

        // Insert ke detail_transaksi
        $query_detail_transaksi = "INSERT INTO detail_transaksi (transaksi_id, produk_id, kuantitas, harga) VALUES (?, ?, ?, ?)";
        executeQuery($koneksi, $query_detail_transaksi, [$transaksi_id, $produk_id, $kuantitas, $harga], 'iiid');
    }

    // Hapus item dari keranjang setelah checkout selesai
    $query_hapus_keranjang = "DELETE FROM item_keranjang WHERE cart_id IN (SELECT cart_id FROM keranjang WHERE user_id = ?)";
    executeQuery($koneksi, $query_hapus_keranjang, [$user_id], 'i');

    // Redirect ke halaman konfirmasi atau sukses
    header("Location: ./konfirmasi_pesanan.php");
    exit();
}
?>