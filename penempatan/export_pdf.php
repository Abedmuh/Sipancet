<?php
// Include the mPDF library
require '../vendor/autoload.php';
require '../koneksi.php';

$koneksi = new Koneksi();
$ambildata = $koneksi->query("SELECT * FROM penempatan");
// Initialize mPDF
$mpdf = new \Mpdf\Mpdf([
    'format' => 'A4-L', // A4 Landscape
    'margin_left' => 5, // Left margin
    'margin_right' => 5, // Right margin
    'margin_top' => 10, // Top margin
    'margin_bottom' => 10, // Bottom margin
    'margin_header' => 5, // Header margin
    'margin_footer' => 5, // Footer margin
]);

$stylesheet = "
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 10pt;
    }
    th, td {
        padding: 2px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
        font-size: 8pt;
    }
    td {
        font-size: 7pt;
    }
    .small-col {
        width: 6%;
    }
    .medium-col {
        width: 8%;
    }
    .large-col {
        width: 15%;
    }
    .foto-col {
        width: 27%;
        text-align: center;
    }
    .img {
        max-width: 250px; 
        max-height: 250px; 
        width: auto; 
        height: auto;
    }
";

// HTML structure for the table
$html = '
<h1>ASDP Pencatatan aset</h1>
<table>
    <thead>
        <tr style="background-color: #f2f2f2;">
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
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>';

// Loop through the data and add rows to the table
foreach ($ambildata as $row) {

    // Define the local path for the image, assuming the "foto" column contains the image filename
    $imagePath = 'foto/' . htmlspecialchars($row['foto']);

    // Check if the image exists, else show a placeholder or error message
    $imageTag = file_exists($imagePath) ? '<img src="' . $imagePath . '" class="img"/>' : 'No Image';

    $html .= '<tr>
        <td>' . htmlspecialchars($row['nama_barang']) . '</td>
        <td>' . htmlspecialchars($row['tahun_perolehan']) . '</td>
        <td>' . htmlspecialchars($row['grup']) . '</td>
        <td>' . htmlspecialchars($row['kategori']) . '</td>
        <td>' . htmlspecialchars($row['kelas']) . '</td>
        <td>' . htmlspecialchars($row['sub_kelas']) . '</td>
        <td>' . htmlspecialchars($row['nomor_urut']) . '</td>
        <td>' . htmlspecialchars($row['kode_aset']) . '</td>
        <td class="large-col">' . htmlspecialchars($row['qr_code']) . '</td>
        <td>' . htmlspecialchars($row['kode_telkom']) . '</td>
        <td>' . htmlspecialchars($row['serial_number']) . '</td>
        <td class="foto-col">' . $imageTag . '</td>
    </tr>';
}

$html .= '
    </tbody>
</table>';

// Write the HTML content to the PDF
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html);

// Output the PDF to the browser
$mpdf->Output('asset_report.pdf', 'I');
