<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbluser WHERE iduser=$id";
        $row = $db->getITEM($sql);
    }
?>

<h1>Update user</h1>
<div class="mb-3">
    <form action="" method="post">
        <div class="mt-2 mb-3 w-50">
            <label for="">Nama User</label>
            <input type="text" name="user" required value="<?php echo $row['user'] ?>" class="form-control">
        </div>
        <div class="mt-2 mb-3 w-50">
            <label for="">Email</label>
            <input type="email" name="email" required value="<?php echo $row['email'] ?>" class="form-control">
        </div>
        <div class="mt-2 mb-3 w-50">
            <label for="">Password</label>
            <input type="password" name="password" required value="<?php echo $row['password'] ?>" class="form-control">
        </div>
        <div class="mt-2 mb-3 w-50">
            <label for="">Konfirmasi Password</label>
            <input type="password" name="konfirmasi" required value="<?php echo $row['password'] ?>" class="form-control">
        </div>
        <div class="mt-2 w-50">
            <label for="">Level</label> <br>
            <select name="level" id="">
                <option value="admin" <?php if ($row['level']==="admin") {
                    echo "selected";
                } ?> >Admin</option>
                
                <option value="koki" <?php if ($row['level']==="koki") {
                    echo "selected";
                } ?> >Koki</option>
                
                <option value="kasir" <?php if ($row['level']==="kasir") {
                    echo "selected";
                } ?> >Kasir</option>
            </select>
        </div>
        <div>
            <input type="submit" name="simpan" value="simpan" class="mt-3 btn btn-primary">
        </div>
    </form>
</div>

<?php 

    if (isset($_POST['simpan'])) {
        $user =  $_POST['user'];
        $email =  $_POST['email'];
        $password = $_POST['password'];
        $konfirmasi = $_POST['konfirmasi'];
        $level = $_POST['level'];
        if ($konfirmasi === $password) {
            $sql = "UPDATE tbluser SET user = '$user', email = '$email', password = '$password', level = '$level' WHERE iduser = $id";
            echo $sql;
            $db->runSQL($sql);
            header("location:?f=user&m=select");
        }else {
            echo "<h3>PASSWORD  TIDAK SESUAI</h3>";
        }
    }

?>