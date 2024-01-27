<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blogId = $_POST['blog_id'];

    // Beğeni sayısını artır
    $updateQuery = "UPDATE create_blogs SET begeni = begeni + 1 WHERE blog_id = '$blogId'";
    if ($conn->query($updateQuery) === TRUE) {
        // Güncellenmiş beğeni sayısını getir
        $begeni_sorgusu = "SELECT begeni FROM create_blogs WHERE blog_id = '$blogId'";
        $begeni_sonuc = $conn->query($begeni_sorgusu);
        $begeni_satir = $begeni_sonuc->fetch_assoc();
        $begeni_sayisi = $begeni_satir['begeni'];

        // Güncellenmiş beğeni sayısını JSON olarak geri döndür
        echo json_encode($begeni_sayisi);
    } else {
        echo "Hata: " . $conn->error;
    }
}
$conn->close();
?>
