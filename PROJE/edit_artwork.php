<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı için gerekli bilgiler
$servername = "localhost";
$username = "dbusr20360859011";
$password = "1UGK8txiBUro";
$dbname = "dbstorage20360859011";

// Veritabanı bağlantısını oluşturun
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanat eseri artworks_ID'sini al
$artwork_id = isset($_GET['id']) ? $_GET['id'] : '';

// artworks_ID parametresinin doğruluğunu kontrol et
if (empty($artwork_id)) {
    die("Geçersiz Sanat Eseri ID");
}

$artwork_id = $conn->real_escape_string($artwork_id);

// Sanat eserini seçmek için SQL sorgusu
$sql = "SELECT * FROM artworks WHERE artworks_ID = '$artwork_id'";
$result = $conn->query($sql);

// Hata kontrolü
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Sanat eseri bulunamazsa, kullanıcıyı liste sayfasına yönlendir
if ($result->num_rows == 0) {
    header("Location: list_artworks.php");
    exit();
}

$artwork = $result->fetch_assoc();

// Form gönderildiğinde sanat eserini güncelle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);

    $update_sql = "UPDATE artworks SET title = '$title', description = '$description' WHERE artworks_ID = '$artwork_id'";
    
    if ($conn->query($update_sql) === TRUE) {
        header("Location: list_artworks.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanat Eserini Düzenle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Sanat Eserini Düzenle</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Başlık</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($artwork['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Açıklama</label>
                <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($artwork['description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
</body>
</html>

<?php
// Veritabanı bağlantısını kapatın
$conn->close();
?>
