<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$conn = new mysqli("localhost", "root", "", "db_joki");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];
$successMessage = "";
$errorMessage = "";

$sql = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$currentUsername = $userData['username'];
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["username"];
    $newPassword = $_POST["password"];
    $confirmPassword = $_POST["konfirmasi"];

    if ($newPassword !== $confirmPassword) {
        $errorMessage = "Password dan konfirmasi tidak sama!";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $update->bind_param("ssi", $newUsername, $hashedPassword, $userId);

        if ($update->execute()) {
            $successMessage = "Profil berhasil diperbarui.";
            $currentUsername = $newUsername;
        } else {
            $errorMessage = "Gagal memperbarui profil.";
        }
        $update->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Profil</title>
  <link rel="stylesheet" href="css/style-pendaftaran.css" />
</head>
<body>
  <section class="wrapper">
    <div class="form signup">
      <header>Edit Profil</header>

      <?php if ($successMessage): ?>
        <p style="color: green;"><?= $successMessage ?></p>
      <?php elseif ($errorMessage): ?>
        <p style="color: red;"><?= $errorMessage ?></p>
      <?php endif; ?>

      <form method="POST" action="edit_profile.php">
        <input type="text" name="username" value="<?= htmlspecialchars($currentUsername) ?>" required />
        <input type="password" name="password" placeholder="Password baru" required />
        <input type="text" name="konfirmasi" placeholder="Konfirmasi Password" required />
        <input type="submit" value="Simpan Perubahan" />
        <button class="back-button" onclick="window.location.href='dashboard.php'; return false;">Kembali</button>
      </form>
    </div>
  </section>
</body>
</html>
