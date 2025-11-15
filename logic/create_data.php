<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header('Location: ../login.php?status=login_dulu');
    exit();
}

require '../config/koneksi.php';

// Cek apakah form di-submit
if (isset($_POST['tambah'])) {
    // Tangkap data dari form
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $nomer_hp = mysqli_real_escape_string($koneksi, trim($_POST['nomer_hp']));
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $id_tim = intval($_POST['id_tim']);
    $id_user = $_SESSION['id_user'];
    
    // Validasi data tidak boleh kosong
    if (empty($nama) || empty($nomer_hp) || empty($email)) {
        header("Location: ../pendaftaran.php?id_tim=$id_tim&status=gagal_tambah");
        exit();
    }
    
    // Query insert data peserta
    $sql = "INSERT INTO peserta (nama, nomer_hp, email, id_tim, id_user) 
            VALUES ('$nama', '$nomer_hp', '$email', $id_tim, $id_user)";
    $result = mysqli_query($koneksi, $sql);
    
    // Cek apakah berhasil
    if ($result) {
        header("Location: ../pendaftaran.php?id_tim=$id_tim&status=berhasil_tambah");
        exit();
    } else {
        header("Location: ../pendaftaran.php?id_tim=$id_tim&status=gagal_tambah");
        exit();
    }
} else {
    // Jika akses langsung tanpa POST
    header('Location: ../index.php');
    exit();
}
?>