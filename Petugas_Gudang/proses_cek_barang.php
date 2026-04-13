<?php
include "../config.php";

$id = $_POST['id'];
$jenis = $_POST['jenis'];
$kondisi = strtolower(trim($_POST['kondisi'])); 
$catatan = $_POST['catatan'];

if($jenis=="restock"){

mysqli_query($conn,"
UPDATE permintaan_restock
SET kondisi_barang='$kondisi',
catatan='$catatan',
status='dicek'
WHERE id='$id'
");

}else{

mysqli_query($conn,"
UPDATE retur_barang
SET kondisi_barang='$kondisi',
catatan='$catatan',
status='dicek'
WHERE id_retur='$id'
");

}

header("Location: barang_datang.php");
exit;
?>