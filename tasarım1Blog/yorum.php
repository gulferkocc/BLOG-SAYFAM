<?php
    include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['yorum'])) {
        $blog_id = $_POST['blog_id'];
        $yorum = $_POST['yorum'];

        // Yorumun boş olup olmadığını kontrol edin
        if (!empty($yorum)) {
            // Yorum ekleme işlemi
            $sql = "INSERT INTO yorumlar (blog_id, yorum) VALUES ('$blog_id', '$yorum')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Yorum başarıyla eklendi.</p>";
            } else {
                echo "<p>Yorum eklenirken hata oluştu: " . $conn->error . "</p>";
            }
        } else {
            echo "<p>Lütfen bir yorum girin.</p>";
        }
    }
?>
