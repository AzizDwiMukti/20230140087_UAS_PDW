<?php
session_start();
include '../config/config.php';

if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
    header("Location: manage_users.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    header("Location: manage_users.php");
}

$data = mysqli_query($conn, "SELECT * FROM users");
?>
<h2>Kelola Akun Pengguna</h2>
<form method="POST">
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    Role:
    <select name="role">
        <option value="mahasiswa">Mahasiswa</option>
        <option value="asisten">Asisten</option>
    </select>
    <button name="tambah">Tambah</button>
</form>
<hr>
<table border="1">
    <tr><th>Username</th><th>Role</th><th>Aksi</th></tr>
    <?php while ($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
            <td><?= $row['username'] ?></td>
            <td><?= $row['role'] ?></td>
            <td><a href="?hapus=<?= $row['id'] ?>">Hapus</a></td>
        </tr>
    <?php endwhile; ?>
</table>
