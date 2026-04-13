<?php
$conn = mysqli_connect("localhost", "root", "", "db_toko_elektronik");

if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan");
}

$id = (int) $_GET['id'];

$trxQuery = mysqli_query($conn,
    "SELECT * FROM transaksi WHERE id = $id");

if (mysqli_num_rows($trxQuery) == 0) {
    die("Transaksi tidak ditemukan");
}

$trx = mysqli_fetch_assoc($trxQuery);

$detail = mysqli_query($conn,
    "SELECT * FROM detail_transaksi WHERE transaksi_id = $id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <link rel="stylesheet" href="struk.css"> 
</head>
<body>
    <div class="struk-container">
    <div class="struk">

        <h2>TOKO ELEKTRONIK ENGGAL MULYO</h2>
        <p class="alamat">Bugisan, Prambanan, Klaten</p>

        <hr>

        <p class="info">
            Tanggal: <?= date("d-m-Y", strtotime($trx['tanggal'])) ?><br>
            Waktu: <?= date("H:i:s", strtotime($trx['tanggal'])) ?>
        </p>

        <hr>

        <table>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>

            <?php while($d = mysqli_fetch_assoc($detail)): ?>
            <tr>
                <td><?= $d['nama_produk'] ?></td>
                <td class="center"><?= $d['qty'] ?></td>
                <td class="right">Rp <?= number_format($d['subtotal']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <hr>

        <div class="summary">
            <p>Total Bayar</p>
            <h3>Rp <?= number_format($trx['total_harga']) ?></h3>
        </div>

        <hr>

        <p class="thanks">
            Terima kasih 🙏<br>
            Selamat Berbelanja
        </p>

        <hr> 

        <!-- Tombol cetak struk -->
        <div class="aksi">
            <button onclick="cetakStruk()" class="btn-print">🖨️ Cetak Struk</button>
        </div>

        <div id="notif" class="notif">Struk Pembayaran Berhasil Dicetak ✅</div>

    </div>
</div>

<script>
function cetakStruk() {
    window.print();

    const notif = document.getElementById("notif");
    notif.style.display = "block";

    setTimeout(() => {
        notif.style.display = "none";
    }, 3000);
}
</script>

</body>
</html>