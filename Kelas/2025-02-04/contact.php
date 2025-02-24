<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    $stmt = $pdo->prepare("INSERT INTO kontak (nama, email, pesan) VALUES (?, ?, ?)");
    $stmt->execute([$nama, $email, $pesan]);

    echo "Pesan berhasil dikirim.";
}
?>