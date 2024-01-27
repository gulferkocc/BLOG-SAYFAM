<?php

session_start();

// Oturumda admin yetkisi kontrolü yapın
if(isset($_SESSION['giriş']) && isset($_SESSION['username']) && $_SESSION['username'] === 'admin@gmail.com') {
    // POST isteği kontrolü yapın ve silme isteği alınmışsa işleme devam edin
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sil_blog'])) {
        // Veritabanı bağlantısını içe aktarın
        include 'db.php';

        // Formdan gelen blog_id'yi al
        $blog_id = $_POST['blog_id'];

        // Veritabanından ilgili blogu sil
        $silme_sorgusu = "DELETE FROM create_blogs WHERE blog_id = '$blog_id'";
        if ($conn->query($silme_sorgusu) === TRUE) {
            // Başarılı bir şekilde silindiyse, kullanıcıyı başka bir sayfaya yönlendirin veya mesaj gösterin
            header("Location: blogList.php"); // Blog listesi sayfasına yönlendirme
            exit();
        } else {
            // Silme işlemi başarısız olduysa, hata mesajı gösterin veya uygun bir işlem yapın
            echo "Blog silinirken bir hata oluştu: " . $conn->error;
        }
    }
} else {
    // Yetkisiz erişim durumunda kullanıcıyı başka bir sayfaya yönlendirin veya uygun bir mesaj gösterin
    echo "Üzgünüz, bu işlemi gerçekleştirmek için yeterli yetkiniz yok.";
    exit(); // İşlemi durdur
}
?>
