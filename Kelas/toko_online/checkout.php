<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    ?>

    <header class="bg-light py-3">
        <div class="container">
            <h2 class="text-center">Checkout</h2>
        </div>
    </header>

    <div class="container my-5">
        <h3>Your Cart</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $products = [
                    ['name' => 'Product Name 1', 'price' => 10.00],
                    ['name' => 'Product Name 2', 'price' => 15.00],
                    ['name' => 'Product Name 3', 'price' => 20.00],
                ];

                $grandTotal = 0;

                foreach ($products as $index => $product) {
                    $quantity = isset($_SESSION['cart'][$index]) ? $_SESSION['cart'][$index] : 0;
                    if ($quantity > 0) {
                        $total = $quantity * $product['price'];
                        $grandTotal += $total;
                        echo "<tr>
                                <td>{$product['name']}</td>
                                <td>\${$product['price']}</td>
                                <td>{$quantity}</td>
                                <td>\$$total</td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                    <td><strong>$<?php echo $grandTotal; ?></strong></td>
                </tr>
            </tfoot>
        </table>

        <h3>Payment Information</h3>
        <form method="POST" action="process_order.php">
            <div class="mb-3">
                <label for="billingName" class="form-label">Name</label>
                <input type="text" class="form-control" id="billingName" name="billingName" required>
            </div>
            <div class="mb-3">
                <label for="billingEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="billingEmail" name="billingEmail" required>
            </div>
            <div class="mb-3">
                <label for="billingAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="billingAddress" name="billingAddress" required>
            </div>
            <button type="submit" class="btn btn-primary">Complete Purchase</button>
        </form>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <p class="text-center">Toko Online &copy; 2023</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
