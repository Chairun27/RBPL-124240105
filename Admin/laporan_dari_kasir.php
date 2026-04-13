<?php 
session_start();
include "../config.php";

$query = mysqli_query($conn,"
    SELECT * FROM laporan_transaksi
    ORDER BY tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Kasir</title>
    <link rel="stylesheet" href="style_laporan_dari_kasir.css">
</head>
<body>

<div class="mobile-wrapper">

    <!-- Header -->
    <div class="header">
        <a href="dashboard_admin.php" class="back">←</a>
        <h3>Laporan Transaksi dari Kasir</h3>
    </div>

    <!-- List Laporan -->
    <div class="list-container">

    <?php 
    if(mysqli_num_rows($query)==0){
        echo "<p class='kosong'>Belum ada laporan</p>";
    }
    ?>

    <?php while($d=mysqli_fetch_assoc($query)){ ?>

    <div class="card">

        <p class="tanggal">
            <?= date("d F Y", strtotime($d['tanggal'])) ?>
        </p>

        <div class="info">
            <p>Total Transaksi</p>
            <strong><?= $d['total_transaksi'] ?></strong>
        </div>

        <div class="info">
            <p>Total Unit</p>
            <strong><?= $d['total_unit'] ?></strong>
        </div>

        <div class="info pendapatan">
            <p>Total Pendapatan</p>
            <strong>Rp <?= number_format($d['total_pendapatan']) ?></strong>
        </div>

        <!-- BUTTON CETAK -->
        <div class="btn-area">
            <a href="../cetak_laporan.php?tanggal=<?= $d['tanggal'] ?>" target="_blank">
                <button class="btn-cetak">Cetak Laporan</button>
            </a>
        </div>

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