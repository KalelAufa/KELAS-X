<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Tambah Barang</h2>

        <form action="index.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Barang:</label>
                <input type="text" name="nama_barang" class="form-control" required placeholder="Masukkan nama barang...">
            </div>

            <div class="form-group">
                <label>Harga:</label>
                <input type="number" name="harga" step="0.01" class="form-control" required placeholder="Masukkan harga barang...">
            </div>

            <div class="form-group">
                <label>Stok:</label>
                <input type="number" name="stok" class="form-control" required placeholder="Masukkan jumlah stok...">
            </div>

            <div class="form-group">
                <label>Gambar:</label><br />
                <input type="file" name="gambar" accept="image/*" class='form-control-file'><br />
            </div>

            <button type='submit' class='btn btn-primary'>Tambah Barang</button>

        </form>

        <a href='index.php' class='btn btn-secondary mt-3'>Kembali ke Daftar Barang</a>

    </div>

    <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>

</body>

</html>