<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header('Location: ../login.php?status=login_dulu');
    exit();
}

require '../config/koneksi.php';

// Tangkap data
$id_user = $_SESSION['id_user'];
$id_peserta = intval($_POST['id_peserta']);
$id_tim = intval($_POST['id_tim']);

// Cek apakah peserta ini milik user yang login (otoritas)
$check_sql = "SELECT * FROM peserta WHERE id_peserta = $id_peserta AND id_user = $id_user";
$check_result = mysqli_query($koneksi, $check_sql);

// Jika data ditemukan dan milik user yang login
if (mysqli_num_rows($check_result) > 0) {
    // Query delete
    $sql = "DELETE FROM peserta WHERE id_peserta = $id_peserta AND id_user = $id_user";
    $result = mysqli_query($koneksi, $sql);
    
    // Cek apakah berhasil
    if ($result) {
        header("Location: ../pendaftaran.php?id_tim=$id_tim&status=berhasil_hapus");
        exit();
    } else {
        header("Location: ../pendaftaran.php?id_tim=$id_tim");
        exit();
    }
} else {
    // Jika user tidak memiliki akses (bukan pemilik data)
    header("Location: ../pendaftaran.php?id_tim=$id_tim&status=tidak_ada_akses");
    exit();
}
?>