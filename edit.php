<?php
session_start();
require "components/components.php";
require "components/session_protected.php";
require "config/koneksi.php";

// Ambil id peserta dari URL
$id_peserta = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id_user = $_SESSION['id_user'];

// Query untuk ambil data peserta
$sql = "SELECT p.*, t.nama as nama_tim, t.gambar_url FROM peserta p 
        LEFT JOIN tim t ON p.id_tim = t.id_tim 
        WHERE p.id_peserta = $id_peserta AND p.id_user = $id_user";
$result = mysqli_query($koneksi, $sql);

// Cek apakah data ditemukan
if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit();
}

$data = mysqli_fetch_assoc($result);

// Query untuk ambil semua tim (untuk dropdown)
$tim_sql = "SELECT * FROM tim";
$tim_result = mysqli_query($koneksi, $tim_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?= head('Edit Data Peserta')  ?> 
</head>

<body>
  <!-- NAVBAR -->
  <?php navbar() ?>

  <!-- CONTENT -->
  <section class="container mt-3 w-100">
    <div class="d-flex gap-3 bg-body-secondary p-3">
      <!-- SISI KIRI -->
      <div class="w-35">
        <div class="mb-2">
          <img src="<?= htmlspecialchars($data['gambar_url']) ?>" alt="<?= htmlspecialchars($data['nama_tim']) ?>" class="object-fit-cover w-100 rounded mb-2 border">
          <p class="m-0 fw-semibold fs-4"><?= htmlspecialchars($data['nama_tim']) ?></p>
        </div>
      </div>
      <!-- SIIS KANAN -->
      <div class="flex-grow-1">
        <a href="pendaftaran.php?id_tim=<?= $data['id_tim'] ?>"><button class="btn btn-dark mb-3">Kembali</button></a>
        <h3 class="mb-2">Update Data Peserta Tim <?= htmlspecialchars($data['nama_tim']) ?></h3>
        <form action="logic/update_data.php" method="POST">
          <!-- HIDDEN INPUT -->
          <input type="hidden" name="id_peserta" value="<?= $data['id_peserta'] ?>">
          
          <div class="mb-3">
            <label for="nama" class="form-label">Nama : </label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="nomer_hp" class="form-label">Nomer Handphone : </label>
            <input type="text" class="form-control" id="nomer_hp" name="nomer_hp" placeholder="Masukkan Nomer HP" value="<?= htmlspecialchars($data['nomer_hp']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email : </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="<?= htmlspecialchars($data['email']) ?>" required>
          </div>
          <div class="mb-3">
            <label for="id_tim" class="form-label">Tim : </label>
            <select class="form-control" id="id_tim" name="id_tim" required>
              <?php while ($tim = mysqli_fetch_assoc($tim_result)): ?>
                <option value="<?= $tim['id_tim'] ?>" <?= $tim['id_tim'] == $data['id_tim'] ? 'selected' : '' ?>>
                  <?= htmlspecialchars($tim['nama']) ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>
          <button type="submit" name="update" class="btn btn-dark">Update Data Peserta</button>
        </form>
      </div>
    </div>
  </section>

  <?php footer() ?>
</body>

</html>