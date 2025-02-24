<?php
$servername = "localhost";
$username = "root"; // Change this if your username is different
$password = ""; // Change this if you have a password set
$dbname = "toko_online"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
