<?php
session_start(); 
include "config.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'Kasir') {
    header("Location: index.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link rel="stylesheet" href="style_dashboard_kasir.css"> 
</head>
<body>
<div class="mobile-wrapper">
    <!-- HEADER -->
    <div class="dashboard-header">
        <div class="header-text">
            <strong>Selamat Datang,</strong>
            <br>
            <strong><?php echo $_SESSION['username']; ?></strong>
        </div>

        <a href="logout.php" class="logout">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="dashboard-content">
        <button class="btn-transaksi" onclick="location.href='transaksi_baru.php'">+ Transaksi Baru</button>

        <div class="info-card">
            <p>Transaksi Penjualan Hari Ini</p>
            <h2>4</h2>
        </div>

        <div class="info-card">
            <p>Omset Sementara</p>
            <h2>Rp 3.880.000,-</h2>
        </div>

        <div class="info-card">
            <p>Pelanggan Baru</p>
            <h2>2</h2>
        </div>
    </div>

    <!-- BOTTOM NAV -->
    <div class="bottom-nav">
        <a href="dashboard_kasir.php">🏠</a>
        <a href="transaksi_baru.php">📋</a>
        <a href="riwayat_transaksi.php">💳</a>
        <a href="laporan_harian.php">📄</a>
    </div> 
</div>
</body>
</html>