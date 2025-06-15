<?php
include "koneksi.php";

$poin = isset($_GET['poin']) ? intval($_GET['poin']) : 0;

if ($poin < 0 || $poin > 199) {
    echo 0;
    exit;
}

$stmt = $koneksi->prepare("SELECT hitung_diamond_magicwheel(?) AS diamond");
$stmt->bind_param("i", $poin);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo $row['diamond'];
?>

