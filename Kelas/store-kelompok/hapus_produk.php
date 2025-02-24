<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM produk WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin.php");
exit;
?>