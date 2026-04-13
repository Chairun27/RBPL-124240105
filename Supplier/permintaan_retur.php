<?php
session_start();
include "../config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Permintaan Retur Barang</title>

    <link rel="stylesheet" href="style_supplier.css">
</head>
<body>

<div class="mobile-wrapper">

    <div class="header1">
        <a href="dashboard_supplier.php" class="back">←</a>
        <h3>Melihat Permintaan Retur</h3>
    </div>
    <br>

    <div class="menu">
        <?php
            $query = mysqli_query($conn,"
            SELECT r.*, p.nama_produk 
            FROM retur_barang r
            JOIN produk p ON r.id_barang = p.id
            ORDER BY r.tanggal DESC
            ");

            if(mysqli_num_rows($query)==0){
                echo "<p style='text-align:center'>Tidak ada retur</p>";
            }

            while($d=mysqli_fetch_assoc($query)){

            $status = strtolower(trim($d['status']));
        ?>

        <div class="card">
            <p><strong>Barang:</strong> <?= $d['nama_produk'] ?></p>
            <p><strong>Jumlah:</strong> <?= $d['jumlah'] ?></p>
            <p><strong>Alasan:</strong> <?= $d['alasan'] ?></p>

            <br>
            <img src="../<?= $d['foto'] ?>" width="100%">
            </br> 

            <p><strong>Status:</strong> <?= ucfirst($status) ?></p>

            <?php if($status=="menunggu" || $status=="pending"){ ?>

            <div class="action-btn">
                <a class="btn-proses"
                href="update_status_retur.php?id=<?= $d['id_retur'] ?>&status=disetujui">
                Setujui
                </a>

                <a class="btn-kirim"
                href="update_status_retur.php?id=<?= $d['id_retur'] ?>&status=ditolak">
                Tolak
                </a>
            </div>

            <?php } ?>
        </div>

        <?php } ?>
    </div>
    <br><br><br>

    <div class="bottom-nav">
        <a href="dashboard_supplier.php">🏠</a>
        <a href="melihat_restock.php">📦</a>
        <a href="permintaan_retur.php">↩️</a>
        <a href="pengiriman_barang.php">🚚</a>
    </div>
</div>
</body>
</html>