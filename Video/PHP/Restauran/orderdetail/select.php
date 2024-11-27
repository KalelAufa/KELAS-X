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
    }else{
        $mulai = 0;
    }

    $sql = "SELECT * FROM vorderdetail ORDER BY idorderdetail DESC LIMIT $mulai, $banyak";
    if (isset($_POST['simpan'])) {
        $tawal = $_POST['tawal'];
        $takhir = $_POST['takhir'];
        $sql = "SELECT * FROM vorderdetail WHERE tglorder BETWEEN '$tawal' AND '$takhir' ";
    }

    $row = $db->getALL($sql);

    $no = 1+$mulai;
    $total = 0;

?>

<table class="table table-bordered w-70">
    <thead>
        <tr>
            <th>No</th>
            <th>pelanggan</th>
            <th>Tanggal</th>
            <th>Menu</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($row)) { ?>
        <?php foreach ($row as $r): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $r['pelanggan'] ?></td>
            <td><?= $r['tglorder'] ?></td>
            <td><?= $r['menu'] ?></td>
            <td><?= $r['harga'] ?></td>
            <td><?= $r['jumlah'] ?></td>
            <td><?= $r['jumlah'] * $r['harga'] ?></td>
            <td><?= $r['alamat'] ?></td>

            <?php 
                $total = $total + ($r['jumlah'] * $r['harga']);
            ?>
        </tr>
        <?php endforeach; ?>
        <?php }?>
        <tr>
            <td colspan="6"><h3>Grand Total</h3></td>
            <td><h4><?= $total ?></h4></td>
        </tr>
    </tbody>
</table>

<?php 

    for ($i=1; $i <= $halaman ; $i++) { 
    echo '<a href="?f=orderdetail&m=select&p='.$i.'">'.$i.'</a>';
    echo '&nbsp &nbsp &nbsp';
    }

?>