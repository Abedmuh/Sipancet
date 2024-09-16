<?php
include_once(__DIR__ . '/../koneksi.php');
$connection = new Koneksi();
$uri = explode('/', $_SERVER['REQUEST_URI']);
$url = "http://" . $_SERVER['HTTP_HOST'] . '/' . $uri[1] . '/' . $uri[2];
$currentUser = $connection->fetch_one_assoc($connection->query("SELECT nama, jabatan, foto FROM `users` WHERE `email` = '" . $_SESSION['email'] . "'"));

?>
<div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-0" href="<?= $url ?>"><img src="<?= $url . '/' ?>aset/Asdp-Logo.png" class="mr-2" alt="logo" /><p class="font-weight-light small-text mb-0 text-muted">PT ASDP Indonesia Ferry (Persero)</p></a>
            <a class="navbar-brand brand-logo-mini" href="<?= $url ?>"><img src="<?= $url . '/' ?>aset/Asdp-Logo.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <div class="d-flex align-items-center" style="gap: 15px;">
                            <img src="<?= $url . '/' ?>penempatan/foto/<?= $currentUser['foto']?>" alt="profile" />
                            <span>
                                <h6 class="my-1"><?= isset($currentUser) && $currentUser != null ? ucwords($currentUser['nama']) : '' ?></h6>
                                <h6 style="font-size: 11px;" class="d-block text-muted mb-0"><?= isset($currentUser) && $currentUser != null ? $currentUser['jabatan'] : '' ?></h6>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href=" <?= $url . '/logout.php' ?>">
                            <i class="ti-power-off text-primary"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">