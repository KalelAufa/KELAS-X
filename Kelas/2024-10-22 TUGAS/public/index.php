<?php 
    $identitas = ["M. KAL'EL AKBAR AUFA P. E. Z.", "Omah Pesona Buduran", "PELAJAR", "081235500150", "mkalelaufa@gmail.com"];
    $skill = ["HTML", "CSS", "PHP", "C++"];
    $sekolah = ["MI DARUL HIKMAH ENTALSEWU", "SDN PAGERWOJO", "SMPN 1 SIDOARJO",  "SMKN 2 BUDURAN"];
    $main = ["PROFIL", "EDUKASI", "TELEPON", "EMAIL", "ALAMAT", "SKILL", "HOBI"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/output.css">
    <title>TUGAS CURRICULUM VITAE</title>
    <style>
        @font-face {
            font-family: intro-black;
            src: url(../fonts/Intro/Intro\ Black\ Alt.otf);
        }
        @font-face {
            font-family: intro-bold;
            src: url(../fonts/Intro/Intro\ Bold\ Alt.otf);
        }
        @font-face {
            font-family: intro-light;
            src: url(../fonts/Intro/Intro\ Light\ Alt.otf);
        }
    </style>
</head>
<body class="text-gray-200 bg-gray-900">
    <div class="flex items-center justify-center p-4">
        <div class="w-full max-w-3xl bg-gray-800 shadow-lg rounded-xl">
            <div class="flex flex-col md:flex-row">
                <div class="flex items-center justify-center p-4 md:w-1/3">
                    <img src="../image/pp.jpeg" alt="foto profile" class="w-24 h-24 border-4 border-blue-500 rounded-full md:w-32 md:h-32">
                </div>
                <div class="flex flex-col items-center justify-center p-4 md:w-2/3 rounded-r-xl">
                    <h1 class="text-xl font-bold text-center text-white md:text-left" style="font-family:'intro-black';"><?=  $identitas[0] ?></h1>
                    <p class="text-sm text-center text-blue-400 md:text-left" style="font-family:'intro-bold';"><?=   $identitas[2] ?></p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="p-4 md:w-1/2">
                    <div class="mb-4">
                        <h1 class="font-bold text-pink-400" style="font-family: 'intro-bold';"><?= $main[0] ?></h1>
                        <p class="text-gray-300" style="font-family: 'intro-light';">
                            Saya adalah seorang pelajar berusia 16 tahun yang bersemangat dalam dunia teknologi dan pemrograman. 
                            Dengan rasa ingin tahu yang tinggi dan keinginan untuk terus belajar, saya selalu berusaha mengembangkan 
                            keterampilan dalam berbagai bahasa pemrograman dan teknologi web. Meskipun masih muda, saya memiliki 
                            tekad kuat untuk menjadi seorang pengembang web yang handal di masa depan.
                        </p>
                    </div>
                    <div>
                        <div>
                            <h1 class="font-bold text-pink-400" style="font-family: 'intro-bold';"><?= $main[1] ?></h1>
                            <ul class="ml-5 text-gray-300 list-disc" style="font-family: 'intro-light';">
                                <?php foreach($sekolah as $school): ?>
                                    <li><?= $school ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="p-4 md:w-1/2">
                    <div class="mb-4">
                        <h1 class="font-bold text-pink-400" style="font-family: 'intro-bold';"><?= $main[5] ?></h1>
                        <div class="ml-3">
                            <?php 
                                $skills_percentage = [75, 50, 45, 55];
                                foreach ($skill as $index => $skill_name): 
                            ?>
                                <p class="text-gray-300" style="font-family: 'intro-light';"><?= $skill[$index] ?></p>
                                <div class="w-full bg-gray-600 rounded-full">
                                    <div class="text-center text-white bg-blue-500 rounded-full" style="width:<?= $skills_percentage[$index] ?>%;"><?= $skills_percentage[$index] ?>%</div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div>
                        <h1 class="font-bold text-pink-400" style="font-family: 'intro-bold';"><?= $main[6] ?></h1>
                        <ul class="ml-5 text-gray-300 list-disc" style="font-family: 'intro-light';">
                            <li>Belajar Bahasa Pemrograman</li>
                            <li>Badminton</li>
                            <li>Mendengarkan Musik</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-4 md:flex md:flex-row md:gap-10">
                <div class="flex items-center gap-2 mb-2">
                    <div class="mr-2">
                        <img src="../image/telpon.png" alt="logo" class="w-6 h-6 scale-110">
                    </div>
                    <div>
                        <h1 class="font-bold text-pink-400" style="font-family: 'intro-bold';"><?= $main[2] ?></h1>
                        <p class="text-gray-300" style="font-family: 'intro-light';"><?= $identitas[3] ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-2 mb-2">
                    <div class="mr-2">
                        <img src="../image/lokasi.png" alt="logo" class="w-6 h-6 scale-125">
                    </div>
                    <div>
                        <h1 class="font-bold text-pink-400" style="font-family: 'intro-bold';"><?= $main[3] ?></h1>
                        <p class="text-gray-300" style="font-family: 'intro-light';"><?= $identitas[1] ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="mr-2">
                        <img src="../image/email2.png" alt="logo" class="w-6 h-6 scale-150">
                    </div>
                    <div>
                        <h1 class="font-bold text-pink-400" style="font-family: 'intro-bold';"><?= $main[4] ?></h1>
                        <p class="text-gray-300" style="font-family: 'intro-light';"><?= $identitas[4] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>