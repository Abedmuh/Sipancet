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
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?= $url . '/' ?>template/images/logo-unri-panjang.svg" alt="logo">
              </div>
              <div class="text-center mt-4 font-weight-light">
                <h4>Buat Akun</h4>
              </div>
              <form class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="inputUsername1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="inputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="inputPassword1"
                    placeholder="Password">
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
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                    href="login.php">SIGN UP</a>
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
