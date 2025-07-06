<?php
session_start();
include '../config/config.php';
include '../partials/header.php';

// Filter pencarian
$where = '';
if (isset($_GET['cari']) && $_GET['cari'] !== '') {
  $cari = mysqli_real_escape_string($conn, $_GET['cari']);
  $where = "WHERE u.username LIKE '%$cari%' OR m.judul LIKE '%$cari%'";
}

$query = mysqli_query($conn, "
  SELECT l.*, u.username, m.judul 
  FROM laporan l 
  JOIN users u ON l.id_user = u.id 
  JOIN modul m ON l.id_modul = m.id
  $where
");
?>

<h2 class="text-2xl font-bold mb-4">Laporan Masuk</h2>

<!-- Search & Export -->
<div class="flex items-center justify-between mb-4">
  <form method="GET" class="flex gap-2">
    <input type="text" name="cari" value="<?= $_GET['cari'] ?? '' ?>" placeholder="Cari mahasiswa/modul..." class="border rounded px-3 py-1">
    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Cari</button>
  </form>
  <a href="export_pdf.php" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">Export PDF</a>
</div>

<!-- Tabel Laporan -->
<div class="overflow-x-auto">
  <table class="min-w-full text-sm border border-gray-200 bg-white rounded shadow">
    <thead class="bg-gray-100 text-left">
      <tr>
        <th class="p-3 border">Mahasiswa</th>
        <th class="p-3 border">Modul</th>
        <th class="p-3 border">File</th>
        <th class="p-3 border">Nilai</th>
        <th class="p-3 border">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($query)) : ?>
        <tr class="border-t hover:bg-gray-50">
          <td class="p-3 border"><?= $row['username'] ?></td>
          <td class="p-3 border"><?= $row['judul'] ?></td>
          <td class="p-3 border">
            <a href="../uploads/<?= $row['file_laporan'] ?>" class="text-blue-600 hover:underline" download>
              Unduh
            </a>
          </td>
          <td class="p-3 border"><?= $row['nilai'] ?? 'Belum dinilai' ?></td>
          <td class="p-3 border">
            <a href="beri_nilai.php?id=<?= $row['id'] ?>" class="text-indigo-600 hover:underline">Nilai</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include '../partials/footer.php'; ?>
