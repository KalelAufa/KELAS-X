<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Ambil daftar pengguna dari database
$query = "SELECT id, nama_depan, nama_belakang, email, role FROM users ORDER BY id DESC";
$result = executeSelect($koneksi, $query, [], []);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Daftar Pengguna</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="min-w-full bg-white border border-gray-300 mt-2">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nama Depan</th>
                        <th class="border px-4 py-2">Nama Belakang</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Role</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['id']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['nama_depan']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['nama_belakang']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['email']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['role']); ?></td>

                            <!-- Button Edit dan Hapus -->
                            <td class="border px-4 py-2 flex space-x-2">
                                <!-- Edit -->
                                <a href="./edit_pengguna.php?id=<?php echo $row['id']; ?>"
                                    class='bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700'>Edit</a>

                                <!-- Hapus -->
                                <form action="./hapus_pengguna_process.php" method='POST'>
                                    <input type='hidden' name='id' value='<?php echo $row["id"]; ?>' />
                                    <button type='submit'
                                        onclick='return confirm("Apakah Anda yakin ingin menghapus pengguna ini?");'
                                        class='bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700'>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>Tidak ada pengguna terdaftar.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>