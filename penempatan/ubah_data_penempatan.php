<title>Ubah Data Penempatan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../koneksi.php') ?>
<?php require_once('../component/header.php') ?>
<?php
$koneksi = new Koneksi();
$id = $_GET['id'];
$penempatan = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM penempatan WHERE id = '$id'"));

if (isset($_POST['submit'])) {
    $foto = NULL;

    if ($_FILES['foto']['name'] != '') {
        $target_dir = 'foto/'  . basename($_FILES['foto']['name']);
        $imageFileType = strtolower(pathinfo($target_dir, PATHINFO_EXTENSION));
        $checkMime = getimagesize($_FILES['foto']['tmp_name']);

        if ($checkMime !== false) {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir)) {
                $foto = htmlspecialchars(basename($_FILES['foto']['name']));
            }
        }
    }

    $id_lama = $_POST['id_lama'];
    $nama_barang = $_POST['nama_barang'];
    $kode_aset = $_POST['kode_aset'];
    $qr_code = $_POST['qr_code'];
    $kode_telkom = $_POST['kode_telkom'];
    $serial_number = $_POST['serial_number'];
    $lokasi = $_POST['lokasi'];
    $keterangan = $_POST['keterangan'];
    $kondisi = $_POST['kondisi'];
    $status = $_POST['status'];
    $pelabuhan = $_POST['pelabuhan'];

    $koneksi->query("UPDATE penempatan SET nama_barang = '$nama_barang', kode_aset = '$kode_aset', qr_code = '$qr_code', kode_telkom = '$kode_telkom', serial_number = '$serial_number', lokasi = '$lokasi', keterangan = '$keterangan', kondisi = '$kondisi', status = '$status', pelabuhan = '$pelabuhan'" . ($foto ? ", foto = '$foto'" : "") . " WHERE id = '$id_lama'");
    echo "<script>Swal.fire('Berhasil', 'Data penempatan berhasil diubah', 'success').then(() => window.location = 'lihat_data_penempatan.php')</script>";
}
?>
<?php require_once('../component/navbar.php') ?>
<?php require_once('../component/sidebar.php') ?>
<div class="card shadow overflow-hidden">
    <div class="card-body">
        <h4 class="card-title"><i class="fa fa-fw fa-edit"></i>&nbsp; Ubah Data Penempatan</h4>
        <?php if ($penempatan != null) : ?>
            <form class="form-sample" enctype="multipart/form-data" method="POST" action="">
                <input type="hidden" name="id_lama" value="<?= $penempatan['id'] ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Barang <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_barang" value="<?= $penempatan['nama_barang'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kode Aset <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kode_aset" value="<?= $penempatan['kode_aset'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">QR Code <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="qr_code" value="<?= $penempatan['qr_code'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kode Telkom <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kode_telkom" value="<?= $penempatan['kode_telkom'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Serial Number <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="serial_number" value="<?= $penempatan['serial_number'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lokasi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lokasi" value="<?= $penempatan['lokasi'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Keterangan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="keterangan" value="<?= $penempatan['keterangan'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kondisi <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="kondisi" required>
                                    <option value="" disabled selected>Pilih Kondisi</option>
                                    <option value="Baik" <?= $penempatan['kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
                                    <option value="Rusak" <?= $penempatan['kondisi'] == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
                                    <option value="Dalam Pencarian" <?= $penempatan['kondisi'] == 'Dalam Pencarian' ? 'selected' : '' ?>>Dalam Pencarian</option>
                                    <option value="Repair" <?= $penempatan['kondisi'] == 'Repair' ? 'selected' : '' ?>>Repair</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Terpasang" <?= $penempatan['status'] == 'Terpasang' ? 'selected' : '' ?>>Terpasang</option>
                                    <option value="Tidak terpasang" <?= $penempatan['status'] == 'Tidak terpasang' ? 'selected' : '' ?>>Tidak terpasang</option>
                                    <option value="Pindah" <?= $penempatan['status'] == 'Pindah' ? 'selected' : '' ?>>Pindah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Pelabuhan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pelabuhan" value="<?= $penempatan['pelabuhan'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Foto</label>
                            <div class="col-sm-9">
                                <div class="input-group col-xs-12">
                                    <input type="file" name="foto" class="file-upload-default" accept=".jpg, .jpeg, .png, .bmp, .ico, .webp, .svg, .heic">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php if ($penempatan['foto']) : ?>
                            <img src="foto/<?= $penempatan['foto'] ?>" alt="Foto penempatan" width="100">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" onclick="goBack()"><i class="fa fw fa-arrow-left"></i>&nbsp; Kembali</button>
                        <button type="submit" name="submit" class="btn btn-primary mr-2"><i class="fa fa-fw fa-save"></i>&nbsp; Simpan</button>
                    </div>
                </div>
            </form>            
            <script>
            function goBack() {
                window.history.back();
            }
            </script>
            <?php else : ?>
            <div class="alert alert-danger" role="alert">
                Data penempatan tidak ditemukan.
            </div>
            <div class="clearfix">
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" onclick="goBack()"><i class="fa fw fa-arrow-left"></i>&nbsp; Kembali</button>
                    </div>
                </div>
            </form>            
            <script>
            function goBack() {
                window.history.back();
            }
            </script>
        <?php endif ?>
    </div>
</div>
<?php require_once('../component/footer.php') ?>
