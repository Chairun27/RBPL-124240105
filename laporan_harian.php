<?php
$conn = mysqli_connect("localhost", "root", "", "db_toko_elektronik");

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date("Y-m-d");

$query = "
    SELECT * FROM transaksi
    WHERE DATE(tanggal) = '$tanggal'
    ORDER BY tanggal DESC
";

$data = mysqli_query($conn, $query);

// HITUNG RINGKASAN
$totalTransaksi = mysqli_num_rows($data);
$totalUnit = 0;
$totalPendapatan = 0;

$transaksi = [];

while ($row = mysqli_fetch_assoc($data)) {
    $totalUnit += $row['total_unit'];
    $totalPendapatan += $row['total_harga'];
    $transaksi[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Harian</title>
    <link rel="stylesheet" href="style_laporan.css"> 
</head>
<body>
<div class="mobile">

    <!-- HEADER -->
    <div class="header">
        <a href="dashboard_kasir.php" class="back">←</a>
        <h3>Laporan Transaksi</h3>
    </div>

    <!-- FILTER TANGGAL -->
    <div class="filter">
        <form method="get" class="filter"> 
            <input type="date" name="tanggal" value="<?= $tanggal ?>">
            <button class="btn-cari">Cari</button>
        </form>
    </div>

    <!-- RINGKASAN -->
    <div class="summary">
        <div class="item">
            <span>Total Transaksi</span>
            <strong><?= $totalTransaksi ?></strong>
        </div>
        
        <div class="item">
            <span>Total Unit</span>
            <strong><?= $totalUnit ?></strong>
        </div>
        
        <div class="item total">
            <span>Total Pendapatan</span>
            <strong>Rp <?= number_format($totalPendapatan) ?></strong>
        </div>
    </div>

    <!-- LIST TRANSAKSI -->
    <div class="content">
        <p class="section-title">Daftar Transaksi</p>

        <?php if(count($transaksi) == 0): ?>
            <p class="kosong">Tidak ada transaksi</p>
        <?php endif; ?>

        <?php foreach($transaksi as $trx): ?>
            <a href="struk.php?id=<?= $trx['id'] ?>" class="trx-card">
                <span>TRX-<?= str_pad($trx['id'], 5, "0", STR_PAD_LEFT) ?></span>
                <strong>Rp <?= number_format($trx['total_harga']) ?></strong>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- BUTTON CETAK -->
    <div class="footer">
        <a href="cetak_laporan.php?tanggal=<?= $tanggal ?>" target="_blank">
            <button class="btn-print">Cetak Laporan</button>
        </a> 
    </div>

</div>
</body>
</html>