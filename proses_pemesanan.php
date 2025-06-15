<?php
include 'koneksi.php';
session_start();

// Validasi input penting
if (
    !isset($_POST['id_pengguna']) ||
    !isset($_POST['platform']) ||
    !isset($_POST['harga']) ||
    !isset($_POST['layanan']) ||
    !isset($_POST['metode_pembayaran']) ||
    !isset($_POST['nomor_whatsapp'])
) {
    echo "<script>alert('Data tidak lengkap.'); window.history.back();</script>";
    exit;
}

// Ambil dan amankan input
$id_pengguna      = mysqli_real_escape_string($koneksi, $_POST['id_pengguna']);
$platform         = mysqli_real_escape_string($koneksi, $_POST['platform']);
$catatan          = mysqli_real_escape_string($koneksi, $_POST['catatan']);
$harga            = (int) $_POST['harga'];
$paket            = mysqli_real_escape_string($koneksi, $_POST['layanan']);
$metode           = mysqli_real_escape_string($koneksi, $_POST['metode_pembayaran']);
$nomor_whatsapp   = mysqli_real_escape_string($koneksi, $_POST['nomor_whatsapp']);
$status           = "pending";


// Validasi saldo jika metode pembayaran = SALDO
if (strtoupper($metode) === 'SALDO') {
    $cek_saldo = mysqli_query($koneksi, "SELECT saldo FROM akses WHERE username = '$id_pengguna'");
    $data_saldo = mysqli_fetch_assoc($cek_saldo);

    if (!$data_saldo) {
        echo "<script>alert('Pengguna tidak ditemukan.'); window.history.back();</script>";
        exit;
    }

    if ($data_saldo['saldo'] < $harga) {
        echo "<script>alert('Saldo tidak mencukupi. Silakan isi ulang terlebih dahulu.'); window.location.href='form-pemesanan.php';</script>";
        exit;
    }
}

// Generate invoice baru
$query_invoice = "SELECT invoice FROM data_joki ORDER BY id DESC LIMIT 1";
$result_invoice = mysqli_query($koneksi, $query_invoice);
$lastinvoice = "INV00";
if ($row = mysqli_fetch_assoc($result_invoice)) {
    $lastinvoice = $row['invoice'];
}
$number = (int) substr($lastinvoice, 3);
$number++;
$newinvoice = "INV" . str_pad($number, 2, '0', STR_PAD_LEFT);

// Simpan data pemesanan
$query = "INSERT INTO data_joki (
    id_pengguna, platform, catatan, paket, harga, metode_pembayaran, nomor_whatsapp, status, invoice
) VALUES (
    '$id_pengguna', '$platform', '$catatan', '$paket', $harga, '$metode', '$nomor_whatsapp', '$status', '$newinvoice'
)";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Pesanan berhasil dibuat!'); window.location.href='invoice.php?kode=$newinvoice';</script>";
} else {
    $error = mysqli_error($koneksi);
    echo "<script>alert('Terjadi kesalahan saat menyimpan data: " . addslashes($error) . "'); window.history.back();</script>";
}

file_put_contents('log_saldo.txt', "[$id_pengguna] potong saldo: $harga\n", FILE_APPEND);

?>


