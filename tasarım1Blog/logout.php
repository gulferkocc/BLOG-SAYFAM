<?php
session_start(); // Oturumu başlat

// Tüm oturumu kapat
// Tüm oturum değişkenlerini kaldır
$_SESSION = array();

session_unset();
session_destroy();
header("Location: giriş.php"); // Giriş sayfasına yönlendir
exit();
?>
