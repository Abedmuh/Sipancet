<?php
require '../koneksi.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


$id = $_GET['id'] ?? null; 

$koneksi = new Koneksi();
$ambildata = $koneksi->query("SELECT * FROM penempatan");

session_start();

if ($ambildata->num_rows > 0) {
    ob_start();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $headers = [
        'A1' => 'Nomor',
        'B1' => 'Nama Barang',
        'C1' => 'Tahun Perolehan',
        'D1' => 'Grup',
        'E1' => 'Kategori',
        'F1' => 'Kelas',
        'G1' => 'Sub Kelas',
        'H1' => 'Nomor Urut',
        'I1' => 'Kode Aset',
        'J1' => 'QR Code',
        'K1' => 'Kode Telkom',
        'L1' => 'Serial Number',
        'M1' => 'Foto',
    ];

    foreach ($headers as $cell => $value) {
        $sheet->setCellValue($cell, $value);
    }

    $row = 2; // Start from the second row

    while ($tampil = mysqli_fetch_assoc($ambildata)) { // Use mysqli_fetch_assoc for better readability
        $sheet->fromArray($tampil, null, 'A' . $row); // Efficiently write data to the sheet
        $imageName = $tampil['foto'];
        $imagePath = 'http://localhost:8080/Sipancet/penempatan/foto/'.$imageName;

        // Download the image from the URL
        $customTempDir = 'C:\AppC\laragon\www\Sipancet\penempatan\tmp'; // Custom path
        $tempImagePath = $customTempDir . $imageName; // Use custom path
        $imageData = @file_get_contents($imagePath);

        if ($imageData === FALSE) {
            $sheet->setCellValue('M' . $row, 'Image not found: ' . $imagePath);
        } else {
            $writeSuccess = @file_put_contents($tempImagePath, $imageData);

            if ($writeSuccess === FALSE) {
                $sheet->setCellValue('M' . $row, 'Error saving image.');
            } else {
                $drawing = new Drawing();
                $drawing->setName('Image');
                $drawing->setDescription('Image');
                $drawing->setPath($tempImagePath);
                $drawing->setHeight(200); // Resize image height (adjust as needed)
                $drawing->setCoordinates('M' . $row); // Place image in the 'foto' column
                $drawing->setOffsetX(10); // Adjust X offset as needed
                $drawing->setOffsetY(10); // Adjust Y offset as needed
                $drawing->setWorksheet($sheet);

                // Set row height to match image height (convert from pixels to points)
                $rowHeight = $drawing->getHeight() * 0.75; // Convert pixels to points
                $sheet->getRowDimension($row)->setRowHeight($rowHeight);
            }
        }

        $row++;
    }

    $writer = new Xlsx($spreadsheet);

    ob_end_clean();

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="penempatan.xlsx"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');

    $writer->save('php://output');
    exit();
} else {
    header("Location: index.php");
    exit();
}
