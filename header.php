<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}


require_once 'functions.php';

// pagination
// konfigurasi
$jumlahDataPerhalaman = 10;
$jumlahData = count(query("SELECT * FROM blog"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = ( isset($_GET['halaman'])) ? $_GET['halaman'] : 1;

$awalData = ( $jumlahDataPerhalaman * $halamanAktif ) - $jumlahDataPerhalaman;

$blogs = query("SELECT artikel.nama AS an, artikel.konten AS ak, artikel.gambar AS ag, kategori.nama AS kn,
 artikel.id AS ai, users.id, users.nama AS un, users.username AS uu, users.icon AS ui FROM blog 
 INNER JOIN artikel ON blog.id_artikel = artikel.id 
 INNER JOIN kategori ON blog.id_kategori = kategori.id 
 INNER JOIN users ON blog.id_user = users.id");       
// tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $blg = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brian D</title>
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon-32x32.png"> -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="assets/scss/theme.css" rel="stylesheet">
</head>
<body class="general">
       <!-- Header Section -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container mt-0">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo.png" alt="Adam Fitriyan Logo" class="nav-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 pt-1">
                    <?php

                    
                    ?>
                    
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kategori.php">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">Tentang Kami</a>
                    </li>
                </ul>
                <ul class="navbar-nav profile">
                    <li class="nav-item">
                        <a class="nav-link user" href="profil.php?id=<?= $_SESSION['username']?>"><?= $_SESSION['username']?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>
                        
                    </li>
                </ul>
                
                
                <!-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
            
        </div>
    </nav>

