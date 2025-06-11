<?php

session_start();
require_once "dbcontroller.php";
$db = new DB;
$sql = "SELECT * FROM tblkategori ORDER BY kategori ";
$row = $db->getALL($sql);

if (isset($_GET['log'])) {
    session_destroy();
    header("Location:index.php");
}

function cart()
{
    global $db;
    $cart = 0;
    foreach ($_SESSION as $key => $value) {
        if ($key <> 'pelanggan' && $key <> 'idpelanggan' && $key <> 'user' && $key <> 'level' && $key <> 'iduser') {
            $id = substr($key, 1);
            $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
            $row = $db->getALL($sql);

            foreach ($row as $r) {
                $cart++;
            }
        }
    }
    return $cart;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restauran SMK JAYA | Aplikasi Restauran SMK</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <script src="js/theme-switch.js"></script>
</head>

<body data-bs-theme="dark">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-utensils me-2"></i>Restauran SMK
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="user-menu">
                    <?php
                    if (isset($_SESSION['pelanggan'])) {
                        echo '
                            <a class="nav-link" href="?f=home&m=history"><i class="fas fa-history me-1"></i>History</a>
                            <a class="nav-link" href="?f=home&m=beli">' . $_SESSION['pelanggan'] . '</a>
                            <a class="nav-link cart-badge" href="?f=home&m=beli">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-count">' . cart() . '</span>
                            </a>
                            <a class="nav-link text-danger" href="?log=logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
                        ';
                    } else {
                        echo '
                            <a class="nav-link" href="?f=home&m=login"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
                            <a class="nav-link" href="?f=home&m=daftar"><i class="fas fa-user-plus me-1"></i>Daftar</a>
                        ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    </div>
    </div>
    </div>
    <div class="container mt">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h3>Kategori</h3>
                <hr>
                <?php if (!empty($row)) { ?>
                    <ul class="nav flex-column">
                        <?php foreach ($row as $r): ?>
                            <li class="nav-item"><a class="nav-link" href="?f=home&m=product&id=<?php echo  $r['idkategori']; ?>"><?php echo  $r['kategori']; ?></a></li>
                        <?php endforeach ?>
                    </ul>
                <?php } ?>
            </div>
            <div class="col-md-9 main-content">
                <?php
                if (isset($_GET['f']) && isset($_GET['m'])) {
                    $f = $_GET['f'];
                    $m = $_GET['m'];
                    $file = $f . '/' . $m . '.php';
                    require_once $file;
                } else {
                    require_once "home/product.php";
                }
                ?>
            </div>
        </div>
        <div class=" mt-5 row">
            <div class="col">
                <p class="text-center">2015 - copyright@kalelaufa | <a href="#" onclick="toggleTheme(); return false;">Ganti Tema</a></p>
            </div>
        </div>
    </div>
    <div class="theme-switch" onclick="toggleTheme()" title="Ubah Tema">
        <i class="fas fa-moon"></i>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleTheme() {
            const body = document.body;
            const icon = document.querySelector('.theme-switch i');

            if (body.getAttribute('data-bs-theme') === 'dark') {
                body.setAttribute('data-bs-theme', 'light');
                icon.classList.replace('fa-moon', 'fa-sun');
            } else {
                body.setAttribute('data-bs-theme', 'dark');
                icon.classList.replace('fa-sun', 'fa-moon');
            }
        }
    </script>
</body>

</html>