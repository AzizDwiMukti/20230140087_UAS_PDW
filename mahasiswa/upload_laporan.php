<?php
session_start();
include '../config/config.php';
$id_user = $_SESSION['id'];
$id_modul = $_POST['id_modul'];
$nama_file = $_FILES['file_laporan']['name'];
$tmp = $_FILES['file_laporan']['tmp_name'];
move_uploaded_file($tmp, "../uploads/" . $nama_file);
mysqli_query($conn, "INSERT INTO laporan (id_user, id_modul, file_laporan) 
VALUES ('$id_user', '$id_modul', '$nama_file')");
header("Location: praktikum_saya.php");
?>