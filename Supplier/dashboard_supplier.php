<?php
session_start();
include "../config.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'Supplier') {
    header("Location: ../index.php");
    exit;
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Supplier</title>
    <link rel="stylesheet" href="style_supplier.css">
</head>
<body>
<div class="mobile-wrapper">
    
    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="halo">Halo 👋</div>
            <div class="supplier"><?php echo $_SESSION['username']; ?></div>
        </div>

        <a href="../logout.php" class="logout">Logout</a>
    </div>
    <br>

    <div class="menu">
        <div class="card">
            <div class="card-icon">📦</div>
            <h3>Permintaan Restock</h3>
            <p>Melihat permintaan restock barang dari admin</p>
            <a href="melihat_restock.php" class="btn">Lihat</a>
        </div>

        <div class="card">
            <div class="card-icon">↩️</div>
            <h3>Permintaan Retur</h3>
            <p>Melihat retur barang yang diajukan oleh admin</p>
            <a href="permintaan_retur.php" class="btn">Lihat</a>
        </div>
    </div>

    <div class="bottom-nav">
        <a href="dashboard_supplier.php">🏠</a>
        <a href="melihat_restock.php">📦</a>
        <a href="permintaan_retur.php">↩️</a>
        <a href="pengiriman_barang.php">🚚</a>
    </div>
</div>
</body>
</html>