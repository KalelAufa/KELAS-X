<?php 
    if (isset($_GET['total'])) {
        $total = $_GET['total'];
        $idorder = idorder();
        $idpelanggan = $_SESSION['idpelanggan'];
        $tgl = date('Y-m-d');
        // insertOrder($idorder, $idpelanggan, $tgl, $total);
        insertOrderDetail();
    }

    function idorder(){
        global $db;
        $sql = "SELECT idorder FROM tblorder ORDER BY idorder DESC";
        $jumlah = $db->rowCOUNT($sql);
        if ( $jumlah == 0 ){
            $id = 1;
        }else {
            $item = $db->getITEM($sql);
            $id = $item['idorder'] + 1;
        }
        return $id;
    }
    function insertOrder($idorder, $idpelanggan, $tgl, $total){
        global $db;
        $sql = "INSERT INTO tblorder VALUES ($idorder, $idpelanggan, '$tgl', $total,0,0,0)";
        $db->runSQL($sql);
    }
    function insertOrderDetail($idorder = 1){
        global $db;
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'idpelanggan') {
                $id = substr($key,1);
                $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
                $row = $db->getALL($sql);

                foreach ($row as $r) {
                    $sql = "INSERT INTO tblorderdetail VALUES ($idorder, $r[idmenu], $r[harga], $value)";
                    $db->runSQL($sql);
                }

                echo '<pre>';
                print_r($row);
                echo '</pre>';
            }
        }
    }
?>