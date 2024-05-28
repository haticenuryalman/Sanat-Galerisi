<?php
session_start();

// Kullanıcı giriş yaptıysa ve kullanıcı adı oturum değişkenine atanmışsa
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Misafir";

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

// Sanat eserlerini seçmek için SQL sorgusu
$sql = "SELECT * FROM artworks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanat Galerisi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Sanat Galerisi</h2>
        <p>Kullanıcı Adı: <?php echo htmlspecialchars($username); ?></p> <!-- Kullanıcı adını görüntüle -->
        <a href="add_artwork.php" class="btn btn-primary mb-3">Sanat Eseri Ekle</a> <!-- Sanat Eseri Ekle butonu -->
        <table class="table">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Kullanıcı Adı</th>
                    <th>İşlemler</th> <!-- Yeni sütun: İşlemler -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Sanat eserlerini listeleyin
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . htmlspecialchars($row["title"]) . "</td><td>" . htmlspecialchars($row["description"]) . "</td><td>" . htmlspecialchars($row["username"]) . "</td>";
                        echo "<td><a href='edit_artwork.php?id=" . $row["artworks_ID"] . "' class='btn btn-warning'>Düzenle</a> ";
                        echo "<form action='list_artworks.php' method='post' style='display: inline;'><input type='hidden' name='delete_id' value='" . $row["artworks_ID"] . "'><button type='submit' class='btn btn-danger' name='delete_artwork'>Sil</button></form></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Henüz sanat eseri bulunmamaktadır.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Sanat eserini silme işlemini kontrol etme
if (isset($_POST['delete_artwork'])) {
    // Silinecek sanat eserinin ID'sini alın
    $artwork_id = $_POST['delete_id'];

    // Veritabanı bağlantısı için gerekli bilgiler
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = ""; // Varsayılan olarak boş şifre
    $dbname = "art_gallery";

    // Veritabanı bağlantısını oluşturun
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Sanat eserini silme SQL sorgusu
    $sql_delete = "DELETE FROM artworks WHERE artworks_ID=$artwork_id";

    // SQL sorgusunu çalıştırma
    if ($conn->query($sql_delete) === TRUE) {
        // Silindikten sonra "list_artworks.php" sayfasına yönlendir
        header("Location: list_artworks.php");
        exit();
    } else {
        echo "Error deleting artwork: " . $conn->error;
    }

    // Veritabanı bağlantısını kapatın
    $conn->close();
}
?>
