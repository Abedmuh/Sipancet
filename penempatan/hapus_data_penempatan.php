<title>Hapus Data Karyawan</title>
<?php require_once('../middleware_admin.php') ?>
<?php require_once('../koneksi.php') ?>
<?php
$koneksi = new Koneksi();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil nama karyawan sebelum dihapus
    $karyawan = $koneksi->fetch_one_assoc($koneksi->query("SELECT nama_karyawan FROM karyawan WHERE id = $id"));
    
    if ($karyawan) {
        $nama = $karyawan['nama_karyawan'];
        
        // Hapus karyawan
        if ($koneksi->query("DELETE FROM karyawan WHERE id = $id")) {
            header("Location: lihat_data_karyawan.php?success=true&nama=" . urlencode($nama));
            exit();
        } else {
            echo "Error deleting record: " . $koneksi->error;
        }
    } else {
        echo "Karyawan tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
