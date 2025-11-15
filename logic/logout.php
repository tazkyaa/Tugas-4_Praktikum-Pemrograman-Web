<?php
session_start();

// Hapus semua session
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login dengan status berhasil logout
header('Location: ../login.php?status=berhasil_logout');
exit();
?>