<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['error'] = "You do not have permission to access this page.";
    header("Location: index.php");
    exit;
}

// Query untuk mendapatkan daftar pesanan beserta detailnya
$query_pesanan = "SELECT p.*, u.nama AS nama_user 
                  FROM pesanan p 
                  LEFT JOIN users u ON p.user_id = u.id 
                  ORDER BY p.created_at DESC";
$stmt_pesanan = $pdo->query($query_pesanan);
$pesanan_list = $stmt_pesanan->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Order History</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Daftar Pesanan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pesanan_list)): ?>
                    <?php foreach ($pesanan_list as $pesanan): ?>
                        <tr>
                            <td><?= htmlspecialchars($pesanan['id']) ?></td>
                            <td><?= htmlspecialchars($pesanan['nama_user']) ?></td>
                            <td>Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($pesanan['status']) ?></td>
                            <td><?= htmlspecialchars($pesanan['created_at']) ?></td>
                            <td>
                                <a href="detail_pesanan.php?id=<?= $pesanan['id'] ?>" class="btn btn-info btn-sm">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>