<?php
    // Veritabanı bağlantısı ve verilerin çekilmesi
    include 'db.php';
    include 'navbar.php';
    session_start();
   
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Kullanıcı giriş yapmışsa çıkış butonunu göster
        echo '<a class="nav-link" href="logout.php">Çıkış Yap</a>';
    }
 
    // Veritabanından çekilen blog verilerinin gösterilmesi
    $sql = "SELECT * FROM create_blogs";
    $result = $conn->query($sql);

   

// Kullanıcı girişi yapılmamışsa, giriş sayfasına yönlendir
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.html");
    exit();
}
?>
<script>
       // Örnek: Giriş yapıldıktan sonra çağrılır
       isLoggedIn = true;

// Menüyü güncelle
updateMenu();
    </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Listesi</title>
    <style>
        .blog-box {
            background-color: #f2f2f2;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            flex: 1 1 300px; 
            /* Diğer stil ayarları */
        }

        /* Her blog kutusu içindeki elemanların stilleri */
        .blog-box h2 {
            color: #333;
            /* Başlık stil ayarları */
        }

        .blog-box p {
            color: #666;
            /* Paragraf stil ayarları */
        }
        .blog-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Blog kutuları arasındaki boşluk */
        }
        /* Diğer stillendirmeler */
     

        .blog-box {
            /* Blog kutusu stilleri */
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .button-group {
            display: flex;
            gap: 10px;
        }
        .button-group form {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .button-group input[type="text"],
        .button-group button {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .yorumlar {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

    </style>
</head>
<body>

    <h1 style="text-align:center; color:purple">My Blogs</h1>
    <div class="blog-container">
    <?php
    
        // Veritabanından çekilen blog verilerinin gösterilmesi
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='blog-box'>";
                
                    // Resim varsa, resmi göster
            if (!empty($row["image_path"])) {
                echo "<img src='" . $row["image_path"] . "' alt='" . $row["baslik"] . "' width='300'>";
            }
            // Video varsa, videosu göster
            if (!empty($row["video_path"])) {
                echo "<video width='300' controls>";
                echo "<source src='" . $row["video_path"] . "' type='video/mp4'>";
                echo "Tarayıcınız video etiketini desteklemiyor.";
                echo "</video>";
            }
                echo "<p>" . $row["kategori"] . "</p>"; 
                echo "<h2>" . $row["baslik"] . "</h2>";
                echo "<p>" . $row["icerik"] . "</p>";
                echo "<p>" . $row["olusturma_zamani"] . "</p>";
                echo "<p> " . $row["kullanici_adi"] . "</p>";



             
                echo "<div class='button-group'>";
                
                // Yorum butonu
                echo "<form method='POST' action='blogList.php'>";
                echo "<input type='hidden' name='blog_id' value='" . $row["blog_id"] . "'>";
                echo "<input type='text' name='yorum' placeholder='Yorumunuzu girin'>";
                echo "<button type='submit' name='yorum_btn' style='background: none; border: none;'>";
                echo "&#128172;"; // Yorum simgesi Unicode
                echo "</button>";
                echo "</form>";

                // Beğeni butonu
                echo "<form method='POST' action='blogList.php'>";
                echo "<input type='hidden' name='blog_id' value='" . $row["blog_id"] . "'>";
                echo "<button type='submit' name='begeni' style='background: none; border: none;'>";
                echo "&#x1F497;"; // Kalp simgesi Unicode
                echo "</button>";
                echo "</form>";

                // Silme butonu
echo "<form method='POST' action='sil_blog.php'>";
echo "<input type='hidden' name='blog_id' value='" . $row["blog_id"] . "'>";
echo "<button type='submit' name='sil_blog' style='background: none; border: none; color: red;'>&#128465;</button>";
echo "</form>";


                // Ok işareti (yorumları göstermek için)
                echo "<span class='toggle-yorum' onclick='toggleYorumlar(" . $row["blog_id"] . ")'>&#10148;</span>";

                // Beğeni sayısını gösterme
                $blog_id = $row["blog_id"];
                $begeni_sorgusu = "SELECT COUNT(*) as begeni FROM create_blogs WHERE blog_id = '$blog_id'";
                $begeni_sonuc = $conn->query($begeni_sorgusu);
                $begeni_satir = $begeni_sonuc->fetch_assoc();
                $begeni_sayisi = $begeni_satir["begeni"];

                echo "<span id='begeni_sayisi_$blog_id'> " . $begeni_sayisi . "</span>";
                
                // Yorumları gösterme
                $yorum_sorgusu = "SELECT * FROM yorumlar WHERE blog_id = '$blog_id'";
                $yorum_sonuc = $conn->query($yorum_sorgusu);

                echo "<div class='yorumlar' id='yorumlar_$blog_id'>";
                if ($yorum_sonuc->num_rows > 0) {
                    echo "<p>Yorumlar: <span class='toggle-yorum' onclick='toggleYorumlar($blog_id)'></span></p>";
                    while ($yorum_satir = $yorum_sonuc->fetch_assoc()) {
                        echo "<p>" . $yorum_satir["yorum"] . "</p>";
                    }
                } else {
                    echo "<p>Henüz yorum yapılmamış.</p>";
                }
                echo "</div>"; // yorumlar div'i
                echo "</div>"; // button-group bitişi
                echo "</div>"; // blog-box bitişi
            }
        } else {
            echo "Henüz blog bulunmamaktadır.";
        }
        $conn->close();
    ?>
    </div>
    <script>
        function toggleYorumlar(blogId) {
            var yorumlarDiv = document.getElementById('yorumlar_' + blogId);
            yorumlarDiv.style.display = (yorumlarDiv.style.display === 'none' || yorumlarDiv.style.display === '') ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[name="begeni"]').forEach(function (begeni) {
                begeni.addEventListener('click', function () {
                    var blogId = begeni.previousElementSibling.value;
                    var begeniSayisiSpan = document.getElementById('begeni_sayisi_' + blogId);

                    // AJAX kullanarak sunucuda beğeni sayısını güncelleyin
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4) {
                            if (xhr.status == 200) {
                                // Sunucudan dönen beğeni sayısını güncelleyin
                                begeniSayisiSpan.textContent = parseInt(begeniSayisiSpan.textContent) + 1;
                            } else {
                                console.error("Beğeni eklenirken hata oluştu: " + xhr.statusText);
                            }
                        }
                    };
                    xhr.open('POST', 'begeni_ekle.php', true); // 'begeni_ekle.php' işlemi beğeni sayısını artırmak için oluşturulmuş bir dosya adıdır.
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send('blog_id=' + blogId);
                });
            });

            document.querySelectorAll('[name="yorum_btn"]').forEach(function (yorumBtn) {
                yorumBtn.addEventListener('click', function () {
                    var blogId = yorumBtn.previousElementSibling.previousElementSibling.value;
                    var yorumInput = yorumBtn.previousElementSibling;

                    // AJAX kullanarak sunucuya yorum ekleyin
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 2) {
                            if (xhr.status == 100) {
                                // Sunucudan dönen yanıtı kontrol edin (isteğe bağlı)
                                console.log(xhr.responseText);

                                // Yorum ekledikten sonra sayfayı yeniden yükleyin (isteğe bağlı)
                                location.reload();
                            } else {
                                console.error("Yorum eklenirken hata oluştu: " + xhr.statusText);
                            }
                        }
                    };
                    xhr.open('POST', 'yorum.php', true); // 'yorum_ekle.php' işlemi yorum eklemek için oluşturulmuş bir dosya adıdır.
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.send('blog_id=' + blogId + '&yorum=' + yorumInput.value);
                });
            });
        });
    </script>
    
</body>
</html>
