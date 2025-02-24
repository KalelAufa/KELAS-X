<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        header("Location: admin_login.php");
        exit();
    }
    ?>

    <header class="bg-light py-3">
        <div class="container">
            <h2 class="text-center">Add New Product</h2>
        </div>
    </header>

    <div class="container my-5">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'db_connection.php';

            $name = $_POST['productName'];
            $price = $_POST['productPrice'];

            // Validate input
            if (!empty($name) && !empty($price)) {
                // Insert product data into the database
                $sql = "INSERT INTO products (name, price) VALUES ('$name', '$price')";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>Product added successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Please fill in all fields.</div>";
            }

            $conn->close();
        }
        ?>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <p class="text-center">Toko Online &copy; 2023</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
