<?php
$jumlahdata = $db->rowCOUNT("SELECT idkategori FROM tblkategori");
$banyak = 8;

$halaman =  ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM tblkategori ORDER BY kategori ASC LIMIT $mulai, $banyak";

$row = $db->getALL($sql);

$no = 1 + $mulai;

?>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Kategori</h1>
        <a href="?f=kategori&m=insert" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Tambah Kategori</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data Kategori</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($row)) { ?>
                            <?php foreach ($row as $r): ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $r['kategori'] ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="?f=kategori&m=update&id=<?php echo $r['idkategori'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            <a href="?f=kategori&m=delete&id=<?php echo $r['idkategori'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin akan menghapus data?')"><i class="fas fa-trash"></i></a>
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
                                <a class="page-link" href="?f=kategori&m=select&p=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } ?>
        </div>
    </div>
</div>