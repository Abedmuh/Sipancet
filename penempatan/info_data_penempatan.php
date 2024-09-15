<title>Info Data Penempatan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../koneksi.php') ?>
<?php require_once('../component/header.php') ?>
<?php require_once('../component/navbar.php') ?>
<?php require_once('../component/sidebar.php') ?>
<?php
$id = $_GET['id'];
$koneksi = new Koneksi();
$penempatan = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM penempatan WHERE id = '$id'"));
?>

<div class="card shadow overflow-hidden">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="lihat_data_penempatan.php" class="btn btn-secondary btn-sm d-flex align-items-center"><i class="fa fa-fw fa-arrow-left"></i>&nbsp;</a>
        <h4 class="card-title mb-0">Info Data Penempatan</h4>
        <a href="ubah_data_penempatan.php?id=<?= $penempatan['id'] ?>" class="btn btn-primary btn-sm d-flex align-items-center"><i class="far fa-fw fa-edit"></i>&nbsp; Ubah</a>
    </div>
    <div class="card-body">
        <?php if ($penempatan) : ?>
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="foto/<?= $penempatan['foto'] ?>" alt="Foto penempatan" class="img-fluid" style="width: 100%; max-width: 300px;">
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Barang</th>
                            <td><?= $penempatan['nama_barang'] ?></td>
                        </tr>
                        <tr>
                            <th>Tahun Perolehan</th>
                            <td><?= $penempatan['tahun_perolehan'] ?></td>
                        </tr>
                        <tr>
                            <th>Grup</th>
                            <td><?= $penempatan['grup'] ?></td>
                        </tr>
                        <tr>
                            <th>kelas</th>
                            <td><?= $penempatan['kelas'] ?></td>
                        </tr>
                        <tr>
                            <th>Sub Kelas</th>
                            <td><?= $penempatan['sub_kelas'] ?></td>
                        </tr>
                        <tr>
                            <th>Nomor Urut</th>
                            <td><?= $penempatan['nomor_urut'] ?></td>
                        </tr>
                        <tr>
                            <th>Kode Aset</th>
                            <td><?= $penempatan['kode_aset'] ?></td>
                        </tr>
                        <tr>
                            <th>QR Code</th>
                            <td><?= $penempatan['qr_code'] ?></td>
                        </tr>
                        <tr>
                            <th>Kode Telkom</th>
                            <td><?= $penempatan['kode_telkom'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Data Penempatan tidak ditemukan.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once('../component/footer.php') ?>
