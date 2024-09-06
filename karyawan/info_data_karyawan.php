<title>Info Data Karyawan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../header.php') ?>
<?php require_once('../navbar.php') ?>
<?php require_once('../sidebar.php') ?>
<?php require_once('../koneksi.php') ?>
<?php
$id = $_GET['id'];
$koneksi = new Koneksi();
$karyawan = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM karyawan WHERE id = '$id'"));
?>

<div class="card shadow overflow-hidden">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="lihat_data_karyawan.php" class="btn btn-secondary btn-sm d-flex align-items-center"><i class="fa fa-fw fa-arrow-left"></i>&nbsp;</a>
        <h4 class="card-title mb-0">Info Data Karyawan</h4>
        <a href="ubah_data_karyawan.php?id=<?= $karyawan['id'] ?>" class="btn btn-primary btn-sm d-flex align-items-center"><i class="far fa-fw fa-edit"></i>&nbsp; Ubah</a>
    </div>
    <div class="card-body">
        <?php if ($karyawan) : ?>
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="foto/<?= $karyawan['foto'] ?>" alt="Foto Karyawan" class="img-fluid rounded-circle" style="width: 100%; max-width: 300px;">
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>NIK</th>
                            <td><?= $karyawan['nik'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td><?= $karyawan['nama_karyawan'] ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?= $karyawan['jenis_kelamin'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $karyawan['email'] ?></td>
                        </tr>
                        <tr>
                            <th>Departemen</th>
                            <td><?= $karyawan['departemen'] ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Bergabung</th>
                            <td><?= $karyawan['tanggal_bergabung'] ?></td>
                        </tr>
                        <tr>
                            <th>Lokasi Kerja</th>
                            <td><?= $karyawan['lokasi_kerja'] ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?= $karyawan['alamat'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Data karyawan tidak ditemukan.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once('../footer.php') ?>
