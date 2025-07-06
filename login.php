<?php
session_start();
include 'config/config.php';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'mahasiswa') {
            header("Location: mahasiswa/katalog.php");
        } else {
            header("Location: asisten/manage_praktikum.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - SIMPRAK</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-4 text-blue-700 text-center">Login SIMPRAK</h2>
    
    <?php if (isset($error)) : ?>
      <div class="bg-red-100 text-red-700 p-2 mb-4 rounded"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <div>
        <label class="block text-sm">Username</label>
        <input type="text" name="username" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
      </div>
      <button type="submit" name="login" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
        Login
      </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-500">
      Belum punya akun? <a href="register.php" class="text-blue-500 hover:underline">Daftar di sini</a>
    </p>
  </div>
</body>
</html>
