<?php require_once('../koneksi.php') ?>
<?php
session_start();
$uri = explode('/', $_SERVER['REQUEST_URI']);
$url = "http://" . $_SERVER['HTTP_HOST'] . '/' . $uri[1];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Buat Akun</title>
  <!-- plugins:css -->


  <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= $url . '/' ?>template/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= $url . '/' ?>template/images/favicon.png" />
  <link rel="stylesheet" href="<?= $url . '/' ?>template/vendors/sweetalert-2.11.1.7/dist/sweetalert2.min.css">
  <script src="<?= $url . '/' ?>template/vendors/sweetalert-2.11.1.7/dist/sweetalert2.min.js"></script>
</head>

<body>
  <?php
  $koneksi = new Koneksi();
  if (isset($_POST['btn_submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cekEmail = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM `users` WHERE `email` = '$email'"));

    if ($cekEmail != null) {
      echo "<script>Swal.fire('Gagal', 'Email sudah terdaftar!', 'error')</script>";
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $insertQuery = "INSERT INTO `users` (`email`, `nama`, `password`, `jabatan`, `foto`) VALUES ('$email', '$username', '$hashedPassword', 'admin', 'default.png')";
      $insertResult = $koneksi->query($insertQuery);
      if ($insertResult) {
        header('Location: login.php');
        die;
      } else {
        echo "<script>Swal.fire('Gagal', 'Terjadi kesalahan saat mendaftar. Coba lagi.', 'error')</script>";
      }
    }
  }
  ?>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo" style="text-align: center; margin-bottom: 20px;">
                <img src="<?= $url . '/' ?>aset/Asdp-Logo.png" alt="logo">
              </div>
              <div class="text-center font-weight-light">
                <h3>Data Aset Inventaris</h3>
                <h6>PT ASDP Indonesia Ferry (Persero)</h6>
              </div>
              <div class="text-center mt-4 font-weight-light">
                <h4>Buat Akun</h4>
              </div>
              <form class="pt-3" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="inputUsername1" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="inputEmail1" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="inputPassword1" name="password" placeholder="Password">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Saya setuju dengan Syarat & Ketentuan
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button name="btn_submit" type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    Register Account
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Sudah punya akun? <a href="login.php" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <script src="<?= $url . '/' ?>/template/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?= $url . '/' ?>/template/js/off-canvas.js"></script>
  <script src="<?= $url . '/' ?>/template/js/hoverable-collapse.js"></script>
  <script src="<?= $url . '/' ?>/template/js/template.js"></script>
  <script src="<?= $url . '/' ?>/template/js/settings.js"></script>
  <script src="<?= $url . '/' ?>/template/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>