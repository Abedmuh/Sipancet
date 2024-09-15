<title>ASDP</title>
<?php require_once('middleware_all.php') ?>
<?php require_once('component/header.php') ?>
<?php require_once('component/navbar.php') ?>
<?php require_once('component/sidebar.php') ?>
<?php require_once('koneksi.php') ?>

<?php
$koneksi = new Koneksi();
$url = $koneksi->get_url(); // Pastikan URL didapat dari fungsi koneksi jika diperlukan

// admin dan karyawan
if ($_SESSION['jabatan'] == 'admin') {
    // Tidak ada variabel 'nia', gunakan email atau variabel lain yang sesuai
    $email = $_SESSION['email'];
} else if ($_SESSION['jabatan'] == 'karyawan') {
    $nik = $_SESSION['nik'];
}

$query = "SELECT COUNT(*) AS jumlah_barang FROM penempatan";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
$jumlah_barang = $row['jumlah_barang'];
?>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome <?= $_SESSION['jabatan'] ?></h3>
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
    <div class="col-md-6 grid-margin transparent">
        <?php if ($_SESSION['jabatan'] == 'admin') : ?>
            <!-- Admin-specific content here -->
        <?php endif ?>
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent" onclick="window.location.href='<?= $url . '/' ?>penempatan/lihat_data_penempatan.php';" style="cursor: pointer;">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Jumlah Barang :</p>
                        <p class="fs-30 mb-2"><?= htmlspecialchars($jumlah_barang) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('component/footer.php') ?>
