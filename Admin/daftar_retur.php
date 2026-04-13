<?php 
session_start();
include "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Retur Barang</title>

    <link rel="stylesheet" href="style_retur.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

<div class="mobile-wrapper">

    <!-- HEADER -->
    <div class="header">
        <a href="dashboard_admin.php" class="back">←</a>
        <h3>Daftar Retur</h3>
    </div>

    <div class="list-container">
        <?php
            $query = mysqli_query($conn,"
            SELECT r.*, p.nama_produk 
            FROM retur_barang r
            JOIN produk p ON r.id_barang = p.id
            ORDER BY r.tanggal DESC
            ");

            if(mysqli_num_rows($query) == 0){
                echo "<p style='text-align:center;'>Tidak ada data retur</p>";
            }

            while($d = mysqli_fetch_assoc($query)){

            $status = strtolower(trim($d['status']));
        ?>

        <div class="card">
            <p><strong>Barang:</strong> <?= $d['nama_produk'] ?></p>
            <p><strong>Supplier:</strong> <?= $d['nama_supplier'] ?></p>
            <p><strong>Jumlah:</strong> <?= $d['jumlah'] ?></p>
            <p><strong>Alasan:</strong> <?= $d['alasan'] ?></p>

            <img src="../<?= $d['foto'] ?>" alt="Foto Retur">

            <p class="status 
            <?php
                if($status=="menunggu") echo "pending";
                elseif($status=="disetujui") echo "approved";
                elseif($status=="ditolak") echo "rejected";
            ?>
            ">

            Status: <?= ucfirst($status) ?>
            </p>
        </div>
        
        <?php } ?>
        <br><br><br>
    </div>

    <div class="bottom-nav">
        <a href="dashboard_admin.php">🏠</a>
        <a href="stok_barang.php">📦</a>
        <a href="pengajuan_retur.php">↩</a>
        <a href="laporan_dari_kasir.php">📊</a>
    </div>
</div>
</body>
</html>