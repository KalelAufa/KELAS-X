<?php
$email = $_SESSION['pelanggan'];
$jumlahdata = $db->rowCOUNT("SELECT idorder FROM vorder WHERE email = '$email'");
$banyak = 4;

$halaman =  ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM vorder WHERE email = '$email' ORDER BY tglorder DESC LIMIT $mulai, $banyak";

$row = $db->getALL($sql);

$no = 1 + $mulai;
?>
<h3 class="mb-3 text-center fw-bold fs-5">History Pembelian</h3>
<div class="container mb-3">
    <div class="row justify-content-center">
        <?php if (!empty($row)) { ?>
            <?php foreach ($row as $r): ?>
                <div class="col-12 col-md-8 mb-2">
                    <div class="card shadow-sm rounded-3 border-0 h-100">
                        <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 p-2">
                            <div class="mb-1 mb-md-0">
                                <div class="fw-bold fs-6 mb-1">No: <?php echo $no++ ?></div>
                                <div class="text-muted mb-1" style="font-size:0.95rem;">Tanggal: <span class="fw-semibold"><?php echo $r['tglorder'] ?></span></div>
                                <div style="font-size:0.98rem;">Total: <span class="fw-semibold text-success">Rp <?php echo number_format($r['total'], 0, ',', '.') ?></span></div>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="?f=home&m=detail&id=<?php echo $r['idorder'] ?>" class="btn btn-primary btn-sm px-3 shadow-sm">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } else { ?>
            <div class="col-12 col-md-8">
                <div class="alert alert-info text-center mb-0">Belum ada riwayat pembelian.</div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="d-flex justify-content-center mb-3">
    <nav>
        <ul class="pagination pagination-sm">
            <?php for ($i = 1; $i <= $halaman; $i++) { ?>
                <li class="page-item<?php if (isset($_GET['p']) && $_GET['p'] == $i) echo ' active'; ?>">
                    <a class="page-link rounded-2 mx-1 shadow-sm" style="font-size:0.95rem; padding:4px 12px;" href="?f=home&m=history&p=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>