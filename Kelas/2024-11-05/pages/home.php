<?php 
    $sql = "SELECT * FROM home";
    echo $sql;
    $hasil = mysqli_query($koneksi, $sql);
    while ($row = mysqli_fetch_array($hasil)) {
?>
<div class="home">
    <h1><?= $row[1] ?></h1>
    <p><?= $row[2] ?></p>
</div>
<?php 
    }
?>