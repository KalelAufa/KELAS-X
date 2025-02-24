<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Anda harus login terlebih dahulu.");
}

if (empty($_SESSION['cart'])) {
    echo "Keranjang kosong.";
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    $subtotal = $product['harga'] * $quantity;
    $total += $subtotal;

    echo "Nama Produk: " . $product['nama_produk'] . "\n";
    echo "Harga: Rp" . number_format($product['harga'], 0, ',', '.') . "\n";
    echo "Jumlah: " . $quantity . "\n";
    echo "Subtotal: Rp" . number_format($subtotal, 0, ',', '.') . "\n";
    echo "Hapus: /remove_from_cart.php?id=" . $product_id . "\n\n";
}

echo "Total Belanja: Rp" . number_format($total, 0, ',', '.') . "\n";
echo "Checkout: /checkout.php";
?>