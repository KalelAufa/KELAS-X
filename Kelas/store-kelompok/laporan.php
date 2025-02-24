<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$pesanan = [];

// Filter berdasarkan tanggal
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_awal = $_POST['tanggal_awal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];

    $query = "SELECT * FROM pesanan WHERE created_at BETWEEN ? AND ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$tanggal_awal, $tanggal_akhir]);
    $pesanan = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Sales Report</h2>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="POST" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="tanggal_awal" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_akhir" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Pesanan -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Order List</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($pesanan) > 0): ?>
                        <?php foreach ($pesanan as $p): ?>
                            <tr>
                                <td><?= $p['id'] ?></td>
                                <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                <td><?= $p['created_at'] ?></td>
                                <td><?= htmlspecialchars($p['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>