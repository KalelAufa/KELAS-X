<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Ambil ID produk dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$id) {
    header("Location: manage_produk.php");
    exit;
}

// Query untuk menampilkan detail produk
$query = "SELECT * FROM produk WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$produk = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produk) {
    header("Location: manage_produk.php");
    exit;
}

// Query untuk menampilkan kategori
$query_kategori = "SELECT * FROM kategori";
$stmt_kategori = $pdo->query($query_kategori);
$kategori_list = $stmt_kategori->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = trim($_POST['nama_produk']);
    $harga = $_POST['harga'];
    $deskripsi = trim($_POST['deskripsi']);
    $kategori_id = $_POST['kategori_id'];
    $gambar = $_FILES['gambar'];

    // Validasi input
    if (empty($nama_produk)) {
        $error = "Product name cannot be empty.";
    } elseif (empty($harga) || !is_numeric($harga)) {
        $error = "Price must be a valid number.";
    } elseif (empty($deskripsi)) {
        $error = "Description cannot be empty.";
    } else {
        // Jika ada gambar baru, upload dan ganti gambar lama
        if ($gambar['error'] == UPLOAD_ERR_OK) {
            if (!in_array($gambar['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
                $error = "Only JPG, PNG, or GIF images are allowed.";
            } else {
                $gambar_nama = uniqid('produk_') . '.' . pathinfo($gambar['name'], PATHINFO_EXTENSION);
                move_uploaded_file($gambar['tmp_name'], "assets/images/$gambar_nama");

                // Hapus gambar lama jika ada
                if (!empty($produk['gambar'])) {
                    unlink("assets/images/" . $produk['gambar']);
                }
            }
        } else {
            $gambar_nama = $produk['gambar']; // Tetap gunakan gambar lama
        }

        // Update data produk
        $query = "UPDATE produk SET nama_produk = ?, harga = ?, deskripsi = ?, gambar = ?, kategori_id = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nama_produk, $harga, $deskripsi, $gambar_nama, $kategori_id, $id]);

        $_SESSION['success'] = "Product updated successfully.";
        header("Location: manage_produk.php");
        exit;
    }
}
?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">Edit Product</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Price</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($produk['harga']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= htmlspecialchars($produk['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Category</label>
            <select class="form-select" id="kategori_id" name="kategori_id" required>
                <option value="">Select Category</option>
                <?php foreach ($kategori_list as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= $k['id'] == $produk['kategori_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($k['nama_kategori']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Current Image</label>
            <div class="mb-2">
                <img src="assets/images/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <label for="gambar" class="form-label">New Image (Optional)</label>
            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
            <small class="text-muted">Leave blank to keep the current image.</small>
        </div>
        <button type="submit" class="btn btn-success w-100">Update Product</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>