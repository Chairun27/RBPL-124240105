<?php
include "../config.php";

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn,"
UPDATE retur_barang 
SET status='$status'
WHERE id_retur='$id'
");

header("location:permintaan_retur.php");
?>