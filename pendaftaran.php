<?php
session_start();
require "components/components.php";
require "components/session_protected.php";
require "config/koneksi.php";

// Ambil id_tim dari URL
$id_tim = isset($_GET['id_tim']) ? intval($_GET['id_tim']) : 1;
$id_user = $_SESSION['id_user'];

// Query untuk ambil data tim
$tim_sql = "SELECT * FROM tim WHERE id_tim = $id_tim";
$tim_result = mysqli_query($koneksi, $tim_sql);
$tim_data = mysqli_fetch_assoc($tim_result);

// Query untuk ambil data peserta di tim ini
$peserta_sql = "SELECT p.*, u.username FROM peserta p 
                LEFT JOIN users u ON p.id_user = u.id_user 
                WHERE p.id_tim = $id_tim 
                ORDER BY p.id_peserta DESC";
$peserta_result = mysqli_query($koneksi, $peserta_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <?= head('Pendaftaran Tim - ' . $tim_data['nama'])  ?>
</head>

<body>
  <!-- NAVBAR -->
  <?php navbar() ?>

  <!-- CONTENT -->
  <section class="container mt-3 w-100">
    <!-- PESAN STATUS -->
    <?php if(isset($_GET['status'])) {
      listAlert($_GET['status']); 
    }
    ?>
    
    <div class="d-flex gap-3 bg-body-secondary p-3">
      <!-- SISI KIRI -->
      <div class="w-25">
        <div class="mb-2">
          <img src="<?= htmlspecialchars($tim_data['gambar_url']) ?>" alt="<?= htmlspecialchars($tim_data['nama']) ?>" class="object-fit-cover w-100 rounded mb-2 border">
          <p class="m-0 fw-semibold fs-4"><?= htmlspecialchars($tim_data['nama']) ?></p>
        </div>
        <!-- FORM -->
        <hr>
        <h5>Tambah Data Peserta</h5>
        <form action="logic/create_data.php" method="POST">
          <!-- HIDDEN INPUT -->
          <input type="hidden" name="id_tim" value="<?= $id_tim ?>">
          
          <div class="mb-3">
            <label for="nama" class="form-label">Nama : </label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>
          </div>
          <div class="mb-3">
            <label for="nomer_hp" class="form-label">Nomer HP : </label>
            <input type="text" class="form-control" id="nomer_hp" name="nomer_hp" placeholder="Masukkan Nomer HP" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email : </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
          </div>
          <button type="submit" name="tambah" class="btn btn-dark">Tambah Data</button>
        </form>
      </div>
      <!-- SIIS KANAN -->
      <div class="flex-grow-1">
        <h3 class="mb-2">Data Tim - <?= htmlspecialchars($tim_data['nama']) ?></h3>
        <div class="d-flex flex-column gap-2">
          <!-- TABEL -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Nomer HP</th>
                <th scope="col">Email</th>
                <th scope="col">Didaftarkan Oleh</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!-- LOOP -->
              <?php 
              $no = 1;
              if (mysqli_num_rows($peserta_result) > 0) {
                while ($peserta = mysqli_fetch_assoc($peserta_result)): 
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($peserta['nama']) ?></td>
                  <td><?= htmlspecialchars($peserta['nomer_hp']) ?></td>
                  <td><?= htmlspecialchars($peserta['email']) ?></td>
                  <td><?= htmlspecialchars($peserta['username']) ?></td>
                  <td>
                    <?php if ($peserta['id_user'] == $id_user): ?>
                      <!-- Hanya tampil jika data milik user yang login -->
                      <a href="edit.php?id=<?= $peserta['id_peserta'] ?>" class="btn btn-warning btn-sm">Edit</a>
                      <form action="logic/delete_data.php" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        <input type="hidden" name="id_peserta" value="<?= $peserta['id_peserta'] ?>">
                        <input type="hidden" name="id_tim" value="<?= $id_tim ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                    <?php else: ?>
                      <span class="text-muted">-</span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php 
                endwhile;
              } else {
                echo '<tr><td colspan="6" class="text-center">Belum ada data peserta</td></tr>';
              }
              ?>
              <!-- END LOOP -->
            </tbody>
          </table>
          <!-- END TABEL -->
        </div>
      </div>
    </div>
  </section>

  <?php footer() ?>
</body>

</html>