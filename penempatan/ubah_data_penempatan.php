<title>Ubah Data Penempatan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../koneksi.php') ?>
<?php require_once('../header.php') ?>
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
    $tahun_perolehan = $_POST['tahun_perolehan'];
    $grup = $_POST['grup'];
    $kategori = $_POST['kategori'];
    $kelas = $_POST['kelas'];
    $sub_kelas = $_POST['sub_kelas'];
    $nomor_urut = $_POST['nomor_urut'];
    $kode_aset = $_POST['kode_aset'];
    $qr_code = $_POST['qr_code'];
    $kode_telkom = $_POST['kode_telkom'];
    $serial_number = $_POST['serial_number'];
   
    if ($penempatan['email'] != $email) {
        $cekEmail = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM login WHERE `email` = '$email'"));

        if ($cekEmail != null) {
            echo "<script>Swal.fire('Gagal', 'Email sudah dipakai oleh akun lainnya', 'error')</script>";
        } else {
            $koneksi->query("UPDATE login SET email = '$email' WHERE email = '" . $penempatan['email'] . "'");
        }
    }

    $koneksi->query("UPDATE penempatan SET nama_barang = '$nama_barang', tahun_perolehan = '$tahun_perolehan', grup = '$grup', kategori = '$kategori', kelas = '$kelas', sub_kelas = '$sub_kelas', nomor_urut = '$nomor_urut', kode_aset = '$kode_aset', qr_code = '$qr_code', kode_telkom = '$kode_telkom', serial_number = '$serial_number'" . ($foto ? ", foto = '$foto'" : "") . " WHERE id = '$id_lama'");
    echo "<script>Swal.fire('Berhasil', 'Data penempatan berhasil diubah', 'success').then(() => window.location = 'lihat_data_penempatan.php')</script>";
}
?>
<?php require_once('../navbar.php') ?>
<?php require_once('../sidebar.php') ?>
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
                            <label class="col-sm-3 col-form-label">Tahun Perolehan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tahun_perolehan" value="<?= $penempatan['tahun_perolehan'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Grup <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="grup" value="<?= $penempatan['grup'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="kategori" class="form-control" name="kategori" value="<?= $penempatan['kategori'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kelas <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="kelas" class="form-control" name="kelas" value="<?= $penempatan['kelas'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sub Kelas <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="sub_kelas" class="form-control" name="sub_kelas" value="<?= $penempatan['sub_kelas'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tahun Perolehan <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tahun_perolehan" value="<?= $penempatan['tahun_perolehan'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Grup <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="grup" value="<?= $penempatan['grup'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="kategori" class="form-control" name="kategori" value="<?= $penempatan['kategori'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kelas <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="kelas" class="form-control" name="kelas" value="<?= $penempatan['kelas'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Sub Kelas <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="sub_kelas" class="form-control" name="sub_kelas" value="<?= $penempatan['sub_kelas'] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nomor Urut <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="nomor_urut" class="form-control" name="nomor_urut" value="<?= $penempatan['nomor_urut'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kode Aset <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="kode_aset" class="form-control" name="kode_aset" value="<?= $penempatan['kode_aset'] ?>" />
                            </div>
                        </div>
                    </div>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Lokasi Kerja <span class="text-danger"></span></label>
                            <div class="col-sm-9">
                                <select class="form-control" id="lokasi_kerja" name="lokasi_kerja">
                                    <option value="" selected hidden disabled>-- Pilih lokasi_kerja --</option>
                                    <option value="HO" <?= $penempatan['lokasi_kerja'] == 'HO' ? 'selected' : '' ?>>HO</option>
                                    <option value="Cabang" <?= $penempatan['lokasi_kerja'] == 'Cabang' ? 'selected' : '' ?>>Cabang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat <span class="text-danger"></span></label>
                            <div class="col-sm-9">
                                <input type="alamat" class="form-control" name="alamat" value="<?= $penempatan['alamat'] ?>" />
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
<?php require_once('../footer.php') ?>
