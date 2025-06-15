<?php include 'saldo_navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/logo.png">
	<title>Fly Gaming-Produk</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style_produk.css">
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
				<a href="#">
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
      <div class="left-section">
			<!-- Menu Button & Navbar (tidak saya ubah) -->
			<div class="grid-category">
				<!-- Mobile Section -->
				<div class="category">
					<div class="header">
						<h1 class="category-title">Mobile</h1>
					</div>
					<div class="grid-produk">
						<!-- Produk Mobile -->
						<a href="form-pemesanan.php">
							<div class="card">
								<div class="bs">
									<img src="img/ml.webp"/>
									<h2>Mobile Legends</h2>
								<p>Moonton</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/mc.webp"/>
									<h2>Magic Chess Go Go</h2>
								<p>Moonton</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/hok.webp"/><h2>Honor of Kings</h2>
								<p>TiMi Studio</p>
								</div>
							</div></a>
						<a href="#">
							<div class="bs">
								<div class="card">
							<img src="img/pubg.jpeg"/><h2>PUBG</h2> <p>Tencent</p>
							</div>
							
						</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/ff.webp"/><h2>Free Fire</h2>
								<p>Garena</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/genshin.webp"/>
									<h2>Genshin Impact</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/bs.jpeg"/>
									<h2>Blood Strike</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/sausaga.webp"/>
									<h2>Sausaga Man</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/arena.webp"/>
									<h2>Arena Breakout</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/lm.webp"/>
									<h2>Lord Mobile</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/codm.jpg"/>
									<h2>Call of Duty Mobile</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/bs.jpeg"/>
									<h2>Blood Strike</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/undawn.webp"/>
									<h2>Undawn</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/honkai.jpeg"/>
									<h2>Honkai Impact</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
				</div>

				<!-- PC Section -->
				<div class="category-pc">
					<div class="header">
						<h1 class="category-title">PC</h1>
					</div>
					<div class="grid-pc">
						<!-- Produk PC -->
							<div class="card">
								<div class="bs">
							    <img src="img/dota.png" width="100" height="200"><h2> Dota 2</h2>
								</div>
							    <p>Valve</p>
							</a>
						    </div>
						<a href="#">
						   <div class="bs">
						   	 <div class="card">
							<img src="img/valorant.webp"/>
							<h2>Valorant</h2>
							<p>Riot Games</p>
						   </div>
						  </div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/lol.webp"/>
									<h2>League of Legends</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/fortnite.jpeg"/>
									<h2>Fortnite</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/apex.webp"/>
									<h2>Apex Legends</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="card">
								<div class="bs">
									<img src="img/pb.webp"/>
									<h2>Point Blank</h2>
								<p>HoYoverse</p>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<?php include 'footer.php'; ?>
		</div>
		</div>
	</div>
</body>
<script>
function confirmLogout() {
    return confirm("Apakah kamu yakin ingin logout?");
}
</script>

<script src="script/harga.js"></script>
<script src="script/animasi.js"></script>
</html>