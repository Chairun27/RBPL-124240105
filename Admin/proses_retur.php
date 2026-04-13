<?php
session_start();
include "../config.php";

$id_barang = $_POST['id_barang'];
$nama_supplier = $_POST['nama_supplier'];
$jumlah = $_POST['jumlah'];
$alasan = $_POST['alasan'];
$tanggal = date('Y-m-d H:i:s');

// validasi jumlah
if($jumlah <= 0){
    echo "<script>alert('Jumlah tidak valid!'); window.history.back();</script>";
    exit;
}

// cek stok
$query = mysqli_query($conn, "SELECT stok FROM produk WHERE id='$id_barang'");
$data = mysqli_fetch_assoc($query);

if($jumlah > $data['stok']){
    echo "<script>alert('Jumlah melebihi stok!'); window.history.back();</script>";
    exit;
}

// upload foto  
$nama_file = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// ubah nama file (hapus spasi + tambah timestamp)
$nama_baru = time() . "_" . str_replace(" ", "_", $nama_file);

// path benar (karena file ini di dalam folder admin)
$path_upload = "../upload/" . $nama_baru;

// path untuk database
$path_db = "upload/" . $nama_baru;

// upload file
if(!move_uploaded_file($tmp, $path_upload)){
    echo "<script>alert('Upload gagal! Cek folder upload'); window.history.back();</script>";
    exit;
}

// simpan ke database
mysqli_query($conn, "INSERT INTO retur_barang 
(id_barang, nama_supplier, jumlah, alasan, foto, tanggal, status)
VALUES 
('$id_barang','$nama_supplier','$jumlah','$alasan','$path_db','$tanggal','pending')");

// sukses
echo "<script>alert('Permintaan retur barang telah berhasil diajukan kepada supplier'); window.location='daftar_retur.php';</script>";
?>