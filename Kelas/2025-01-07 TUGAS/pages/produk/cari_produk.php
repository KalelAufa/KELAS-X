<?php
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';
include_once __DIR__ . '/../../includes/session.php';

// Ambil query pencarian dari URL
$query_search = isset($_GET['query']) ? validateInput($_GET['query']) : '';

// Query untuk mencari produk berdasarkan nama atau deskripsi
$query = "SELECT * FROM produk WHERE nama_produk LIKE ? OR deskripsi LIKE ?";
$search_param = "%$query_search%";
$result = executeSelect($koneksi, $query, [$search_param, $search_param], 'ss');
?>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Pencarian untuk: "<?php echo htmlspecialchars($query_search); ?>"</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white shadow rounded overflow-hidden">
                        <img src="<?php echo htmlspecialchars($row['gambar_url']); ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold"><?php echo htmlspecialchars($row['nama_produk']); ?></h3>
                            <p class="text-gray-600">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                            <a href="detail_produk.php?id=<?php echo $row['id']; ?>" class="mt-2 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Lihat Detail</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Tidak ada produk yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>