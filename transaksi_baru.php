<?php
$conn = mysqli_connect("localhost", "root", "", "db_toko_elektronik");
$produk = mysqli_query($conn, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Baru</title>
    <link rel="stylesheet" href="style_transaksi_baru.css">
</head>
<body>
<div class="mobile">
<!-- Header -->
<div class="header">
    <span><a href="dashboard_kasir.php" class="back">←</a></span>  
    <h3>Transaksi Baru</h3> 
</div> 

<!-- Search -->
<div class="search-box">
    <input type="text" id="search" placeholder="Cari Barang" onkeyup="searchProduct()">
</div> 

<!-- List Produk -->
<div class="content"> 
<div class="product-container" id="productContainer">     
    <?php while($row = mysqli_fetch_assoc($produk)): ?>
        <div class="produk-card"
            data-id="<?= $row['id'] ?>"
            data-price="<?= $row['harga'] ?>"
            data-stok="<?= $row['stok'] ?>">

            <img src="assets/<?= $row['gambar'] ?>" alt="<?= $row['nama_produk'] ?>"> 

            <p class="product-name"><?= $row['nama_produk'] ?></p>
            <strong>Rp <?= number_format($row['harga']) ?>,-</strong>

            <br> 
            <small>Stok: <?= $row['stok'] ?></small>

            <div class="qty">
                <button class="minus" type="button">−</button>
                <span>0</span>
                <button class="plus" type="button">+</button>
            </div>
        </div>
    <?php endwhile; ?>
</div>
</div>

<form action="simpan_transaksi.php" method="post" id="formTransaksi">
    <input type="hidden" name="data_produk" id="dataProduk">
    <input type="hidden" name="total_harga" id="inputTotalHarga">
    <input type="hidden" name="total_unit" id="inputTotalUnit">

    <div class="total-box" id="totalBayar" style="display:none">
        <div class="total-info">
            <span id="totalUnit">0 item</span>
            <strong id="totalHarga">Rp 0</strong>
        </div>
        
        <button type="submit" class="btn-simpan">Simpan Transaksi</button>
    </div>
</form> 

    <!-- BOTTOM NAV -->
    <div class="bottom-nav">
        <a href="dashboard_kasir.php">🏠</a>
        <a href="transaksi_baru.php">📋</a>
        <a href="riwayat_transaksi.php">💳</a>
        <a href="laporan_harian.php">📄</a> 
    </div>
</div>

<script src="transaksi.js"></script>
</body>
</html>