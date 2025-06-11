<?php 
    if (!isset($_SESSION['email'])) {
        header('Location: index.php?menu=login');
    }
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        unset($_SESSION['cart'][$id]);
        header('Location: index.php?menu=cart');
    }

    $cart = count($_SESSION['cart']);
    if ($cart == 0) {
        header("loaction: index.php?");
    }

    if (isset($_GET['add'])) {
        $id = $_GET['add'];
        $sql = "SELECT * FROM product WHERE id = $id";
        $hasil = mysqli_query($koneksi, $sql);
        $row = mysqli_fetch_assoc($hasil);
        echo $row['id'];
        echo $row['product'];
        echo $row['harga'];
        $_SESSION['cart'][$row ['id']] = [
            "id" => $row['id'],
            "product" => $row['product'],
            "harga" => $row['harga'],
            "quantity" => isset($_SESSION['cart'][$row ['id']]) ? $_SESSION['cart'][$row['id']]['quantity'] + 1 : 1,
        ];
    }
?>
<div class="cart">
    <h1>Cart</h1>
    <table border="" style="width: 30rem;">
        <thead>
            <tr>
                <th>No</th>
                <th>Product</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Hapus</th>
            </tr>
            <tbody>
                <?php 
                $no = 1;
                    foreach ($_SESSION['cart'] as $key) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $key['product']; ?></td>
                                <td><?= $key['harga']; ?></td>
                                <td><?= $key['quantity']; ?></td>
                                <td><?= $key['quantity'] * $key['harga']; ?></td>
                                <td><a href="?menu=cart&hapus=<?= $key['id']; ?>">Hapus</a></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </thead>
    </table>
</div>