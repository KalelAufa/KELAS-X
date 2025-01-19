<?php
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';
include_once __DIR__ . '/../../includes/sessions.php';

// Ambil kategori dari URL atau form
$kategori = isset($_GET['kategori']) ? validateInput($_GET['kategori']) : '';

// Query untuk mengambil produk berdasarkan kategori
$query = "SELECT * FROM produk WHERE kategori = ?";
$result = executeSelect($koneksi, $query, [$kategori], 's');
?>


<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Produk Kategori: <?php echo htmlspecialchars($kategori); ?></h2>

        <!-- Daftar Produk -->
        <?php if ($result->num_rows > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white shadow rounded overflow-hidden">
                        <img src="<?php echo htmlspecialchars($row['gambar_url']); ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3><?php echo htmlspecialchars($row['nama_produk']); ?></h3>
                            <p>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                            <a href="./detail_produk.php?id=<?php echo $row['id']; ?>" class='inline-block bg-blue600 text-white px4 py2 rounded hover:bg-blue700'>Lihat Detail!</a>
                        </div>
                    </div><?PHP endwhile; ?>
            </div>
        <?php else: ?>
            <p>Tidak ada produk yang tersedia di kategori ini.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>