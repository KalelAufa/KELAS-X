<?php
// Dashboard untuk admin
// File ini akan ditampilkan saat admin pertama kali login

// Mengambil data statistik dari database
$sqlKategori = "SELECT COUNT(*) AS jumlah FROM tblkategori";
$sqlMenu = "SELECT COUNT(*) AS jumlah FROM tblmenu";
$sqlPelanggan = "SELECT COUNT(*) AS jumlah FROM tblpelanggan";
$sqlOrder = "SELECT COUNT(*) AS jumlah FROM tblorder";
$sqlUser = "SELECT COUNT(*) AS jumlah FROM tbluser";

$jumlahKategori = $db->getITEM($sqlKategori);
$jumlahMenu = $db->getITEM($sqlMenu);
$jumlahPelanggan = $db->getITEM($sqlPelanggan);
$jumlahOrder = $db->getITEM($sqlOrder);
$jumlahUser = $db->getITEM($sqlUser);
?>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Dashboard Admin</h1>

    <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6 col-xl-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Kategori</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="fa fa-list-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?php echo isset($jumlahKategori['jumlah']) ? $jumlahKategori['jumlah'] : 0; ?></h1>
                                <div class="mb-0">
                                    <a href="?f=kategori&m=select" class="text-muted">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Menu</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="fa fa-utensils"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?php echo isset($jumlahMenu['jumlah']) ? $jumlahMenu['jumlah'] : 0; ?></h1>
                                <div class="mb-0">
                                    <a href="?f=menu&m=select" class="text-muted">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Pelanggan</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?php echo isset($jumlahPelanggan['jumlah']) ? $jumlahPelanggan['jumlah'] : 0; ?></h1>
                                <div class="mb-0">
                                    <a href="?f=pelanggan&m=select" class="text-muted">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Order</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?php echo isset($jumlahOrder['jumlah']) ? $jumlahOrder['jumlah'] : 0; ?></h1>
                                <div class="mb-0">
                                    <a href="?f=order&m=select" class="text-muted">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Statistik Order Terbaru</h5>
                </div>
                <div class="card-body d-flex w-100">
                    <div class="align-self-center chart chart-lg">
                        <div class="text-center p-4">
                            <h5>Grafik Order Bulanan</h5>
                            <p class="text-muted">Grafik akan ditampilkan di sini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Menu Populer</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="text-center">
                                <h5>Daftar Menu Populer</h5>
                                <p class="text-muted">Daftar menu populer akan ditampilkan di sini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>