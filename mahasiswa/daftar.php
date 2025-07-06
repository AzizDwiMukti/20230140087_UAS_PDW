<?php
session_start();
include '../config/config.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id'];
$id_praktikum = $_GET['id'];

$query = "INSERT INTO peserta (id_user, id_praktikum) VALUES ('$id_user', '$id_praktikum')";
mysqli_query($conn, $query);

header("Location: praktikum_saya.php");
exit();
?>
