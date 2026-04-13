<?php
include "../config.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';

if($id != '' && $jenis != ''){

    // Restock barang 
    if($jenis == "restock"){

        $query = "UPDATE permintaan_restock 
        SET status='dikirim' 
        WHERE id='$id'";

        mysqli_query($conn,$query);
    }

    // Retur barang 
    elseif($jenis == "retur"){

        $query = "UPDATE retur_barang 
        SET status='dikirim' 
        WHERE id_retur='$id'";

        mysqli_query($conn,$query);
    }

}

header("Location: pengiriman_barang.php");
exit;
?>