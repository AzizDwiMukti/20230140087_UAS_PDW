<?php
session_start();
include '../config/config.php';

$id_user = $_SESSION['id'];

$query_praktikum = "SELECT * FROM praktikum";
$result_praktikum = mysqli_query($conn, $query_praktikum);

$daftar_id = [];
$query_terdaftar = "SELECT id_praktikum FROM peserta WHERE id_user = '$id_user'";
$result_terdaftar = mysqli_query($conn, $query_terdaftar);
while ($row = mysqli_fetch_assoc($result_terdaftar)) {
    $daftar_id[] = $row['id_praktikum'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Katalog Praktikum</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: linear-gradient(to bottom right, #f0f4ff, #ffffff);
    }
  </style>
</head>
<body class="text-gray-800">

  <!-- Header -->
  <header class="bg-gradient-to-r from-indigo-700 to-blue-600 text-white shadow-lg">
    <div class="container mx-auto px-6 py-5 flex justify-between items-center">
      <h1 class="text-3xl font-extrabold tracking-wide flex items-center gap-2">
        <i data-feather="layers" class="w-6 h-6"></i> Daftar Praktikum
      </h1>
      <nav class="space-x-4 text-sm">
        <a href="praktikum_saya.php" class="hover:underline">Praktikum Saya</a>
        <a href="../logout.php" class="hover:underline text-red-200">Logout</a>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="text-center py-12">
    <h2 class="text-4xl font-bold mb-3 tracking-tight">Mata Praktikum Tersedia</h2>
    <p class="text-gray-600 text-lg">Pilih mata praktikum yang sesuai dengan minat dan rencana belajarmu</p>
  </section>

  <!-- Kartu Praktikum -->
  <main class="container mx-auto px-6 pb-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
    <?php while ($row = mysqli_fetch_assoc($result_praktikum)): ?>
      <?php
        $warna = 'blue';
        if (str_contains(strtolower($row['nama']), 'data')) $warna = 'green';
        elseif (str_contains(strtolower($row['nama']), 'jaringan')) $warna = 'purple';
      ?>
      <div class="bg-white rounded-xl shadow-md hover:shadow-xl border border-<?= $warna ?>-100 p-6 transition transform hover:scale-105">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-semibold text-<?= $warna ?>-800"><?= htmlspecialchars($row['nama']) ?></h3>
          <span class="text-xs bg-<?= $warna ?>-50 text-<?= $warna ?>-600 px-2 py-1 rounded">ID: <?= $row['id'] ?></span>
        </div>
        <p class="text-gray-600 mb-5"><?= htmlspecialchars($row['deskripsi']) ?></p>

        <?php if (in_array($row['id'], $daftar_id)) : ?>
          <div class="flex items-center gap-2 bg-<?= $warna ?>-100 text-<?= $warna ?>-700 text-sm font-semibold px-4 py-2 rounded">
            <i data-feather="check-circle" class="w-4 h-4"></i> Sudah Didaftarkan
          </div>
        <?php else : ?>
          <a href="daftar.php?id=<?= $row['id'] ?>" class="inline-flex items-center bg-<?= $warna ?>-600 text-white px-4 py-2 rounded-lg hover:bg-<?= $warna ?>-700 transition font-medium">
            <i data-feather="plus-circle" class="w-4 h-4 mr-2"></i> Daftar Sekarang
          </a>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </main>

  <!-- Footer -->
  <footer class="bg-white py-6 text-center text-sm text-gray-500 border-t">
    &copy; <?= date('Y') ?> Sistem Informasi Praktikum – Azis Dwi Mukti
  </footer>

  <script>
    feather.replace();
  </script>
</body>
</html>
