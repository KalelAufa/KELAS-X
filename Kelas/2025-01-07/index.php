<?php
include_once 'dbconfig.php';
include_once 'Barang.php';

$database = new Database();
$db = $database->getConnection();
$barang = new Barang($db);

// Handle form submission for creating new item
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nama_barang']) && !empty($_POST['harga']) && !empty($_POST['stok'])) {
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            move_uploaded_file($_FILES['gambar']['tmp_name'], "$upload_dir/" . basename($_FILES['gambar']['name']));
            if ($barang->create($nama_barang, $harga, $stok, "$upload_dir/" . basename($_FILES['gambar']['name']))) {
                header("Location: index.php");
                exit();
            } else {
                echo "<p class='text-danger'>Error adding item.</p>";
            }
        } else {
            echo "<p class='text-danger'>Error uploading image.</p>";
        }
    } else {
        echo "<p class='text-danger'>Please fill in all fields.</p>";
    }
}

$stmt = $barang->read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Data Barang</h2>
        <a href="create.php" class="btn btn-primary mb-3">Tambah Barang</a>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = ($stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']); ?></td>
                            <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                            <td><?= number_format(htmlspecialchars($row['harga']), 2); ?></td>
                            <td><?= htmlspecialchars($row['stok']); ?></td>
                            <td><img src="<?= htmlspecialchars($row['gambar']); ?>" width="50" class="img-thumbnail"></td>
                            <td>
                                <a href="edit.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?= htmlspecialchars($row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>