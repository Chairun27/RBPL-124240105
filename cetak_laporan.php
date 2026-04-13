<?php 
$conn = mysqli_connect("localhost", "root", "", "db_toko_elektronik");

$tanggal = $_GET['tanggal'];
date_default_timezone_set("Asia/Jakarta"); 

// Mengambil transaksi 
$query = "
    SELECT * FROM transaksi
    WHERE DATE(tanggal) = '$tanggal'
    ORDER BY tanggal ASC
";

$data = mysqli_query($conn, $query);

$totalTransaksi = mysqli_num_rows($data);
$totalUnit = 0;
$totalPendapatan = 0;

$transaksi = [];

while ($row = mysqli_fetch_assoc($data)) {
    $totalUnit += $row['total_unit'];
    $totalPendapatan += $row['total_harga'];
    $transaksi[] = $row;
}

// Menyimpan laporan ke database (mengecek apakah laporan sudah ada)
$cek = mysqli_query($conn, "
    SELECT * FROM laporan_transaksi 
    WHERE tanggal='$tanggal'
");

if(mysqli_num_rows($cek) == 0){

    mysqli_query($conn,"
        INSERT INTO laporan_transaksi
        (tanggal,total_transaksi,total_unit,total_pendapatan)
        VALUES
        ('$tanggal','$totalTransaksi','$totalUnit','$totalPendapatan')
    ");

}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Harian</title>
    <link rel="stylesheet" href="style_cetak_laporan.css">
</head>
<body onload="window.print()">
<div class="laporan">

    <h2>LAPORAN TRANSAKSI HARIAN</h2>
    <p class="tanggal">
        Tanggal: <?= date("d F Y", strtotime($tanggal)) ?>
    </p>

    <hr>

    <div class="ringkasan">
        <p>Total Transaksi : <strong><?= $totalTransaksi ?></strong></p>
        <p>Total Unit      : <strong><?= $totalUnit ?></strong></p>
        <p>Total Pendapatan: <strong>Rp <?= number_format($totalPendapatan) ?></strong></p>
    </div>

    <hr>

    <table>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Waktu</th>
            <th>Total Unit</th>
            <th>Total Harga</th>
        </tr>

        <?php $no = 1; foreach($transaksi as $trx): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td>TRX-<?= str_pad($trx['id'], 5, "0", STR_PAD_LEFT) ?></td>
            <td><?= date("H:i", strtotime($trx['tanggal'])) ?></td>
            <td><?= $trx['total_unit'] ?></td>
            <td>Rp <?= number_format($trx['total_harga']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table> 

    <p class="footer">
        Dicetak pada: <?= date("d-m-Y H:i:s") ?>
    </p>

</div>
</body>
</html>