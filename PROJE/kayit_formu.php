<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı için gerekli bilgiler
$servername = "localhost";
$db_username = "dbusr20360859011";
$password = "1UGK8txiBUro";
$dbname = "dbstorage20360859011";

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alın
    $staff_username = $_POST['staff_username'];
    $staff_email = $_POST['staff_email'];
    $staff_password = $_POST['staff_password'];

    // Şifre ve diğer girdileri güvenli hale getirme
    $staff_username = htmlspecialchars($staff_username);
    $staff_email = htmlspecialchars($staff_email);
    $staff_password = htmlspecialchars($staff_password);
    $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT);

    // Veritabanı bağlantısını oluşturun
    $conn = new mysqli($servername, $db_username, $password, $dbname);

    // Bağlantıyı kontrol etme
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Kullanıcıyı veritabanına ekleme
    $sql = "INSERT INTO staff (staff_username, staff_email, staff_password) VALUES ('$staff_username', '$staff_email', '$hashed_password')";
    if ($conn->query($sql) === TRUE) {
        echo "Yönetici başarıyla kaydedildi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Kayıt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff	 ; /* Haki rengi */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px; /* Container'ı biraz daha büyüttük */
            margin: 100px auto;
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
            background-color: #000000; /* Butonun hover rengini biraz daha koyu pembe yaptık */
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h2>Yönetici Kayıt Formu</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="staff_username">Kullanıcı Adı:</label>
            <input type="text" id="staff_username" name="staff_username" required>

            <label for="staff_email">E-posta Adresi:</label>
            <input type="email" id="staff_email" name="staff_email" required>

            <label for="staff_password">Şifre:</label>
            <input type="password" id="staff_password" name="staff_password" required>

            <input type="submit" value="Kayıt Ol">
        </form>
    </div>
</body>
</html>
