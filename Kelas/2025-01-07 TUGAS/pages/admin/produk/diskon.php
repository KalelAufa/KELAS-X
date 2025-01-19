<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Ambil data diskon dari database
$query = "SELECT * FROM diskon ORDER BY id DESC";
$result = executeSelect($koneksi, $query, [], []);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskon - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Manajemen Diskon</h2>

        <!-- Form Tambah Diskon -->
        <div class="bg-white shadow rounded p-4 mb-4">
            <h3 class="text-lg font-semibold">Tambah Diskon Baru</h3>
            <form action="./tambah_diskon_process.php" method="POST">
                <div class="mb-4">
                    <label for="kode_diskon" class="block">Kode Diskon:</label>
                    <input type="text" name="kode_diskon" id="kode_diskon" required class="border rounded px-4 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label for="persentase" class="block">Persentase Diskon (%):</label>
                    <input type="number" name="persentase" id="persentase" required min="1" max="100" class="border rounded px-4 py-2 w-full">
                </div>

                <button type='submit' name='tambah_diskon' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Tambah Diskon</button>
            </form>
        </div>

        <!-- Tabel Diskon -->
        <?php if ($result->num_rows > 0): ?>
            <table class="min-w-full bg-white border border-gray-300 mt-2">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID Diskon</th>
                        <th class="border px-4 py-2">Kode Diskon</th>
                        <th class="border px-4 py-2">Persentase (%)</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['id']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['kode_diskon']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['persentase']); ?></td>

                            <!-- Button Hapus Diskon -->
                            <td class="border px-4 py-2">
                                <form action='./hapus_diskon_process.php' method='post'>
                                    <input type='hidden' name='id' value='<?php echo $row["id"]; ?>' />
                                    <button type='submit' class='bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700'>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>Tidak ada diskon yang tersedia.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>