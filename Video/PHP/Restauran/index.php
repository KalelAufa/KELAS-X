<?php 

    session_start();
    require_once "dbcontroller.php";
    $db = new DB;
    $sql = "SELECT * FROM tblkategori ORDER BY kategori ";
    $row = $db->getALL($sql);
    
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
                <h2>Restauran SMK JAYA</h2>
            </div>

            <div class="mt-4 col-md-9">
                <div class="flex flex-row gap-3 float-end d-flex">
                    <div class="">Logout</div>
                    <div class="">Login</div>
                    <div class="">Pelangan</div>
                    <div>Daftar</div>
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
                    <li class="nav-item"><a class="nav-link" href="#"><?php echo  $r['kategori']; ?></a></li>
                    <?php endforeach ?>
                </ul>
                <?php } ?>
            </div>
            <div class="col-md-9">
                <?php 
                
                echo "<h1>DAFTAR MENU</h1>";
                
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