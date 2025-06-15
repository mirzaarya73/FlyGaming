<?php
include 'koneksi.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? 'pembeli'; // default jika tidak diisi

// Validasi dasar
if (empty($username) || empty($password) || empty($role)) {
    echo "<script>alert('Semua field harus diisi!'); window.location.href='register.php';</script>";
    exit;
}

// Cek apakah username sudah digunakan
$stmt = $koneksi->prepare("SELECT id FROM akses WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('Username sudah digunakan!'); window.location.href='register.php';</script>";
    exit;
}
$stmt->close();

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Default foto dan saldo
$foto = 'img/default.jpg';
$saldo = 0;

// Masukkan data ke database
$stmt = $koneksi->prepare("INSERT INTO akses (username, password, role, foto, saldo) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $username, $hashedPassword, $role, $foto, $saldo);

if ($stmt->execute()) {
    echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
} else {
    echo "<script>alert('Gagal registrasi. Silakan coba lagi.'); window.location.href='register.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>

</body>
</html>