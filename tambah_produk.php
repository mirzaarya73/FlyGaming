<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $layanan = $_POST['layanan'];
    $harga = $_POST['harga'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $folder = "uploads/";
    $nama_file_baru = time() . "_" . basename($gambar);
    $path_simpan = $folder . $nama_file_baru;

    if (move_uploaded_file($tmp_name, $path_simpan)) {
        $query = "INSERT INTO produk (nama_produk,layanan, gambar, harga) VALUES ('$nama_produk', '$layanan', '$path_simpan', $harga)";
        mysqli_query($koneksi, $query);
        header("Location: data_produk.php");
        exit;
    } else {
        echo "Gagal upload gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="css/style_tambah_produk.css"> <!-- gunakan CSS login -->
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h2>Tambah Produk</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="nama_produk" placeholder="Nama Game" required>
                <input type="text" name="layanan" placeholder="Layanan" required>
                <input type="number" name="harga" placeholder="Harga (tanpa titik/koma)" required>
                <input type="file" name="gambar" accept="image/*" required>
                <button type="submit">Simpan</button>
            </form>
            <div style="margin-top: 10px; text-align: center;">
                <a href="data_produk.php" style="color: white; text-decoration: underline;">← Kembali ke Daftar Produk</a>
            </div>
        </div>
    </div>
</body>
</html>
