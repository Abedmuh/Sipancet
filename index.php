<title>ASDP</title>
<?php require_once('middleware_all.php') ?>
<?php require_once('header.php') ?>
<?php require_once('navbar.php') ?>
<?php require_once('sidebar.php') ?>
<?php require_once('koneksi.php') ?>
<?php
$koneksi = new Koneksi();
$url = $koneksi->get_url(); // Pastikan URL didapat dari fungsi koneksi jika diperlukan

// admin dan karyawan
if ($_SESSION['role'] == 'admin') {
    // Tidak ada variabel 'nia', gunakan email atau variabel lain yang sesuai
    $email = $_SESSION['email'];
} else if ($_SESSION['role'] == 'karyawan') {
    $nik = $_SESSION['nik'];
}
?>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome <?= $_SESSION['role'] ?></h3>
                <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
            </div>
            <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                        <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="mdi mdi-calendar"></i> Hari ini <?php $currentDate = date('(d/m/Y)'); echo $currentDate;?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card tale-bg">
            <div class="card-people mt-auto">
                <img src="<?= $url . '/' ?>template/images/dashboard/people.svg" alt="people">
                <div class="weather-info">
                    <div class="d-flex">
                        <div>
                            <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>32<sup>C</sup></h2>
                        </div>
                        <div class="ml-2">
                            <h4 class="location font-weight-normal">Cempaka Putih</h4>
                            <h6 class="font-weight-normal">Jakarta Pusat</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin transparent">
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <!-- Admin-specific content here -->
        <?php endif ?>
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Jumlah Izin :</p>
                        <p class="fs-30 mb-2">2</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Sisa Jatah Izin :</p>
                        <p class="fs-30 mb-2">1</p>
                        <div class="progress progress-md">
      <div class="progress-bar bg-warning" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Jumlah Datang Tepat Waktu :</p>
                        <p class="fs-30 mb-2">2</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Jumlah Terlambat :</p>
                        <p class="fs-30 mb-2">1</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('footer.php') ?>
