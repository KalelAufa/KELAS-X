<?php 
    $sql = "SELECT * FROM jadwal";
    echo $sql;
    $hasil = mysqli_query($koneksi, $sql);
    while ($row = mysqli_fetch_array($hasil)) {
?>
<div class="jadwal">
    <h1><?= $row[1] ?></h1>
    <p><?= $row[2] ?></p>
</div>
<?php 
    }
?>