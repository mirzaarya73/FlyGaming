<?php include 'saldo_navbar.php'; ?>

<?php
include 'koneksi.php'; // file koneksi ke database

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data user (saldo & username)
$queryUser = mysqli_query($koneksi, "SELECT username, saldo FROM akses WHERE id = $user_id");
$user = mysqli_fetch_assoc($queryUser);

// Ambil riwayat mutasi saldo
$queryMutasi = mysqli_query($koneksi, "SELECT * FROM mutasi_saldo WHERE user_id = $user_id ORDER BY created_at DESC");
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

<h2>Mutasi Saldo</h2>
<br>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Tipe</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($queryMutasi) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($queryMutasi)): ?>
                <tr>
                    <td><?= $row['created_at'] ?></td>
                    <td><?= ucfirst($row['tipe']) ?></td>
                    <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">Belum ada riwayat mutasi saldo.</td></tr>
        <?php endif; ?>
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