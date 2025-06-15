<?php
// Proses form tambah
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'koneksi.php';
    
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    
    $query = "INSERT INTO akses (username, password, role) VALUES ('$username', '$password', '$role')";
    mysqli_query($conn, $query);
    
    header("Location: user_table.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengguna</title>
</head>
<body>
    <h2>Tambah Pengguna Baru</h2>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <label>Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="pembeli">Pembeli</option>
        </select><br><br>
        
        <button type="submit">Simpan</button>
        <a href="users_table.php">Batal</a>
    </form>
</body>
</html>