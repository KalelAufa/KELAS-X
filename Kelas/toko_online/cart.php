<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-light py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">TokoOnline</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cart.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="d-flex align-items-center">
                <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
                <button class="btn btn-outline-success position-relative">
                    <i class="bi bi-cart"></i> Cart
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button>
            </div>
        </div>
    </header>

    <div class="container my-4">
        <h2 class="text-center">Keranjang Belanja</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                // Example products (this should be replaced with dynamic product loading)
                $products = [
                    ['name' => 'Product Name 1', 'price' => 10.00],
                    ['name' => 'Product Name 2', 'price' => 15.00],
                    ['name' => 'Product Name 3', 'price' => 20.00],
                ];

                // Display cart items
                foreach ($products as $index => $product) {
                    $quantity = isset($_SESSION['cart'][$index]) ? $_SESSION['cart'][$index] : 0;
                    $total = $quantity * $product['price'];
                    echo "<tr>
                            <td>{$product['name']}</td>
                            <td>\${$product['price']}</td>
                            <td>
                                <input type='number' class='form-control' value='{$quantity}' min='0' onchange='updateCart({$index}, this.value)'>
                            </td>
                            <td>\$$total</td>
                            <td>
                                <button class='btn btn-danger' onclick='removeFromCart({$index})'>Hapus</button>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                    <td colspan="2"><strong>
                        <?php
                        $grandTotal = 0;
                        foreach ($products as $index => $product) {
                            $grandTotal += (isset($_SESSION['cart'][$index]) ? $_SESSION['cart'][$index] : 0) * $product['price'];
                        }
                        echo "\$$grandTotal";
                        ?>
                    </strong></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-center">
            <a href="#" class="btn btn-primary">Lanjutkan ke Checkout</a>
        </div>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Menu</h5>
                    <nav class="nav flex-column">
                        <a class="nav-link text-white" href="index.php">Home</a>
                        <a class="nav-link text-white" href="about.php">About</a>
                        <a class="nav-link text-white" href="shop.php">Shop</a>
                        <a class="nav-link text-white" href="contact.php">Contact</a>
                    </nav>
                </div>
                <div class="col-md-3">
                    <h5>Payment</h5>
                    <img src="https://via.placeholder.com/100x50" alt="Payment Methods" class="img-fluid">
                    <p class="mt-2">We accept Visa, MasterCard, and PayPal.</p>
                </div>
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <div>
                        <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i> Facebook</a>
                        <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i> Instagram</a>
                        <a href="#" class="text-white"><i class="bi bi-twitter"></i> Twitter</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <p><a href="mailto:contact@tokoonline.com" class="text-white">contact@tokoonline.com</a></p>
                    <p>Phone: +123-456-7890</p>
                    <p>Address: 123 Online St, Web City</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateCart(index, quantity) {
            // Update the cart in the session (this should be handled via AJAX in a real application)
            console.log('Update cart:', index, quantity);
        }

        function removeFromCart(index) {
            // Remove the item from the cart (this should be handled via AJAX in a real application)
            console.log('Remove from cart:', index);
        }
    </script>
</body>

</html>
