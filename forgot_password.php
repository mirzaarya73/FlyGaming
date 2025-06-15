<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Lupa Password</title>
  <link rel="stylesheet" href="css/style_lupa_password.css">
</head>
<body>
  <div class="container">
    <h2>Reset Password</h2>
    <form action="proses/proses_lupa_password.php" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password Baru" required>
      <button type="submit">Reset Password</button>
    </form>
    <div class="back-link">
      <a href="login.php">Kembali ke Login</a>
    </div>
  </div>
</body>
</html>
