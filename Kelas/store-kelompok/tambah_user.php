<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validasi input
    if (empty($nama)) {
        $error = "Name cannot be empty.";
    } elseif (empty($email)) {
        $error = "Email cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (empty($password)) {
        $error = "Password cannot be empty.";
    } else {
        // Periksa apakah email sudah terdaftar
        $query_check_email = "SELECT * FROM users WHERE email = ?";
        $stmt_check_email = $pdo->prepare($query_check_email);
        $stmt_check_email->execute([$email]);
        if ($stmt_check_email->rowCount() > 0) {
            $error = "Email already registered.";
        } else {
            // Enkripsi password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data pengguna
            $query = "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nama, $email, $hashed_password, $role]);

            $_SESSION['success'] = "User added successfully.";
            header("Location: manage_user.php");
            exit;
        }
    }
}
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Add New User</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Name</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="customer" selected>Customer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100">Add User</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>