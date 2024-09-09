<title>Hapus Data Penempatan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../koneksi.php') ?>
<?php
$koneksi = new Koneksi();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil nama penempatan sebelum dihapus
    $penempatan = $koneksi->fetch_one_assoc($koneksi->query("SELECT nama_barang FROM penempatan WHERE id = $id"));
    
    if ($penempatan) {
        $nama = $penempatan['nama_penempatan'];
        
        // Hapus penempatan
        if ($koneksi->query("DELETE FROM penempatan WHERE id = $id")) {
            header("Location: lihat_data_penempatan.php?success=true&nama_barang=" . urlencode($nama_barang));
            exit();
        } else {
            echo "Error deleting record: " . $koneksi->error;
        }
    } else {
        echo "penempatan tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
