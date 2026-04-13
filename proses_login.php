<?php
session_start();
include "config.php";

$role     = $_POST['role'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($role == "" || $username == "" || $password == "") {
    echo "<script> 
        alert('Username, Password, dan Role Wajib Diisi!');
        window.location='index.php'; 
    </script>";
    exit; 
}

$query = mysqli_query($conn, 
    "SELECT * FROM users 
    WHERE username='$username' 
    AND password='$password' 
    AND role='$role'");

$data = mysqli_fetch_assoc($query); 

if($data) {
    $_SESSION['login'] = true; 
    $_SESSION['role'] = $data['role']; 
    $_SESSION['username'] = $data['username']; 

    // Redirect halaman sesuai role 
    // Setelah itu nanti bisa menggunakan elseif 
    if ($data['role'] == 'Kasir') {
        header("Location: dashboard_kasir.php"); 
    } elseif ($data['role'] == 'Admin') {
        header("Location: Admin/dashboard_admin.php"); 
    } elseif ($data['role'] == 'Supplier') {
        header("Location: Supplier/dashboard_supplier.php"); 
    } elseif ($data['role'] == 'Petugas_Gudang') {
        header("Location: Petugas_Gudang/dashboard_petugas_gudang.php"); 
    } elseif ($data['role'] == 'Manajer_Gudang') {
        header("Location: Manajer_Gudang/dashboard_manajer_gudang.php"); 
    }
} else {
    echo "<script>
        alert('Maaf Login Gagal! Username atau Password Anda Salah');
        window.location='index.php';
    </script>"; 
}
?>