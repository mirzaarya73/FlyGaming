<?php include 'saldo_navbar.php'; ?>

<?php
include 'koneksi.php';

// Proses update status
if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    
    $query = "UPDATE data_joki SET status = '$status' WHERE id = $id";
    mysqli_query($koneksi, $query);
    echo "<script>alert('Status berhasil diupdate!'); window.location='data_pesanan.php';</script>";
}

// Ambil parameter search jika ada
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$where_clause = '';
if (!empty($search)) {
    $where_clause = "WHERE id_pengguna LIKE '%$search%' OR paket LIKE '%$search%' OR status LIKE '%$search%'";
}

// Konfigurasi pagination
$per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = ($page < 1) ? 1 : $page;
$start = ($page - 1) * $per_page;

// Hitung total data dengan kondisi search
$query_total = "SELECT COUNT(*) as total FROM data_joki $where_clause";
$result_total = mysqli_query($koneksi, $query_total);
$total_data = mysqli_fetch_assoc($result_total)['total'];
$total_pages = ceil($total_data / $per_page);

// Ambil data pesanan dengan pagination dan search
$query = "SELECT * FROM data_joki $where_clause ORDER BY tanggal_pesan DESC LIMIT $start, $per_page";
$result = mysqli_query($koneksi, $query);
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
            <div class="grid">
                <!-- Left Section -->
                <div class="header-riwayat">
                    <h2>Daftar Akses</h2>
                    <h2>Manajemen Pesanan (Admin)</h2>
                    
                    <!-- Tambahkan form search di sini -->
                    <form method="get" action="data_pesanan.php" style="margin-bottom: 20px;">
                        <input type="text" name="search" placeholder="Cari username, paket, atau status..." 
                               value="<?= htmlspecialchars($search) ?>" style="padding: 8px; width: 300px;">
                        <button type="submit" style="padding: 8px 15px;">Cari</button>
                        <?php if (!empty($search)): ?>
                            <button>
                                <a href="data_pesanan.php" style="margin-left: 10px; padding: 8px 15px;">Reset</a>
                        <?php endif; ?>
                            </button>
                    </form>
                    
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Paket</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Ubah Status</th>
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['id_pengguna']) ?></td>
                            <td><?= htmlspecialchars($row['paket']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= ucfirst($row['status']) ?></td>
                            <td>
                                <form method="post" style="display: flex; justify-content: center; gap: 5px;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <select name="status">
                                        <option value="pending" <?= $row['status']=='pending'?'selected':'' ?>>Pending</option>
                                        <option value="proses" <?= $row['status']=='proses'?'selected':'' ?>>Proses</option>
                                        <option value="Selesai" <?= $row['status']=='Selesai'?'selected':'' ?>>Selesai</option>
                                        <option value="batal" <?= $row['status']=='batal'?'selected':'' ?>>batal</option>
                                    </select>
                                    <button type="submit" name="update_status">Update</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    
                    <!-- Tambahkan pagination -->
                    <div class="pagination" style="margin-top: 20px;">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page-1 ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>">Previous</a>
                        <?php endif; ?>
                        
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="?page=<?= $i ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>" 
                               <?= $i == $page ? 'style="font-weight:bold;"' : '' ?>>
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                        
                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?= $page+1 ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
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
<script src="script/harga.js"></script>
<script src="script/animasi.js"></script>
</html>