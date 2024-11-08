<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XX GİRİŞ SEKMESİ</title>
    <!-- Bootstrap CSS -->
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
        .yanlis {
            color: white;
            text-align: center;
            background-color: rgba(255, 0, 0, 0.58);
            width: 230px;
            border-radius: 10px;
            font-size: 16px;
            font-family: Arial;
            box-shadow: 1px 1px 6px #8B0000;
            margin-left: 130px;
        }
        label {
            color: white;
            font-family: Arial;
            margin-left: 215px;
        }
        h2 {
            color: white;
            font-family: Arial;
            margin-left: 185px;
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
        asdasd {
            color: white;
            text-shadow: 1px 1px 5px black;
            font-family: Verdana;
            padding: 20px;
            border-radius: 15px;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <br><br><br><br><br>
        <div class="kutu">
            <br><br>
            <div class="yanlis">
        <?php
session_start();

$correct_key = 'crackturkey';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'];

    if ($key === $correct_key) {
        $_SESSION['authenticated'] = true;
        header('Location: index.php');
        exit;
    } else {
        echo 'Yanlış anahtar. Lütfen tekrar deneyin.';
    }
}
?>
</div>
        <br><br><h2 class="text-center">XX GİRİŞ</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="key">Auth Key:</label><br><br>
                    <input class="inputicin" type="password" name="key" id="key" class="form-control" required>
                </div>
                <br><button class="buton" type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
