<?php
session_start();
include "../config.php";

$query = "
SELECT pr.*, p.nama_produk 
FROM permintaan_restock pr
JOIN produk p ON pr.produk_id = p.id
ORDER BY pr.tanggal_permintaan DESC
";

$data = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Permintaan Restock Barang</title>
    <link rel="stylesheet" href="style_supplier.css">
</head>
<body>
<div class="mobile-wrapper">
    <div class="header1">
        <a href="dashboard_supplier.php" class="back">←</a>
        <h3>Melihat Permintaan Restock</h3>
    </div>

<div class="menu">
<div class="table-scroll"> 
    <div class="table-card">
        <table class="restock-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>    

            <tbody>
            <?php while($row = mysqli_fetch_assoc($data)) { ?>

            <?php 
                $status = strtolower(trim($row['status']));
            ?>

                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nama_produk'] ?></td>
                    <td><?= $row['jumlah_permintaan'] ?></td>
                    <td><?= date("d-m-Y",strtotime($row['tanggal_permintaan'])) ?></td>

                    <td>
                    <?php
                    if($status=="menunggu"){
                        echo "<span class='badge badge-menunggu'>Menunggu</span>";
                    }
                    elseif($status=="diproses"){
                        echo "<span class='badge badge-diproses'>Diproses</span>";
                    }
                    elseif($status=="dikirim"){
                        echo "<span class='badge badge-dikirim'>Dikirim</span>";
                    }
                    ?>
                    </td>

                    <td>
                    <?php
                    if($status=="menunggu"){
                    ?>

                    <a href="update_status_restock.php?id=<?= $row['id'] ?>&status=diproses" class="btn-proses">
                    Proses
                    </a>

                    <?php
                    }
                    elseif($status=="diproses"){
                    ?>

                    <a href="update_status_restock.php?id=<?= $row['id'] ?>&status=dikirim" class="btn-kirim">
                    Kirim
                    </a>

                    <?php
                    }
                    else{
                        echo "-";
                    }
                    ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>     
        </table>
    </div>
</div> 
</div>

    <div class="bottom-nav">
        <a href="dashboard_supplier.php">🏠</a>
        <a href="melihat_restock.php">📦</a>
        <a href="permintaan_retur.php">↩️</a>
        <a href="pengiriman_barang.php">🚚</a>
    </div>
</div>
</body>
</html>