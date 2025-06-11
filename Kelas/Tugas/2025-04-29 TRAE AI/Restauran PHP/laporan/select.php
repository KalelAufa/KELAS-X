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

// Filter berdasarkan tanggal jika ada
$where = "";
if (isset($_POST['tgl_mulai']) && isset($_POST['tgl_akhir'])) {
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_akhir = $_POST['tgl_akhir'];

    if (!empty($tgl_mulai) && !empty($tgl_akhir)) {
        $where = "WHERE tglorder BETWEEN '$tgl_mulai' AND '$tgl_akhir'";
    }
}

$sql = "SELECT * FROM vorder $where ORDER BY tglorder DESC LIMIT $mulai, $banyak";
$row = $db->getALL($sql);

// Hitung total pendapatan
$sqlTotal = "SELECT SUM(total) as total_pendapatan FROM vorder $where WHERE status = 1";
$rowTotal = $db->getITEM($sqlTotal);
$totalPendapatan = $rowTotal['total_pendapatan'] ?? 0;

$no = 1 + $mulai;
?>

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Laporan Penjualan</h1>
        <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print me-2"></i>Cetak Laporan</button>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Filter Laporan</h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="<?php echo isset($_POST['tgl_mulai']) ? $_POST['tgl_mulai'] : '' ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" value="<?php echo isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '' ?>">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-2"></i>Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Pendapatan</h5>
                    <h2 class="text-primary">Rp. <?php echo number_format($totalPendapatan, 0, ',', '.') ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Data Penjualan</h5>
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
                                <?php
                                if ($r['status'] == 0) {
                                    $status = '<span class="badge bg-warning">Belum Bayar</span>';
                                    $aksi = '<a href="?f=order&m=bayar&id=' . $r['idorder'] . '" class="btn btn-sm btn-success"><i class="fas fa-money-bill-wave"></i></a>';
                                } else {
                                    $status = '<span class="badge bg-success">Lunas</span>';
                                    $aksi = '<a href="?f=orderdetail&m=select&id=' . $r['idorder'] . '" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $r['pelanggan'] ?></td>
                                    <td><?php echo $r['tglorder'] ?></td>
                                    <td>Rp. <?php echo number_format($r['total'], 0, ',', '.') ?></td>
                                    <td>Rp. <?php echo number_format($r['bayar'], 0, ',', '.') ?></td>
                                    <td>Rp. <?php echo number_format($r['kembali'], 0, ',', '.') ?></td>
                                    <td><?php echo $status ?></td>
                                    <td><?php echo $aksi ?></td>
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
                                <a class="page-link" href="?f=laporan&m=select&p=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } ?>
        </div>
    </div>
</div>

<style>
    @media print {

        .navbar,
        .btn,
        .pagination,
        .card-header,
        form,
        .no-print {
            display: none !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>