<?php
include 'koneksi.php';

// Cek apakah ada kode invoice
if (!isset($_GET['kode'])) {
    echo "Invoice tidak ditemukan.";
    exit;
}

$invoice = $_GET['kode'];

// Query cari data berdasarkan invoice
$query = "SELECT * FROM data_joki WHERE invoice = '$invoice'";
$result = mysqli_query($koneksi, $query);

if (!$row = mysqli_fetch_assoc($result)) {
    echo "Data pesanan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice Pesanan</title>
    <link rel="stylesheet" href="css/style_invoice.css"> <!-- kalau kamu punya CSS sendiri -->
</head>
<body>
    <div class="container">
        <h1>✅ Pesanan Berhasil!</h1>
        <p>Terima kasih sudah memesan joki di Fly Gaming 🚀</p>

        <h2>Detail Invoice</h2>
        <ul>
            <li><strong>Invoice:</strong> <?= $row['invoice'] ?></li>
            <li><strong>Platform:</strong> <?= $row['platform'] ?></li>
            <li><strong>Paket:</strong> <?= $row['paket'] ?></li>
            <li><strong>Harga:</strong> Rp <?= number_format($row['harga'], 0, ',', '.') ?></li>
            <li><strong>Status:</strong> <?= ucfirst($row['status']) ?></li>
            <li><strong>Metode Pembayaran:</strong> <?= $row['metode_pembayaran'] ?></li>
            <li><strong>Catatan:</strong> <?= $row['catatan'] ?></li>
            <li><strong>Nomor WhatsApp:</strong> <?= $row['nomor_whatsapp'] ?></li>
        </ul>

        <a href="cek_pesanan.php"><button>Kembali ke Cek Pesanan</button></a>
    </div>
</body>
</html>
