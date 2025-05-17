<?php

$row = $db->getALL("SELECT * FROM tblkategori ORDER BY kategori ASC");

?>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Tambah Menu</h1>
        <a href="?f=menu&m=select" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Form Tambah Menu</h5>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idkategori" class="form-label">Kategori</label>
                            <select name="idkategori" id="idkategori" class="form-select">
                                <?php foreach ($row as $r): ?>
                                    <option value="<?php echo $r['idkategori'] ?>"><?php echo $r['kategori'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="menu" class="form-label">Nama Menu</label>
                            <input type="text" name="menu" id="menu" required placeholder="Masukkan nama menu" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga" id="harga" required placeholder="Masukkan harga" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control">
                            <div class="form-text">Pilih gambar dengan format JPG, PNG, atau JPEG</div>
                        </div>
                    </div>
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
    $idkategori = $_POST['idkategori'];
    $menu =  $_POST['menu'];
    $harga = $_POST['harga'];
    $gambar = $_FILES['gambar']['name'];
    $temp = $_FILES['gambar']['tmp_name'];

    if (empty($gambar)) {
        echo "<h3>GAMBAR KOSONG</h3>";
    } else {
        $sql = "INSERT INTO tblmenu VALUES  ('',$idkategori,'$menu','$gambar',$harga)";
        move_uploaded_file($temp, '../upload/' . $gambar);
        $db->runSQL($sql);
        header("location:?f=menu&m=select");
    }
}

?>