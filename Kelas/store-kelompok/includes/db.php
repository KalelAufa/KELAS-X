<?php
$host = 'localhost';
$dbname = 'toko_k'; // Sesuaikan dengan nama database Anda
$username = 'root'; // Username MySQL
$password = ''; // Password MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>