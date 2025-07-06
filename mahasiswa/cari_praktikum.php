<?php
session_start();
include '../config/config.php';

// Pastikan user sudah login
if (!isset($_SESSION['id'])) {
    header('Location: ../auth/login.php');
    exit;
}

$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($conn, $_GET['keyword']) : '';
$query = "SELECT * FROM praktikum";
if ($keyword !== '') {
    $query .= " WHERE nama_praktikum LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%'";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cari Praktikum</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

  <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Cari Mata Praktikum</h1>

    <!-- Form Pencarian -->
    <form method="GET" class="flex mb-6">
      <input
        type="text"
        name="keyword"
        placeholder="Masukkan kata kunci praktikum..."
        value="<?= htmlspecialchars($keyword) ?>"
        class="flex-grow px-4 py-2 border rounded-l-md focus:outline-none"
      >
      <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-r-md hover:bg-blue-700">Cari</button>
    </form>

    <!-- Hasil Pencarian -->
    <div class="space-y-4">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="border p-4 rounded-md bg-gray-50">
            <h2 class="text-lg font-semibold"><?= htmlspecialchars($row['nama_praktikum']) ?></h2>
            <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars($row['deskripsi']) ?></p>
            <a href="daftar_praktikum.php?id=<?= $row['id'] ?>" class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Daftar</a>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-red-500">Tidak ada praktikum yang ditemukan.</p>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
