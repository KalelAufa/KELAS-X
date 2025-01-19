<?php
// Pastikan sesi hanya dimulai jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fungsi untuk memeriksa apakah pengguna sudah login
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Fungsi untuk mendapatkan informasi pengguna
function getUserInfo()
{
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email'],
            'role' => $_SESSION['user_role'] // Misalnya: 'admin' atau 'user'
        ];
    }
    return null;
}

// Fungsi untuk login pengguna dan menyimpan informasi sesi
function loginUserSession($userId, $username, $email, $role)
{
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = htmlspecialchars($username);
    $_SESSION['email'] = htmlspecialchars($email);
    $_SESSION['user_role'] = htmlspecialchars($role); // Misalnya: 'admin' atau 'user'
}

// Fungsi untuk logout pengguna
function logoutUser()
{
    session_unset(); // Menghapus semua variabel sesi
    session_destroy(); // Menghancurkan sesi
}

// Fungsi untuk mengarahkan pengguna jika tidak memiliki akses
function redirectIfNotLoggedIn($redirectUrl)
{
    if (!isLoggedIn()) {
        header("Location: " . htmlspecialchars($redirectUrl));
        exit();
    }
}
