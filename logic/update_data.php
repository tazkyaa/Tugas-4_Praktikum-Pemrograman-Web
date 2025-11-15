<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header('Location: ../login.php?status=login_dulu');
    exit();
}

require '../config/koneksi.php';

// Cek apakah form di-submit
if (isset($_POST['update'])) {
    // Tangkap data dari form
    $id_peserta = intval($_POST['id_peserta']);
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $nomer_hp = mysqli_real_escape_string($koneksi, trim($_POST['nomer_hp']));
    $email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $id_tim = intval($_POST['id_tim']);
    $id_user = $_SESSION['id_user'];
    
    // Validasi data tidak boleh kosong
    if (empty($nama) || empty($nomer_hp) || empty($email)) {
        header("Location: ../edit.php?id=$id_peserta&status=gagal_edit");
        exit();
    }
    
    // Cek apakah peserta ini milik user yang login (otoritas)
    $check_sql = "SELECT * FROM peserta WHERE id_peserta = $id_peserta AND id_user = $id_user";
    $check_result = mysqli_query($koneksi, $check_sql);
    
    // Jika data ditemukan dan milik user yang login
    if (mysqli_num_rows($check_result) > 0) {
        // Query update
        $sql = "UPDATE peserta SET 
                nama = '$nama', 
                nomer_hp = '$nomer_hp', 
                email = '$email', 
                id_tim = $id_tim 
                WHERE id_peserta = $id_peserta AND id_user = $id_user";
        $result = mysqli_query($koneksi, $sql);
        
        // Cek apakah berhasil
        if ($result) {
            header("Location: ../pendaftaran.php?id_tim=$id_tim&status=berhasil_edit");
            exit();
        } else {
            header("Location: ../edit.php?id=$id_peserta&status=gagal_edit");
            exit();
        }
    } else {
        // Jika user tidak memiliki akses (bukan pemilik data)
        header("Location: ../pendaftaran.php?id_tim=$id_tim&status=tidak_ada_akses");
        exit();
    }
} else {
    // Jika akses langsung tanpa POST
    header('Location: ../index.php');
    exit();
}
?>