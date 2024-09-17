<title>Lihat Data Penempatan</title>
<?php require_once('../koneksi.php') ?>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../component/header.php') ?>
<?php require_once('../component/navbar.php') ?>
<?php require_once('../component/sidebar.php') ?>
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
                        <th>Kode Aset</th>
                        <th>QR Code</th>
                        <th>Kode Telkom</th>
                        <th>Serial Number</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Pelabuhan</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listPenempatan as $penempatan) : ?>
                        <tr>

                            <td><?= $penempatan['nama_barang'] ?></td>
                            <td><?= $penempatan['kode_aset'] ?></td>
                            <td><?= $penempatan['qr_code'] ?></td>
                            <td><?= $penempatan['kode_telkom'] ?></td>
                            <td><?= $penempatan['serial_number'] ?></td>
                            <td><?= $penempatan['lokasi'] ?></td>
                            <td><?= $penempatan['keterangan'] ?></td>
                            <td><?= $penempatan['kondisi'] ?></td>
                            <td><?= $penempatan['status'] ?></td>
                            <td><?= $penempatan['pelabuhan'] ?></td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#imageModal" data-image="foto/<?= $penempatan['foto'] ?>">
                                    <img src="foto/<?= $penempatan['foto'] ?>" alt="<?= $penempatan['foto'] ?>" style="width: 150px; height: auto; border-radius: 0;">
                                </a>
                            </td>

                            <td class="d-flex align-items-center" style="gap: 10px;">
                                <a href="info_data_penempatan.php?id=<?= $penempatan['id'] ?>" title="Detail penempatan">
                                    <i class="fas fa-fw fa-info-circle" style="font-size: 20px; padding: 5px;"></i>
                                </a>
                                <a href="ubah_data_penempatan.php?id=<?= $penempatan['id'] ?>" title="Ubah">
                                    <i class="far fa-fw fa-edit" style="font-size: 20px; padding: 5px;"></i>
                                </a>
                                <a href="javascript:hapus('<?= $penempatan['id'] ?>', '<?= $penempatan['nama_barang'] ?>')" title="Hapus">
                                    <i class="fas fa-fw fa-trash" style="font-size: 20px; padding: 5px;"></i>
                                </a>
                            </td>

                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center">
                <img id="modalImage" src="" class="img-fluid" alt="Gambar" style="max-width: 100%; max-height: 100vh;">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#penempatanTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });

        // Handle image click to show modal
        $('#imageModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var imageSrc = button.data('image'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-body #modalImage').attr('src', imageSrc);
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
<?php require_once('../component/footer.php') ?>
