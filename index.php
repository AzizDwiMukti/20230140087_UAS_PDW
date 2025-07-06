<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>SIMPRAK - Sistem Praktikum</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
  <header class="bg-blue-700 text-white p-6 shadow">
    <div class="container mx-auto text-center">
      <h1 class="text-3xl font-bold">SIMPRAK</h1>
      <p class="text-sm">Sistem Informasi Pengumpulan Tugas Praktikum</p>
    </div>
  </header>

  <main class="container mx-auto p-6 text-center">
    <h2 class="text-xl font-semibold mb-4">Selamat Datang di SIMPRAK</h2>
    <p class="mb-6">Aplikasi untuk manajemen tugas, laporan, dan penilaian praktikum berbasis web.</p>

    <div class="space-x-4">
      <a href="login.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Login</a>
      <a href="register.php" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Daftar</a>
    </div>
  </main>

  <footer class="text-center text-sm text-gray-500 py-6">
    &copy; <?= date('Y') ?> SIMPRAK - Dibuat oleh Aziz Dwi Mukti
  </footer>
</body>
</html>
