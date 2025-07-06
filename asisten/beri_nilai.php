<?php
session_start();
include '../config/config.php';
include '../partials/header.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM laporan WHERE id=$id"));

if (isset($_POST['submit'])) {
  $nilai = $_POST['nilai'];
  $feedback = $_POST['feedback'];
  mysqli_query($conn, "UPDATE laporan SET nilai='$nilai', feedback='$feedback' WHERE id=$id");
  header("Location: laporan_masuk.php");
  exit;
}
?>

<h2 class="text-xl font-semibold mb-4">Beri Nilai</h2>
<form method="POST" class="space-y-4">
  <div>
    <label class="block text-sm font-medium">Nilai (0–100)</label>
    <input type="number" name="nilai" value="<?= $data['nilai'] ?? '' ?>" class="w-full border rounded px-3 py-2" required>
  </div>
  <div>
    <label class="block text-sm font-medium">Feedback</label>
    <textarea name="feedback" rows="3" class="w-full border rounded px-3 py-2"><?= $data['feedback'] ?? '' ?></textarea>
  </div>
  <button name="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php include '../partials/footer.php'; ?>
