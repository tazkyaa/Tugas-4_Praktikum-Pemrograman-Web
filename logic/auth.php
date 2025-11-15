<?php
session_start();
require "../config/koneksi.php";

// Untuk Login
if(isset($_POST['login'])){
    // Tangkap data
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = mysqli_real_escape_string($koneksi, trim($_POST['password']));
    
    // Query
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $sql);
    
    // Cek apakah user ditemukan
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        // Verifikasi password (jika menggunakan password_hash)
        // Jika password di database tidak di-hash, gunakan perbandingan biasa
        if (password_verify($password, $data['password']) || $password == $data['password']) {
            // Setting session
            $_SESSION['username'] = $data['username'];
            $_SESSION['id_user'] = $data['id_user'];
            
            // Pindahkan ke index.php
            header('Location: ../index.php');
            exit();
        } else {
            // Password salah
            header('Location: ../login.php?status=gagal_login');
            exit();
        }
    } else {
        // User tidak ditemukan
        header('Location: ../login.php?status=gagal_login');
        exit();
    }
}

// Untuk Register
if(isset($_POST['register'])){
    // Tangkap data
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = mysqli_real_escape_string($koneksi, trim($_POST['password']));
    $confirm_password = mysqli_real_escape_string($koneksi, trim($_POST['confirm_password']));
    
    // Cek apakah password sama
    if ($password !== $confirm_password) {
        header('Location: ../register.php?status=password_tidak_sama');
        exit();
    }
    
    // Cek apakah username sudah ada
    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($koneksi, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        header('Location: ../register.php?status=gagal_mendaftar');
        exit();
    }
    
    // Hash password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Query insert
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    $result = mysqli_query($koneksi, $sql);
    
    // Cek apakah berhasil
    if ($result) {
        header('Location: ../login.php?status=berhasil_mendaftar');
        exit();
    } else {
        header('Location: ../register.php?status=gagal_mendaftar');
        exit();
    }
}
?>