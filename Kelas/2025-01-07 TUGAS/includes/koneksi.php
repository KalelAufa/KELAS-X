<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "toko_online";

$koneksi = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Fungsi untuk menutup koneksi
if (!function_exists('closeConnection')) {
    function closeConnection($connection)
    {
        if ($connection) {
            $connection->close();
        }
    }
}
?>