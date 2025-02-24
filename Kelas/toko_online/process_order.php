<?php
session_start();
include 'db_connection.php';

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Get billing information
$billingName = $_POST['billingName'];
$billingEmail = $_POST['billingEmail'];
$billingAddress = $_POST['billingAddress'];

// Insert order into the database
$stmt = $conn->prepare("INSERT INTO orders (name, email, address) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $billingName, $billingEmail, $billingAddress);

if ($conn->query($sql) === TRUE) {
    $orderId = $conn->insert_id; // Get the last inserted order ID

    // Insert order items into the order_items table
    foreach ($_SESSION['cart'] as $index => $quantity) {
        if ($quantity > 0) {
            $productSql = "SELECT * FROM products WHERE id='$index'";
            $productResult = $conn->query($productSql);
            $product = $productResult->fetch_assoc();
            $productName = $product['name'];
            $productPrice = $product['price'];
            $totalPrice = $quantity * $productPrice;

$orderItemSql = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
$orderItemSql->bind_param("isid", $orderId, $productName, $quantity, $totalPrice);

            $conn->query($orderItemSql);
        }
    }

    // Clear the cart
    unset($_SESSION['cart']);

    echo "<div class='alert alert-success'>Order placed successfully! Your order ID is $orderId.</div>";
} else {
    echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
}

$conn->close();
?>
