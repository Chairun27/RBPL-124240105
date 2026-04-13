<?php
session_start();
include "../config.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../index.php");
}

// Menghitung stok menipis 
// $notif = mysqli_query($conn,"
// SELECT COUNT(*) as total 
// FROM produk 
// WHERE stok <= stok_minimum
// ");

// $data_notif = mysqli_fetch_assoc($notif);
// $total_notif = $data_notif['total'];

// Mengambil data produk 
// $query = mysqli_query($conn,"SELECT * FROM produk");

$notif = mysqli_query($conn,"
SELECT COUNT(*) as total 
FROM produk 
WHERE stok <= stok_minimum
");

$data_notif = mysqli_fetch_assoc($notif);
$total_notif = $data_notif['total'];

$search = isset($_GET['search']) ? $_GET['search'] : "";
$status = isset($_GET['status']) ? $_GET['status'] : "";
$sort   = isset($_GET['sort']) ? $_GET['sort'] : "";

$sql = "SELECT * FROM produk WHERE 1=1";

if($search != ""){
    $sql .= " AND nama_produk LIKE '%$search%'";
}

if($status == "aman"){
    $sql .= " AND stok > stok_minimum";
}

elseif($status == "menipis"){
    $sql .= " AND stok <= stok_minimum AND stok > 0";
}

elseif($status == "habis"){
    $sql .= " AND stok = 0";
}

if($sort == "terbanyak"){
    $sql .= " ORDER BY stok DESC";
}

elseif($sort == "tersedikit"){
    $sql .= " ORDER BY stok ASC";
}

$query = mysqli_query($conn,$sql);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang</title>
    <link rel="stylesheet" href="style_stok.css"> 
</head>
<body>
<div class="mobile-wrapper">
    <div class="header">
        <span><a href="dashboard_admin.php" class="back">←</a></span>  
        <h3>Stok Barang</h3> 
    </div>

    <?php if($total_notif > 0){ ?>
        <div class="notif-warning">
            ⚠ Peringatan Stok Minimum 
            <p> 
            <?php echo $total_notif ?> barang mencapai stok minimum
        </div>
    <?php } ?>

    <div class="filter-box">
        <form method="GET">
            <input type="text" name="search" placeholder="Cari produk..." 
            value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

            <select name="status">
                <option value="">Semua Status</option>
                <option value="aman">Aman</option>
                <option value="menipis">Menipis</option>
                <option value="habis">Habis</option>
            </select>

            <select name="sort">
                <option value="">Urutkan Stok</option>
                <option value="terbanyak">Stok Paling Banyak</option>
                <option value="tersedikit">Stok Paling Sedikit</option>
            </select>

            <button type="submit">Filter</button>
        </form>
    </div>

    <div class="produk-container">
        <?php while($row = mysqli_fetch_assoc($query)) { 

            if($row['stok'] == 0){
                $status = "Habis";
                $class = "habis";
            }
            elseif($row['stok'] <= $row['stok_minimum']){
                $status = "Menipis";
                $class = "menipis";
            }
            else{
                $status = "Aman";
                $class = "aman";
            }
        ?>

    <div class="card">
    <img src="../assets/<?php echo $row['gambar']; ?>" class="produk-img"> 

        <h3><?php echo $row['nama_produk']; ?></h3>

        <p>Stok Saat Ini : <b><?php echo $row['stok']; ?></b></p>

        <p>Stok Minimum : <b><?php echo $row['stok_minimum']; ?></b></p>

        <span class="status <?php echo $class ?>">
            <?php echo $status ?>
        </span>

        <?php if($status != "Aman"){ ?>
        <a href="form_restock.php?id=<?php echo $row['id']; ?>" class="btn-restock">
            + Restock
        </a>
        <?php } ?>
    </div>
    <?php } ?>
    
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