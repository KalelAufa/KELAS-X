<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Anda harus login terlebih dahulu.");
}

if (empty($_SESSION['cart'])) {
    die("Keranjang kosong.");
}

$total = 0;
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    $subtotal = $product['harga'] * $quantity;
    $total += $subtotal;
}

echo "Total Pembayaran: Rp" . number_format($total, 0, ',', '.') . "\n";
echo "Silakan lakukan pembayaran melalui transfer bank.";
?>