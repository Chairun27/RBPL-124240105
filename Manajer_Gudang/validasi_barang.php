<?php
session_start();
include "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Barang</title>
    <link rel="stylesheet" href="style_manajer_gudang.css">
</head>
<body>
<div class="mobile-wrapper">

    <div class="header1">
        <a href="dashboard_manajer_gudang.php" class="back">←</a>
        <h3>Validasi Barang</h3>
    </div>

    <div class="menu">
    
        <?php
        // Restock barang 
        $restock = mysqli_query($conn,"
        SELECT pr.*, p.nama_produk
        FROM permintaan_restock pr
        JOIN produk p ON pr.produk_id=p.id
        WHERE LOWER(pr.status)='dicek'
        ");

        while($d=mysqli_fetch_assoc($restock)){

        $kondisi = strtolower(trim($d['kondisi_barang']));
        ?>

        <div class="card">
            <span class="badge badge-restock">Restock</span>

            <p><b>Barang:</b> <?= $d['nama_produk'] ?></p>
            <p><b>Jumlah:</b> <?= $d['jumlah_permintaan'] ?></p>
            <p><b>Kondisi:</b> <?= ucfirst($kondisi) ?></p>

            <!-- Divalidasi -->
            <a href="proses_validasi.php?id=<?= $d['id'] ?>&jenis=restock&aksi=validasi"
            class="btn-kirim">
            Validasi
            </a>

            <!-- Ditolak -->
            <a href="proses_validasi.php?id=<?= $d['id'] ?>&jenis=restock&aksi=tolak"
            class="btn-tolak">
            Tolak
            </a>
        </div>

        <?php } ?>

        <?php
        // Retur barang 
        $retur = mysqli_query($conn,"
        SELECT r.*, p.nama_produk
        FROM retur_barang r
        JOIN produk p ON r.id_barang=p.id
        WHERE LOWER(r.status)='dicek'
        ");

        while($d=mysqli_fetch_assoc($retur)){

        $kondisi = strtolower(trim($d['kondisi_barang']));
        ?>

        <div class="card">
            <span class="badge badge-retur">Retur</span>

            <p><b>Barang:</b> <?= $d['nama_produk'] ?></p>
            <p><b>Jumlah:</b> <?= $d['jumlah'] ?></p>
            <p><b>Kondisi:</b> <?= ucfirst($kondisi) ?></p>

            <!-- Divalidasi -->
            <a href="proses_validasi.php?id=<?= $d['id_retur'] ?>&jenis=retur&aksi=validasi"
            class="btn-kirim">
            Validasi
            </a>

            <!-- Ditolak -->
            <a href="proses_validasi.php?id=<?= $d['id_retur'] ?>&jenis=retur&aksi=tolak"
            class="btn-tolak">
            Tolak
            </a>
        </div>

        <?php } ?>

    </div>
</div>
</body>
</html>