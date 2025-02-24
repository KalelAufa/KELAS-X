<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Query untuk menampilkan semua produk
$query = "SELECT p.*, k.nama_kategori 
          FROM produk p 
          LEFT JOIN kategori k ON p.kategori_id = k.id";
$stmt = $pdo->query($query);
$produk_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete produk
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Ambil nama gambar dari database
    $query_get_image = "SELECT gambar FROM produk WHERE id = ?";
    $stmt_get_image = $pdo->prepare($query_get_image);
    $stmt_get_image->execute([$id]);
    $produk = $stmt_get_image->fetch(PDO::FETCH_ASSOC);

    if ($produk) {
        // Hapus gambar dari folder assets/images jika ada
        if (!empty($produk['gambar']) && file_exists("assets/images/" . $produk['gambar'])) {
            unlink("assets/images/" . $produk['gambar']);
        }

        // Hapus data produk dari database
        $query_delete = "DELETE FROM produk WHERE id = ?";
        $stmt_delete = $pdo->prepare($query_delete);
        $stmt_delete->execute([$id]);

        $_SESSION['success'] = "Product deleted successfully.";
    } else {
        $_SESSION['error'] = "Product not found.";
    }

    header("Location: manage_produk.php");
    exit;
}
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Manage Products</h2>

    <!-- Tambah Produk -->
    <div class="mb-4">
        <a href="tambah_produk.php" class="btn btn-primary">Add New Product</a>
    </div>

    <!-- Tabel Produk -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Product List</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($produk_list) > 0): ?>
                        <?php foreach ($produk_list as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['id']) ?></td>
                                <td>
                                    <img src="assets/images/<?= htmlspecialchars($p['gambar']) ?>" alt="<?= htmlspecialchars($p['nama_produk']) ?>" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td><?= htmlspecialchars($p['nama_produk']) ?></td>
                                <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                                <td><?= htmlspecialchars($p['nama_kategori'] ?? 'Uncategorized') ?></td>
                                <td>
                                    <a href="edit_produk.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="?action=delete&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>