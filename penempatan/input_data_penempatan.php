<title>Input Data Penempatan</title>

<?php require_once('../middleware_admin.php') ?>
<?php require_once('../koneksi.php') ?>
<?php require_once('../component/header.php') ?>
<?php require_once('../component/navbar.php') ?>
<?php require_once('../component/sidebar.php') ?>
<?php
$koneksi = new Koneksi();
?>

<?php
$id = $nama_barang = $kode_aset = $qr_code = $kode_telkom = $serial_number = $lokasi = $keterangan = $kondisi = $status = $pelabuhan = '';
if (isset($_POST['btn_submit'])) {
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
            $query = "INSERT INTO penempatan (nama_barang, kode_aset, qr_code, kode_telkom, serial_number, lokasi, keterangan, kondisi, status, pelabuhan, foto) 
                      VALUES ('$nama_barang', '$kode_aset', '$qr_code', '$kode_telkom','$serial_number', '$lokasi','$keterangan', '$kondisi', '$status', '$pelabuhan', '$foto')";

            if ($koneksi->query($query)) {
                echo "<script>Swal.fire('Berhasil', 'Data penempatan berhasil ditambahkan', 'success').then(() => window.location = 'lihat_data_penempatan.php')</script>";
            } else {
                echo "<script>Swal.fire('Gagal', 'Data penempatan gagal ditambahkan: " . htmlspecialchars($koneksi->error()) . "', 'error')</script>";
            }
        }
    }
}
?>

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
                        <label class="col-sm-3 col-form-label">Lokasi <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lokasi" required value="<?php echo htmlspecialchars($lokasi); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Keterangan <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="keterangan" required value="<?php echo htmlspecialchars($keterangan); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kondisi <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="kondisi" required>
                                <option value="" disabled selected>Pilih Kondisi</option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Dalam Pencarian">Dalam Pencarian</option>
                                <option value="Repair">Repair</option>
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
                            <option value="Terpasang">Terpasang</option>
                            <option value="Tidak Terpasang">Tidak Terpasang</option>
                            <option value="Pindah">Pindah</option>
                        </select>
                    </div>
                </div>
            </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pelabuhan <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="pelabuhan" required value="<?php echo htmlspecialchars($pelabuhan); ?>" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
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

<?php require_once('../component/footer.php') ?>
<script src='../file-upload.js'> </script>
