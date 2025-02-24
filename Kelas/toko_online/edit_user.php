<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Toko Online</title>
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

    // Fetch user details
    $userId = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id='$userId'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    ?>

    <header class="bg-light py-3">
        <div class="container">
            <h2 class="text-center">Edit User</h2>
        </div>
    </header>

    <div class="container my-5">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="userName" class="form-label">Name</label>
                <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="userEmail" name="userEmail" value="<?php echo $user['email']; ?>" required>
            </div>
            <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['userName'];
            $email = $_POST['userEmail'];
            $id = $_POST['userId'];

            // Validate input
            if (!empty($name) && !empty($email)) {
                // Update user data in the database
                $sql = "UPDATE users SET name='$name', email='$email' WHERE id='$id'";
                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>User updated successfully!</div>";
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
