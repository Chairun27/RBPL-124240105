<?php
$conn = mysqli_connect("localhost", "root", "", "db_toko_elektronik");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

date_default_timezone_set("Asia/Jakarta"); 
?>