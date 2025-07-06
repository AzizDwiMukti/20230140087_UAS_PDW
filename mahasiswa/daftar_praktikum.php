<?php
session_start();
include '../config/config.php';

$id_praktikum = $_GET['id'];
$id_user = $_SESSION['id'];

// Cek duplikasi
$check = mysqli_query($conn, "SELECT * FROM peserta WHERE id_user = '$id_user' AND id_praktikum = '$id_praktikum'");
if (mysqli_num_rows($check) === 0) {
  $query = "INSERT INTO peserta (id_user, id_praktikum) VALUES ('$id_user', '$id_praktikum')";
  mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pendaftaran Berhasil</title>
  <meta http-equiv="refresh" content="3;url=praktikum_saya.php" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-green-50 flex items-center justify-center h-screen">
  <div class="bg-white shadow-md rounded p-8 max-w-md text-center">
    <h1 class="text-2xl font-bold text-green-700 mb-2">✅ Pendaftaran Berhasil</h1>
    <p class="text-gray-700 mb-4">Kamu telah berhasil mendaftar ke praktikum.</p>
    <p class="text-sm text-gray-500">Kamu akan diarahkan ke halaman <strong>Praktikum Saya</strong> secara otomatis...</p>
    <a href="praktikum_saya.php" class="inline-block mt-4 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
      Klik di sini jika tidak diarahkan
    </a>
  </div>
</body>
</html>
