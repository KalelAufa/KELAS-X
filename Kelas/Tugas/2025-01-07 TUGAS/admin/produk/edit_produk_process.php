<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Proses jika formulir dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produk_id = validateInput($_POST['id']);
    $nama_produk = validateInput($_POST['nama_produk']);
    $harga = validateInput($_POST['harga']);
    $deskripsi = validateInput($_POST['deskripsi']);
    $kategori = validateInput($_POST['kategori']);
    $stok = validateInput($_POST['stok']);

    // Proses upload gambar jika ada gambar baru diupload
    $target_dir = "../../assets/images/produk/";

    if (!empty($_FILES["gambar"]["name"])) {
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi tipe file gambar
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check === false) {
            header("Location: ./edit_produk.php?id=$produk_id&error=File yang diupload bukan gambar.");
            exit();
        }

        // Validasi ukuran file (maksimal 2MB)
        if ($_FILES["gambar"]["size"] > 2000000) {
            header("Location: ./edit_produk.php?id=$produk_id&error=Ukuran file terlalu besar. Maksimal 2MB.");
            exit();
        }

        // Hanya izinkan format gambar tertentu
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
            header("Location: ./edit_produk.php?id=$produk_id&error=Hanya file JPG, JPEG, dan PNG yang diizinkan.");
            exit();
        }

        // Upload file gambar
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Update data produk ke database dengan gambar baru
            $query = "UPDATE produk SET nama_produk=?, harga=?, gambar_url=?, deskripsi=?, kategori=?, stok=? WHERE id=?";
            executeQuery($koneksi, $query, [$nama_produk, $harga, basename($_FILES["gambar"]["name"]), $deskripsi, $kategori, $stok, $produk_id], 'sdssssi');
        } else {
            header("Location: ./edit_produk.php?id=$produk_id&error=Gagal mengupload gambar.");
            exit();
        }
    } else {
        // Update data produk ke database tanpa mengganti gambar
        $query = "UPDATE produk SET nama_produk=?, harga=?, deskripsi=?, kategori=?, stok=? WHERE id=?";
        executeQuery($koneksi, $query, [$nama_produk, $harga, $deskripsi, $kategori, $stok, $produk_id], 'sdsssi');
    }

    header("Location: ./produk.php?success=Produk berhasil diperbarui.");
    exit();
}
