<?php 
session_start();
include "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Retur Barang</title>
    <link rel="stylesheet" href="style_restock.css"> 
</head>
<body>
<div class="mobile-wrapper">
    <div class="header">
        <a href="dashboard_admin.php" class="back">←</a>
        <h3>Form Pengajuan Retur Barang</h3>
    </div>

    <div class="form-container"> 
        <form action="proses_retur.php" method="POST" enctype="multipart/form-data">

            <label><b>Nama Barang:</b></label>
            <select name="id_barang" required>
                <option value="">-- Pilih Barang --</option>

                <?php
                $barang = mysqli_query($conn, "SELECT * FROM produk");

                if(!$barang){
                    die("Query error: " . mysqli_error($conn));
                }

                if(mysqli_num_rows($barang) > 0){
                    while($b = mysqli_fetch_assoc($barang)){
                        echo "<option value='".$b['id']."'>".$b['nama_produk']."</option>";
                    }
                } else {
                    echo "<option>Tidak ada data produk</option>";
                }
                ?>
            </select><br><br>

            <label><b>Nama Supplier:</b></label>
            <input type="text" name="nama_supplier" placeholder="Masukkan nama supplier" required><br><br>

            <label><b>Jumlah Retur:</b></label>
            <input type="number" name="jumlah" required><br><br>

            <label><b>Alasan:</b></label>
            <textarea name="alasan" required></textarea><br><br>

            <label><b>Upload Foto:</b></label>
            <input type="file" name="foto" accept="image/*" onchange="previewImage(event)" required><br><br>

            <img id="preview" width="120">

            <button type="submit">Kirim</button> 
        </form>
        <br></br>
        <br></br>
    </div>

    <!-- BOTTOM NAV -->
    <div class="bottom-nav">
        <a href="dashboard_admin.php">🏠</a>
        <a href="stok_barang.php">📦</a>
        <a href="pengajuan_retur.php">↩</a>
        <a href="laporan_dari_kasir.php">📊</a>
    </div>
</div> 

<script>
function previewImage(event){
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
</body>
</html>