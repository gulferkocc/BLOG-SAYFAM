<?php
include 'db.php';
$dosyaAdi = $_FILES['dosya']['name']; // Yüklenen dosyanın adı
$geciciYol = $_FILES['dosya']['tmp_name']; // Yüklenen dosyanın geçici yolunu al

$hedefYol = 'uploads/' . $dosyaAdi; // Dosyanın kaydedileceği hedef yol

if (move_uploaded_file($geciciYol, $hedefYol)) {
    echo "Dosya başarıyla yüklendi. Yol: " . $hedefYol;
} else {
    echo "Dosya yüklenirken bir hata oluştu.";
}
?>
