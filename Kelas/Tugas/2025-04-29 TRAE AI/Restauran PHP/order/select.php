<?php
$jumlahdata = $db->rowCOUNT("SELECT idorder FROM vorder");
$banyak = 8;

$halaman = ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM vorder ORDER BY status,idorder ASC LIMIT $mulai, $banyak";

$row = $db->getALL($sql);

$no = 1 + $mulai;

?>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Daftar Pesanan</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data Pesanan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($row)) { ?>
                            <?php foreach ($row as $r): ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $r['pelanggan'] ?></td>
                                    <td><?php echo $r['tglorder'] ?></td>
                                    <td>Rp. <?php echo number_format($r['total'], 0, ',', '.') ?></td>
                                    <td>Rp. <?php echo number_format($r['bayar'], 0, ',', '.') ?></td>
                                    <td>Rp. <?php echo number_format($r['kembali'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php if ($r['status'] == 0): ?>
                                            <span class="badge bg-warning">Belum Bayar</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if ($r['status'] == 0): ?>
                                                <a href="?f=order&m=bayar&id=<?php echo $r['idorder'] ?>" class="btn btn-sm btn-success"><i class="fas fa-money-bill-wave"></i></a>
                                            <?php endif; ?>
                                            <a href="?f=orderdetail&m=select&id=<?php echo $r['idorder'] ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
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
                                <a class="page-link" href="?f=order&m=select&p=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } ?>
        </div>
    </div>
</div>

<?php

for ($i = 1; $i <= $halaman; $i++) {
    echo '<a href="?f=order&m=select&p=' . $i . '">' . $i . '</a>';
    echo '&nbsp &nbsp &nbsp';
}

?>