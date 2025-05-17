<h3>Keranjang Belanja</h3>
<?php
if (isset($_GET['hapus'])) {
    $id =  $_GET['hapus'];
    unset($_SESSION['_' . $id]);
    header("Location:?f=home&m=beli");
}
if (isset($_GET['tambah'])) {
    $id =  $_GET['tambah'];
    $_SESSION['_' . $id]++;
    header("Location:?f=home&m=beli");
}
if (isset($_GET['kurang'])) {
    $id =  $_GET['kurang'];
    $_SESSION['_' . $id]--;
    header("Location:?f=home&m=beli");

    if ($_SESSION['_' . $id] == 0) {
        unset($_SESSION['_' . $id]);
    }
}
if (!isset($_SESSION['pelanggan'])) {
    header("location: ?f=home&m=login");
} else {
    if (isset($_GET['id'])) {
        $id =  $_GET['id'];
        isi($id);
        header("Location: ?f=home&m=beli");
    } else {
        keranjang();
    }
}
function isi($id)
{
    if (isset($_SESSION['_' . $id])) {
        $_SESSION['_' . $id]++;
    } else {
        $_SESSION['_' . $id] = 1;
    }
}

function keranjang()
{
    global $db;
    $total = 0;
    global $total;
    echo '<div class="row g-3">';
    foreach ($_SESSION as $key => $value) {
        if ($key <> 'pelanggan' && $key <> 'idpelanggan' && $key <> 'user' && $key <> 'level' && $key <> 'iduser') {
            $id = substr($key, 1);
            $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
            $row = $db->getALL($sql);
            foreach ($row as $r) {
                echo '<div class="col-12 mb-3">';
                echo '<div class="card shadow-sm">';
                echo '<div class="card-body">';
                echo '<div class="row align-items-center">';
                // Kolom 1: Nama Menu & Harga
                echo '<div class="col-12 col-md-4 mb-2 mb-md-0">';
                echo '<strong>' . $r['menu'] . '</strong><br>';
                echo '<span class="text-muted">Harga: <b>Rp ' . number_format($r['harga'], 0, ',', '.') . '</b></span>';
                echo '</div>';
                // Kolom 2: Jumlah + tombol
                echo '<div class="col-6 col-md-3 mb-2 mb-md-0">';
                echo '<div class="d-flex align-items-center">';
                echo '<a href="?f=home&m=beli&kurang=' . $r['idmenu'] . '" class="btn btn-sm btn-outline-secondary">-</a>';
                echo '<span class="mx-2">' . $value . '</span>';
                echo '<a href="?f=home&m=beli&tambah=' . $r['idmenu'] . '" class="btn btn-sm btn-outline-secondary">+</a>';
                echo '</div>';
                echo '</div>';
                // Kolom 3: Total harga per item
                echo '<div class="col-6 col-md-3 mb-2 mb-md-0">';
                echo '<b>Rp ' . number_format($r['harga'] * $value, 0, ',', '.') . '</b>';
                echo '</div>';
                // Kolom 4: Aksi hapus
                echo '<div class="col-12 col-md-2">';
                echo '<a href="?f=home&m=beli&hapus=' . $r['idmenu'] . '" class="btn btn-sm btn-danger">Hapus</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                $total = $total + ($value * $r['harga']);
            }
        }
    }
    echo '</div>';
    echo '<div class="mt-4 text-end">';
    echo '<h4 class="d-inline-block me-3 align-middle">GRAND TOTAL : <span class="badge bg-success fs-6">Rp ' . number_format($total, 0, ',', '.') . '</span></h4>';
    echo '</div>';
}
?>
<?php
if (!empty($total)) {
?>
    <div class="mt-3 text-end">
        <a class="btn btn-sm btn-primary px-3 py-1 fw-bold" href="?f=home&m=checkout&total=<?= $total ?>" role="button">CHECKOUT</a>
    </div>
<?php
}
?>