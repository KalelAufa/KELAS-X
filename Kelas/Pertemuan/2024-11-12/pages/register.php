<div class="register">
    <h1>Register</h1>
    <form action="" method="post">
        <input type="email" name="email" required placeholder="Masukkan Almaat Email">
        <input type="password" name="password" required placeholder="Masukkan Password"> 
        <input type="submit" name="register" value="register">
    </form>
</div>
<?php 
    if (isset($_POST['register'])) {
        $email = $_POST['email'];
        // echo $email;
        $password = $_POST['password'];
        // echo $password;
        $sql = "INSERT INTO customer (email, password) VALUES ('$email', '$password')";
        mysqli_query($koneksi, $sql);
        header("location:index.php?menu=login");
        echo $sql;
    }
?>