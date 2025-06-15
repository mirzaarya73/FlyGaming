<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/png" href="img/logo.png">
  <title>Fly Gaming - Login</title>
  <link rel="stylesheet" href="css/style-pendaftaran.css" />
</head>
<body>
  <section class="wrapper">
    <div class="form signup">
      <header>Login</header>
      <!-- Arahkan ke proses_login.php -->
      <form action="proses_login.php" method="post">
        <!-- Tambahkan name agar datanya terkirim -->
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" value="Login" />
        
        <div class="link-login">
          <div class="forgot-link">
            <a href="forgot_password.php">Lupa Password?</a>
          </div>
          <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>

        <button class="back-button" type="button" onclick="kembali()">Kembali</button>
      </form>
    </div>
  </section>

  <script type="text/javascript">
    function kembali() {
      window.location.href = "index.php"; // kembali ke halaman utama
    }
  </script>
</body>
</html>