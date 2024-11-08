<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');
    exit;
}

function detect_encoding($filename) {
    $contents = file_get_contents($filename);
    $encoding = mb_detect_encoding($contents, mb_list_encodings(), true);
    return $encoding ?: 'UTF-8';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $source_file = $_FILES['source_file']['tmp_name'];
    $target_file = basename($_POST['target_file']);
    
    $user_profile = getenv('USERPROFILE');
    $desktop_dir = $user_profile . '\\Desktop\\';

    $target_path = $desktop_dir . $target_file;

    if (is_uploaded_file($source_file)) {
        $encoding = detect_encoding($source_file);

        $regex = '/(https?:\/\/\S+):((05\d{9})|(5\d{9})):([^:\s]+)/';
        $clean_data = [];

        $handle = fopen($source_file, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = mb_convert_encoding($line, 'UTF-8', $encoding);
                if (preg_match_all($regex, $line, $matches, PREG_SET_ORDER)) {
                    foreach ($matches as $match) {
                        $phone = $match[2];
                        $password = $match[5];
                        $clean_data[] = "$phone:$password\n";
                    }
                }
            }
            fclose($handle);
        } else {
            echo "Dosya okunamadı.";
            exit;
        }

        file_put_contents($target_path, $clean_data);

        echo "İşlem tamamlandı. Temizlenmiş veri '$target_path' dosyasına kaydedildi.";
    } else {
        echo "Dosya yüklenemedi.";
    }
} else {
    // Dosya seçimi formu
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tr Tell Pass Ayırıcı</title>
    <style>
    .inputicin {
        background-color: white;
        border-radius: 15px;
        font-size: 15px;
        width: 180px;
        height: 23px;
        margin-left: 154px;
    }
    .inputicinn {
        background-color: white;
        border-radius: 15px;
        font-size: 15px;
        width: 240px;
        height: 23px;
        margin-left: 126px;
    }
    .kutu {
        background-color: rgba(0, 0, 0, 0.5);
        width: 500px;
        height: 400px;
        border-radius: 15px;
        box-shadow: 1px 1px 40px white;
    }
    label {
        color: white;
        font-family: Arial;
        margin-left: 148px;
    }
    h2 {
        color: white;
        font-family: Arial;
        margin-left: 175px;
    }
    body {
        justify-content: center;
        display: flex;
        align-items: center;
        background-color: black;
        background-image: url(https://media.istockphoto.com/id/537761159/photo/human-skull.jpg?s=612x612&w=0&k=20&c=yu6S06Fhrb5aOWbdWlIeEUppgXC4_luoYpL4-ZXR6NQ=);
        background-size: 150px;
    }
    .buton {
        color: black;
        background-color: grey;
        text-align: center;
        border-style: none;
        border-radius: 50px;
        font-size: 18px;
        width: 180px;
        height: 40px;
        margin-left: 160px;
        transition: 390ms;
    }
    .buton:hover {
        box-shadow: 1px 1px 15px white;
    }
    .sidebar {
        width: 250px;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        background-color: black;
        overflow-x: hidden;
        padding-top: 20px;
        font-family: Arial;
        font-size: 20px;
        border-right: 1px solid #fff;
    }

    .menu {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .menu li {
        padding: 10px 15px;
        border-bottom: 1px solid #ccc;
    }

    .menu li a {
        text-decoration: none;
        color: #fff;
        display: block;
        padding: 10px;
    }

    .menu li a:hover {
        background-color: #ddd;
        color: #000;
    }
    h3 {
        color: white;
        font-family: Arial;
        font-size: 25px;
    }
</style>
</head>
<body>
<div class="sidebar">
<ul class="menu">
    <a style="color: white;">☰ Menü</a>
    <button type="button" class="btn btn-lg btn-lg-square btn-primary m-2"><i class="fa fa-home"></i></button>
    <li><a href="process.php">📞 Tr Tell Pass Ayırıcı</a></li>
    <li><a href="process2.php">📄 Txt Log Extractor</a></li>
    <li><a href="process3.php">🔗 Url Silici</a></li>
    <li><a href="process4.php">📚 Duplicates Silici</a></li>
</ul>
</div>
</style>
</head>
<body>
    <div class="container">
    <br><br><br><br>
        <div class="kutu">
        <br><br>
            <h2 class="text-center">TR TELL:PASS AYIRICI</h2>
            <form action="process.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="source_file">Dosyayı Seçin:</label><br><br>
                    <input class="inputicinn" type="file" name="source_file" id="source_file" class="form-control" required>
                </div>
                <div class="form-group">
                <br><label for="target_file">Hedef dosya adı (örn: tellpass.txt):</label>
                <br><br><input class="inputicin" type="text" name="target_file" id="target_file" class="form-control" required>
                </div>
                <br><br><button class="buton" type="submit" class="btn btn-custom btn-block">BAŞLAT</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>';
}
?>
