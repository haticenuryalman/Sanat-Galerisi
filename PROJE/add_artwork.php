<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kullanıcı adı oturum değişkeninden alınıyor, eğer yoksa "Misafir" olarak ayarlanıyor
if (isset($_SESSION['username'])) {
    $session_username = $_SESSION['username']; // Oturumdan kullanıcı adını al
} else {
    $session_username = "Misafir";
}

// Veritabanı bağlantısı için gerekli bilgiler
$servername = "localhost";
$db_username = "dbusr20360859011"; // Veritabanı kullanıcı adı
$password = "1UGK8txiBUro";
$dbname = "dbstorage20360859011";

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alın
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Veritabanı bağlantısını oluşturun
    $conn = new mysqli($servername, $db_username, $password, $dbname);

    // Bağlantıyı kontrol etme
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanat eserini veritabanına ekleme
    $sql = "INSERT INTO artworks (title, description, username) VALUES ('$title', '$description', '$session_username')";
    if ($conn->query($sql) === TRUE) {
        // Sanat eseri başarıyla eklendiğinde, sanat eserlerini listeleyen sayfaya yönlendir
        header("Location: list_artworks.php");
        exit();
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
    <title>Add Artwork</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-control-lg {
            height: calc(1.5em + 1rem + 2px); /* Varsayılan yüksekliği ayarla */
            padding: 0.5rem 1rem; /* Varsayılan dolguyu ayarla */
            font-size: 1.25rem; /* Varsayılan yazı boyutunu ayarla */
        }
        .btn-lg {
            padding: 0.5rem 1rem; /* Varsayılan dolguyu ayarla */
            font-size: 1.25rem; /* Varsayılan yazı boyutunu ayarla */
            line-height: 1.5; /* Varsayılan satır yüksekliğini ayarla */
            background-color: black; /* Buton arka plan rengini siyah yap */
            color: white; /* Buton yazı rengini beyaz yap */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Sanat Eseri Ekle</h2>
        <form action="add_artwork.php" method="post">
            <div class="form-group">
                <label for="title">Başlık:</label>
                <input type="text" class="form-control form-control-lg" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Açıklama:</label>
                <textarea class="form-control form-control-lg" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Sanat Eseri Ekle</button>
            <a href="list_artworks.php" class="btn btn-primary btn-lg">Sanat Eserlerini Görüntüle</a>
        </form>
    </div>
</body>
</html>
