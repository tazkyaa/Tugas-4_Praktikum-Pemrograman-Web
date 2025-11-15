<?php 
// Pengecekan session untuk proteksi halaman
// File ini di-include di halaman yang memerlukan login

if (!isset($_SESSION['username'])) {
    header("location: login.php?status=login_dulu");
    exit();
}
?>