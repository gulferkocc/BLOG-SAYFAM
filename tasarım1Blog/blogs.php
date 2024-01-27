
<?php
    include 'db.php';
    include 'navbar.php';
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <style>
      

/* Gerekli CSS stilleri */
.hidden {
    display: none;
}

h1 {
            text-align: center;
            color: #000;
            margin-top: 50px;
            display: block;
        }
#showBlogForm {
    /* Diğer stiller */
    display: block; /* Butonun tam genişlikte olmasını sağla */
    margin-left: auto; /* Butonu sola yasla */
    margin-right: auto; /* Butonu sağa yasla */
    /* Diğer stiller */
}

.container {
    
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
  
}
.create-blog-form {
    background-color: #f2f2f2;
    padding: 50px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    width: 900px;
    max-width: 90%;
    margin: 200px;
   
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
textarea,
select {
    width: calc(100% - 18px);
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: auto;
    margin-right: auto;
    display: block;
    
}

button[type="submit"],
#showBlogForm {
    width: calc(25% - 18px);
    padding: 10px;
    border: none;
    background-color: #bb8d9c;
    color: #fff;
    cursor: pointer;
    border-radius: 3px;
    transition: background-color 0.3s ease;
    margin-top: 10px;
    text-align: center;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

button[type="submit"]:hover,
#showBlogForm:hover {
    background-color: #ad3981;
}

.result-message {
    display: none;
    margin-top: 10px;
    text-align: center;
    color: #ad3981;
    font-weight: bold;
}

h2 {
    text-align: center;
    color: #ad3981;
}

.image-preview {
            max-width: 300px;
            margin: 20px auto;
        }

   
        .file-input {
            display: none;
        }
    </style>
</head>
<body>

    <h1>BLOG</h1>
    <button id="showBlogForm">Create Blog</button>
  
    <div id="blogForm" class="container hidden"><form method="post" action="" enctype="multipart/form-data">
        <div class="create-blog-form" id="createBlogForm"> 
             
            <h2>Create Blog</h2>
            <div class="form-group">
                <label for="blogTitle">Blog Title</label>
                <input type="text" id="blogTitle" name="blogTitle" required>
            </div>
            <div class="form-group">
                <label for="blogCategory">Blog Category</label>
                <select id="blogCategory" name="blogCategory">
                    <option value="technology">Technology</option>
                    <option value="travel">Travel</option>
                    <option value="travel">Education</option>
                    <option value="lifestyle">Lifestyle</option>
                    <!-- Diğer kategori seçenekleri -->
                </select>
            </div>
            <div class="form-group">
                <label for="blogContent">Blog Content</label>
                <textarea id="blogContent" name="blogContent" required></textarea>
            </div>
            <p>Upload Image<input type="file" name="fileInput" id="fileInput"></p>
    <div class="image-preview" id="imagePreview"></div>

<!-- upload_video.html -->

<p>Upload video <input type="file" name="videoInput" id="videoInput"></p>

    <?php
$upload_directory = 'uploads/';

if (!file_exists($upload_directory)) {
    mkdir($upload_directory, 0777, true);
}
if(isset($_POST['send'])){
    $blogTitle = $_POST['blogTitle'];
    $blogCategory = $_POST['blogCategory'];
    $blogContent = $_POST['blogContent'];


    // Resim yükleme işlemi
    $file_name = $_FILES['fileInput']['name'];
    $file_tmp = $_FILES['fileInput']['tmp_name'];
    $file_destination = 'uploads/' . $file_name; // Yüklenecek klasör yolu
    

    if (move_uploaded_file($file_tmp, $file_destination)) {
        // Resim başarıyla yüklendi, veritabanına yolunu kaydet
        $sql = "INSERT INTO create_blogs (baslik, kategori, icerik, image_path) VALUES ('$blogTitle', '$blogCategory', '$blogContent', '$file_destination')";

        if ($conn->query($sql) === TRUE) {
            echo '<p style="margin:0; margin-left:12px;">Mesajınız eklenmiştir.</p><br/>';
        } else {
            echo "Hata oluştu: " . $conn->error;
        }
    } else {
        echo "Dosya yükleme hatası!";
    }
// upload_video.php

if(isset($_POST['send'])){
    $blogTitle = $_POST['blogTitle'];
    $blogCategory = $_POST['blogCategory'];
    $blogContent = $_POST['blogContent'];

    // Video yükleme işlemi
    $video_name = $_FILES['videoInput']['name'];
    $video_tmp = $_FILES['videoInput']['tmp_name'];
    $video_destination = 'uploads/videos/' . $video_name; // Yüklenecek klasör yolu

    if (move_uploaded_file($video_tmp, $video_destination)) {
        // Video başarıyla yüklendi, veritabanına yolunu kaydet
        $sql = "INSERT INTO create_blogs (baslik, kategori, icerik, video_path) VALUES ('$blogTitle', '$blogCategory', '$blogContent', '$video_destination')";

        if ($conn->query($sql) === TRUE) {
            echo '<p style="margin:0; margin-left:12px;">Blog başarıyla oluşturuldu.</p><br/>';
        } else {
            echo "Hata oluştu: " . $conn->error;
        }
    } else {
        echo "Video yükleme hatası!";
    }

    $conn->close();
}

    $conn->close();
}

else{
                                    echo '<p style="margin:0; margin-left:12px;">Lütfen Formu Eksiksiz Doldurun!</p><br/>';
                                }

                            
                        ?>

            <button type="submit" name="send" >Create Blog</button>
            <button onclick="window.location.href='blogList.php'"type="submit"  > Blogs >></button>
        </form>
        <div class="result-message" style="display: none;"></div>
    </div></div>
    <div id="blogList">
        <!-- Oluşturulan bloglar burada listelenecek -->
    </div>
    <script>// Yeni bir blog girişi eklemek için fonksiyon
        function addBlogEntry(username, content) {
            const today = new Date();
            const creationTime = today.toLocaleDateString(); // Bugünün tarihi
        
            const newBlogEntry = {
                username: username,
                content: content,
                creationTime: creationTime
            };
        
            blogEntries.push(newBlogEntry);
            displayBlogs(); // Güncellenmiş blogları görüntüle
        }
        
        // Örnek kullanım
        addBlogEntry('john_doe', 'Content of the blog entry.');
        </script>

    <script>
        const fileInput = document.getElementById('fileInput');
        const imagePreview = document.getElementById('imagePreview');

        fileInput.addEventListener('change', function() {
            const file = this.files[0]; // İlk seçilen dosyayı alır

            if (file) {
                const reader = new FileReader(); // Dosyayı okumak için FileReader nesnesi

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result; // Resmi görüntüleme alanına ekler
                    imagePreview.innerHTML = ''; // Önceki resmi temizler
                    imagePreview.appendChild(img);
                }

                reader.readAsDataURL(file); // Resmi okur ve base64 formatında alır
            }
        });
    </script>
    




    <script>
        const showBlogFormButton = document.getElementById('showBlogForm');
        const blogForm = document.getElementById('blogForm');

        showBlogFormButton.addEventListener('click', function() {
            // Butona tıklandığında formu göster veya gizle
            blogForm.classList.toggle('hidden');
        });

        document.getElementById('createBlogForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            // Sunucuya POST isteği göndermek için fetch kullanımı
            fetch('/api/create-blog', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const resultMessage = document.querySelector('.result-message');
                resultMessage.style.display = 'block';
                resultMessage.textContent = data.message;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
