<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-light py-3">
        <div class="container">
            <h2 class="text-center">Admin Login</h2>
        </div>
    </header>

    <div class="container my-5">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="adminEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="adminEmail" name="adminEmail" required>
            </div>
            <div class="mb-3">
                <label for="adminPassword" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="adminPassword" name="adminPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'db_connection.php';

            $email = $_POST['adminEmail'];
            $password = $_POST['adminPassword'];

            // Validate input
            if (!empty($email) && !empty($password)) {
                // Check admin credentials (this should be replaced with actual admin validation)
                if ($email === 'admin@example.com' && $password === 'admin123') {
                    $_SESSION['admin_logged_in'] = true;
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Invalid admin credentials.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Please fill in all fields.</div>";
            }
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
