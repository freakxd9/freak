<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Url Silici</title>
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
            margin-top: 50px;
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
        <li><a href="/">🏠 Dashboard</a></li>
        <li><a href="process.php">📞 Tr Tell Pass Ayırıcı</a></li>
        <li><a href="process2.php">📄 Txt Log Extractor</a></li>
        <li><a href="process3.php">🔗 Url Silici</a></li>
        <li><a href="process4.php">📚 Duplicates Silici</a></li>
    </ul>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $inputFilePath = $_FILES['file']['tmp_name'];
    $outputFileName = !empty($_POST['output']) ? $_POST['output'] : 'output.txt';

    try {
        if (!is_uploaded_file($inputFilePath)) {
            throw new Exception("Dosya yüklenemedi.");
        }

        $desktopPath = getenv("USERPROFILE") . "\\Desktop\\";
        $outputFilePath = $desktopPath . $outputFileName;

        $file = fopen($inputFilePath, 'r');
        if (!$file) {
            throw new Exception("Dosya açılamadı.");
        }

        $resFile = fopen($outputFilePath, 'w');
        if (!$resFile) {
            fclose($file);
            throw new Exception("Çıkış dosyası açılamadı.");
        }

        while (($line = fgets($file)) !== false) {
            try {
                $line = trim($line);
                if (substr($line, -1) == ':') {
                    $cleanedLine = preg_replace('/\b(?:https?:\/\/)?(?:www\.)\S+\/\/\.www\b/', '', $line);
                    $parts = explode(':', $cleanedLine);
                    if (count($parts) >= 2) {
                        $username = trim($parts[count($parts) - 2]);
                        $password = trim($parts[count($parts) - 1]);
                        if ($username && $password) {
                            fwrite($resFile, "$username:$password\n");
                            echo "$username:$password<br>";
                        }
                    }
                } else {
                    $splitedLine = explode(' ', rtrim($line));
                    if (count($splitedLine) > 1) {
                        $data = $splitedLine[1];
                        list($username, $password) = explode(':', $data);
                        $username = trim($username);
                        $password = trim($password);
                    } else {
                        $splitedLine = explode(':', rtrim($line));
                        $username = trim($splitedLine[count($splitedLine) - 2]);
                        $password = trim($splitedLine[count($splitedLine) - 1]);
                    }

                    if ($username && $password) {
                        fwrite($resFile, "$username:$password\n");
                        echo "$username:$password<br>";
                    }
                }
            } catch (Exception $err) {
                echo "$line -> Hata verdi: " . $err->getMessage() . "<br>";
            }
        }

        fclose($file);
        fclose($resFile);
        echo "";

    } catch (Exception $e) {
        echo "Hata oluştu: " . $e->getMessage() . "<br>";
    }
} else {
?>
<div class="kutu">
    <form action="" method="post" enctype="multipart/form-data">
        <br><br><br><br><br>
        <h2 for="file">Silinecek Txt:</h2>
        <input class="inputicinn" type="file" name="file" id="file" accept=".txt">
        <br><br>
        <label for="output">Çıktı Dosyası Adı :</label><br><br>
        <input class="inputicin" type="text" name="output" id="output" placeholder="output.txt">
        <br><br>
        <input class="buton" type="submit" value="Başlat">
    </form>
</div>
<?php
}
?>
</body>
</html>
