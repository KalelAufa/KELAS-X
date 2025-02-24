<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    include 'db_connection.php';

    $userId = $_SESSION['user_id'];
    ?>

    <header class="bg-light py-3">
        <div class="container">
            <h2 class="text-center">Order History</h2>
        </div>
    </header>

    <div class="container my-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($order = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$order['id']}</td>
                            <td>{$order['created_at']}</td>
                            <td>\${$order['total_amount']}</td>
                            <td>{$order['status']}</td>
                          </tr>";
                }

                $stmt->close();
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
