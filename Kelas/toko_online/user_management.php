<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Toko Online</title>
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
            <h2 class="text-center">User Management</h2>
        </div>
    </header>

    <div class="container my-5">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                while ($user = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$user['id']}</td>
                            <td>{$user['name']}</td>
                            <td>{$user['email']}</td>
                            <td>
                                <a href='edit_user.php?id={$user['id']}' class='btn btn-warning'>Edit</a>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='userId' value='{$user['id']}'>
                                    <button type='submit' class='btn btn-danger' name='deleteUser'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                }

                // Handle user deletion
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteUser'])) {
                    $userId = $_POST['userId'];
                    $deleteSql = "DELETE FROM users WHERE id='$userId'";
                    if ($conn->query($deleteSql) === TRUE) {
                        echo "<div class='alert alert-success'>User deleted successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error deleting user: " . $conn->error . "</div>";
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
