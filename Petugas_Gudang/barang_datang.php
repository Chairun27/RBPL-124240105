<?php
session_start();
include "../config.php";

// Restock barang 
$restock = mysqli_query($conn,"
SELECT pr.*, p.nama_produk
FROM permintaan_restock pr
JOIN produk p ON pr.produk_id = p.id
WHERE pr.status='dikirim'
");

// Retur barang 
$retur = mysqli_query($conn,"
SELECT r.*, p.nama_produk
FROM retur_barang r
JOIN produk p ON r.id_barang = p.id
WHERE r.status='dikirim'
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melihat Barang Datang ke Gudang</title>
    <link rel="stylesheet" href="style_petugas_gudang.css">
</head>
<body>
<div class="mobile-wrapper">

    <div class="header1">
        <a href="dashboard_petugas_gudang.php" class="back">←</a>
        <h3>Barang Datang</h3>
    </div>
    <br>

        <div class="menu">
            <!-- RESTOCK -->
            <?php while($d = mysqli_fetch_assoc($restock)){ ?>

            <div class="card">
                <p><strong>Jenis:</strong> Restock</p>
                <p><strong>Barang:</strong> <?= $d['nama_produk'] ?></p>
                <p><strong>Jumlah:</strong> <?= $d['jumlah_permintaan'] ?></p>

                <a class="btn-proses"
                href="cek_barang.php?id=<?= $d['id'] ?>&jenis=restock">
                Terima & Cek Barang
                </a>
            </div>

            <?php } ?>
            <!-- RETUR -->
            <?php while($r = mysqli_fetch_assoc($retur)){ ?>

            <div class="card">
                <p><strong>Jenis:</strong> Retur</p>
                <p><strong>Barang:</strong> <?= $r['nama_produk'] ?></p>
                <p><strong>Jumlah:</strong> <?= $r['jumlah'] ?></p>

                <a class="btn-proses"
                href="cek_barang.php?id=<?= $r['id_retur'] ?>&jenis=retur">
                Terima & Cek Barang
                </a>
            </div>

            <?php } ?>
        </div>
</div>
</body>
</html>