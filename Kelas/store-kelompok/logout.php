<?php
// Mulai sesi
session_start();

// Nonaktifkan cache browser
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman utama
header("Location: index.php");
exit;
?>