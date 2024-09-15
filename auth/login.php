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
    <title>Login ASDP</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= $url . '/' ?>vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= $url . '/' ?>vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= $url . '/' ?>vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= $url . '/' ?>css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= $url . '/' ?>aset/favicon.png" />
    <link rel="stylesheet" href="<?= $url . '/' ?>vendors/sweetalert-2.11.1.7/dist/sweetalert2.min.css">
    <script src="<?= $url . '/' ?>vendors/sweetalert-2.11.1.7/dist/sweetalert2.min.js"></script>
</head>

<body>
    <?php
    $koneksi = new Koneksi();

    if (isset($_POST['btn_submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cekEmail = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM `users` WHERE `email` = '$email'"));

        if ($cekEmail != null) {
            if (password_verify($password, $cekEmail['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['jabatan'] = $cekEmail['jabatan'];
                $_SESSION['email'] = $cekEmail['email'];

                if ($cekEmail['jabatan'] == 'karyawan') {
                    $karyawan = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM `users` WHERE `email` = '$email'"));
                    $_SESSION['nik'] = $cekEmail['nik'];
                    header('Location: ../');
                    die;
                } else if ($cekEmail['jabatan'] == 'admin') {
                    // Tidak ada tabel admin, gunakan login tabel
                    $_SESSION['jabatan'] = 'admin';
                    header('Location: ../');
                    die;
                }

                header('Location: ../');
            } else {
                echo "<script>Swal.fire('Gagal', 'Password yang Anda masukkan salah!', 'error')</script>";
            }
        } else {
            echo "<script>Swal.fire('Gagal', 'Email tidak terdaftar!', 'error')</script>";
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
                            <form method="POST" action="" class="pt-3">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" id="exampleInputEmail1" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button name="btn_submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">LOGIN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Ingat saya
                                        </label>
                                    </div>
                                    <a href="lupa_password.php" class="text-primary">Lupa password?</a>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Belum memiliki akun? <a href="register.php" class="text-primary">Buat akun</a>
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
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= $url . '/' ?>/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= $url . '/' ?>/js/off-canvas.js"></script>
    <script src="<?= $url . '/' ?>/js/hoverable-collapse.js"></script>
    <script src="<?= $url . '/' ?>/js/template.js"></script>
    <script src="<?= $url . '/' ?>/js/settings.js"></script>
    <script src="<?= $url . '/' ?>/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>
