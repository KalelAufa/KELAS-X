<?php
$jumlahdata = $db->rowCOUNT("SELECT iduser FROM tbluser");
$banyak = 8;

$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM tbluser ORDER BY user ASC LIMIT $mulai, $banyak";
$row = $db->getALL($sql);
$no = 1 + $mulai;
?>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar User</h1>
        <a href="?f=user&m=insert" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Tambah User</a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data User</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($row as $r): ?>
                            <?php
                            if (isset($r['aktif'])) {
                                if ($r['aktif'] == 1) {
                                    $status = "<span class='badge bg-success'>AKTIF</span>";
                                } else {
                                    $status = "<span class='badge bg-danger'>NONAKTIF</span>";
                                }
                            } else {
                                $status = "<span class='badge bg-success'>AKTIF</span>";
                            }
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $r['user'] ?></td>
                                <td><?php echo $r['email'] ?></td>
                                <td><span class="badge bg-<?php echo ($r['level'] === 'admin') ? 'primary' : (($r['level'] === 'koki') ? 'success' : 'info'); ?>"><?php echo $r['level'] ?></span></td>
                                <td><?php echo $status ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="?f=user&m=update&id=<?php echo $r['iduser'] ?>" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit me-1"></i>Edit</a>
                                        <a href="?f=user&m=delete&id=<?php echo $r['iduser'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')"><i class="fas fa-trash me-1"></i>Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $halaman; $i++) : ?>
                                <li class="page-item <?php echo (isset($_GET['p']) && $_GET['p'] == $i) || (!isset($_GET['p']) && $i == 1) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?f=user&m=select&p=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>