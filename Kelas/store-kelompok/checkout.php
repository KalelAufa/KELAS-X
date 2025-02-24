<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Pastikan keranjang tidak kosong
if (empty($_SESSION['cart'])) {
    $_SESSION['error'] = "Your cart is empty. Please add products to your cart first.";
    header("Location: cart.php");
    exit;
}

// Query untuk mendapatkan detail produk di keranjang
$cart_items = [];
$total_price = 0;

if (!empty($_SESSION['cart'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $query = "SELECT p.*, k.nama_kategori 
              FROM produk p 
              LEFT JOIN kategori k ON p.kategori_id = k.id 
              WHERE p.id IN ($placeholders)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array_keys($_SESSION['cart']));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        $quantity = $_SESSION['cart'][$product['id']];
        $subtotal = $product['harga'] * $quantity;
        $total_price += $subtotal;

        $cart_items[] = [
            'id' => $product['id'],
            'nama_produk' => $product['nama_produk'],
            'kategori' => $product['nama_kategori'],
            'harga' => $product['harga'],
            'gambar' => $product['gambar'],
            'quantity' => $quantity,
            'subtotal' => $subtotal,
        ];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_penerima = trim($_POST['nama_penerima']);
    $alamat = trim($_POST['alamat']);
    $telepon = trim($_POST['telepon']);
    $metode_pembayaran = trim($_POST['metode_pembayaran']);

    // Validasi input
    if (empty($nama_penerima)) {
        $error = "Nama penerima tidak boleh kosong.";
    } elseif (empty($alamat)) {
        $error = "Alamat tidak boleh kosong.";
    } elseif (empty($telepon)) {
        $error = "Nomor telepon tidak boleh kosong.";
    } elseif (empty($metode_pembayaran)) {
        $error = "Metode pembayaran harus dipilih.";
    } else {
        // Simpan data pesanan ke database
        $query_order = "INSERT INTO pesanan (user_id, nama_penerima, alamat, telepon, total_harga, status, metode_pembayaran) 
                        VALUES (?, ?, ?, ?, ?, 'pending', ?)";
        $stmt_order = $pdo->prepare($query_order);
        $stmt_order->execute([$_SESSION['user']['id'], $nama_penerima, $alamat, $telepon, $total_price, $metode_pembayaran]);

        $order_id = $pdo->lastInsertId();

        // Simpan detail pesanan
        foreach ($cart_items as $item) {
            $query_detail = "INSERT INTO detail_pesanan (pesanan_id, produk_id, quantity, harga) 
                             VALUES (?, ?, ?, ?)";
            $stmt_detail = $pdo->prepare($query_detail);
            $stmt_detail->execute([$order_id, $item['id'], $item['quantity'], $item['harga']]);
        }

        // Kosongkan keranjang
        unset($_SESSION['cart']);

        // Redirect ke halaman konfirmasi pesanan
        $_SESSION['success'] = "Order placed successfully!";
        header("Location: order_confirmation.php");
        exit;
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Ringkasan Pesanan -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td>
                            <img src="assets/images/<?= htmlspecialchars($item['gambar']) ?>" alt="<?= htmlspecialchars($item['nama_produk']) ?>" style="width: 50px; height: 50px; object-fit: cover;">
                            <?= htmlspecialchars($item['nama_produk']) ?>
                        </td>
                        <td><?= htmlspecialchars($item['kategori']) ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Total Harga -->
    <div class="d-flex justify-content-end mb-4">
        <h4>Total: Rp <?= number_format($total_price, 0, ',', '.') ?></h4>
    </div>

    <!-- Formulir Checkout -->
    <form method="POST">
        <h5 class="mb-3">Shipping Information</h5>
        <div class="mb-3">
            <label for="nama_penerima" class="form-label">Recipient Name</label>
            <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Address</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
        </div>

        <!-- Metode Pembayaran -->
        <h5 class="mb-3">Payment Method</h5>
        <div class="mb-3">
            <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                <option value="">Select Payment Method</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success btn-lg">Place Order</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>