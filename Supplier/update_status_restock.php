<?php
include "../config.php";

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn,"
UPDATE permintaan_restock
SET status='$status'
WHERE id='$id'
");

header("Location: melihat_restock.php");
?>