<?php
$servername = "localhost";
$username = "dbusr20360859011";
$password = "1UGK8txiBUro";
$dbname = "dbstorage20360859011";

// Veritabanı bağlantısını oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme

if (!$conn) {

    die("Connection failed: " . 
mysqli_connect_error());

}
echo "Connected successfully";
mysqli_close($conn);
?>