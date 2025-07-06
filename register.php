<?php
session_start();
include 'config/config.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($username) || empty($password) || empty($role)) {
        $error = "Semua field wajib diisi.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "Username sudah digunakan!";
        } else {
            mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$hash', '$role')");
            $success = "Registrasi berhasil. Silakan login.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="POST" onsubmit="return validateForm()" class="bg-white p-6 rounded shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-4">Register</h2>
        <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='text-green-500'>$success</p>"; ?>
        <input type="text" name="username" id="username" placeholder="Username" class="border w-full p-2 mb-2" required>
        <input type="password" name="password" id="password" placeholder="Password" class="border w-full p-2 mb-2" required>
        <select name="role" id="role" class="border w-full p-2 mb-4" required>
            <option value="">Pilih Role</option>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="asisten">Asisten</option>
        </select>
        <button name="register" class="bg-green-500 text-white px-4 py-2 rounded w-full">Register</button>
    </form>
    <script>
    function validateForm() {
        const user = document.getElementById('username').value.trim();
        const pass = document.getElementById('password').value.trim();
        const role = document.getElementById('role').value;
        if (!user || !pass || !role) {
            alert("Semua field wajib diisi!");
            return false;
        }
        return true;
    }
    </script>
</body>
</html>
