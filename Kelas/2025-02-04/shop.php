<?php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM produk");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo "Nama Produk: " . $product['nama_produk'] . "\n";
    echo "Harga: Rp" . number_format($product['harga'], 0, ',', '.') . "\n";
    echo "Gambar: " . $product['gambar'] . "\n";
    echo "Tambah ke Cart: /add_to_cart.php?id=" . $product['id'] . "\n\n";
}
?>