<?php
// Konfigurasi Database
$host = "localhost";
$user = "root";
$pass = "";
$database = "latres_web_ifk";

// Koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset untuk mencegah masalah encoding
mysqli_set_charset($koneksi, "utf8mb4");
?>