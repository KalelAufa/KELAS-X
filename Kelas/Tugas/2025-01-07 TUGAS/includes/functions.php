<?php
// Fungsi untuk membuat koneksi ke database
include 'koneksi.php';

// Fungsi untuk memvalidasi input
function validateInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Fungsi untuk mengeksekusi query SELECT
function executeSelect($koneksi, $query, $params = [], $types = '')
{
    $stmt = $koneksi->prepare($query);

    if ($params) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    return $stmt->get_result();
}

// Fungsi untuk mengeksekusi query INSERT, UPDATE, DELETE
function executeQuery($koneksi, $query, $params = [], $types = '')
{
    $stmt = $koneksi->prepare($query);

    if ($params) {
        $stmt->bind_param($types, ...$params);
    }

    if ($stmt->execute() === false) {
        die("Error executing query: " . $stmt->error);
    }
}

// Fungsi untuk mengambil semua data dari hasil query
function fetchAll($result)
{
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fungsi untuk mengambil satu baris data berdasarkan ID
function fetchById($koneksi, $tableName, $id)
{
    $query = "SELECT * FROM $tableName WHERE id = ?";
    return executeSelect($koneksi, $query, [$id], 'i')->fetch_assoc();
}

// Fungsi untuk menambah produk
function addProduct($koneksi, $name, $price, $image, $description)
{
    $query = "INSERT INTO produk name, price, image, description) VALUES (?, ?, ?, ?)";
    executeQuery($koneksi, $query, [$name, $price, $image, $description], 'sdss');
}

// Fungsi untuk mengedit produk
function editProduct($koneksi, $id, $name, $price, $image, $description)
{
    $query = "UPDATE produk SET name = ?, price = ?, image = ?, description = ? WHERE id = ?";
    executeQuery($koneksi, $query, [$name, $price, $image, $description, $id], 'sdssi');
}

// Fungsi untuk menghapus produk
function deleteProduct($koneksi, $id)
{
    $query = "DELETE FROM produk WHERE id = ?";
    executeQuery($koneksi, $query, [$id], 'i');
}

// Fungsi untuk mendaftar pengguna
function registerUser($koneksi, $username, $password, $email)
{
    // Validasi input kosong dan email tidak valid
    if (empty($username) || empty($password) || empty($email)) {
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Hash password sebelum menyimpan
    if ($stmt = $koneksi->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)")) {
        // Hash password sebelum menyimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Bind parameter dan eksekusi
        $stmt->bind_param("sss", $username, $hashed_password, $email);
        return ($stmt->execute() === true);
    }

    return false; // Gagal mendaftar
}

// Fungsi untuk login pengguna
function loginUser($koneksi, $username, $password)
{
    if ($stmt = $koneksi->prepare("SELECT password FROM users WHERE username = ?")) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return true; // Login berhasil
            }
        }

        return false; // Username atau password salah
    }

    return false; // Gagal mengeksekusi query
}

function isAdmin()
{
    // Pastikan sesi sudah dimulai
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Cek apakah pengguna sudah login dan memiliki role 'admin'
    if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        return true;
    }
    return false;
}


// Fungsi untuk mengupload gambar dan mengembalikan URL-nya
function uploadImage($file)
{
    // Tentukan direktori upload dan nama file baru
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file adalah gambar atau bukan
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return false; // Bukan gambar
    }

    // Cek ukuran file (misalnya maksimum 5MB)
    if ($file["size"] > 5000000) {
        return false; // File terlalu besar 
    }

    // Izinkan format file tertentu (misalnya JPG dan PNG)
    if (!in_array($imageFileType, ["jpg", "png", "jpeg"])) {
        return false;
    }

    // Coba upload file ke server 
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return htmlspecialchars($target_file);
    } else {
        return false;
    }
}
