<?php
session_start();
include "../config.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'Manajer_Gudang') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajer Gudang</title>
    <link rel="stylesheet" href="style_manajer_gudang.css">
</head>
<body>
<div class="mobile-wrapper">

    <!-- Header -->
    <div class="header">
        <div>
            <div class="halo">Halo 👋</div>
            <div class="manajer_gudang"><?= $_SESSION['username']; ?></div>
        </div>

        <a href="../logout.php" class="logout">Logout</a>
    </div>

    <div class="menu">
        <a href="validasi_barang.php" class="menu-card">
        ✅
        <h4>Validasi Barang</h4>
        <p>Setujui barang setelah dicek oleh petugas gudang</p>
        </a>
    </div>

</div>
</body>
</html>