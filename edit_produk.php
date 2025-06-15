<?php
$koneksi = new mysqli("localhost", "root", "", "db_joki");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if (!isset($_GET['id'])) {
    echo "ID produk tidak ditemukan.";
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $harga = $_POST['harga'];
    $gambar = $data['gambar']; // default gambar lama

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["gambar"]["name"]);
        $targetFilePath = $targetDir . time() . "_" . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
                // opsional: hapus gambar lama jika file-nya ada
                if (file_exists($data['gambar'])) {
                    unlink($data['gambar']);
                }
                $gambar = $targetFilePath;
            } else {
                echo "Gagal mengunggah gambar.";
                exit;
            }
        } else {
            echo "Format gambar tidak didukung. Gunakan JPG, PNG, atau WEBP.";
            exit;
        }
    }

    $update = $koneksi->prepare("UPDATE produk SET gambar = ?, harga = ? WHERE id = ?");
    $update->bind_param("sii", $gambar, $harga, $id);

    if ($update->execute()) {
        header("Location: data_produk.php");
        exit;
    } else {
        echo "Gagal mengupdate data.";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
</head>
<link rel="stylesheet" href="css/style_edit.css">
<body>
    <div class="container">
        <h2>Edit Produk</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Nama Game</label><br>
            <input type="text" value="<?= htmlspecialchars($data['nama_produk']) ?>" disabled><br><br>

            <label>Layanan</label><br>
            <input type="text" value="<?= htmlspecialchars($data['layanan']) ?>" disabled><br><br>

            <label>Gambar</label><br>
               <input type="file" name="gambar" accept="image/*"><br>

            <label>Harga</label><br>
            <input type="number" name="harga" value="<?= htmlspecialchars($data['harga']) ?>" required><br><br>

            <button type="submit">Simpan Perubahan</button>
            <a href="data_produk.php">Kembali</a>
        </form>
    </div>
</body>
</html>
