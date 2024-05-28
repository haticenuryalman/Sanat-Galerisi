<?php
session_start();
// Veritabanı bağlantısı için gerekli bilgiler
$servername = "localhost";
$username = "dbusr20360859011";
$password = "1UGK8txiBUro";
$dbname = "dbstorage20360859011";

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alın
    $staff_username = $_POST['staff_username'];
    $staff_password = $_POST['staff_password'];

    // Veritabanı bağlantısını oluşturun
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantıyı kontrol etme
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Kullanıcıyı veritabanından sorgulama
    $sql = "SELECT * FROM staff WHERE staff_username='$staff_username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Kullanıcı adı doğrulandı, şifreyi kontrol et
        $row = $result->fetch_assoc();
        if (password_verify($staff_password, $row['staff_password'])) {
            // Şifre doğrulandı, oturumu başlat ve yönlendir
            $_SESSION['username'] = $staff_username;
            // Yönetici paneline yönlendir
            header('Location: index.php');
            exit();
        } else {
            // Şifre hatalı
            echo "Hatalı şifre.";
        }
    } else {
        // Kullanıcı bulunamadı
        echo "Kullanıcı bulunamadı.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Girişi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff	 ; /* Haki rengi */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px; /* Container'ı biraz daha büyüttük */
            margin: 135px auto;
            padding: 100px;
            background-color: #ffffff;
            border-radius: 12px; /* Kenarları yuvarlattık */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Gölgelendirme */
            border: 2px solid #e52b50; /* Kenarlık kalınlığı ve rengi */
            height: auto;
        }
        h2 {
            text-align: center;
            color: #000000; /* Yazı rengini pembe olarak değiştirdik */
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #000000; /* Etiket rengini de pembe yaptık */
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #e52b50; /* Buton rengini pembe yaptık */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #e52b50; /* Butonun hover rengini biraz daha koyu pembe yaptık */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Yönetici Girişi</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="staff_username">Kullanıcı Adı:</label>
            <input type="text" id="staff_username" name="staff_username" required>

            <label for="staff_password">Şifre:</label>
            <input type="password" id="staff_password" name="staff_password" required>

        <input type="submit" value="Giriş Yap">
    </form>
    </div>
</body>
</html>
