<div class="float-start mt-4">
</div>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Menu</h1>
        <a href="?f=menu&m=insert" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Tambah Menu</a>
    </div>

    <?php
    if (isset($_POST['opsi'])) {
        $opsi = $_POST['opsi'];
        $where = "WHERE idkategori = $opsi";
    } else {
        $opsi = 0;
        $where = "";
    }
    ?>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Filter Kategori</h5>
        </div>
        <div class="card-body">
            <?php
            $row = $db->getALL("SELECT * FROM tblkategori ORDER BY kategori ASC");
            ?>
            <form action="" method="post">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="opsi" class="form-label">Pilih Kategori</label>
                        <select name="opsi" id="opsi" class="form-select" onchange="this.form.submit()">
                            <option value="0">Semua Kategori</option>
                            <?php foreach ($row as $r): ?>
                                <option <?php if ($r['idkategori'] == $opsi) echo "selected" ?> value="<?php echo $r['idkategori'] ?>"><?php echo $r['kategori'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    $jumlahdata = $db->rowCOUNT("SELECT idmenu FROM tblmenu $where");
    $banyak = 6;

    $halaman = ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    } else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM tblmenu $where ORDER BY menu ASC LIMIT $mulai, $banyak";

    $row = $db->getALL($sql);

    $no = 1 + $mulai;
    ?>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data Menu</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($row)) { ?>
                            <?php foreach ($row as $r): ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $r['menu'] ?></td>
                                    <td>Rp. <?php echo number_format($r['harga'], 0, ',', '.') ?></td>
                                    <td><img class="img-thumbnail" style="width:100px" src="../upload/<?php echo $r['gambar'] ?>" alt="<?php echo $r['menu'] ?>"></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="?f=menu&m=update&id=<?php echo $r['idmenu'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            <a href="?f=menu&m=delete&id=<?php echo $r['idmenu'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin akan menghapus data?')"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php if ($halaman > 1) { ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-3">
                        <?php for ($i = 1; $i <= $halaman; $i++) { ?>
                            <li class="page-item <?php if ($i == @$_GET['p']) echo 'active'; ?>">
                                <a class="page-link" href="?f=menu&m=select&p=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } ?>
        </div>
    </div>
</div>
?>