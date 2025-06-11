<?php
include_once 'header.php';
if (isset($_GET['f']) && isset($_GET['m'])) {
    $f = $_GET['f'];
    $m = $_GET['m'];
    $file = $f . '/' . $m . '.php';
    if (file_exists($file)) {
        require_once $file;
    } else {
        require_once "pages/front.php";
    }
} else {
    require_once "pages/front.php";
}
include_once 'footer.php';
?>