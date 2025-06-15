<?php include 'saldo_navbar.php'; ?>
<?php
include 'koneksi.php';

// Ambil semua produk
$produk = mysqli_query($koneksi, "SELECT * FROM produk");

// Ambil produk best seller dari view ranking_produk
$ranking = mysqli_query($koneksi, "SELECT paket FROM ranking_produk WHERE peringkat = 1 LIMIT 1");
$best_seller_row = mysqli_fetch_assoc($ranking);
$best_seller = $best_seller_row ? $best_seller_row['paket'] : null;
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo.png">
	<title>Beranda</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style_pemesanan.css">
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
                            <a href="index.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
			<div class="grid">
      <!-- Left Section -->
      <div class="left-section">
        <div class="header">
          <img alt="Mobile Legend Image" class="header-img" src="https://storage.googleapis.com/a1aa/image/ibW4IDK9bhqNAxJ6cdi28zvfMmXADBQI7IX1glWEJ4s.jpg"/>
          <div class="header-text">
            <h1>Mobile Legend</h1>
            <p>Joki Rank</p>
          </div>
        </div>
        <div class="warning">
          <p class="warning-title">Peringatan:</p>
          <p>jangan login ketika proses belom selesai jika login maka proses akan kami berhentikan dan di anggap selesai</p>
        </div>
        <div class="tutorial_transaksi">
          <p class="tutorial-title">Cara Transaksi:</p>
          <ol class="list-tutorial">
              <p>
                <li>Masukkan ID & Server Mobile Legends</li>
                <li>Masukkan Username & Password Moonton/Tiktok Facebook (tergantung bind akun)</li>
                <li>pilih layanan yang anda mau</li>
                <li>pilih metode pembayarannya</li>
                <li>Masukkan voucher jika ada</li>
                <li>Masukkan nomor Whatsapp yang aktif</li>
              </p>
          </ol>
        </div>
        <div class="product-info">
          <p class="product-title">🔥 Produk Mobile Legend</p>
          <p>Berikut adalah beberapa produk yang paling populer saat ini</p>
        </div>
      </div>
      <div class="right-section">
      	<form action="proses_pemesanan.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="id_pengguna" value="<?php echo htmlspecialchars($username); ?>">
  <div class="section">
    <div class="section-header">
      <div class="input-section">
        <div class="section-number">1</div>
        <br>
        <div class="section-title">MASUKKAN ID PENGGUNA</div>
        <select name="platform" required>
          <option value="">Pilih Platform</option>
          <option value="Moonton">Moonton</option>
          <option value="Tiktok">Tiktok</option>
          <option value="Facebook">Facebook</option>
        </select>
        <input name="id_pengguna_display" placeholder="Email/No. Hp/Moonton ID" type="text" required />
        <input name="catatan" placeholder="Catatan Untuk Penjoki" type="text" />
      </div>
    </div>
  </div>
  <div class="denomination-section">
    <div class="section-number">2</div>
    <br>
    <h3>PILIH DENOMINASI</h3>
    <br>
    <input type="hidden" name="harga" id="harga_terpilih" />
    <input type="hidden" name="layanan" id="paket_terpilih">
    <div class="denomination-grid">
        <?php
$query = mysqli_query($koneksi, "SELECT * FROM produk");
while ($row = mysqli_fetch_assoc($query)) {
    $harga = $row['harga'];
    $gambar = $row['gambar'];
    $layanan = $row['layanan'];

$is_best = strcasecmp($layanan, $best_seller) === 0;

$class = $is_best ? 'denomination-item best-seller' : 'denomination-item';

    echo '
    <div class="' . $class . '">
        <p>' . htmlspecialchars($layanan) . '</p>
        <div class="gambar-tier">
            <img src="' . htmlspecialchars($gambar) . '" alt="Gambar Produk">
        </div>
        <button type="button" class="price" onclick="updatePaymentAmount(' . $harga . ', \'' . addslashes($layanan) . '\')" required>
            Rp. ' . number_format($harga, 0, ',', '.') . '
        </button>
    </div>';
}
?>


    </div>
</div>
<div class="section">
  <div class="section-header">
    <div class="section-number">3</div>
    <h2 class="section-title">PILIH PEMBAYARAN</h2>
  </div>

  <div class="grid-list" id="paymentList" >
      <div class="grid-item" data-metode="SALDO"onclick="pilihPembayaran('SALDO')"><span>SALDO</span></div>
      <div class="grid-item" data-metode="BCA"onclick="pilihPembayaran('BCA')"><span>BCA</span></div>
      <div class="grid-item" data-metode="BNI"onclick="pilihPembayaran('BNI')"><span>BNI</span></div>
      <div class="grid-item" data-metode="MANDIRI"onclick="pilihPembayaran('MANDIRI')"><span>MANDIRI</span></div>
      <div class="grid-item" data-metode="BRI"onclick="pilihPembayaran('BRI')"><span>BRI</span></div>
      <div class="grid-item" data-metode="DANA"onclick="pilihPembayaran('DANA')"><span>DANA</span></div>
      <div class="grid-item" data-metode="OVO"onclick="pilihPembayaran('OVO')"><span>OVO</span></div>
      <div class="grid-item" data-metode="GOPAY"onclick="pilihPembayaran('GOPAY')"><span>GOPAY</span></div>
    </div>

  <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" required />
</div>

  <div class="section">
    <div class="section-header">
      <div class="section-number">5</div>
      <h2 class="section-title">MASUKKAN NOMOR WHATSAPP</h2>
    </div>
    <input type="number" name="nomor_whatsapp" placeholder="Nomor Whatsapp" class="input" required>
    <div class="total-bayar" id="total-bayar" style="margin-top: 15px; font-weight: bold;"></div>
  </div>
  <button type="submit" class="btn" onclick="return validateForm()">Order Sekarang</button>
  </div>
</form>
    </div>
  </div>

    </div>
		</div>
	</div>
</body>
<script src="script/berhasil_order.js"></script>
<script src="script/harga.js"></script>
<script src="script/animasi.js"></script>
</html>