<?php
require_once '../koneksi.php';
if (!isset($_GET['id'])) {
    echo '<div class="alert alert-danger">ID pesanan tidak ditemukan.</div>';
    exit;
}
$id = intval($_GET['id']);
$sqlOrder = "SELECT * FROM vorder WHERE idorder=$id";
$order = $db->getITEM($sqlOrder);
$sqlDetail = "SELECT * FROM vorderdetail WHERE idorder=$id";
$row = $db->getALL($sqlDetail);
$total = 0;
?>
<div class="container-fluid p-0">
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
        </div>
    </div>
</div>