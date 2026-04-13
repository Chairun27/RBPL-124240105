<?php
session_start();
include "../config.php";

date_default_timezone_set("Asia/Jakarta"); 

$query = mysqli_query($conn,"
SELECT r.*, p.nama_produk 
FROM permintaan_restock r
JOIN produk p ON r.produk_id = p.id
ORDER BY r.tanggal_permintaan DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permintaan Restock Barang</title>
    <link rel="stylesheet" href="style_restock.css">
</head>
<body>
<div class="mobile-wrapper">
    <div class="header">
        <a href="dashboard_admin.php" class="back">←</a>
        <h3>Permintaan Restock</h3>
    </div>

    <div class="restock-container">
        <?php while($row = mysqli_fetch_assoc($query)) { ?>

        <div class="restock-card">

            <h4><?php echo $row['nama_produk']; ?></h4>

            <p>Jumlah : <?php echo $row['jumlah_permintaan']; ?></p>

            <p>Supplier : <?php echo $row['supplier']; ?></p>

            <p>Tanggal : <?php echo date("d-m-Y H:i", strtotime($row['tanggal_permintaan'])); ?></p> 

            <span class="status <?php echo strtolower($row['status']); ?>">
            <?php echo $row['status']; ?>
            </span>
        </div>
        <?php } ?>
    </div>

    <!-- BOTTOM NAV -->
    <div class="bottom-nav">
        <a href="dashboard_admin.php">🏠</a>
        <a href="stok_barang.php">📦</a>
        <a href="pengajuan_retur.php">↩</a>
        <a href="laporan_dari_kasir.php">📊</a>
    </div>
</div>
</body>
</html>