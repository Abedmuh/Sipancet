<title>Input Data Karyawan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../koneksi.php') ?>
<?php require_once('../header.php') ?>
<?php
$koneksi = new Koneksi();
?>

<?php
$nik = $nama_karyawan = $jenis_kelamin = $email = $departemen = $tanggal_bergabung = '';
if (isset($_POST['btn_submit'])) {
    $nik = $_POST['nik'];
    $nama_karyawan = $_POST['nama_karyawan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $departemen = $_POST['departemen'];
    $tanggal_bergabung = $_POST['tanggal_bergabung'];

    // Proses upload foto
    $foto = 'default.png'; // Default foto jika tidak ada upload

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

    // Cek apakah NIK sudah ada
    $cekNik = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM karyawan WHERE nik = '$nik'"));

    if ($cekNik != null) {
        echo "<script>Swal.fire('Gagal', 'Data dengan NIK $nik telah ada, harap periksa', 'error')</script>";
    } else {
        // Cek email
        $cekEmail = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM karyawan WHERE email = '$email'"));

        if ($cekEmail != null) {
            echo "<script>Swal.fire('Gagal', 'Email $email sudah dipakai oleh akun lainnya', 'error')</script>";
        } else {
            $query = "INSERT INTO karyawan (nik, nama_karyawan, jenis_kelamin, email, departemen, foto, tanggal_bergabung) 
                      VALUES ('$nik', '$nama_karyawan', '$jenis_kelamin', '$email', '$departemen', '$foto', '$tanggal_bergabung')";
            
            if ($koneksi->query($query)) {
                echo "<script>Swal.fire('Berhasil', 'Data karyawan berhasil ditambahkan', 'success').then(() => window.location = 'lihat_data_karyawan.php')</script>";
            } else {
                echo "<script>Swal.fire('Gagal', 'Data karyawan gagal ditambahkan: " . htmlspecialchars($koneksi->error()) . "', 'error')</script>";
            }
        }
    }
}
?>

<?php require_once('../navbar.php') ?>
<?php require_once('../sidebar.php') ?>

<div class="card shadow overflow-hidden">
    <div class="card-body">
        <h4 class="card-title"><i class="fa fa-fw fa-plus"></i>&nbsp; Input Data Karyawan</h4>
        <form class="form-sample" enctype="multipart/form-data" method="POST" action="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">NIK <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nik" required value="<?php echo htmlspecialchars($nik); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_karyawan" required value="<?php echo htmlspecialchars($nama_karyawan); ?>" />
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
                                <option value="Laki-laki" <?php if ($jenis_kelamin == "Laki-laki") echo "selected"; ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if ($jenis_kelamin == "Perempuan") echo "selected"; ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" required value="<?php echo htmlspecialchars($email); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Bergabung <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tanggal_bergabung" required value="<?php echo htmlspecialchars($tanggal_bergabung); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="departemen" class="col-sm-3 col-form-label">Departemen <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="departemen" name="departemen" required>
                                <option value="" selected hidden disabled>-- Pilih Departemen --</option>
                                <option value="Perencanaan TI" <?php if ($departemen == "Perencanaan TI") echo "selected"; ?>>Perencanaan TI</option>
                                <option value="Operasional TI" <?php if ($departemen == "Operasional TI") echo "selected"; ?>>Operasional TI</option>
                                <option value="Pengembangan TI" <?php if ($departemen == "Pengembangan TI") echo "selected"; ?>>Pengembangan TI</option>
                                <option value="Pelayanan TI" <?php if ($departemen == "Pelayanan TI") echo "selected"; ?>>Pelayanan TI</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Foto</label>
                        <div class="col-sm-9">
                            <input type="file" name="foto" class="file-upload-default" accept=".jpg, .jpeg, .png, .bmp, .ico, .webp, .svg, .heic">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <!-- <label class="col-sm-3 col-form-label">Foto</label>
                        <div class="col-sm-9">
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control file-upload-info" name="foto" readonly placeholder="Upload Image" accept=".jpg, .jpeg, .png, .bmp, .ico, .webp, .svg, .heic">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div> -->
                    </div>
                </div>
                
            </div>
            <div class="clearfix">
                <div class="float-right">
                    <button type="reset" class="btn btn-secondary"><i class="fa fw fa-sync"></i>&nbsp; Reset</button>
                    <button type="submit" name="btn_submit" class="btn btn-primary mr-2"><i class="fa fa-fw fa-save"></i>&nbsp; Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once('../footer.php') ?>
<?php require_once('../file-upload.js') ?>
<!-- <script src="../../js/file-upload.js"></script> -->
