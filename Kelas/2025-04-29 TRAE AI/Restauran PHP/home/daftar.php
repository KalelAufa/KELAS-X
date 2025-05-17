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
    }

    .card-header {
        background-color: #27548A;
        border-bottom: 1px solid #eee;
        border-radius: 10px 10px 0 0 !important;
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center py-3">
                        <h4 class="mb-0">Registrasi Pelanggan</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="pelanggan" class="form-label">Nama Pelanggan</label>
                                <input type="text" name="pelanggan" id="pelanggan" required placeholder="Masukkan nama lengkap" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="Alamat" id="alamat" required placeholder="Masukkan alamat lengkap" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">No. Telepon</label>
                                <input type="text" name="Telp" id="telp" required placeholder="Masukkan nomor telepon" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" required placeholder="Masukkan email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" required placeholder="Masukkan password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="konfirmasi" id="konfirmasi" required placeholder="Konfirmasi password" class="form-control">
                            </div>
                            <button type="submit" name="simpan" class="btn btn-primary w-100">Daftar</button>
                        </form>
                        <div class="text-center mt-3">
                            <small class="text-muted">Sudah punya akun? <a href="login.php" class="text-decoration-none">Login disini</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['simpan'])) {
    $pelanggan =  $_POST['pelanggan'];
    $alamat =  $_POST['alamat'];
    $telp =  $_POST['telp'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];
    $level = $_POST['level'];
    if ($konfirmasi === $password) {
        $sql = "INSERT INTO tblpelanggan VALUES  ('','$pelanggan','$alamat','$telp','$email','$password',1)";
        $db->runSQL($sql);
        header("location:?f=home&m=info");
    } else {
        echo "<h3>PASSWORD  TIDAK SESUAI</h3>";
    }
}

?>