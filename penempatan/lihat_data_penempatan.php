<title>Lihat Data Penempatan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../header.php') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<?php require_once('../navbar.php') ?>
<?php require_once('../sidebar.php') ?>
<?php require_once('../koneksi.php') ?>
<?php
$uri = explode('/', $_SERVER['REQUEST_URI']);
$url = "http://" . $_SERVER['HTTP_HOST'] . '/' . $uri[1] . '/' . $uri[2];
$koneksi = new Koneksi();
$listPenempatan = $koneksi->fetch_all_assoc($koneksi->query("SELECT * FROM `penempatan`"));
?>
<div class="card shadow overflow-hidden">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Data Penempatan</h4>
        <div class="d-inline-flex">
            <a href="input_data_penempatan.php" class="btn btn-primary btn-sm d-flex align-items-center"><i class="fa fa-fw fa-plus"></i>&nbsp; Tambah</a>
            <a href="export_penempatan.php" class="btn btn-primary btn-sm d-flex align-items-center ml-2"><i class="fa fa-fw fa-download"></i>&nbsp; Export</a>
            <a href="export_pdf.php" class="btn btn-primary btn-sm d-flex align-items-center ml-2"><i class="fa fa-fw fa-download"></i>&nbsp; PDF</a>
        </div>            
    </div>
    <div class="card-body">
            <div class="table-responsive">
            <table id="penempatanTable" class="table table-striped">
                <thead>
                    <tr>

                        <th>Nama Barang</th>
                        <th>Tahun Perolehan</th>
                        <th>Grup</th>
                        <th>Kategori</th>
                        <th>Kelas</th>
                        <th>Sub Kelas</th>
                        <th>Nomor Urut</th>
                        <th>Kode Aset</th>
                        <th>QR Code</th>
                        <th>Kode Telkom</th>
                        <th>Serial Number</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listPenempatan as $penempatan) : ?>
                        <tr>

                            <td><?= $penempatan['nama_barang'] ?></td>
                            <td><?= $penempatan['tahun_perolehan'] ?></td>
                            <td><?= $penempatan['grup'] ?></td>
                            <td><?= $penempatan['kategori'] ?></td>
                            <td><?= $penempatan['kelas'] ?></td>
                            <td><?= $penempatan['sub_kelas'] ?></td>
                            <td><?= $penempatan['nomor_urut'] ?></td>
                            <td><?= $penempatan['kode_aset'] ?></td>
                            <td><?= $penempatan['qr_code'] ?></td>
                            <td><?= $penempatan['kode_telkom'] ?></td>
                            <td><?= $penempatan['serial_number'] ?></td>
                            <td><img src="foto/<?= $penempatan['foto'] ?>" alt="<?= $penempatan['foto'] ?>" width="75"></td>

                            <td class="d-flex align-items-center" style="gap: 10px;">
                                <a href="info_data_penempatan.php?id=<?= $penempatan['id'] ?>" title="Detail penempatan"><i class="fas fa-fw fa-info-circle"></i></a>
                                <a href="ubah_data_penempatan.php?id=<?= $penempatan['id'] ?>" title="Ubah"><i class="far fa-fw fa-edit"></i></a>
                                <a href="javascript:hapus('<?= $penempatan['id'] ?>', '<?= $penempatan['nama_barang'] ?>')" title="Hapus"><i class="fas fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#penempatanTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });

    function hapus(id, nama) {
        Swal.fire({
            title: 'Apa anda yakin?',
            html: `Menghapus data penempatan <b>${nama}</b> akan menghapus seluruh kategori di dalamnya`,
            icon: 'warning',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: 'Tidak'
        }).then((res) => {
            if (res.isConfirmed) {
                window.location = `hapus_data_penempatan.php?id=${id}&nama=${encodeURIComponent(nama)}`;
            }
        });
    }

    <?php if (isset($_GET['success']) && isset($_GET['nama_barang'])) : ?>
    Swal.fire({
        title: 'Berhasil',
        html: `Data penempatan <b><?php echo htmlspecialchars($_GET['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></b> berhasil dihapus`,
        icon: 'success'
    });
    <?php endif; ?>
</script>
<?php require_once('../footer.php') ?>
