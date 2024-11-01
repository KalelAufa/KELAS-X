<?php 
    if (!isset($_SESSION['pelanggan'])) {
        header("location: ?f=home&m=login");
    }
    if (isset($_GET['id'])) {
        $id =  $_GET['id'];
        echo $id;
        echo "<br>";

        if (isset($_SESSION['_'.$id])) {
            $_SESSION['_'.$id]++;
        }else {
            $_SESSION['_'.$id] = 1;
        }
        foreach ($_SESSION as $key => $value) {
            if ($key<>'pelanggan' && $key<>'idpelanggan') {
                $id = substr($key,1);
                $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
                $row = $db->getALL($sql);
                foreach ($row as $r) {
                    echo $r['menu'];
                    echo "<br>";
                }
                echo $sql.'-'.$value ;
                echo "<br>";
            }
        }
    }
?>