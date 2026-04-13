<?php
session_start();
include "../config.php";

$id = $_GET['id'];
$jenis = $_GET['jenis'];

if($jenis=="restock"){

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT pr.*, p.nama_produk
FROM permintaan_restock pr
JOIN produk p ON pr.produk_id=p.id
WHERE pr.id='$id'
"));

$jumlah = $data['jumlah_permintaan'];

}else{

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT r.*, p.nama_produk
FROM retur_barang r
JOIN produk p ON r.id_barang=p.id
WHERE r.id_retur='$id'
"));

$jumlah = $data['jumlah'];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mengecek Kondisi Fisik Barang</title>
    <link rel="stylesheet" href="style_petugas_gudang.css">
</head>
<body>
<div class="mobile-wrapper">

    <div class="header1">
        <a href="barang_datang.php" class="back">←</a>
        <h3>Cek Barang</h3>
    </div>
    <br> 

        <div class="menu">
            <div class="card">
                <p><strong>Barang:</strong> <?= $data['nama_produk'] ?></p>
                <br>
                <p><strong>Jumlah:</strong> <?= $jumlah ?></p>

                <br> 
                <form method="POST" action="proses_cek_barang.php">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="jenis" value="<?= $jenis ?>">

                    <b><label>Kondisi Barang</label></b> 
                    <select name="kondisi" required>
                        <option value="baik">Baik</option>
                        <option value="rusak">Rusak</option>
                        <option value="tidak sesuai">Jumlah Tidak Sesuai</option>
                    </select>

                    <br><br>

                    <b><label>Catatan</label></b>
                    <textarea name="catatan"></textarea>

                    <br><br>
                    
                    <button type="submit" class="btn-kirim">
                        Simpan Hasil Cek
                    </button>
                </form>
            </div>
        </div>
</div>
</body>
</html>