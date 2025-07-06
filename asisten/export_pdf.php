<?php
require '../vendor/autoload.php';
include '../config/config.php';

$mpdf = new \Mpdf\Mpdf();
$html = '<h2>Rekap Nilai Laporan</h2><table border="1" style="width:100%;border-collapse:collapse;"><tr><th>Mahasiswa</th><th>Modul</th><th>Nilai</th><th>Feedback</th></tr>';

$query = mysqli_query($conn, "SELECT u.username, m.judul, l.nilai, l.feedback 
    FROM laporan l 
    JOIN users u ON l.id_user = u.id 
    JOIN modul m ON l.id_modul = m.id");

while ($row = mysqli_fetch_assoc($query)) {
    $html .= "<tr>
        <td>{$row['username']}</td>
        <td>{$row['judul']}</td>
        <td>{$row['nilai']}</td>
        <td>{$row['feedback']}</td>
    </tr>";
}

$html .= "</table>";
$mpdf->WriteHTML($html);
$mpdf->Output("nilai_laporan.pdf", "I");
?>
