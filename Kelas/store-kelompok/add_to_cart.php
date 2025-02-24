<?php
session_start();
include 'includes/db.php';

// Pastikan request menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil ID produk dari form
    $product_id = (int)$_POST['id'];

    // Validasi ID produk
    if ($product_id <= 0) {
        $_SESSION['error'] = "Invalid product ID.";
        header("Location: index.php");
        exit;
    }

    // Cek apakah produk ada di database
    $query = "SELECT * FROM produk WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        $_SESSION['error'] = "Product not found.";
        header("Location: index.php");
        exit;
    }

    // Inisialisasi keranjang jika belum ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Tambahkan produk ke keranjang atau tambah jumlah jika sudah ada
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }

    // Set pesan sukses
    $_SESSION['success'] = "Product added to cart successfully.";
}

// Redirect kembali ke halaman sebelumnya
header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
exit;
?>