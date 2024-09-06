<title>Ubah Data Karyawan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../koneksi.php') ?>
<?php require_once('../header.php') ?>
<?php
$koneksi = new Koneksi();
$id = $_GET['id'];
$karyawan = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM karyawan WHERE id = '$id'"));

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
    $nik = $_POST['nik'];
    $nama_karyawan = $_POST['nama_karyawan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = $_POST['departemen'];
    $tanggal_bergabung = $_POST['tanggal_bergabung'];
    $email = $_POST['email'];
    $lokasi_kerja = $_POST['lokasi_kerja'];
    $alamat = $_POST['alamat'];

    if ($karyawan['email'] != $email) {
        $cekEmail = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM login WHERE `email` = '$email'"));

        if ($cekEmail != null) {
            echo "<script>Swal.fire('Gagal', 'Email sudah dipakai oleh akun lainnya', 'error')</script>";
        } else {
            $koneksi->query("UPDATE login SET email = '$email' WHERE email = '" . $karyawan['email'] . "'");
        }
    }

    $koneksi->query("UPDATE karyawan SET nik = '$nik', nama_karyawan = '$nama_karyawan', jenis_kelamin = '$jenis_kelamin', email = '$email', departemen = '$departemen', tanggal_bergabung = '$tanggal_bergabung', lokasi_kerja = '$lokasi_kerja', alamat = '$alamat'" . ($foto ? ", foto = '$foto'" : "") . " WHERE id = '$id_lama'");
    echo "<script>Swal.fire('Berhasil', 'Data karyawan berhasil diubah', 'success').then(() => window.location = 'lihat_data_karyawan.php')</script>";
}
?>
<?php require_once('../navbar.php') ?>
<?php require_once('../sidebar.php') ?>
<div class="card shadow overflow-hidden">
    <div class="card-body">
        <h4 class="card-title"><i class="fa fa-fw fa-edit"></i>&nbsp; Ubah Data Karyawan</h4>
        <?php if ($karyawan != null) : ?>
            <form class="form-sample" enctype="multipart/form-data" method="POST" action="">
                <input type="hidden" name="id_lama" value="<?= $karyawan['id'] ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nik" value="<?= $karyawan['nik'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_karyawan" value="<?= $karyawan['nama_karyawan'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="" selected hidden disabled>-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-Laki" <?= $karyawan['jenis_kelamin'] == 'Laki-Laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?= $karyawan['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="<?= $karyawan['email'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal Bergabung <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tanggal_bergabung" value="<?= $karyawan['tanggal_bergabung'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Departemen <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="departemen" name="departemen" required>
                                    <option value="" selected hidden disabled>-- Pilih Departemen --</option>
                                    <option value="Perencanaan TI" <?= $karyawan['departemen'] == 'Perencanaan TI' ? 'selected' : '' ?>>Perencanaan TI</option>
                                    <option value="Operasional TI" <?= $karyawan['departemen'] == 'Operasional TI' ? 'selected' : '' ?>>Operasional TI</option>
                                    <option value="Pengembangan TI" <?= $karyawan['departemen'] == 'Pengembangan TI' ? 'selected' : '' ?>>Pengembangan TI</option>
                                    <option value="Pelayanan TI" <?= $karyawan['departemen'] == 'Pelayanan TI' ? 'selected' : '' ?>>Pelayanan TI</option>
                                </select>
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
                        <?php if ($karyawan['foto']) : ?>
                            <img src="foto/<?= $karyawan['foto'] ?>" alt="Foto Karyawan" width="100">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lokasi Kerja <span class="text-danger"></span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="lokasi_kerja" name="lokasi_kerja">
                                    <option value="" selected hidden disabled>-- Pilih lokasi_kerja --</option>
                                    <option value="HO" <?= $karyawan['lokasi_kerja'] == 'HO' ? 'selected' : '' ?>>HO</option>
                                    <option value="Cabang" <?= $karyawan['lokasi_kerja'] == 'Cabang' ? 'selected' : '' ?>>Cabang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat <span class="text-danger"></span></label>
                            <div class="col-sm-9">
                                <input type="alamat" class="form-control" name="alamat" value="<?= $karyawan['alamat'] ?>" />
                            </div>
                        </div>
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
                Data karyawan tidak ditemukan.
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
<?php require_once('../footer.php') ?>
