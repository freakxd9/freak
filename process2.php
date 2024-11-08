<?php
ini_set('memory_limit', '1024M');
ini_set('upload_max_filesize', '256M');
ini_set('post_max_size', '256M');
ini_set('max_input_time', '300');
ini_set('max_execution_time', '300');

class App {
    private static $instance = null;
    private $input_file_path = "";
    private $target_urls = "";
    private $user_key = "";
    private $status_message = "";

    private function __construct() {
        if (self::$instance !== null) {
            throw new Exception("Uygulama zaten başlatıldı. Tek bir örnek izin verilmektedir.");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["input_file_path"])) {
                $this->input_file_path = $_POST["input_file_path"];
            }
            if (isset($_POST["target_urls"])) {
                $this->target_urls = $_POST["target_urls"];
            }
            if (isset($_POST["user_key"])) {
                $this->user_key = $_POST["user_key"];
            }
            if (isset($_POST["start_processing"])) {
                $this->start_processing();
            }
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public function create_widgets() {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG EXTRACTOR</title>
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
            height: 450px;
            border-radius: 15px;
            box-shadow: 1px 1px 40px white;
        }
        label {
            color: white;
            font-family: Arial;
            margin-left: 83px;
        }
        label1 {
            color: white;
            font-family: Arial;
            margin-left: 219px;
        }
        h2 {
            color: white;
            font-family: Arial;
            margin-left: 130px;
        }
        h1 {
            color: white;
            font-family: Arial;
            margin-left: 74px;
            font-size: 29px;
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
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <br><br><br><br>
        <div class="kutu">
            <br><h1>Log Extractor</h1>
            <h2 for="input_file_path">Txt Logu Seçin:</h2>
            <input class="inputicinn" type="file" id="input_file_path" name="input_file_path" accept=".txt" required>
            <br><br><label for="target_urls">Çekmek İstediğiniz URL'ler (Virgülle Ayırarak):</label>
            <br><br><input class="inputicin" type="text" id="target_urls" name="target_urls" value="<?php echo htmlspecialchars($this->target_urls); ?>" required>
            <br><br><label1 for="user_key">Anahtar:</label1><br><br>
            <input class="inputicin" type="password" id="user_key" name="user_key" value="<?php echo htmlspecialchars($this->user_key); ?>" required>
            <br><br><button class="buton" type="submit" name="start_processing">BAŞLAT</button>
        </div>
    </form>
    <?php if (!empty($this->status_message)) : ?>
        <p class="status-message <?php echo strpos($this->status_message, 'başarıyla') !== false ? 'success' : ''; ?>"><?php echo $this->status_message; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
<?php
    }

    private function start_processing() {
    $target_urls = array_map('trim', explode(',', $this->target_urls));
    $user_key = $this->user_key;

    if ($user_key !== 'freak') {
        $this->status_message = "Geçersiz anahtar! Program sonlandırılıyor.";
        return;
    }

    try {
        $file_contents = file_get_contents($_FILES["input_file_path"]["tmp_name"]);

        $desktop_path = getenv("USERPROFILE") . "\\Desktop\\";

        foreach ($target_urls as $target_url) {
            $file_name = $target_url . '.txt';
            $output_file_path = $desktop_path . $file_name;
            $output_file_content = '';

            $lines = explode("\n", $file_contents);
            foreach ($lines as $line) {
                if (strpos($line, $target_url) !== false) {
                    $output_file_content .= $line . "\n";
                }
            }

            file_put_contents($output_file_path, $output_file_content);

            $this->status_message = "Çıktı başarıyla masaüstüne kaydedildi: " . $file_name;
        }

    } catch (Exception $e) {
        $this->status_message = "Hata: Dosya işleme sırasında bir sorun oluştu. Hata: {$e->getMessage()}";
    }
}


    public function render() {
        $this->create_widgets();
    }
}

$app = App::getInstance();
$app->render();
?>
