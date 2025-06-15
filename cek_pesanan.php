<?php 
include 'saldo_navbar.php'; 
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
<link rel="stylesheet" type="text/css" href="css/style_cek_pesanan.css">
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
		</div>		</div>
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
      <div class="left-section">
        <div class="header-riwayat">
          <h1 class="title">Cek Pesanan</h1>
        <p class="subtitle">Masukkan nomor invoice transaksi untuk melihat detail order dan proses pembayaran</p>
        <form method="GET" action="table_cek_pesanan.php">
        	<div class="input-group">
            <input type="text" name="invoice"placeholder="Masukkan kode Invoice..">
            <button id="btntransaksi">Telusuri</button>
    </div>
        </form>
		</div>
	</div>
</body>
<script src="script/harga.js"></script>
<script src="script/animasi.js"></script>
<script>
function confirmLogout() {
    return confirm("Apakah kamu yakin ingin logout?");
}
</script>
</html>