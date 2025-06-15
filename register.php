<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>Fly Gaming - Register</title>
    <link rel="stylesheet" href="css/style-pendaftaran.css" />
  </head>
  <body>
    <section class="wrapper">
      <div class="form signup">
        <header>Register</header>
        <form action="proses_registrasi.php" method="post">
          <input type="text" name="username" placeholder="Username" required />
          <input type="password" name="password" placeholder="Password" required />
          
          <!-- Ganti Konfirmasi dengan Pilihan Role -->
          <select name="role" required>
            <div>
              <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="pembeli">Pembeli</option> <!-- Disesuaikan dengan ENUM di database -->
            </div>
          </select>

          <input type="submit" value="Daftar" />
          
          <div class="deskripsi-login">
            <p>Dengan mendaftar, Anda setuju dengan <a href="login.php">Persyaratan dan Ketentuan</a></p>
          </div>

          <div class="link-login">
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
          </div>
          
          <button class="back-button" type="button" onclick="kembali()">Kembali</button>
        </form>
      </div>
    </section>
    
    <script>
      function kembali() {
        window.location.href = "index.php";
      }
    </script>
  </body>
</html>
