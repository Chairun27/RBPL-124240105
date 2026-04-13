<?php
session_start();
include "../config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengiriman Barang</title>
    <link rel="stylesheet" href="style_supplier.css">
</head>
<body>

<div class="mobile-wrapper">

<!-- HEADER -->
<div class="header1">
    <a href="dashboard_supplier.php" class="back">←</a>
    <h3>Pengiriman Barang</h3>
</div>
<br> 
<div class="menu">
    <?php

    // Restock barang yang siap dikirim 
    $restock = mysqli_query($conn,"
    SELECT pr.*, p.nama_produk
    FROM permintaan_restock pr
    JOIN produk p ON pr.produk_id = p.id
    WHERE pr.status='Diproses'
    ORDER BY pr.tanggal_permintaan DESC
    ");

    while($r = mysqli_fetch_assoc($restock)){
    ?>

    <div class="card">
        <span class="badge-restock">RESTOCK</span>

        <p><strong>Barang:</strong> <?= $r['nama_produk'] ?></p>
        <p><strong>Jumlah:</strong> <?= $r['jumlah_permintaan'] ?></p>

        <p class="status-proses">Status: Diproses</p>

        <a class="btn-kirim"
        href="update_pengiriman.php?id=<?= $r['id'] ?>&jenis=restock"
        onclick="return confirm('Yakin barang akan dikirim?')">
        🚚 Kirim Barang
        </a>
    </div>

    <?php } ?>

    <?php

    // Retur barang yang disetujui 
    $retur = mysqli_query($conn,"
    SELECT r.*, p.nama_produk
    FROM retur_barang r
    JOIN produk p ON r.id_barang = p.id
    WHERE r.status='Disetujui'
    ORDER BY r.tanggal DESC
    ");

    while($d = mysqli_fetch_assoc($retur)){
    ?>

    <div class="card">
        <span class="badge-retur">RETUR</span>

        <p><strong>Barang:</strong> <?= $d['nama_produk'] ?></p>
        <p><strong>Jumlah:</strong> <?= $d['jumlah'] ?></p>

        <p class="status-setuju">Status: Disetujui</p>

        <a class="btn-kirim"
        href="update_pengiriman.php?id=<?= $d['id_retur'] ?>&jenis=retur"
        onclick="return confirm('Yakin barang akan dikirim?')">
        🚚 Kirim Barang
        </a>
    </div>

    <?php } ?>

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