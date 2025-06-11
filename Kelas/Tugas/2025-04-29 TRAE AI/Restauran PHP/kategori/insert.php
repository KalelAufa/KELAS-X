<h3>Insert Kategori</h3>
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Tambah Kategori</h1>
        <a href="?f=kategori&m=select" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Form Tambah Kategori</h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="kategori" class="form-label">Nama Kategori</label>
                    <input type="text" name="kategori" id="kategori" required placeholder="Masukkan nama kategori" class="form-control">
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
    $kategori =  $_POST['kategori'];
    $sql = "INSERT INTO tblkategori VALUES  ('','$kategori')";

    $db->runSQL($sql);

    header("location:?f=kategori&m=select");
}

?>