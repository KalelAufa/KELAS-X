<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Online</title>
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
        <h2 class="text-center">Login</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="loginEmail" name="loginEmail" required>
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Masuk</button>
        </form>

        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'db_connection.php';

            $email = $_POST['loginEmail'];
            $password = $_POST['loginPassword'];

            // Validate input
            if (!empty($email) && !empty($password)) {
                // Check user credentials
                $sql = "SELECT * FROM users WHERE email='$email'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['password'])) {
                        // Start session and redirect
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['user_name'] = $row['name'];
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Invalid password.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>No user found with this email.</div>";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.js"></script>
</body>

</html>
