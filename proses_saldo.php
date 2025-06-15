<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href = 'login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$jumlah = (int) $_POST['jumlah'];

if ($jumlah <= 0) {
    echo "<script>alert('Jumlah saldo tidak valid.'); window.history.back();</script>";
    exit;
}

// Lakukan penambahan saldo
$update = mysqli_query($koneksi, "UPDATE akses SET saldo = saldo + $jumlah WHERE id = $user_id");

if ($update) {
    // Tambahkan mutasi
    $keterangan = "Isi saldo manual via form";
    mysqli_query($koneksi, "INSERT INTO mutasi_saldo (user_id, tipe, jumlah, keterangan)
                         VALUES ($user_id, 'kredit', $jumlah, '$keterangan')");

    echo "<script>alert('Saldo berhasil ditambahkan.'); window.location.href = 'mutasi.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan saldo.'); window.history.back();</script>";
}
?>