<?php
include 'saldo_navbar.php';
include 'koneksi.php';

$total_selesai = 0;
$total_proses = 0;
$total_batal = 0;

$q1 = $koneksi->query("SELECT COUNT(*) as total FROM data_joki WHERE status = 'Selesai'");
if ($row = $q1->fetch_assoc()) {
    $total_selesai = $row['total'];
}
$q2 = $koneksi->query("SELECT COUNT(*) as total FROM data_joki WHERE status = 'pending'");
if ($row = $q2->fetch_assoc()) {
    $total_proses = $row['total'];
}
$q3 = $koneksi->query("SELECT COUNT(*) as total FROM data_joki WHERE status = 'batal'");
if ($row = $q3->fetch_assoc()) {
    $total_batal = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>Fly Gaming - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style_dasboard.css">
    <link rel="stylesheet" type="text/css" href="css/style_dropdown.css">
    <link rel="stylesheet" type="text/css" href="css/style_admin.css">
</head>
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
                    <a href="dasboard.php">
                        <img src="img/dasboard.png" class="icon" active>
                        <span class="deskripsi">Dasboard</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="data_akses.php">
                        <img src="img/user2.png" class="icon">
                        <span class="deskripsi">Data Akses</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="data_produk.php">
                        <img src="img/produk.png" class="icon">
                        <span class="deskripsi">Data Produk</span>
                    </a>
                </div>
                <div class="list-item">
                    <a href="data_pesanan.php">
                        <img src="img/search-alt.png" class="icon">
                        <span class="deskripsi">Data Pesanan</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <div id="menu-button">
                <input type="checkbox" id="menu-checkbox">
                <label for="menu-checkbox" id="menu-label">
                    <div id="hamburger"></div>
                </label>
            </div>
            <div class="navbar">
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
            <div class="dashboard-center">
                <h2 class="dashboard-title">Ringkasan Transaksi</h2>
                <div class="dashboard-summary">
                    <div class="summary-box selesai">
                        <strong>Selesai</strong>
                        <span><?= $total_selesai ?></span>
                    </div>
                    <div class="summary-box proses">
                        <strong>Proses</strong>
                        <span><?= $total_proses ?></span>
                    </div>
                    <div class="summary-box batal">
                        <strong>Batal</strong>
                        <span><?= $total_batal ?></span>
                    </div>
                </div>
                <div class="dashboard-info">
                    <h2>Selamat datang di Dashboard Admin Fly Gaming!</h2>
                    <p>Gunakan menu di samping untuk mengelola data akses, produk, dan pesanan.</p>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
function confirmLogout() {
    return confirm("Apakah kamu yakin ingin logout?");
}
</script>
</html>
