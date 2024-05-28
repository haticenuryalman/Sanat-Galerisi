<?php
session_start();

// Kullanıcı giriş yapmış mı kontrol edin
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Misafir";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff; /* Light background for contrast */
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #ffffff;
        }
        a {
            text-decoration: none;
        }
        li {
            display: inline-block;
            color: white;
        }
        a:hover {
            color: #d71092;
        }
        .navbar {
            position: fixed; /* Navbar'ı sabit konuma getir */
            top: 0; /* Sayfanın en üstünde */
            left: 0; /* Sayfanın solunda */
            width: 100%; /* Genişlik */
            background-color: #333; /* Arkaplan rengi */
            padding: 10px 0; /* Yatay ve dikey dolgu */
            background: white;
        }
        .navButton {  
            color: black;
            text-decoration: none;
            font-size: larger;
            margin-right: 10px;
            background-color: white;
        }
        .navButton2 {  
            color: black;
            text-decoration: none;
            background-color: white;
            font-size: larger;
            border-radius: 50px; /* Oval şekil için border-radius */
            padding: 10px 30px; /* Boşluklar */
            margin-right: 20px;
        }
        nav ul {
            float: right; /* Navbarı sağa yasla */
        }
        nav ul li {
            margin-left: 10px;
            margin-top: 10px; /* Navbar öğeleri arasındaki boşluğu ayarla */
        }
        .navbar-brand {
            float: left;
            color: black;
            font-size: larger;
            margin-left: 20px;
            font-weight: 500px;
            background: white;
        }
        .container {
            margin-top: 100px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar Başlangıç-->
    <nav class="navbar">
        <div class="navbar-brand">Sanat Galerisi</div>
        <ul>
            <li><a href="index.php" class="navButton">Ana Sayfa</a></li>
            <?php if($username === "Misafir"): ?>
                <li><a href="giris_yap.php" class="navButton">Giriş Yap</a></li>
                <li><a href="kayit_formu.php" class="navButton">Kayıt Ol</a></li>
            <?php else: ?>
                <li><a href="cikis_yap.php" class="navButton">Çıkış Yap</a></li>
            <?php endif; ?>
            <li><a href="list_artworks.php" class="navButton2">Sanat Eserleri</a></li>
        </ul>
    </nav>
    <!-- Navbar Bitiş-->
    <div class="container">
        <h1>Hoş Geldiniz, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Bu, Sanat Galerisi Yönetim Sistemi'nin anasayfasıdır. Lütfen menüden istediğiniz seçeneği seçin.</p>
        <a href="list_artworks.php" class="btn btn-primary btn-lg">Sanat Eseri Ekle</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
