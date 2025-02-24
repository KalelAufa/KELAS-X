<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Ambil ID pengguna dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$id) {
    header("Location: manage_user.php");
    exit;
}

// Query untuk menampilkan detail pengguna
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: manage_user.php");
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
    } else {
        // Jika password diisi, enkripsi ulang
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $hashed_password = $user['password']; // Tetap gunakan password lama
        }

        // Update data pengguna
        $query = "UPDATE users SET nama = ?, email = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nama, $email, $hashed_password, $role, $id]);

        $_SESSION['success'] = "User updated successfully.";
        header("Location: manage_user.php");
        exit;
    }
}
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Edit User</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Name</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
            <small class="text-muted">Leave blank to keep the current password.</small>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="customer" <?= $user['role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100">Update User</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>