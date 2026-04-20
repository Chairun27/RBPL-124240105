<?php
include "../config.php";

// validasi parameter  
if(!isset($_GET['id']) || !isset($_GET['status'])){
    echo "<script>alert('Parameter tidak lengkap!');location='daftar_retur.php';</script>";
    exit;
}

$id = $_GET['id'];
$status = $_GET['status'];

// mengambil data retur 
$query = mysqli_query($conn, "SELECT * FROM retur_barang WHERE id_retur='$id'");
$data = mysqli_fetch_assoc($query);

// kalau data tidak ada
if(!$data){
    echo "<script>alert('Data tidak ditemukan!');location='daftar_retur.php';</script>";
    exit;
}

// cek status apakah sudah diproses 
if($data['status'] != 'pending'){
    echo "<script>alert('Retur sudah diproses!');location='daftar_retur.php';</script>";
    exit;
}

// update status  
$update = mysqli_query($conn, "UPDATE retur_barang SET status='$status' WHERE id_retur='$id'");

if(!$update){
    die("Gagal update status: " . mysqli_error($conn));
}

// update status saja (tanpa mengubah/mengurangi jumlah stok barang di database)
$update = mysqli_query($conn, "
    UPDATE retur_barang 
    SET status='$status' 
    WHERE id_retur='$id'
");

if(!$update){
    die("Gagal update status: " . mysqli_error($conn));
}

// redirect halaman  
echo "<script>alert('Status berhasil diperbarui');location='daftar_retur.php';</script>";
?>
