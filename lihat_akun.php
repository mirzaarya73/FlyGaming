<?php
session_start();

include 'koneksi.php';

// Inisialisasi data sesi jika belum ada
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Ganti dengan ID user dari sistem login kamu
}

// Ambil data user dari database berdasarkan user_id
$user_id = $_SESSION['user_id'];
$result = $koneksi->query("SELECT * FROM akses WHERE id = $user_id");
$user = $result->fetch_assoc();

if (!isset($_SESSION['foto'])) {
    $_SESSION['foto'] = $user['foto'] ?? 'img/default.png';
}
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = $user['username'];
}

// Proses edit foto profil
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_foto'])) {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target = 'uploads/' . basename($_FILES['foto']['name']);
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $_SESSION['foto'] = $target;

            // Simpan ke database
            $stmt = $koneksi->prepare("UPDATE akses SET foto = ? WHERE id = ?");
            $stmt->bind_param("si", $target, $user_id);
            $stmt->execute();

            $pesan_foto = "Foto profil berhasil diubah!";
        }
    }
}

// Proses edit nama & email
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_data'])) {
    $new_username = $_POST['username'];

    $_SESSION['username'] = $new_username;

    // Simpan ke database
    $stmt = $koneksi->prepare("UPDATE akses SET username = ? WHERE id = ?");
    $stmt->bind_param("si", $new_username, $user_id);
    $stmt->execute();

    $pesan_data = "Profil berhasil diperbarui!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lihat & Edit Profil</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .form-container { max-width: 400px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 10px; }
        input[type="text"], input[type="email"], input[type="file"] {
            width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px;
        }
        input[type="submit"] {
            background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px;
        }
        .pesan { color: green; }
        .foto-profil {
            display: block;
            margin: auto;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Profil Saya</h2>

    <img src="<?= $_SESSION['foto'] ?>" class="foto-profil" alt="Foto Profil">

    <?php if (!empty($pesan_foto)) echo "<p class='pesan'>$pesan_foto</p>"; ?>
    <form method="POST" enctype="multipart/form-data">
        <label>Ubah Foto Profil:</label>
        <input type="file" name="foto" accept="image/*">
        <input type="submit" name="update_foto" value="Simpan Foto">
    </form>

    <hr>

    <?php if (!empty($pesan_data)) echo "<p class='pesan'>$pesan_data</p>"; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" value="<?= $_SESSION['username'] ?>" required>

        <input type="submit" name="update_data" value="Simpan Perubahan">
    </form>
    <br>
<a href="produk.php">
    <button type="button" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px;">
        ⬅ Kembali ke Produk
    </button>
</a>
</div>

</body>
</html>
