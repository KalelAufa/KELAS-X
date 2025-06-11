<style>
    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        border: none;
        width: 100%;
    }

    .card-header {
        background-color: #27548A;
        border-bottom: 1px solid #eee;
        border-radius: 10px 10px 0 0 !important;
    }

    .btn-primary {
        padding: 0.8rem;
        font-weight: 500;
    }

    .form-control {
        padding: 0.8rem;
    }
</style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card">
                    <div class="card-header text-center py-3">
                        <h4 class="mb-0">Login Restauran</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" value="login" name="login">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <small class="text-muted">Belum punya akun? <a href="daftar.php" class="text-decoration-none">Daftar disini</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// Pastikan tidak ada spasi, baris kosong, atau output apapun sebelum tag pembuka PHP ini
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM tblpelanggan WHERE email='$email' AND password='$password' AND aktif=1";
    $count = $db->rowCOUNT($sql);
    if ($count == 0) {
        echo "<center><h3>Email atau Password Salah!!</h3></center>";
    } else {
        $sql = "SELECT * FROM tblpelanggan WHERE email='$email' AND password='$password' AND aktif=1";
        $row = $db->getITEM($sql);
        $_SESSION['pelanggan'] = $row['email'];
        $_SESSION['idpelanggan'] = $row['idpelanggan'];
        header("Location:index.php");
    }
}
?>