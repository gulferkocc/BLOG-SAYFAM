<?php
    include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt</title>
    <style>.container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        
    }
   
    .register-form {
        background-color: #bb8d9c;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    }
    
    .register-form h2 {
        text-align: center;
        color: #fff;
        height: 50px;

    }
    
    .form-group {
        margin-bottom: 15px;
        width: 400px;
        height: 110px;
        display: flex;
            flex-direction: column;
            align-items: center;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }
    
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
        
    }
    
    .form-group input[type="text"],
    .form-group input[type="email"],
        .form-group input[type="password"] {
            width: calc(100% - 18px); /* Genişlik hesaplaması */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 5px; /* Aralık için */
            margin-bottom: 5px; /* Aralık için */
            margin-left: auto; /* Ortalamak için sol kenarı hizalama */
            margin-right: auto; /* Ortalamak için sağ kenarı hizalama */
            display: block; /* Satır sonu oluşturmak için */
        }
    
    button[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #bb8d9c;
        color: #fff;
        cursor: pointer;
        border-radius: 3px;
        transition: background-color 0.3s ease;
    }
    
    button[type="submit"]:hover {
        background-color: #ad3981;
    }
    
    body{background-color: #ad3981;
    color: #fff;}
        </style>
</head>
<body>
<?php include 'navbar.php'; ?>

    <!-- NAVBAR -->

    <div class="container">
        <div class="register-form">
            <form method="post" action=""> 
                <h2>Kayıt Ekranı </h2>
                <div class="form-group">
                    <!-- Kullanıcı adı, e-posta ve şifre inputları -->
                    <label for="username"style="color: #fff;">Kullanıcı Adı</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email"style="color: #fff;">E-posta</label>
                    <input type="email" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Geçerli bir e-posta adresi girin" required>
                </div>
                <div class="form-group">
                    <label for="password"style="color: #fff;">Şifre</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <?php
include 'db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Geçerli bir e-posta adresi girin.";
    } else {
        // Rastgele onay anahtarı oluştur
        $confirmationKey = md5(uniqid(rand(), true));

        // Onay bağlantısını oluştur
        $confirmationLink = "http://www.example.com/onay.php?key=$confirmationKey";

        // Kullanıcıyı veritabanına eklemeden önce onay anahtarını kaydet
        $sql = "INSERT INTO kayit_onay (kullanici_adi, email, sifre, onay_anahtari) VALUES ('$username', '$email', '$password', '$confirmationKey')";

        if ($conn->query($sql) === TRUE) {
            // Onay e-postasını gönder
            $to = $email;
            $subject = 'Hesap Onayı';
            $message = "Merhaba $username, \n\nHesabınızı onaylamak için lütfen aşağıdaki bağlantıya tıklayın:\n$confirmationLink";
            $headers = 'From: gulferkoc@gmail.com' . "\r\n" .
                'Reply-To: admin@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            if (mail($to, $subject, $message, $headers)) {
                echo '<p style="margin:0; margin-left:12px;">Kayıt başarıyla tamamlandı. Lütfen e-postanızı kontrol edin ve hesabınızı onaylayın.</p><br/>';
                // Belirli bir süre sonra başka bir sayfaya yönlendirme yapmak için header fonksiyonunu kullanabilirsiniz
                header("refresh:5;url=index.php"); // 5 saniye sonra index.php'ye yönlendirme
                exit; // Yönlendirme yaptıktan sonra scriptin devam etmemesi için exit kullanılır
            } else {
                echo "Mail gönderimi başarısız oldu.";
            }
        } else {
            echo "Hata oluştu: " . $conn->error;
        }
    }
}
?>
<form action="onay.php" method="POST">

                <button type="submit" name="send">Kayıt Ol</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Kullanıcı adı, e-posta ve şifre alınır
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Şifre kontrolü yapılır (örnek olarak, şifrenin en az 6 karakter olması gerektiği varsayılmıştır)
            if (password.length < 6) {
                alert('Şifreniz en az 6 karakter olmalıdır! Lütfen tekrar deneyin.');
            } else {
                // Diğer işlemler (örneğin, sunucu tarafı ile kayıt)
                // Bu kısımda sunucu tarafı işlemleri yapılmalıdır
                // Eğer her şey yolundaysa başka bir sayfaya yönlendirme gerçekleştirilebilir
                window.location.href = 'giriş.php';
            }
        });
    </script>
</body>
</html>
