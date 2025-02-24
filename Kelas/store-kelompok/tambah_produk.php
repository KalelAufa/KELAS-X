<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = trim($_POST['nama_produk']);
    $kategori_id = (int)$_POST['kategori_id'];
    $harga = (float)$_POST['harga'];
    $deskripsi = trim($_POST['deskripsi']);
    $gambar = $_FILES['gambar'];

    // Validasi input
    if (empty($nama_produk)) {
        $error = "Nama produk tidak boleh kosong.";
    } elseif (empty($kategori_id)) {
        $error = "Kategori harus dipilih.";
    } elseif ($harga <= 0) {
        $error = "Harga harus lebih besar dari 0.";
    } elseif ($gambar['error'] != UPLOAD_ERR_OK) {
        $error = "Gambar wajib diunggah.";
    } else {
        // Simpan gambar ke folder
        $target_dir = "assets/images/";
        $gambar_name = uniqid() . '_' . basename($gambar['name']);
        $target_file = $target_dir . $gambar_name;

        if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
            // Simpan data produk ke database
            $query = "INSERT INTO produk (nama_produk, kategori_id, harga, deskripsi, gambar) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$nama_produk, $kategori_id, $harga, $deskripsi, $gambar_name]);

            $_SESSION['success'] = "Produk berhasil ditambahkan.";
            header("Location: manage_produk.php");
            exit;
        } else {
            $error = "Gagal mengunggah gambar.";
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Tambah Produk</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select class="form-select" id="kategori_id" name="kategori_id" required>
                <option value="">Pilih Kategori</option>
                <?php
                $query_kategori = "SELECT * FROM kategori";
                $stmt_kategori = $pdo->query($query_kategori);
                while ($kategori = $stmt_kategori->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $kategori['id'] . '">' . htmlspecialchars($kategori['nama_kategori']) . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" step="0.01" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Produk</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>