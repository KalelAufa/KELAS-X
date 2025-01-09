<?php
include_once 'dbconfig.php';
include_once 'Barang.php';

$database = new Database();
$db = $database->getConnection();
$barang = new Barang($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get ID from URL and validate it
    if (!isset($_GET['id'])) die('ERROR: ID not specified.');

    // Validate inputs
    if (!empty($_POST['nama_barang']) && !empty($_POST['harga']) && !empty($_POST['stok'])) {
        // Prepare data for updating
        $id = $_GET['id'];
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // Handle file upload for gambar (optional)
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {

            // Define upload directory and file path
            move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . basename($_FILES['gambar']['name']));

            // Update with new image path
            if ($barang->update($id,  htmlspecialchars(strip_tags(basename($_FILES['gambar']['name']))), $harga, $stok, "uploads/" . basename($_FILES['gambar']['name']))) {
                header("Location: index.php");
                exit();
            }
        } else {
            // If no new image is uploaded, keep existing image path (fetch it from DB)
            if ($barang->update($id, $nama_barang, $harga, $stok, null)) {
                header("Location: index.php");
                exit();
            }
        }
    } else {
        echo "<p>Please fill in all fields.</p>";
    }
}
