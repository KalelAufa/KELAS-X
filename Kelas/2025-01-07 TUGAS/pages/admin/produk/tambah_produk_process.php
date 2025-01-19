<?php
session_start();
include '../../includes/koneksi.php';
include '../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Proses jika formulir dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = validateInput($_POST['nama_produk']);
    $harga = validateInput($_POST['harga']);
    $deskripsi = validateInput($_POST['deskripsi']);
    $kategori = validateInput($_POST['kategori']);
    $stok = validateInput($_POST['stok']);

    // Proses upload gambar
    $target_dir = "../../assets/images/produk/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi tipe file gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        header("Location: ./tambah_produk.php?error=File yang diupload bukan gambar.");
        exit();
    }

    // Validasi ukuran file (maksimal 2MB)
    if ($_FILES["gambar"]["size"] > 2000000) {
        header("Location: ./tambah_produk.php?error=Ukuran file terlalu besar. Maksimal 2MB.");
        exit();
    }

    // Hanya izinkan format gambar tertentu
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        header("Location: ./tambah_produk.php?error=Hanya file JPG, JPEG, dan PNG yang diizinkan.");
        exit();
    }

    // Upload file gambar
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Simpan data produk ke database
        $query = "INSERT INTO produk (nama_produk, harga, gambar_url, deskripsi, kategori, stok) VALUES (?, ?, ?, ?, ?, ?)";

        if (executeQuery($koneksi, $query, [$nama_produk, $harga, basename($_FILES["gambar"]["name"]), $deskripsi, $kategori, $stok], 'sdsssi')) {
            header("Location: ./produk.php?success=Produk berhasil ditambahkan.");
            exit();
        } else {
            header("Location: ./tambah_produk.php?error=Gagal menambahkan produk. Silakan coba lagi.");
            exit();
        }
    } else {
        header("Location: ./tambah_produk.php?error=Gagal mengupload gambar.");
        exit();
    }
}
?>