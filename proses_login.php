<?php
session_start();
include 'koneksi.php';


// Ambil input dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Validasi input
if (empty($username) || empty($password)) {
    echo "<script>alert('Username dan password wajib diisi!'); window.location.href='login.php';</script>";
    exit;
}

// Ambil data user dari database
$query = "SELECT * FROM akses WHERE username = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Simpan data user di session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['foto'] = $user['foto'];
        $_SESSION['saldo'] = $user['saldo'];
        $_SESSION['role'] = $user['role'];


        // Redirect berdasarkan role
        if ($user['role'] === 'admin') {
            header("Location: dasboard.php");
        } else {
            header("Location: produk.php");
        }
        exit;
    } else {
        echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Username tidak ditemukan!'); window.location.href='login.php';</script>";
}
?>
