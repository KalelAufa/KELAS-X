<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    include 'db_connection.php';

    // Fetch product details
    $productId = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id='$productId'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
    ?>

    <header class="bg-light py-3">
        <div class="container">
            <h2 class="text-center"><?php echo $product['name']; ?></h2>
        </div>
    </header>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="https://via.placeholder.com/400" class="img-fluid" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="col-md-6">
                <h3>Price: $<?php echo $product['price']; ?></h3>
                <p>Description: <?php echo $product['description']; ?></p>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <p class="text-center">Toko Online &copy; 2023</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
