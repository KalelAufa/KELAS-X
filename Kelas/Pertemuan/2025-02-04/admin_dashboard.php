<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Anda tidak memiliki akses ke halaman ini.");
}

echo "Selamat datang di Dashboard Admin, " . $_SESSION['nama_lengkap'] . "!\n";
echo "Berikut adalah daftar pelanggan:\n";

require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM pelanggan");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    echo "ID: " . $user['id'] . "\n";
    echo "Nama Lengkap: " . $user['nama_lengkap'] . "\n";
    echo "Email: " . $user['email'] . "\n";
    echo "Role: " . $user['role'] . "\n\n";
}
?>