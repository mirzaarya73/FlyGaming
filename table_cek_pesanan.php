<?php include 'saldo_navbar.php'; 
include 'koneksi.php'; // koneksi ke database
$invoice = isset($_GET['invoice']) ? trim($_GET['invoice']) : '';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>Fly Gaming-Cek Pesanan</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style_data_pesanan.css">
<link rel="stylesheet" type="text/css" href="css/style_dropdown.css">
<body>
    <div class="container">
        <div class="sidebar">
            <div class="header-logo">
                <div class="item-logo">
                    <a href="#">
                        <img src="img/logo.png" class="logo">
                    </a>
                    <span class="nama-logo">Fly Gaming</span>
                </div>
            </div>
            <div class="main">
            <div class="list-item">
                <a href="produk.php">
                    <img src="img/produk.png" class="icon" active>
                    <span class="deskripsi">Produk</span>
                </a>
            </div>
            <div class="list-item">
                <a href="cek_pesanan.php">
                    <img src="img/search.png" class="icon">
                    <span class="deskripsi">Cek Pesanan</span>
                </a>
            </div>
            <div class="list-item">
                <a href="isi_saldo.php">
                    <img src="img/wallet.png" class="icon">
                    <span class="deskripsi">Deposit Saldo</span>
                </a>
            </div>
            <div class="list-item">
                <a href="mutasi.php">
                    <img src="img/mutasi.png" class="icon">
                    <span class="deskripsi">Mutasi Saldo</span>
                </a>
            </div>
            <div class="list-item">
                <a href="magic_wheel.php">
                    <img src="img/magic.png" class="icon">
                    <span class="deskripsi">Magic Wheel</span>
                </a>
            </div>
            <div class="list-item">
                <a href="https://wa.me/62895412035639">
                    <img src="img/cs.png" class="icon">
                    <span class="deskripsi">Helpdesk</span>
                </a>
            </div>
        </div>
        </div>
        <div class="content">
            <div id="menu-button">
                <input type="checkbox" id="menu-checkbox">
                <label for="menu-checkbox" id="menu-label">
                    <div id="hamburger">
                    </div>
                </label>
            </div>
            <div class="navbar">
                <div class="saldo">
                    <span>Saldo : Rp <?= number_format($saldo, 0, ',', '.') ?></span>
                </div>
                <div class="user-dropdown">
                <div class="profil">
                    <button class="dropdown-toggle">
                    <img src="<?= htmlspecialchars($foto) ?>" class="profil-pic">
                    <span class="profil-nama"><?= htmlspecialchars($username) ?></span>
                    <span class="dropdown-arrow">▼</span>
                </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-item">
                            <a href="lihat_akun.php">Lihat Akun</a>
                        </div>
                        <div class="dropdown-item">
                           <a href="logout.php" onclick="return confirmLogout()">Logout</a>

                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="grid">
      <!-- Left Section -->
        <div class="header-riwayat">

<h2>Hasil</h2>
<br>

<table>
    <thead>
      <tr>
        <th>No</th>
        <th>Invoice ID</th>
        <th>User ID</th>
        <th>Paket</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Tanggal Pemesanan</th>
      </tr>
    </thead>
    <tbody>
       <?php
$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$start = ($page - 1) * $per_page;

// Hitung total data
if (!empty($invoice)) {
    $stmt_total = $koneksi->prepare("SELECT COUNT(*) AS total FROM data_joki WHERE invoice = ?");
    $stmt_total->bind_param("s", $invoice);
} else {
    $stmt_total = $koneksi->prepare("SELECT COUNT(*) AS total FROM data_joki");
}
$stmt_total->execute();
$result_total = $stmt_total->get_result();
$row_total = $result_total->fetch_assoc();
$total_data = $row_total ? $row_total['total'] : 0;
$total_pages = ceil($total_data / $per_page);
$stmt_total->close();

// Ambil data untuk halaman ini
if (!empty($invoice)) {
    $stmt = $koneksi->prepare("SELECT * FROM data_joki WHERE invoice = ? LIMIT ?, ?");
    $stmt->bind_param("sii", $invoice, $start, $per_page);
} else {
    $stmt = $koneksi->prepare("SELECT * FROM data_joki LIMIT ?, ?");
    $stmt->bind_param("ii", $start, $per_page);
}
$stmt->execute();
$result = $stmt->get_result();
$no = $start + 1;

// Tampilkan data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['invoice']}</td>
                <td>{$row['id_pengguna']}</td>
                <td>{$row['paket']}</td>
                <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                <td>{$row['status']}</td>
                <td>{$row['tanggal_pesan']}</td>
              </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='7'>Data tidak ditemukan.</td></tr>";
}
$stmt->close();
?>

    </tbody>
  </table>
        </div>
</body>
<script type="text/javascript">

    document.getElementById("btntransaksi").addEventListener("click", function() {
        window.location.href ="data_pesanan.php"
    });
function confirmLogout() {
    return confirm("Apakah kamu yakin ingin logout?");
}

  </script>
</html>