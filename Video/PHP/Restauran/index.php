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
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restauran SMK JAYA | Aplikasi Restauran SMK</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="mt-4 col-md-3">
                <h3> <a href="index.php">Restauran SMK</a></h3>
            </div>

            <div class="mt-4 col-md-9">
                <div class="flex flex-row gap-3 float-end d-flex">
                    <?php 
                    if (isset($_SESSION['pelanggan'])) {
                        echo '
                            <div><a href="?log=logout">Logout</a></div>
                            <div>Pelanggan : '.$_SESSION['pelanggan'].'n</div>
                        ';
                    }else {
                        echo '
                            <div><a href="?f=home&m=login">Login</a></div>
                            <div><a href="?f=home&m=daftar">Daftar</a></div>
                        ';
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="mt-5 row">
            <div class="col-md-3">
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
            <div class="col-md-9">
                <?php 
                    if (isset($_GET['f']) && isset($_GET['m'])) {
                        $f = $_GET['f'];
                        $m = $_GET['m'];
                        $file = $f.'/'.$m.'.php';
                        require_once $file;
                    }else {
                        require_once "home/product.php";
                    }
                ?>
            </div>
        </div>
        <div class="mt-5 row">
            <div class="col">
                <p class="text-center">2015 - copyright@kalelaufa</p>
            </div>
        </div>
    </div>
</body>
</html>