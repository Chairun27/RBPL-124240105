<?php
session_start();
include "../config.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../index.php");
    exit;
}

// Total Barang 
$q1 = mysqli_query($conn,"SELECT COUNT(*) as total FROM produk");
$d1 = mysqli_fetch_assoc($q1);
$total_barang = $d1['total'];

// Stok Menipis 
$q2 = mysqli_query($conn,"SELECT COUNT(*) as total FROM produk WHERE stok <= stok_minimum");
$d2 = mysqli_fetch_assoc($q2);
$stok_menipis = $d2['total'];

// Stok Habis 
$q3 = mysqli_query($conn,"SELECT COUNT(*) as total FROM produk WHERE stok = 0");
$d3 = mysqli_fetch_assoc($q3);
$stok_habis = $d3['total'];

// Total Transaksi 
$q4 = mysqli_query($conn,"SELECT COUNT(*) as total FROM transaksi");
$d4 = mysqli_fetch_assoc($q4);
$total_transaksi = $d4['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style_dashboard_admin.css"> 
</head>
<body>
<div class="mobile-wrapper">

<!-- HEADER -->
<div class="header">
    <div>
        <div class="halo">Halo 👋</div>
        <div class="admin"><?php echo $_SESSION['username']; ?></div>
    </div>

    <a href="../logout.php" class="logout">Logout</a>
</div>
<br>

<!-- CARD STATISTIK -->
<div class="card-list">
    <div class="stat-card">
        <div>
            <p>Total Barang</p>
            <h2><?php echo $total_barang; ?> unit</h2>
        </div>
    </div>

    <div class="stat-card warning">
        <div>
            <p>Stok Menipis</p>
            <h2><?php echo $stok_menipis; ?></h2>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <p>Stok Habis</p>
            <h2><?php echo $stok_habis; ?></h2>
        </div>
    </div>

    <div class="stat-card">
        <div>
            <p>Total Transaksi</p>
            <h2><?php echo $total_transaksi; ?></h2>
        </div>
    </div>
</div>

<!-- MENU -->
<h4 class="menu-title">Menu Utama</h4>
<div class="menu">
    <div class="menu-card" onclick="location.href='stok_barang.php'">
        <div>
            <b>📦 Stok Barang</b>
            <span>Mengelola inventori barang</span>
        </div>
        <div class="arrow">›</div>
    </div>

    <div class="menu-card" onclick="location.href='daftar_restock.php'">
        <div>
            <b>🔄 Daftar Restock Barang</b>
            <span>Melihat daftar permintaan restock barang</span>
        </div>
        <div class="arrow">›</div>
    </div>

    <div class="menu-card" onclick="location.href='daftar_retur.php'">
        <div>
            <b>↩ Daftar Retur Barang</b>
            <span>Melihat daftar pengajuan retur barang</span>
        </div>
        <div class="arrow">›</div>
    </div>

    <div class="menu-card" onclick="location.href='laporan_dari_kasir.php'">
        <div>
            <b>📊 Laporan</b>
            <span>Melihat laporan lengkap</span>
        </div>
        <div class="arrow">›</div>
    </div>
</div>
<br></br>
<br></br>

<!-- BOTTOM NAV -->
<div class="bottom-nav">
    <a href="dashboard_admin.php">🏠</a>
    <a href="stok_barang.php">📦</a>
    <a href="pengajuan_retur.php">↩</a>
    <a href="laporan_dari_kasir.php">📊</a>
</div>

</div>
</div>
</body>
</html>