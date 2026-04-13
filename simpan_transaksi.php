<?php
date_default_timezone_set("Asia/Jakarta");

$conn = mysqli_connect("localhost", "root", "", "db_toko_elektronik");

$dataProduk = json_decode($_POST['data_produk'], true);
$totalHarga = $_POST['total_harga'];
$totalUnit  = $_POST['total_unit'];
$tanggal    = date("Y-m-d H:i:s");

// SIMPAN KE TABEL TRANSAKSI
mysqli_query($conn, "
    INSERT INTO transaksi (tanggal, total_harga, total_unit)
    VALUES ('$tanggal', '$totalHarga', '$totalUnit')
");

$transaksi_id = mysqli_insert_id($conn);

// SIMPAN DETAIL + CEK STOK
foreach ($dataProduk as $item) {

    $produk_id = $item['id'];
    $qty       = $item['qty'];

    // CEK STOK DULU
    $cek = mysqli_query($conn,
        "SELECT stok FROM produk WHERE id = '$produk_id'"
    );

    $dataStok = mysqli_fetch_assoc($cek);

    if ($dataStok['stok'] < $qty) {
        die("Stok tidak mencukupi untuk produk: " . $item['name']);
    }

    // SIMPAN DETAIL TRANSAKSI
    mysqli_query($conn, "
        INSERT INTO detail_transaksi
        (transaksi_id, produk_id, nama_produk, harga, qty, subtotal)
        VALUES (
            '$transaksi_id',
            '$produk_id',
            '{$item['name']}',
            '{$item['harga']}',
            '$qty',
            '{$item['subtotal']}'
        )
    ");

    // KURANGI STOK
    mysqli_query($conn, "
        UPDATE produk
        SET stok = stok - $qty
        WHERE id = '$produk_id'
    ");
}

// redirect ke struk
header("Location: struk.php?id=$transaksi_id");
exit; 
?>