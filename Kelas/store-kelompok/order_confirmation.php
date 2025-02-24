<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan ada ID pesanan di session
if (!isset($_SESSION['last_order_id'])) {
    $_SESSION['error'] = "No order found.";
    header("Location: index.php");
    exit;
}

$order_id = $_SESSION['last_order_id'];

// Query untuk mendapatkan detail pesanan
$query_order = "SELECT p.*, u.nama AS nama_user 
                FROM pesanan p 
                LEFT JOIN users u ON p.user_id = u.id 
                WHERE p.id = ?";
$stmt_order = $pdo->prepare($query_order);
$stmt_order->execute([$order_id]);
$transaksi = $stmt_order->fetch(PDO::FETCH_ASSOC);

if (!$transaksi) {
    $_SESSION['error'] = "Order not found.";
    header("Location: index.php");
    exit;
}

// Query untuk mendapatkan detail item pesanan
$query_detail = "SELECT dp.*, pr.nama_produk, pr.harga 
                 FROM detail_pesanan dp 
                 LEFT JOIN produk pr ON dp.produk_id = pr.id 
                 WHERE dp.pesanan_id = ?";
$stmt_detail = $pdo->prepare($query_detail);
$stmt_detail->execute([$order_id]);
$detail_items = $stmt_detail->fetchAll(PDO::FETCH_ASSOC);

// Hitung total harga
$total_price = 0;
foreach ($detail_items as $item) {
    $total_price += $item['harga'] * $item['quantity'];
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Order Confirmation</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Informasi Pesanan -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Order Details</h5>
            <p><strong>Order ID:</strong> <?= htmlspecialchars($transaksi['id']) ?></p>
            <p><strong>Recipient Name:</strong> <?= htmlspecialchars($transaksi['nama_penerima']) ?></p>
            <p><strong>Address:</strong> <?= htmlspecialchars($transaksi['alamat']) ?></p>
            <p><strong>Phone Number:</strong> <?= htmlspecialchars($transaksi['telepon']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($transaksi['status']) ?></p>
        </div>
    </div>

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
                <?php if (!empty($detail_items)): ?>
                    <?php foreach ($detail_items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                            <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td>Rp <?= number_format($item['harga'] * $item['quantity'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No items in this order.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Total Harga -->
    <div class="d-flex justify-content-end mb-4">
        <h4>Total: Rp <?= number_format($total_price, 0, ',', '.') ?></h4>
    </div>
</div>

<?php include 'includes/footer.php'; ?>