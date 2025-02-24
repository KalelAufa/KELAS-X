<?php
session_start();
include 'includes/db.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$status = $_GET['status'];

// Update status pesanan
$stmt = $pdo->prepare("UPDATE pesanan SET status = ? WHERE id = ?");
$stmt->execute([$status, $id]);

header("Location: admin.php");
exit;
?>