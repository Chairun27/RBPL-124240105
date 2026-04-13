<?php
session_start();
include "../config.php";

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM produk WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Permintaan Restock Barang</title>
    <link rel="stylesheet" href="style_restock.css">
</head>
<body>
<div class="mobile-wrapper">
    <div class="header">
        <a href="stok_barang.php" class="back">←</a>
        <h3>Permintaan Restock</h3>
    </div>

    <div class="form-container">
        <form method="POST">
            <label><b>Nama Barang</b></label>
            <input type="text" value="<?php echo $data['nama_produk']; ?>" readonly>

            <label><b>Stok Saat Ini</b></label>
            <input type="text" value="<?php echo $data['stok']; ?>" readonly>

            <label><b>Jumlah Permintaan</b></label>
            <input type="number" name="jumlah" required>

            <label><b>Nama Supplier</b></label>
            <input type="text" name="supplier" required>

            <label><b>Alasan Restock</b></label>
            <textarea name="alasan" required></textarea>

            <button type="submit" name="kirim">Kirim Permintaan</button>
        </form>
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
</body>
</html>

<?php
if(isset($_POST['kirim'])){

$jumlah = $_POST['jumlah'];
$supplier = $_POST['supplier'];
$alasan = $_POST['alasan'];
$tanggal = date("Y-m-d H:i:s");

mysqli_query($conn,"
INSERT INTO permintaan_restock
(produk_id,jumlah_permintaan,alasan_restock,supplier,tanggal_permintaan)
VALUES
('$id','$jumlah','$alasan','$supplier','$tanggal')
");

echo "<script>
alert('Permintaan Restock Barang Kepada Supplier Berhasil Dikirim');
window.location='daftar_restock.php';
</script>";

}
?>