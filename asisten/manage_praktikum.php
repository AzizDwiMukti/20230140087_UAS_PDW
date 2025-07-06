<?php
session_start();
include '../config/config.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    mysqli_query($conn, "INSERT INTO praktikum (nama, deskripsi) VALUES ('$nama', '$deskripsi')");
    header("Location: manage_praktikum.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM praktikum WHERE id=$id");
    header("Location: manage_praktikum.php");
}

$data = mysqli_query($conn, "SELECT * FROM praktikum");
?>
<h2>Kelola Mata Praktikum</h2>
<form method="POST">
    Nama: <input type="text" name="nama" required>
    Deskripsi: <input type="text" name="deskripsi" required>
    <button name="tambah">Tambah</button>
</form>
<hr>
<table border="1">
    <tr><th>Nama</th><th>Deskripsi</th><th>Aksi</th></tr>
    <?php while ($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['deskripsi'] ?></td>
            <td><a href="?hapus=<?= $row['id'] ?>">Hapus</a></td>
        </tr>
    <?php endwhile; ?>
</table>
