<h3>Detail Pembelian</h3>
<div class="">
    <form action="" method="post">
        <div class=" w-50 float-start">
            <label for="" class="mb-3">Tanggal Awal</label>
            <input type="date" name="tawal" required class="form-control">
        </div>
        <div class=" w-50 float-start">
            <label for="" class="mb-3">Tanggal Akhir</label>
            <input type="date" name="takhir" required class="form-control">
        </div>
        <div>
            <input type="submit" name="simpan" value="Cari" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>
<?php
$jumlahdata = $db->rowCOUNT("SELECT idorderdetail FROM vorderdetail");
$banyak = 3;

$halaman =  ceil($jumlahdata / $banyak);

if (isset($_GET['p'])) {
    $p = $_GET['p'];
    $mulai = ($p * $banyak) - $banyak;
} else {
    $mulai = 0;
}

$sql = "SELECT * FROM vorderdetail ORDER BY idorderdetail DESC LIMIT $mulai, $banyak";
if (isset($_POST['simpan'])) {
    $tawal = $_POST['tawal'];
    $takhir = $_POST['takhir'];
    $sql = "SELECT idorder, tglorder, pelanggan, SUM(harga * jumlah) as subtotal FROM vorderdetail WHERE tglorder BETWEEN '$tawal' AND '$takhir' GROUP BY idorder, tglorder, pelanggan ORDER BY tglorder DESC";
    $row = $db->getALL($sql);
?>
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Rekap Transaksi</h1>
            <a href="?f=orderdetail&m=select" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Daftar Transaksi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($row)) {
                                $no = 1;
                                foreach ($row as $r): ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $r['tglorder'] ?></td>
                                        <td><?php echo $r['pelanggan'] ?></td>
                                        <td>Rp. <?php echo number_format($r['subtotal'], 0, ',', '.') ?></td>
                                        <td><a href="?f=orderdetail&m=select&id=<?php echo $r['idorder'] ?>" class="btn btn-info btn-sm"><i class="fas fa-info-circle me-1"></i> Detail</a></td>
                                    </tr>
                                <?php endforeach;
                            } else { ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada transaksi pada rentang tanggal ini.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
    return;
}
$row = $db->getALL($sql);

$no = 1 + $mulai;
$total = 0;

?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM vorder WHERE idorder=$id";
    $order = $db->getITEM($sql);

    $sqlDetail = "SELECT * FROM vorderdetail WHERE idorder=$id";
    $row = $db->getALL($sqlDetail);

    $no = 1;
    $total = 0;
?>
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Detail Pesanan</h1>
            <a href="?f=order&m=select" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Pesanan</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="30%"><strong>No. Pesanan</strong></td>
                                <td>: <?php echo $id ?></td>
                            </tr>
                            <?php if (isset($order)) { ?>
                                <tr>
                                    <td><strong>Pelanggan</strong></td>
                                    <td>: <?php echo $order['pelanggan'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <td>: <?php echo $order['tglorder'] ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>: <?php echo ($order['status'] == 1) ? '<span class="badge bg-success">Lunas</span>' : '<span class="badge bg-warning">Belum Bayar</span>' ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Item Pesanan</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 flex-column">
                    <?php if (!empty($row)) {
                        $no = 1;
                        $total = 0; ?>
                        <?php foreach ($row as $r): ?>
                            <?php $subtotal = $r['harga'] * $r['jumlah'];
                            $total += $subtotal; ?>
                            <div class="col-12 mb-1">
                                <div class="d-flex align-items-center gap-4">
                                    <span><strong><?php echo $r['menu'] ?></strong></span>
                                    <span>Harga: Rp. <?php echo number_format($r['harga'], 0, ',', '.') ?></span>
                                    <span>Jumlah: <?php echo $r['jumlah'] ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-12 mt-3">
                            <div class="alert alert-primary text-end">
                                <strong>Subtotal: Rp. <?php echo number_format($total, 0, ',', '.') ?></strong>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-12">
                            <div class="alert alert-info">Tidak ada item dalam keranjang.</div>
                        </div>
                    <?php } ?>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print me-2"></i>Cetak</button>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="container-fluid p-0">
        <div class="alert alert-info">Silakan pilih pesanan untuk melihat detail.</div>
    </div>
<?php } ?>

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

    .card-body .card {
        margin-bottom: 0;
    }
</style>

<?php

for ($i = 1; $i <= $halaman; $i++) {
    echo '<a href="?f=orderdetail&m=select&p=' . $i . '">' . $i . '</a>';
    echo '&nbsp &nbsp &nbsp';
}

?>
<!-- Modal Detail Pesanan -->
<div class="modal fade" id="modalDetailPesanan" tabindex="-1" aria-labelledby="modalDetailPesananLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailPesananLabel">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalDetailContent">
                <div class="text-center py-5">
                    <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Kode modal dan AJAX dihapus
</script>