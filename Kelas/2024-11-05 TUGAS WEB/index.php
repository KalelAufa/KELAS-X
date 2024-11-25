<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>SMKN 2 Buduran Sidoarjo – "Unggul, Mumpuni, Berkarakter"</title>
</head>
<body class="wrapper">
    <div class="web-box">
        <div class="atas">
            <div class="container atss">
                <img src="https://www.smkn2buduran.sch.id/wp-content/uploads/2019/01/cropped-logo-text-kecil-5.png" alt="">
                <h6>"Unggul, Mumpuni, Berkarakter"</h6>
            </div>
        </div>
        <div class="container">
            <div class="header">
                <nav class="nav nav-bgc">
                        <div class="nav-C">
                            <ul>
                                <li class="nav-Itm"><a href="" class="nav-Link"><i class="fas fa-search"></i></a></li>
                                <li class="nav-Itm drop"><a href="#" class="nav-Link">Profil Sekolah
                                    <i class="fas fa-caret-down"></i>
                                    <ul class="drop-menu">
                                        <li class="drop-item "><a href="?menu=merpati">Sekolah "MERPATI"</a></li>
                                        <li class="drop=item"><a href="?menu=sejarah">Sejarah Sekolah</a></li>
                                        <li class="drop=item"><a href="?menu=sambutan">Sambutan Kepsek</a></li>
                                        <li class="drop=item"><a href="?menu=visimisi">Visi & Misi</a></li>
                                    </ul>
                                </a></li>
                                <li class="nav-Itm"><a href="?menu=kerjasama" class="nav-Link">Kerja Sama</a></li>
                                <li class="nav-Itm"><a href="?menu=tour" class="nav-Link">Tour Sekolah</a></li>
                                <li class="nav-Itm drop"><a href="#" class="nav-Link">Kosentrasi keahlian
                                    <i class="fas fa-caret-down"></i>
                                    <ul class="drop-menu">
                                        <li class="drop-item pt-2"><a href="?menu=rpl">RPL | Rekayasa Perangkat Lunak</a></li>
                                        <li class="drop=item"><a href="?menu=dkv">DKV | Desain Komunikasi Visual</a></li>
                                        <li class="drop=item"><a href="?menu=lp">LP | Layanan Perbankan </a></li>
                                        <li class="drop=item"><a href="?menu=ak">AK | Akuntansi</a></li>
                                        <li class="drop=item"><a href="?menu=mp">MP | Manajemen Perkantoran</a></li>
                                        <li class="drop=item"><a href="?menu=bd">BD | Bisnis Digital</a></li>
                                    </ul>
                                </a></li>
                                <li class="nav-Itm drop"><a href="#" class="nav-Link">Bidang
                                    <i class="fas fa-caret-down"></i>
                                    <ul class="drop-menu">
                                        <li class="drop-item pt-2"><a href="?menu=bkk">Bursa Kerja Khusus (BKK)</a></li>
                                        <li class="drop=item"><a href="?menu=lsp">LSP P1 SMKN 2 Buduran</a></li>
                                        <li class="drop=item"><a href="?menu=technopark">Technopark</a></li>
                                    </ul>
                                </a></li>
                                <li class="nav-Itm drop"><a href="#" class="nav-Link">Fitur-fitur
                                    <i class="fas fa-caret-down"></i>
                                    <ul class="drop-menu">
                                        <li class="drop-item pt-2"><a href="?menu=karyasiswa">Karya Siswa</a></li>
                                        <li class="drop-item"><a href="?menu=informasi">Informasi</a></li>
                                        <li class="drop-item"><a href="?menu=galeri">Galeri</a></li>
                                        <li class="drop-item"><a href="?menu=artikel">Artikel</a></li>
                                        <li class="drop-item"><a href="?menu=elearning">E-Learning</a></li>
                                    </ul>
                                </a></li>
                                <li class="nav-Itm drop"><a href="#" class="nav-Link">Administrasi
                                    <i class="fas fa-caret-down"></i>
                                    <ul class="drop-menu">
                                        <li class="drop-item pt-2"><a href="http://182.253.93.251:100/">DAPODIK</a></li>
                                        <li class="drop=item"><a href="http://182.253.93.251:200/">E-Raport</a></li>
                                        <li class="drop=item"><a href="http://182.253.93.251:300/">EDS-PMP</a></li>
                                    </ul>
                                </a></li>
                            </ul>
                        </div>
                </nav>
            </div>
            <div class="main">
                <div class="left">left</div>
                <div class="center">
                    <?php 
                        if (isset($_GET['menu'])) {
                            $menu = $_GET['menu'];
                            if ($menu == 'merpati'){
                                require_once('pages/profil/merpati.php');
                            }
                            if ($menu == 'sejarah') {
                                require_once('pages/profil/sejarah.php');
                            }
                            if ($menu == 'sambutan') {
                                require_once('pages/profil/sambutan.php');
                            }
                            if ($menu == 'visimisi') {
                                require_once('pages/profil/visimisi.php');
                            }
                            if ($menu == 'kerjasama') {
                                require_once('pages/KerjaSama/kerjasama.php');
                            }
                            if ($menu == 'tour') {
                                require_once('pages/Tour/tour.php');
                            }
                            if ($menu == 'rpl') {
                                require_once('pages/menu/rpl.php');
                            }
                            if ($menu == 'dkv') {
                                require_once('pages/menu/dkv.php');
                            }
                            if ($menu == 'lp') {
                                require_once('pages/menu/lp.php');
                            }
                            if ($menu == 'ak') {
                                require_once('pages/menu/ak.php');
                            }
                            if ($menu == 'mp') {
                                require_once('pages/menu/mp.php');
                            }
                            if ($menu == 'bd') {
                                require_once('pages/menu/bd.php');
                            }
                            if ($menu == 'bkk') {
                                require_once('pages/menu/bkk.php');
                            }
                            if ($menu == 'lsp') {
                                require_once('pages/menu/lsp.php');
                            }
                            if ($menu == 'technopark') {
                                require_once('pages/menu/technopark.php');
                            }
                            if ($menu == 'karyasiswa') {
                                require_once('pages/fitur/karyasiswa.php');
                            }
                            if ($menu == 'informasi') {
                                require_once('pages/fitur/informasi.php');
                            }
                            if ($menu == 'galeri') {
                                require_once('pages/fitur/galeri.php');
                            }
                            if ($menu == 'artikel') {
                                require_once('pages/fitur/artikel.php');
                            }
                            if ($menu == 'elearning') {
                                require_once('pages/fitur/elearning.php');
                            }
                        }else {
                            require_once('pages/home.php');
                        }
                    ?>
                </div>
                <div class="right">right</div>
            </div>
        </div>
        <div class="footer">
                <div class="fot-1">
                    <div class="fot-left">
                        <div class="fot-content">
                            <div class="image scl">
                                <img src="https://www.smkn2buduran.sch.id/wp-content/uploads/2019/01/cropped-logo-text-kecil-5.png" alt="">
                            </div>
                            <div class="txt">
                                <h6>SMKN 2 BUDURAN</h6>
                                <p>
                                    Jl. Jenggolo No.2A Siwalanpanji  Kec. Buduran <br>
                                    Kabupaten Sidoarjo, Jawa Timur 61219
                                </p>
                            </div>
                            <div class="txt">
                                <p>
                                    NPSN : 20501695 <br>
                                    Email : info@smkn2buduran.sch.id <br>
                                    No. Telp : (031) 8964034
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="fot-center">
                        <div class="fot-content">
                            
                        </div>
                    </div>
                    <div class="fot-right">
                        <div class="fot-content">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2525730087873!2d112.72019927487881!3d-7.437280692573597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e77ba09185a9%3A0x80a96e7778bba87d!2sState%20Professional%20School%202%20Buduran%20Sidoarjo!5e0!3m2!1sen!2sus!4v1731423405435!5m2!1sen!2sus" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="fot-2"></div>
        </div>
    </div>
    <script src="./Bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./Bootstrap/js/bootstrap.min.js"></script>
</body>
</html>