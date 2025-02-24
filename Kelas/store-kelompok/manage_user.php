<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Query untuk menampilkan semua pengguna
$query = "SELECT * FROM users";
$stmt = $pdo->query($query);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete user
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    header("Location: manage_user.php");
    exit;
}
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Manage Users</h2>

    <!-- Tambah User -->
    <div class="mb-4">
        <a href="tambah_user.php" class="btn btn-primary">Add New User</a>
    </div>

    <!-- Tabel Pengguna -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">User List</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($users) > 0): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']) ?></td>
                                <td><?= htmlspecialchars($user['nama']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['role']) ?></td>
                                <td>
                                    <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="?action=delete&id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>