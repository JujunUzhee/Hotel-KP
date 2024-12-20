<?php
session_start();
include "functions.php";

if (!isset($_COOKIE['login'])) {
  $_COOKIE['login'] = "0";
} else if ($_COOKIE['login'] == "1") {
  header("location: ../");
} else if ($_COOKIE['login'] == "2") {
  header("location: ../admin/");
} else if ($_COOKIE['login'] == "3") {
  header("location: ../admin/");
}

$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link href="style.css" rel="stylesheet">
  <link href='../img/logo/<?= $hotel['logo_primary'] ?>' rel='shortcut icon'>
  <!-- Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Login</title>
  <style>
    body {
      background-image: url('../img/background.jpg');
      background-repeat: no-repeat; 
    }
  </style>
</head>

<body>

 <div class="container overflow-hidden mt-lg-5">
  <div class="card my-2 shadow-md mt-5" style="background-color: rgba(255, 255, 255, 0.8); border-radius: 15px;">
    <div class="row">
      <div class="col-lg-5 pt-5 text-center">
        <img src="../img/login.png" class="logo" alt="Logo">
      </div>
      <div class="col-lg-7 p-1 pt-lg-5">
        <h3 class="text-center">Login</h3>
        <div class="row justify-content-center">
          <div class="col-8 mb-3">
            <form action="cek_login.php" method="post" autocomplete="off">
              <div class="my-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" style="background-color: #e8f0fe;" class="form-control" name="username" id="username" placeholder="Masukkan Username" autofocus>
              </div>
              <div class="my-3">
                <div class="form-group">
                  <label for="password">Password</label>
                  <div class="input-group" id="show_hide_password">
                    <input type="password" style="background-color: #e8f0fe;" name='password' class="form-control" name="password" required placeholder="Password">
                    <div class="input-group-append">
                      <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="my-3">
                <div class="form-check form-switch">
                  <input name="remember" class="form-check-input" type="checkbox" id="remember">
                  <label class="form-check-label" for="remember">Remember Me</label>
                </div>
              </div>
              <div class="my-3">
                <button style="background-color: #FF6500;" class="btn text-white w-100" type="submit" name="login">Login</button>
              </div>
              <a style="color: #FF6500;" href="./register.php" class="lg nav-link text-center">Belum punya akun? Daftar sekarang</a>
              <a style="color: #FF6500;" href="./register.php" class="sm nav-link text-center">Daftar?</a>
              <a style="color: #FF6500;" href="../index.php" class="nav-link text-center">Kembali ke halaman awal</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


  <?php if (isset($_GET['pesan'])) : ?>
  <div class="container">
    <script>
      // Deklarasi Toast hanya satu kali
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer);
          toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
      });

      // Cek kondisi pesan
      <?php if ($_GET['pesan'] == "gagal") : ?>
        Swal.fire({
          icon: 'error',
          title: 'Login Gagal!',
          text: 'Username atau Password salah!',
        });
      <?php elseif ($_GET['pesan'] == "berhasil-logout") : ?>
        Toast.fire({
          icon: 'success',
          title: 'Anda berhasil logout!'
        });
      <?php elseif ($_GET['pesan'] == "daftar-berhasil") : ?>
        Toast.fire({
          icon: 'success',
          title: 'Akun berhasil dibuat!'
        });
      <?php endif; ?>
    </script>
  </div>
<?php endif; ?>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("bi bi-eye-slash");
          $('#show_hide_password i').removeClass("bi bi-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("bi bi-eye-slash");
          $('#show_hide_password i').addClass("bi bi-eye");
        }
      });
    });
  </script>

</body>

</html>