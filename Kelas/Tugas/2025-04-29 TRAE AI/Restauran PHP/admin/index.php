<?php

session_start();
require_once "../dbcontroller.php";
$db = new DB;

if (!isset($_SESSION['user'])) {
    header("location:login.php");
}

if (isset($_GET['log'])) {
    session_destroy();
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page | Aplikasi Restauran SMK</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/custom.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-dark text-white p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="index.php" class="text-white text-decoration-none">
                            <h2><i class="fas fa-utensils me-2"></i>Admin Restauran</h2>
                        </a>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3">Level: <span class="badge bg-primary"><?php echo $_SESSION['level']; ?></span></div>
                        <div class="me-3">User: <a href="?f=user&m=updateuser&id=<?= $_SESSION['iduser']; ?>" class="text-white"><?php echo $_SESSION['user']; ?></a></div>
                        <div><a href="?log=logout" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt me-1"></i>Logout</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-0">
            <div class="col-md-2 bg-light p-0" style="min-height: calc(100vh - 150px);">
                <div class="list-group list-group-flush">
                    <a href="index.php" class="list-group-item list-group-item-action"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                    <?php
                    $level = $_SESSION['level'];
                    switch ($level) {
                        case 'admin':
                            echo '
                                    <a class="list-group-item list-group-item-action" href="?f=kategori&m=select"><i class="fas fa-list-alt me-2"></i>Kategori</a>
                                    <a class="list-group-item list-group-item-action" href="?f=menu&m=select"><i class="fas fa-utensils me-2"></i>Menu</a>
                                    <a class="list-group-item list-group-item-action" href="?f=pelanggan&m=select"><i class="fas fa-users me-2"></i>Pelanggan</a>
                                    <a class="list-group-item list-group-item-action" href="?f=order&m=select"><i class="fas fa-shopping-cart me-2"></i>Order</a>
                                    <a class="list-group-item list-group-item-action" href="?f=orderdetail&m=select"><i class="fas fa-receipt me-2"></i>Order Detail</a>
                                    <a class="list-group-item list-group-item-action" href="?f=user&m=select"><i class="fas fa-user-cog me-2"></i>User</a>
                                ';
                            break;
                        case 'kasir':
                            echo '
                                    <a class="list-group-item list-group-item-action" href="?f=order&m=select"><i class="fas fa-shopping-cart me-2"></i>Order</a>
                                    <a class="list-group-item list-group-item-action" href="?f=orderdetail&m=select"><i class="fas fa-receipt me-2"></i>Order Detail</a>
                                ';
                            break;
                        case 'koki':
                            echo '
                                    <a class="list-group-item list-group-item-action" href="?f=orderdetail&m=select"><i class="fas fa-receipt me-2"></i>Order Detail</a>
                                ';
                            break;
                        default:
                            echo '
                                    <span class="list-group-item">Tidak Ada Menu</span>
                                ';
                            break;
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-10 p-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php

                        if (isset($_GET['f']) && isset($_GET['m'])) {
                            $f = $_GET['f'];
                            $m = $_GET['m'];

                            $file = '../' . $f . '/' . $m . '.php';
                            require_once $file;
                        } else {
                            // Tampilkan dashboard sebagai halaman default
                            require_once 'dashboard.php';
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <p class="text-center text-muted">2024 - copyright@kalelaufa | Aplikasi Restauran SMK</p>
            </div>
        </div>
    </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>