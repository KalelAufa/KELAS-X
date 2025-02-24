<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

$query = "SELECT * FROM pesanan WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$pesanan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Order History</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Address</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesanan as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td><?= htmlspecialchars($p['alamat']) ?></td>
                            <td><?= htmlspecialchars($p['metode_pembayaran']) ?></td>
                            <td><?= htmlspecialchars($p['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>