<title>Input Data Penempatan</title>

<?php require_once('../middleware_admin.php') ?>
<?php require_once('../koneksi.php') ?>
<?php require_once('../header.php') ?>
<?php
$koneksi = new Koneksi();
?>

<?php
$id = $nama_barang = $tahun_perolehan = $grup = $kategori = $kelas = $sub_kelas = $nomor_urut = $kode_aset = $qr_code = $kode_telkom = $serial_number = '';
if (isset($_POST['btn_submit'])) {
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

    // Cek apakah Nama Barang sudah ada
    $ceknama = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM penempatan WHERE nama_barang = '$nama_barang'"));

    if ($ceknama != null) {
        echo "<script>Swal.fire('Gagal', 'Data dengan Nama Barang $nama_barang telah ada, harap periksa', 'error')</script>";
    } else {
        // Cek kode_aset
        $cekkode_aset = $koneksi->fetch_one_assoc($koneksi->query("SELECT * FROM penempatan WHERE kode_aset = '$kode_aset'"));

        if ($cekkode_aset != null) {
            echo "<script>Swal.fire('Gagal', 'kode_aset $kode_aset sudah dipakai oleh akun lainnya', 'error')</script>";
        } else {
            $query = "INSERT INTO penempatan (nama_barang, tahun_perolehan, grup, kategori, kelas, sub_kelas, nomor_urut, kode_aset, qr_code, kode_telkom, serial_number, foto) 
                      VALUES ('$nama_barang', '$tahun_perolehan', '$grup', '$kategori','$kelas', '$sub_kelas','$nomor_urut', '$kode_aset', '$qr_code', '$kode_telkom', '$serial_number', '$foto')";

            if ($koneksi->query($query)) {
                echo "<script>Swal.fire('Berhasil', 'Data penempatan berhasil ditambahkan', 'success').then(() => window.location = 'lihat_data_penempatan.php')</script>";
            } else {
                echo "<script>Swal.fire('Gagal', 'Data penempatan gagal ditambahkan: " . htmlspecialchars($koneksi->error()) . "', 'error')</script>";
            }
        }
    }
}
?>

<?php require_once('../navbar.php') ?>
<?php require_once('../sidebar.php') ?>

<div class="card shadow overflow-hidden">
    <div class="card-body">
        <h4 class="card-title"><i class="fa fa-fw fa-plus"></i>&nbsp; Input Data Penempatan</h4>
        <form class="form-sample" enctype="multipart/form-data" method="POST" action="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Barang <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_barang" required value="<?php echo htmlspecialchars($nama_barang); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tahun Perolehan <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tahun_perolehan" required value="<?php echo htmlspecialchars($tahun_perolehan); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Grup <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="grup" required value="<?php echo htmlspecialchars($grup); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">kategori <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kategori" required value="<?php echo htmlspecialchars($kategori); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kelas <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kelas" required value="<?php echo htmlspecialchars($kelas); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sub Kelas <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="sub_kelas" required value="<?php echo htmlspecialchars($sub_kelas); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nomor Urut <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nomor_urut" required value="<?php echo htmlspecialchars($sub_kelas); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kode Aset <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_aset" required value="<?php echo htmlspecialchars($kode_aset); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">QR Code <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="qr_code" required value="<?php echo htmlspecialchars($qr_code); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kode Telkom <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_telkom" required value="<?php echo htmlspecialchars($kode_telkom); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Serial Number <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="serial_number" required value="<?php echo htmlspecialchars($serial_number); ?>" />
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
<script src='../file-upload.js'> </script>
