<?php
include_once 'dbconfig.php';
include_once 'Barang.php';

$database = new Database();
$db = $database->getConnection();
$barang = new Barang($db);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        if ($barang->delete($_GET[' id '])) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Unable to delete record.";
        }
    } else {
        echo "No ID specified.";
    }
}
