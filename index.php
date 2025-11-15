<?php
session_start();
require "components/components.php";
require "components/session_protected.php";
require "config/koneksi.php";

// Query untuk ambil data tim
$sql = "SELECT * FROM tim ORDER BY id_tim";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head('Pilih Tim')  ?>
</head>

<body>
  <!-- NAVBAR -->
  <?php navbar() ?>

  <!-- CONTENT -->
  <section class="container my-5">
    <main class="d-flex justify-content-center gap-5">
      <!-- Loop data tim menggunakan function card() -->
      <?php
      while ($data = mysqli_fetch_array($result)) {
        card($data);
      }
      ?>
      <!-- END CARD -->
    </main>
  </section>

  <?php footer() ?>
</body>

</html>