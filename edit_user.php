<?php
include 'koneksi.php';

// Ambil data user yang akan diedit
$id = $_GET['id'];
$query = "SELECT * FROM akses WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

// Proses form edit
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $saldo = $_POST['saldo'];
    $role = $_POST['role'];

    $query = "UPDATE akses SET username = '$username', saldo = '$saldo', role = '$role' WHERE id = $id";
    mysqli_query($koneksi, $query);

    header("Location: data_akses.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengguna</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style_edit.css">
<body>
    <div class="container">
        <h2>Edit Pengguna</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            
            <label>Role:</label>
            <select name="role">
                <option value="pembeli" <?php if ($user['role'] == 'pembeli') echo 'selected'; ?>>Pembeli</option>
                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            </select>

            <label>Saldo:</label>
            <input type="text" name="saldo" value="<?php echo htmlspecialchars($user['saldo']); ?>">

            <button type="submit">Update</button>
            <a href="data_akses.php" class="cancel">Batal</a>
        </form>
    </div>
</body>
</html>
