<?php
session_start();
include "../config.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'Petugas_Gudang') {
    header("Location: ../index.php");
    exit;
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas Gudang</title>
    <link rel="stylesheet" href="style_petugas_gudang.css">
</head>
<body>
<div class="mobile-wrapper">
    
    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="halo">Halo 👋</div>
            <div class="petugas_gudang"><?php echo $_SESSION['username']; ?></div>
        </div>

        <a href="../logout.php" class="logout">Logout</a>
    </div>
    <br>

    <div class="menu">
        <a href="barang_datang.php" class="menu-card">
        📦
        <h4>Barang Datang</h4>
        <p>Terima dan cek kondisi barang</p>
        </a>
    </div>
    
</div>
</body>
</html>