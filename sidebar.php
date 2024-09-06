<?php
$uri = explode('/', $_SERVER['REQUEST_URI']);
$url = "http://" . $_SERVER['HTTP_HOST'] . '/' . $uri[1] . '/' . $uri[2];
$url_sekarang = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (substr($url_sekarang, strlen($url_sekarang) - 1, 1) == '/') {
    $url_sekarang = substr($url_sekarang, 0, strlen($url_sekarang) - 1);
}
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?= $url == $url_sekarang ? 'active' : '' ?>">
            <a class="nav-link" href="<?= $url ?>">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">Karyawan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="form-elements">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="<?= $url . '/' ?>karyawan/lihat_data_karyawan.php">Lihat Data</a> </li>
                        <li class="nav-item"><a class="nav-link" href="<?= $url . '/' ?>karyawan/input_data_karyawan.php">Input
                                Data</a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif ?>
    </ul>
</nav>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">