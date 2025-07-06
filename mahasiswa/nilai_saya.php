<?php
session_start();
include '../config/config.php';

$id_user = $_SESSION['id'];
$query = mysqli_query($conn, "
  SELECT l.*, t.judul AS judul_tugas, p.nama_praktikum, l.nilai
  FROM laporan l
  JOIN tugas t ON l.id_tugas = t.id
  JOIN praktikum p ON t.id_praktikum = p.id
  WHERE l.id_user = '$id_user'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Nilai Saya</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Nilai Laporan Praktikum</h1>
    <table class="w-full border">
      <thead>
        <tr class="bg-gray-200">
          <th class="px-4 py-2 border">Praktikum</th>
          <th class="px-4 py-2 border">Tugas</th>
          <th class="px-4 py-2 border">Tanggal Upload</th>
          <th class="px-4 py-2 border">Nilai</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
          <td class="border px-4 py-2"><?= $row['nama_praktikum'] ?></td>
          <td class="border px-4 py-2"><?= $row['judul_tugas'] ?></td>
          <td class="border px-4 py-2"><?= date('d-m-Y', strtotime($row['tanggal_upload'])) ?></td>
          <td class="border px-4 py-2"><?= $row['nilai'] ?? 'Belum Dinilai' ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
