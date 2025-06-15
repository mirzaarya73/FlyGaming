<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Isi Saldo</title>
    <link rel="stylesheet" href="css/style_saldo.css">
</head>
<body>
    <div class="saldo-container">
        <h2>Form Isi Saldo</h2>
        <form method="post" action="proses_saldo.php" class="saldo-form" enctype="multipart/form-data">
            <label for="jumlah">Jumlah (Rp):</label>
            <input type="number" id="jumlah" name="jumlah" required min="1000" placeholder="Minimal 1000">

            <label for="bukti">Upload Bukti Transfer:</label>
            <input type="file" id="bukti" name="bukti" accept="uploads/*" required>

            <button type="submit">Isi Saldo</button>
        </form>

        <div class="rekening-info">
            <p><strong>Informasi Rekening Tujuan:</strong></p>
            <p>Nama Rekening: <strong>PT Jasa Top Up Indonesia</strong></p>
            <p>Bank: <strong>BCA</strong></p>
            <p>No. Rekening: <strong>1234567890</strong></p>
        </div>

        <button class="back-button" type="button" onclick="kembali()">Kembali</button>
    </div>
</body>
<script>
    function kembali() {
        window.location.href = "produk.php";
    }
</script>
</html>
