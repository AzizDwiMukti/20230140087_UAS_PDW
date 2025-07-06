<?php
session_start();
include '../config/config.php';

$id_user = $_SESSION['id'];

// Pencarian
$search = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';

// Ambil daftar praktikum
$query = mysqli_query($conn, "
  SELECT p.id, p.nama, p.deskripsi 
  FROM praktikum p
  JOIN peserta ps ON p.id = ps.id_praktikum
  WHERE ps.id_user = '$id_user'
    AND p.nama LIKE '%$search%'
");
$jumlah_praktikum = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Praktikum Saya</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

  <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-2 text-blue-700">📘 Praktikum Saya</h1>

    <!-- Notifikasi -->
    <?php if (isset($_SESSION['notif'])): ?>
      <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-4">
        <?= $_SESSION['notif'] ?>
      </div>
      <?php unset($_SESSION['notif']); ?>
    <?php endif; ?>

    <!-- Info jumlah dan pencarian -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
      <p class="text-sm text-gray-600">Mengikuti <span class="font-bold"><?= $jumlah_praktikum ?></span> praktikum</p>
      <form method="GET" class="w-full sm:w-auto">
        <input type="text" name="q" placeholder="Cari praktikum..."
               value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
               class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-300 focus:border-blue-400">
      </form>
    </div>

    <!-- Jika tidak ada -->
    <?php if ($jumlah_praktikum === 0): ?>
      <p class="text-gray-700 mb-4">Kamu belum mendaftar ke praktikum manapun.</p>
      <a href="cari_praktikum.php" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Cari Praktikum
      </a>
    <?php else: ?>

      <!-- Kartu daftar praktikum -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
          <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all p-4">
            <div class="flex items-start justify-between">
              <div>
                <h2 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($row['nama']) ?></h2>
                <p class="text-sm text-gray-500"><?= htmlspecialchars($row['deskripsi']) ?></p>
              </div>
              <form method="POST" action="batal_praktikum.php" onsubmit="return confirm('Yakin ingin keluar dari praktikum ini?')">
                <input type="hidden" name="id_praktikum" value="<?= $row['id'] ?>">
                <button title="Batalkan Praktikum" class="text-red-500 hover:text-red-700 text-xl font-bold">×</button>
              </form>
            </div>
            <div class="mt-3">
              <a href="detail_praktikum.php?id=<?= $row['id'] ?>" 
                 class="text-sm text-blue-600 hover:underline">
                📄 Lihat Detail & Tugas
              </a>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

    <?php endif; ?>
  </div>

</body>
</html>
