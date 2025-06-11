<?php
include_once 'dbconfig.php';
include_once 'Barang.php';

$database = new Database();
$db = $database->getConnection();
$barang = new Barang($db);

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record not found.');

$stmt = $barang->read();
$row = null;

while ($r = ($stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null)) {
    if ($r['id'] == intval($id)) {
        $row = $r;
        break;
    }
}

if (!$row) {
    die('ERROR: Record not found.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class='container mt-5'>
        <h2 class='text-center mb-4'>Edit Barang</h2>

        <form action='update.php?id=<?= htmlspecialchars($row['id']); ?>' method='POST' enctype='multipart/form-data'>
            <div class='form-group'>
                <label>Nama Barang:</label><br />
                <input type='text' name='nama_barang' value='<?= htmlspecialchars($row['nama_barang']); ?>' required class='form-control'>
            </div>

            <div class='form-group'>
                <label>Harga:</label><br />
                <input type='number' name='harga' step='0.01' value='<?= htmlspecialchars($row['harga']); ?>' required class='form-control'>
            </div>

            <div class='form-group'>
                <label>Stok:</label><br />
                <input type='number' name='stok' value='<?= htmlspecialchars($row['stok']); ?>' required class='form-control'>
            </div>

            <div class='form-group'>
                <label>Gambar:</label><br />
                Current Image:
                <img src="<?= htmlspecialchars($row['gambar']); ?>" width='50' alt='Current Image'><br />
                (Upload new image if you want to change it)<br />
                <input type='file' name='gambar' accept='image/*' class='form-control-file'>
            </div>

            <button type='submit' class='btn btn-warning'>Update Barang</button>

        </form>

        <a href='index.php' class='btn btn-secondary mt-3'>Kembali ke Daftar Barang</a>

    </div>

    <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>

</body>

</html>