<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Tambahkan kategori baru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_kategori'])) {
    $nama_kategori = trim($_POST['nama_kategori']);

    if (!empty($nama_kategori)) {
        $stmt = $pdo->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
        $stmt->execute([$nama_kategori]);
    }
}

// Query untuk menampilkan kategori
$query = "SELECT * FROM kategori";
$stmt = $pdo->query($query);
$kategori = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Category Management</h2>

    <!-- Tambah Kategori -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Category</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                </div>
                <button type="submit" class="btn btn-success w-100" name="tambah_kategori">Add Category</button>
            </form>
        </div>
    </div>

    <!-- Daftar Kategori -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Category List</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($kategori) > 0): ?>
                        <?php foreach ($kategori as $k): ?>
                            <tr>
                                <td><?= htmlspecialchars($k['nama_kategori']) ?></td>
                                <td>
                                    <a href="edit_kategori.php?id=<?= $k['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="hapus_kategori.php?id=<?= $k['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center">No categories found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>