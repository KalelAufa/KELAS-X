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

// Handle perubahan status pesanan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $order_id = (int)$_POST['order_id'];
    $new_status = trim($_POST['status']);

    // Validasi status
    if (!in_array($new_status, ['pending', 'completed', 'cancelled'])) {
        $_SESSION['error'] = "Invalid status.";
        header("Location: manage_orders.php");
        exit;
    }

    // Update status pesanan di database
    $query_update = "UPDATE pesanan SET status = ? WHERE id = ?";
    $stmt_update = $pdo->prepare($query_update);
    $stmt_update->execute([$new_status, $order_id]);

    $_SESSION['success'] = "Order status updated successfully.";
    header("Location: manage_orders.php");
    exit;
}

// Query untuk mendapatkan daftar pesanan
$query_orders = "SELECT p.*, u.nama AS nama_user 
                 FROM pesanan p 
                 LEFT JOIN users u ON p.user_id = u.id 
                 ORDER BY p.created_at DESC";
$stmt_orders = $pdo->query($query_orders);
$orders_list = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2 class="mb-4">Manage Orders</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
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
                <?php if (!empty($orders_list)): ?>
                    <?php foreach ($orders_list as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['id']) ?></td>
                            <td><?= htmlspecialchars($order['nama_user']) ?></td>
                            <td>Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <!-- Form untuk mengubah status pesanan -->
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                        <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                                        <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    </select>
                                    <input type="hidden" name="update_status" value="1">
                                </form>
                            </td>
                            <td><?= htmlspecialchars($order['created_at']) ?></td>
                            <td>
                                <a href="detail_pesanan.php?id=<?= $order['id'] ?>" class="btn btn-info btn-sm">
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