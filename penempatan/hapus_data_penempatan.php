<title>Hapus Data Penempatan</title>
<?php require_once('../middleware_admin.php'); ?>
<?php require_once('../koneksi.php'); ?>
<?php
$koneksi = new Koneksi();

if (isset($_GET['id'])) {
    // Escape the id value
    $id = mysqli_real_escape_string($koneksi->connection(), $_GET['id']);
    
    // Fetch the item name before deletion, treating id as a string by wrapping it in quotes
    $penempatan = $koneksi->fetch_one_assoc($koneksi->query("SELECT nama_barang FROM penempatan WHERE id = '$id'"));
    
    if ($penempatan) {
        $nama_barang = $penempatan['nama_barang'];
        
        // Delete the record, again treating id as a string
        if ($koneksi->query("DELETE FROM penempatan WHERE id = '$id'")) {
            header("Location: lihat_data_penempatan.php?success=true&nama_barang=" . urlencode($nama_barang));
            exit();
        } else {
            echo "Error deleting record: " . $koneksi->error();
        }
    } else {
        echo "Penempatan tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
