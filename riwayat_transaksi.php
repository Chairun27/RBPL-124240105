<?php
$conn = mysqli_connect("localhost", "root", "", "db_toko_elektronik");

$data = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY tanggal DESC"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="style_riwayat_transaksi.css">
</head>
<body>
<div class="mobile">
    
    <!-- Header -->
    <div class="header">
        <a href="dashboard_kasir.php" class="back">←</a>
        <h3>Riwayat Transaksi</h3>
    </div>

    <!-- List Transaksi -->
    <div class="content">
        <?php if(mysqli_num_rows($data) == 0): ?>
            <p class="kosong">Belum ada transaksi</p>
        <?php endif; ?>

        <?php while($trx = mysqli_fetch_assoc($data)): ?>

    <?php
    $detail = mysqli_query($conn, "
        SELECT dt.qty, p.nama_produk, p.stok
        FROM detail_transaksi dt
        JOIN produk p ON dt.produk_id = p.id
        WHERE dt.transaksi_id = {$trx['id']}
    ");
    ?>

    <div class="card" onclick="toggleDetail(<?= $trx['id'] ?>)">
        <div class="left">
            <strong>TRX-<?= str_pad($trx['id'], 5, "0", STR_PAD_LEFT) ?></strong>
            <span>
                <?= date("d M Y", strtotime($trx['tanggal'])) ?> •
                <?= date("H:i", strtotime($trx['tanggal'])) ?>
            </span>
        </div>
        <div class="right">
            <span><?= $trx['total_unit'] ?> item</span>
            <strong>Rp <?= number_format($trx['total_harga']) ?></strong>
        </div>

        <div class="arrow" id="arrow-<?= $trx['id'] ?>">
            ▶
        </div>
    </div>

    <div id="detail-<?= $trx['id'] ?>" class="detail-box">
        <?php while($d = mysqli_fetch_assoc($detail)): ?>
            <div class="detail-item">
                <?= $d['nama_produk'] ?> (<?= $d['qty'] ?>)
                <span class="stok">Sisa: <?= $d['stok'] ?></span> 
            </div>
        <?php endwhile; ?>
    </div>

    <?php endwhile; ?> 
    </div>

    <!-- BOTTOM NAV -->
    <div class="bottom-nav">
        <a href="dashboard_kasir.php">🏠</a>
        <a href="transaksi_baru.php">📋</a>
        <a href="riwayat_transaksi.php">💳</a>
        <a href="laporan_harian.php">📄</a> 
    </div>
</div>
<script>
    function toggleDetail(id) {
        const box = document.getElementById("detail-" + id);
        const arrow = document.getElementById("arrow-" + id);

        box.classList.toggle("active");
        arrow.classList.toggle("rotate");
    }
</script>
</body>
</html>