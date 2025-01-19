<?php
session_start();
include_once __DIR__ . '/../../includes/koneksi.php';
include_once __DIR__ . '/../../includes/functions.php';
include_once __DIR__ . '/../../includes/session.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isLoggedIn() || !isAdmin()) {
    header("Location: ./login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Ambil ulasan yang perlu dimoderasi dari database
$query = "SELECT u.id AS ulasan_id, u.judul, u.isi, u.pengguna, u.approved 
          FROM ulasan u 
          WHERE u.approved IS FALSE OR u.rejected IS TRUE"; // Ulasan yang perlu direview
$result = executeSelect($koneksi, $query, [], []);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderasi Ulasan - Toko Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <?php include_once __DIR__ . '/../../includes/header.php'; ?>

    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Moderasi Ulasan</h2>

        <?php if ($result->num_rows == 0): ?>
            <p>Tidak ada ulasan yang perlu direview.</p>
        <?php else: ?>
            <table class="min-w-full bg-white border border-gray-300 mt-2">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID Ulasan</th>
                        <th class="border px-4 py-2">Judul</th>
                        <th class="border px-4 py-2">Isi Ulasan</th>
                        <th class="border px-4 py-2">Username Pengguna</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['ulasan_id']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['judul']); ?></td>
                            <td class="border px-4 py-2"><?php echo nl2br(htmlspecialchars($row['isi'])); ?></td><!-- nl2br untuk newline -->
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($row['pengguna']); ?></td>

                            <!-- Button Approve or Reject -->
                            <td class="border px-4 py-2 flex space-x-2">
                                <form action='./approve_ulasan_process.php' method='post'>
                                    <input type='hidden' name='id' value='<?php echo $row["ulasan_id"]; ?>' />
                                    <button type='submit' class='bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700'>Approve</button>
                                </form>

                                <form action='./reject_ulasan_process.php' method='post'>
                                    <input type='hidden' name='id' value='<?php echo $row["ulasan_id"]; ?>' />
                                    <button type='submit' class='bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700'>Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../../includes/footer.php'; ?>

</body>

</html>