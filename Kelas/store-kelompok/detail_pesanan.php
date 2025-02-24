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

// Ambil ID pesanan dari URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "Invalid order ID.";
    header("Location: manage_orders.php");
    exit;
}

$order_id = (int)$_GET['id'];

// Query untuk mendapatkan detail pesanan
$query_detail = "SELECT dp.*, pr.nama_produk, pr.harga 
                 FROM detail_pesanan dp 
                 LEFT JOIN produk pr ON dp.produk_id = pr.id 
                 WHERE dp.pesanan_id = ?";
$stmt_detail = $pdo->prepare($query_detail);
$stmt_detail->execute([$order_id]);
$detail_items = $stmt_detail->fetchAll(PDO::FETCH_ASSOC);

if (empty($detail_items)) {
    $_SESSION['error'] = "Order details not found.";
    header("Location: manage_orders.php");
    exit;
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Order Details</h2>

    <!-- Daftar Produk dalam Pesanan -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail_items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td>Rp <?= number_format($item['harga'] * $item['quantity'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>