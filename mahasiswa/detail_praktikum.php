<?php
session_start();
include '../config/config.php';
include '../partials/header.php';

$id_user = $_SESSION['id'];
$id_praktikum = $_GET['id'];
$modul = mysqli_query($conn, "SELECT * FROM modul WHERE id_praktikum = $id_praktikum");
?>

<h2 class="text-2xl font-bold mb-4">Modul & Tugas</h2>

<div class="space-y-6">
  <?php while ($row = mysqli_fetch_assoc($modul)) :
    $id_modul = $row['id'];
    $laporan = mysqli_query($conn, "SELECT * FROM laporan WHERE id_user = $id_user AND id_modul = $id_modul");
    $data_laporan = mysqli_fetch_assoc($laporan);
  ?>
  <div class="border rounded p-4 shadow bg-white">
    <h3 class="font-semibold text-blue-700"><?= $row['judul'] ?></h3>
    <p class="text-sm text-gray-600">Materi:
      <a href="../uploads/<?= $row['file_materi'] ?>" class="text-blue-500 hover:underline">Download</a>
    </p>

    <?php if ($data_laporan): ?>
      <p class="mt-2 text-green-600">✅ Laporan terkumpul</p>
      <p class="text-sm">Nilai: <strong><?= $data_laporan['nilai'] ?></strong> —
      Feedback: <em><?= $data_laporan['feedback'] ?></em></p>
    <?php else: ?>
      <form action="upload_laporan.php" method="POST" enctype="multipart/form-data" class="mt-4 space-y-2">
        <input type="file" name="file_laporan" class="w-full border px-3 py-2 rounded" required>
        <input type="hidden" name="id_modul" value="<?= $id_modul ?>">
        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Upload Laporan</button>
      </form>
    <?php endif; ?>
  </div>
  <?php endwhile; ?>
</div>

<?php include '../partials/footer.php'; ?>
