<?php
session_start();
include 'includes/db.php';
include 'includes/header.php';

// Handle penambahan atau pengurangan quantity
if (isset($_GET['action']) && isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
    $action = $_GET['action'];

    if ($action === 'increase') {
        // Tambahkan quantity
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]++;
        }
    } elseif ($action === 'decrease') {
        // Kurangi quantity
        if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id] > 1) {
            $_SESSION['cart'][$product_id]--;
        } elseif ($_SESSION['cart'][$product_id] <= 1) {
            // Jika quantity kurang dari atau sama dengan 1, hapus item dari keranjang
            unset($_SESSION['cart'][$product_id]);
        }
    }

    // Redirect kembali ke halaman cart untuk memperbarui tampilan
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
?>

<div class="container mt-5">
    <h2 class="mb-4">Shopping Cart</h2>

    <?php if (empty($cart_items)): ?>
        <div class="alert alert-warning text-center w-100">
            Your cart is empty. <a href="index.php" class="alert-link">Continue shopping</a>.
        </div>
    <?php else: ?>
        <!-- Daftar Produk di Keranjang -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
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
                            <td>
                                <!-- Tombol Tambah/Kurangi Quantity -->
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="cart.php?action=decrease&id=<?= $item['id'] ?>" class="btn btn-sm btn-danger">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                    <span class="mx-2 fw-bold"><?= htmlspecialchars($item['quantity']) ?></span>
                                    <a href="cart.php?action=increase&id=<?= $item['id'] ?>" class="btn btn-sm btn-success">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </td>
                            <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                            <td>
                                <a href="cart.php?action=remove&id=<?= $item['id'] ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Remove
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Total Harga -->
        <div class="d-flex justify-content-end mb-4">
            <h4>Total: Rp <?= number_format($total_price, 0, ',', '.') ?></h4>
        </div>

        <!-- Tombol Checkout -->
        <div class="d-flex justify-content-end">
            <a href="checkout.php" class="btn btn-primary btn-lg">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>