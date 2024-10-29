<?php
    $sekolah = ["MI DARUL HIKMAH ENTALSEWU", "SDN PAGERWOJO", "SMPN 1 SIDOARJO",  "SMKN 2 BUDURAN"];
    $sekolahs = ["TK" => "MI DARUL HIKMAH ENTALSEWU", "SD" => "SDN PAGERWOJO", "SMP" => "SMPN 1 SIDOARJO", "SMK" => "SMKN 2 BUDURAN", "PT" => "INSTITUT TEKNOLOGI BANDUNG"];
    $skills = ["C++" => "EXPERT", "HTML" => "NEWBIE", "CSS" => "NEWBIE", "PHP" => "INTERMEDIATE", "JAVASCRIPT" => "INTERMEDIATE",];
    $identitas = ["Nama" => "M. KAL'EL AKBAR AUFA P. E. Z.", "ALamat" => "Omah Pesona Buduran", "Status" => "PELAJAR", "No. Telp" => "081235500150", "Email" => "mkalelaufa@gmail.com"];
    $hobi = ["Coding" , "Musik", "Mancing", "Badminton"];

//     echo $sekolah[0];
//     echo "<br>";
//     echo $sekolahs["TK"];
//     echo "<br>";
//     echo $sekolah[1];
//     echo "<br>";
//     echo $sekolahs["SD"];
//     echo "<br>";
// echo "<br>";
//     for ($i=0; $i < 4 ; $i++) { 
//         echo $sekolah[$i];
//         echo "<br>";
//     }
// echo "<br>";
//     foreach ($sekolah as $joni) {
//         echo $joni;
//         echo "<br>";
//     }
// echo "<br>";
//     foreach ($sekolahs as $key => $value) {
//         echo $key;
//         echo " = ";
//         echo $value;
//         echo "<br>";
//     }
// echo "<br>";
//     foreach ($skills as $key => $value) {
//         echo $key;
//         echo " = ";
//         echo $value;
//         echo "<br>";
//     }

    if (isset($_GET['menu'])) {
        $menu = $_GET['menu'];
        echo $menu;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <hr>
    <ul>
        <li><a href="?menu=home">Home</a></li>
        <li><a href="?menu=cv">CV</a></li>
        <li><a href="?menu=project">Project</a></li>
        <li><a href="?menu=contact">Contact</a></li>
    </ul>
    <h2>Identitas</h2>
    <table border="">
        <thead>
            <tr>
                <th>Identitas</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($identitas as $key => $value) {
            ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>Riwayat Sekolah</h2>
    <table border="">
        <thead>
            <tr>
                <th>Jenjang</th>
                <th>Nama Sekolah</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($sekolahs as $key => $value) {
                    echo "<tr>";
                    echo "<td>".$key."</td>";
                    echo "<td>".$value."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>Skills</h2>
    <table border="">
        <thead>
            <tr>
                <th>Skill</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($skills as $key => $value) {
            ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <h2>Hobi</h2>
    <ul>
        <?php 
        foreach ($hobi as $key) {
        ?>
            <li><?= $key ?></li>
        <?php
        }
        ?>
    </ul>
</body>
</html>