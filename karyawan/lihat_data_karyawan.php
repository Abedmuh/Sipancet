<title>Lihat Data Karyawan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../header.php') ?>
<?php require_once('../navbar.php') ?>
<?php require_once('../sidebar.php') ?>
<?php require_once('../koneksi.php') ?>
<?php
$uri = explode('/', $_SERVER['REQUEST_URI']);
$url = "http://" . $_SERVER['HTTP_HOST'] . '/' . $uri[1] . '/' . $uri[2];
$koneksi = new Koneksi();
$listKaryawan = $koneksi->fetch_all_assoc($koneksi->query("SELECT * FROM `karyawan`"));
?>
<div class="card shadow overflow-hidden">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Data karyawan</h4>
        <a href="input_data_karyawan.php" class="btn btn-primary btn-sm d-flex align-items-center"><i class="fa fa-fw fa-plus"></i>&nbsp; Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            NIK
                        </th>
                        <th>
                            Nama Lengkap
                        </th>
                        <th>
                            Jenis Kelamin
                        </th>
                        <!-- <th>
                            Email
                        </th> -->
                        <th>
                            Departemen
                        </th>
                        <th>
                            Tanggal Bergabung
                        </th>
                        <th>
                            Gambar
                        </th>
                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listKaryawan as $karyawan) : ?>
                        <tr>
                            <td>
                                <?= $karyawan['nik'] ?>
                            </td>
                            <td>
                                <?= $karyawan['nama_karyawan'] ?>
                            </td>
                            <td>
                                <?= $karyawan['jenis_kelamin'] ?>
                            </td>
                            <!-- <td>
                                <?= $karyawan['email'] ?>
                            </td> -->
                            <td>
                                <?= $karyawan['departemen'] ?>
                            </td>
                            <td>
                                <?= $karyawan['tanggal_bergabung'] ?>
                            </td>
                            <td>
                                <img src="foto/<?= $karyawan['foto'] ?>" alt="<?= $karyawan['nama_karyawan'] ?>">
                            </td>
                            <td class="d-flex align-items-center" style="gap: 10px;">
                                <a href="info_data_karyawan.php?id=<?= $karyawan['id'] ?>" title="Detail Karyawan"><i class="fas fa-fw fa-info-circle"></i></a>
                                <a href="ubah_data_karyawan.php?id=<?= $karyawan['id'] ?>" title="Ubah"><i class="far fa-fw fa-edit"></i></a>
                                <a href="javascript:hapus('<?= $karyawan['id'] ?>', '<?= $karyawan['nama_karyawan'] ?>')" title="Hapus"><i class="fas fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function hapus(id, nama) {
        Swal.fire({
            title: 'Apa anda yakin?',
            html: `Menghapus data karyawan <b>${nama}</b> akan menghapus seluruh kategori di dalamnya`,
            icon: 'warning',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: 'Tidak'
        }).then((res) => {
            if (res.isConfirmed) {
                window.location = `hapus_data_karyawan.php?id=${id}&nama=${encodeURIComponent(nama)}`;
            }
        });
    }

    <?php if (isset($_GET['success']) && isset($_GET['nama'])) : ?>
    Swal.fire({
        title: 'Berhasil',
        html: `Data karyawan <b><?php echo htmlspecialchars($_GET['nama'], ENT_QUOTES, 'UTF-8'); ?></b> berhasil dihapus`,
        icon: 'success'
    });
    <?php endif; ?>
</script>
<?php require_once('../footer.php') ?>
