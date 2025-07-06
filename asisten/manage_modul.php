<?php
session_start();
include '../config/config.php';

$praktikum = mysqli_query($conn, "SELECT * FROM praktikum");

if (isset($_POST['tambah'])) {
    $id_praktikum = $_POST['id_praktikum'];
    $judul = $_POST['judul'];
    $file = $_FILES['file_materi']['name'];
    $tmp = $_FILES['file_materi']['tmp_name'];
    move_uploaded_file($tmp, "../uploads/" . $file);
    mysqli_query($conn, "INSERT INTO modul (id_praktikum, judul, file_materi) VALUES ('$id_praktikum', '$judul', '$file')");
    header("Location: manage_modul.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM modul WHERE id=$id");
    header("Location: manage_modul.php");
}

$modul = mysqli_query($conn, "SELECT m.*, p.nama AS praktikum FROM modul m JOIN praktikum p ON m.id_praktikum=p.id");
?>
<h2>Kelola Modul</h2>
<form method="POST" enctype="multipart/form-data">
    Praktikum:
    <select name="id_praktikum">
        <?php while ($p = mysqli_fetch_assoc($praktikum)) : ?>
            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
        <?php endwhile; ?>
    </select>
    Judul: <input type="text" name="judul" required>
    File Materi: <input type="file" name="file_materi" required>
    <button name="tambah">Tambah</button>
</form>
<hr>
<table border="1">
    <tr><th>Praktikum</th><th>Judul</th><th>File</th><th>Aksi</th></tr>
    <?php while ($row = mysqli_fetch_assoc($modul)) : ?>
        <tr>
            <td><?= $row['praktikum'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><a href="../uploads/<?= $row['file_materi'] ?>" download>Unduh</a></td>
            <td><a href="?hapus=<?= $row['id'] ?>">Hapus</a></td>
        </tr>
    <?php endwhile; ?>
</table>
