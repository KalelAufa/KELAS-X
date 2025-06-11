<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Tambah User</h1>
        <a href="?f=user&m=select" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Form Tambah User</h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="user" class="form-label">Nama User</label>
                            <input type="text" name="user" id="user" required class="form-control" placeholder="Masukkan nama user">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" required class="form-control" placeholder="Masukkan email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" required class="form-control" placeholder="Masukkan password">
                        </div>
                        <div class="mb-3">
                            <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi" id="konfirmasi" required class="form-control" placeholder="Konfirmasi password">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" id="level" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="koki">Koki</option>
                        <option value="kasir">Kasir</option>
                    </select>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" name="simpan" value="simpan" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $user = $_POST['user'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];
    $level = $_POST['level'];

    if ($password === $konfirmasi) {
        $sql = "INSERT INTO tbluser VALUES ('', '$user', '$email', '$password', '$level')";
        $db->runSQL($sql);
        echo "<script>window.location.href='?f=user&m=select';</script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Password tidak sama dengan konfirmasi!</div>";
    }
}
?>