<?php
include 'koneksi.php';

$id = $_GET['id'];

// Hapus user dari database
$query = "DELETE FROM produk WHERE id = $id";
mysqli_query($koneksi, $query);

header("Location: data_produk.php");
exit;
?>