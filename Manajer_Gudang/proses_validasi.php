<?php
include "../config.php";

$id    = $_GET['id'];
$jenis = $_GET['jenis'];
$aksi  = $_GET['aksi'];

// Restock barang 
if($jenis=="restock"){

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM permintaan_restock WHERE id='$id'
"));

$kondisi = strtolower(trim($data['kondisi_barang']));

// Validasi 
if($aksi=="validasi"){

    if($kondisi === "baik"){

        // Tambah stok 
        mysqli_query($conn,"
        UPDATE produk 
        SET stok = stok + ".$data['jumlah_permintaan']."
        WHERE id = ".$data['produk_id']."
        ");

        // Status 
        mysqli_query($conn,"
        UPDATE permintaan_restock 
        SET status='selesai'
        WHERE id='$id'
        ");

    }else{

        // Auto tolak 
        mysqli_query($conn,"
        UPDATE permintaan_restock 
        SET status='ditolak'
        WHERE id='$id'
        ");
    }

}

// Tolak 
elseif($aksi=="tolak"){

    mysqli_query($conn,"
    UPDATE permintaan_restock 
    SET status='ditolak'
    WHERE id='$id'
    ");

}

}

// Retur barang 
elseif($jenis=="retur"){

$data = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM retur_barang WHERE id_retur='$id'
"));

$kondisi = strtolower(trim($data['kondisi_barang']));

// Validasi 
if($aksi=="validasi"){

    if($kondisi === "baik"){

        // Tambah stok 
        mysqli_query($conn,"
        UPDATE produk 
        SET stok = stok + ".$data['jumlah']."
        WHERE id = ".$data['id_barang']."
        ");

        // Status 
        mysqli_query($conn,"
        UPDATE retur_barang 
        SET status='selesai'
        WHERE id_retur='$id'
        ");

    }else{

        mysqli_query($conn,"
        UPDATE retur_barang 
        SET status='ditolak'
        WHERE id_retur='$id'
        ");
    }

}

// Tolak 
elseif($aksi=="tolak"){

    mysqli_query($conn,"
    UPDATE retur_barang 
    SET status='ditolak'
    WHERE id_retur='$id'
    ");

}

}

header("Location: validasi_barang.php");
exit;
?>