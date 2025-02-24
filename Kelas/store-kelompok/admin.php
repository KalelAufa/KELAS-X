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

// Query untuk menghitung total produk
$query_produk = "SELECT COUNT(*) AS total_produk FROM produk";
$stmt_produk = $pdo->query($query_produk);
$total_produk = $stmt_produk->fetch(PDO::FETCH_ASSOC)['total_produk'];

// Query untuk menghitung total pengguna
$query_users = "SELECT COUNT(*) AS total_users FROM users";
$stmt_users = $pdo->query($query_users);
$total_users = $stmt_users->fetch(PDO::FETCH_ASSOC)['total_users'];

// Query untuk menghitung total pesanan
$query_pesanan = "SELECT COUNT(*) AS total_pesanan FROM pesanan";
$stmt_pesanan = $pdo->query($query_pesanan);
$total_pesanan = $stmt_pesanan->fetch(PDO::FETCH_ASSOC)['total_pesanan'];

// Query untuk mendapatkan total penjualan per bulan
$query_sales = "SELECT 
                    MONTH(created_at) AS month, 
                    SUM(total_harga) AS total_sales 
                FROM pesanan 
                WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) 
                GROUP BY MONTH(created_at) 
                ORDER BY MONTH(created_at)";
$stmt_sales = $pdo->query($query_sales);
$sales_data = $stmt_sales->fetchAll(PDO::FETCH_ASSOC);

// Format data untuk Chart.js
$months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December"
];
$sales = array_fill(0, 12, 0); // Default semua bulan ke 0

foreach ($sales_data as $row) {
    $month_index = (int)$row['month'] - 1; // Indeks bulan (0-11)
    $sales[$month_index] = (float)$row['total_sales']; // Total penjualan
}
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Admin Dashboard</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- Statistik -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-center bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text display-4"><?= htmlspecialchars($total_produk) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4"><?= htmlspecialchars($total_users) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text display-4"><?= htmlspecialchars($total_pesanan) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Diagram Statistik Penjualan -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Sales Statistics (Last 12 Months)</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Navigasi -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Manage Products</h5>
                </div>
                <div class="card-body">
                    <p>View, add, edit, and delete products.</p>
                    <a href="manage_produk.php" class="btn btn-primary w-100">Go to Product Management</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Manage Users</h5>
                </div>
                <div class="card-body">
                    <p>View, add, edit, and delete users.</p>
                    <a href="manage_user.php" class="btn btn-success w-100">Go to User Management</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Manage Orders</h5>
                </div>
                <div class="card-body">
                    <p>View and manage all orders.</p>
                    <a href="manage_orders.php" class="btn btn-warning w-100">Go to Order Management</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Data penjualan
    const months = <?= json_encode($months) ?>;
    const sales = <?= json_encode($sales) ?>;

    // Inisialisasi Chart.js
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months, // Nama bulan
            datasets: [{
                label: 'Total Sales (Rp)',
                data: sales, // Total penjualan
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += 'Rp ' + context.parsed.y.toLocaleString(); // Format mata uang
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString(); // Format mata uang
                        }
                    }
                }
            }
        }
    });
</script>

<?php include 'includes/footer.php'; ?>