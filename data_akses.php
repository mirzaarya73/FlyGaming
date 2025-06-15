<?php include 'saldo_navbar.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>Fly Gaming-Cek Pesanan</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style_data_akses.css">
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
                <a href="dasboard.php">
                    <img src="img/dasboard.png" class="icon" active>
                    <span class="deskripsi">Dasboard</span>
                </a>
            </div>

            <div class="list-item">
                <a href="data_akses.php">
                    <img src="img/user2.png" class="icon" active>
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
              <h2>Daftar Akses</h2>
    <table class="tabel-produk">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>role</th>
                <th>saldo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $query = "SELECT * FROM akses";
        $result = $koneksi->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                echo "<td>Rp " . number_format($row['saldo'], 0, ',', '.') . "</td>";
                echo "<td>
                        <a href='edit_user.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a>
                        <a href='delete_user.php?id=" . $row['id'] . "' class='btn-delete' onclick=\"return confirm('Yakin ingin menghapus?')\">Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data produk.</td></tr>";
        }

        $koneksi->close();
        ?>
    </div>
        </div>
</body>
<script type="text/javascript">

    document.getElementById("btntransaksi").addEventListener("click", function() {
        window.location.href ="table_cek_pesanan.php"
    });

function confirmLogout() {
    return confirm("Apakah kamu yakin ingin logout?");
}
  </script>
<script src="script/harga.js"></script>
<script src="script/animasi.js"></script>
</html>