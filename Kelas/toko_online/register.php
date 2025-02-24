<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Toko Online</title>
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
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="container my-5">
        <h2 class="text-center">Registrasi</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="registerName" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="registerName" name="registerName" required>
            </div>
            <div class="mb-3">
                <label for="registerEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="registerEmail" name="registerEmail" required>
            </div>
            <div class="mb-3">
                <label for="registerPassword" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="registerPassword" name="registerPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'db_connection.php';

            $name = $_POST['registerName'];
            $email = $_POST['registerEmail'];
            $password = password_hash($_POST['registerPassword'], PASSWORD_DEFAULT);

            // Validate input
            if (!empty($name) && !empty($email) && !empty($password)) {
                // Insert user data into the database
                $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>Registration successful!</div>";
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
</body>

</html>
