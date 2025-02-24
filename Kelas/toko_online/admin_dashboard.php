<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        header("Location: admin_login.php");
        exit();
    }

    include 'db_connection.php';
    ?>

    <header class="bg-light py-3">
        <div class="container">
            <h2 class="text-center">Admin Dashboard</h2>
        </div>
    </header>

    <div class="container my-5">
        <h3>Manage Products</h3>
        <a href="add_product.php" class="btn btn-primary">Add New Product</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                while ($product = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$product['name']}</td>
                            <td>\${$product['price']}</td>
                            <td>
                                <a href='edit_product.php?id={$product['id']}' class='btn btn-warning'>Edit</a>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='productId' value='{$product['id']}'>
                                    <button type='submit' class='btn btn-danger' name='deleteProduct'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                }

                // Handle product deletion
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteProduct'])) {
                    $productId = $_POST['productId'];
                    $deleteSql = "DELETE FROM products WHERE id='$productId'";
                    if ($conn->query($deleteSql) === TRUE) {
                        echo "<div class='alert alert-success'>Product deleted successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error deleting product: " . $conn->error . "</div>";
                    }
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <p class="text-center">Toko Online &copy; 2023</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
