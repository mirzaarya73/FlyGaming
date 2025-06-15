<?php
include 'koneksi.php'; // File koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $passwordBaru = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

    // Cek apakah username ada
    $cek = $koneksi->prepare("SELECT id FROM akses WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        // Update password
        $update = $koneksi->prepare("UPDATE akses SET password = ? WHERE username = ?");
        $update->bind_param("ss", $passwordBaru, $username);
        if ($update->execute()) {
            echo "<script>alert('Berhasil merubah password!'); window.location.href='login.php';</script>";
        } else {
            echo "alert('Gagal mereset password.')";
            header("Location: lupa_password.php");
        }
        $update->close();
    } else {
        echo "Username tidak ditemukan.";
    }

    $cek->close();
} else {
    echo "Akses tidak sah.";
}
?>
