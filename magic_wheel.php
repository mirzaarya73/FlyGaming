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
<link rel="stylesheet" type="text/css" href="css/style_magic_wheel.css">
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

<br>

<div class="magic-wheel-container">
    <div class="calculator-card">
      <div style="text-align: center; margin-bottom: 15px;">
        <img src="img/logo.png" alt="Logo" style="height: 150px;">
      </div>
      <h1>Kalkulator Magic Wheel</h1>
      <p class="description">Digunakan untuk mengetahui total maksimal diamond yang dibutuhkan untuk mendapatkan skin Legends.</p>

      <div class="form-group">
        <label for="poin">Geser sesuai dengan Titik Magic Wheel Anda</label>
        <input type="range" id="poin" name="poin" min="0" max="199" value="10" oninput="update()">
      </div>

      <p><strong>Poin Bintang Kamu:</strong> <span id="poin-text">10</span></p>
      <p><strong>Membutuhkan Maksimal:</strong> <span id="hasil">0</span> Diamond</p>

      <div class="info-section">
        <h3>Cara Menggunakan Kalkulator Magic Wheel</h3>
        <ul>
          <li>Geser slider untuk menentukan jumlah poin bintang yang sudah kamu miliki.</li>
          <li>Kalkulator akan menghitung total diamond maksimal yang dibutuhkan untuk mencapai 200 poin.</li>
          <li>1 kali gacha = 60 diamond (1 poin), 5 kali gacha = 270 diamond (5 poin).</li>
        </ul>
      </div>
    </div>
        </div>
</body>
<script type="text/javascript">
    function update() {
      const poin = document.getElementById("poin").value;
      document.getElementById("poin-text").innerText = poin;

      // Kirim poin ke backend untuk hitung dari stored function
      fetch("proses_magic_wheel.php?poin=" + poin)
        .then(res => res.text())
        .then(data => {
          document.getElementById("hasil").innerText = data;
        });
    }
    update();


    document.getElementById("btntransaksi").addEventListener("click", function() {
        window.location.href ="data_pesanan.php"
    });
function confirmLogout() {
    return confirm("Apakah kamu yakin ingin logout?");
}

  </script>
</html>