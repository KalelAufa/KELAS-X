<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbluser WHERE iduser=$id";
    $row = $db->getITEM($sql);
}
?>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Update User</h1>
        <a href="?f=user&m=select" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Form Update User</h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="user" class="form-label">Nama User</label>
                            <input type="text" name="user" id="user" required value="<?php echo $row['user'] ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" required value="<?php echo $row['email'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" required value="<?php echo $row['password'] ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi" id="konfirmasi" required value="<?php echo $row['password'] ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" id="level" class="form-select">
                        <option value="admin" <?php if ($row['level'] === "admin") echo "selected"; ?>>Admin</option>
                        <option value="koki" <?php if ($row['level'] === "koki") echo "selected"; ?>>Koki</option>
                        <option value="kasir" <?php if ($row['level'] === "kasir") echo "selected"; ?>>Kasir</option>
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
    $user =  $_POST['user'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];
    $level = $_POST['level'];
    if ($konfirmasi === $password) {
        $sql = "UPDATE tbluser SET user = '$user', email = '$email', password = '$password', level = '$level' WHERE iduser = $id";
        echo $sql;
        $db->runSQL($sql);
        header("location:?f=user&m=select");
    } else {
        echo "<h3>PASSWORD  TIDAK SESUAI</h3>";
    }
}

?>