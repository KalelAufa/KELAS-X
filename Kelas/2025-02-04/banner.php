<?php
require_once 'config.php';

// Banner Statis
echo "Banner Statis: Selamat datang di Toko Online XYZ!\n";

// Banner Dinamis dari Database
$stmt = $pdo->query("SELECT * FROM banners");
$banners = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($banners as $banner) {
    echo "Banner Dinamis: " . $banner['judul'] . "\n";
}
?>