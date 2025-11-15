<?php
function head($title)
{ ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <!-- CSS Boostrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <!-- CSS Custom -->
  <link rel="stylesheet" href="css/style.css">
<?php } ?>

<?php
function footer()
{ ?>
  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz4YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <!-- Untuk UX menghapus status urlnya || Silahkan uncomment kalo mau make, gak usah biarain juga boleh -->
  <script>
    // Hapus ?status=... dari URL setelah toast tampil
    if (window.location.search.includes("status=")) {
      setTimeout(function() {
        window.history.replaceState({}, document.title, window.location.pathname + window.location.search.replace(/[?&]status=[^&]+/, '').replace(/^&/, '?'));
      }, 3000);
    }
  </script>
<?php
}
?>

<?php
function listAlert($status)
{
  switch ($status) {
    case 'berhasil_mendaftar': ?>
      <div class="alert alert-success" role="alert">
        Success : Berhasil mendaftarkan akun
      </div>
    <?php break;
    case 'gagal_mendaftar': ?>
      <div class="alert alert-danger" role="alert">
        Error : Gagal mendaftarkan akun
      </div>
    <?php break;
    case 'gagal_login': ?>
      <div class="alert alert-danger" role="alert">
        Error : Gagal Login
      </div>
    <?php break;
    case 'password_tidak_sama': ?>
      <div class="alert alert-danger" role="alert">
        Error : Password tidak sama
      </div>
    <?php break;
    case 'login_dulu': ?>
      <div class="alert alert-danger" role="alert">
        Error : Login terlebih dahulu
      </div>
    <?php break;
    case 'berhasil_logout': ?>
      <div class="alert alert-success" role="alert">
        Success : Berhasil Logout
      </div>
    <?php break;
    case 'berhasil_tambah': ?>
      <div class="alert alert-success" role="alert">
        Success : Berhasil menambahkan peserta
      </div>
    <?php break;
    case 'berhasil_edit': ?>
      <div class="alert alert-success" role="alert">
        Success : Berhasil mengupdate data peserta
      </div>
    <?php break;
    case 'berhasil_hapus': ?>
      <div class="alert alert-success" role="alert">
        Success : Berhasil menghapus data peserta
      </div>
    <?php break;
    case 'tidak_ada_akses': ?>
      <div class="alert alert-danger" role="alert">
        Error : Anda tidak memiliki akses untuk mengubah data ini
      </div>
<?php break;
  }
}
?>

<?php
function navbar()
{ ?>
  <nav class="navbar bg-dark border-bottom">
    <div class="container d-flex justify-content-between">
      <a class="navbar-brand fw-bold fs-3 text-white" href="index.php">
        Pilih Tim
      </a>
      <a href="logic/logout.php"><button class="btn btn-danger">Logout</button></a>
    </div>
  </nav>
<?php } ?>



<?php
function card($data = NULL)
{ ?>
  <div class="card" style="width: 22rem;">
    <img src="<?= htmlspecialchars($data['gambar_url']) ?>" class="card-img-top size-card object-fit-cover" alt="<?= htmlspecialchars($data['nama']) ?>">
    <div class="card-body ">
      <h5 class="card-title text-center mb-3"><?= htmlspecialchars($data['nama']) ?></h5>
      <div class="d-flex justify-content-center">
        <form action="pendaftaran.php" method="GET" class="w-100 d-flex justify-content-center">
          <input type="hidden" name="id_tim" value="<?= $data['id_tim'] ?>">
          <button type="submit" class="btn btn-dark">Tambahkan Peserta</button>
        </form>
      </div>
    </div>
  </div>
<?php
}
?>