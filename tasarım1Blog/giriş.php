
<?php
  include 'db.php';
  include 'navbar.php';
  session_start();




  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputEmail = $_POST['email'];
    $inputPassword = $_POST['password'];

    // Adminin giriş bilgileri
    $adminEmail = "admin@gmail.com";
    $adminPassword = "admin123";

    // Kullanıcı giriş bilgileri kontrol ediliyor
    if ($inputEmail === $adminEmail && $inputPassword === $adminPassword) {
        // Admin girişi başarılı
        $_SESSION['loggedin'] = true;
        header("Location: index.php"); // Admin ana sayfasına yönlendir
        // Admin girişi yapıldığında veritabanına kayıt ekle
        $sql = "INSERT INTO giris (email, sifre) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $inputEmail, $inputPassword);
        $stmt->execute();
        exit();
    }

    // Geçici şifre tablosundan eşleşen bir kayıt var mı kontrol et
    $sql = "SELECT * FROM parola_unutunca WHERE email='$inputEmail' AND password='$inputPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Geçici şifre eşleşmesi bulundu, kullanıcıyı giriş yapmış kabul et
        $_SESSION['loggedin'] = true;
        header("Location: index.php"); // Kullanıcı ana sayfasına yönlendir
        exit();
    } else {
        // Giriş başarısız
        echo '<script>alert("Kullanıcı adı, e-posta veya şifre yanlış! Lütfen tekrar deneyin.");</script>';
    }

    // Kullanıcı adı ve şifreyi kontrol et
    $email = "gulferkoc@gmail.com";
    $password = "123456";

    if ($inputEmail === $email && $inputPassword === $password) {
        // Giriş başarılıysa oturumu başlat
        $_SESSION['loggedin'] = true;

        // Veritabanına giriş bilgilerini kaydet
        $sql = "INSERT INTO giris (email, sifre) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $inputEmail, $inputPassword); // Doğru değişkenleri kullanmalısınız
        $stmt->execute();
        
        // Kullanıcıyı blogList.php sayfasına yönlendir
        header("Location: blogList.php");
        exit();
    } else {
        // Giriş başarısızsa hata mesajını göster
        echo '<script>alert("Kullanıcı adı, e-posta veya şifre yanlış! Lütfen tekrar deneyin.");</script>';
    }
// Diğer sayfalara erişim engelle, bloglist sayfasına yönlendir
header("Location: bloglist.php");
exit;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>body {
        font-family: Arial, sans-serif;
       
        background-color: #f4f4f4;
    }
    
    .container {
        
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        
    }
    
    
    .login-form {
        background-color: #bb8d9c;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    }
    
    .login-form h2 {
        text-align: center;
        color: #fff;
        height: 50px;

    }
    
    .form-group {
        margin-bottom: 15px;
        margin-bottom: 15px;
        width: 400px;
        height: 70px;
        display: flex;
            flex-direction: column;
            align-items: center;
    }
   
    .form-group label {
        display: block;
        margin-bottom: 5px;
    }
    
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
    
    .form-group.checkbox {
        display: flex;
        align-items: center;
    }
    
    .form-group.checkbox input[type="checkbox"] {
        margin-right: 5px;
    }
    
    .form-group a {
        color: #ffffff;
        text-decoration: none;
        display: block;
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
    <!-- <div id="navbar">
         Navbar'ın olduğu dosyayı buraya çağır 
        <object type="text/html" data="navbar.php" style="width:100%; height:auto;"></object>
        
    </div> -->


    <div class="container">
        
        <div class="login-form">
            <form method="post" action="">
            <h2>Giriş</h2>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group checkbox">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Beni Hatırla</label>
            </div>
            <div class="form-group">
                <a href="forgotpass.php" class="forgot-password"><u>Parolanızı mı unuttunuz?</u></a>
            </div>
          
           
            <?php
            
           
            
            
            
                            if(isset($_POST['send'])){
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                

                                if( $email != "" && $password != "" ){
                                    $sql = "INSERT INTO giris (email, sifre) VALUES ( '$email', ' $password')";

                                    if ($conn->query($sql) === TRUE) {
                                        echo '<p style="margin:0; margin-left:12px;">Mesajınız eklenmiştir.</p><br/>';
                                    } else {
                                        echo "Hata oluştu: " . $conn->error;
                                    }

                                    $conn->close();
                                }else{
                                    echo '<p style="margin:0; margin-left:12px;">Lütfen Formu Eksiksiz Doldurun!</p><br/>';
                                }

                            }
                        ?>


            <button type="submit" name="send">Giriş yap</button>
            <li id="logout" style="display: none;"><a href="#">Çıkış Yap</a></li>
        </form>
    </div></div>
    
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Kullanıcı adı, e-posta ve şifre alınır
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
 
  

    <script>// Bu sadece bir örnek gösterimdir, gerçek bir oturum yönetimi gerekecektir.
        let isLoggedIn = false;
        
        const login = () => {
            isLoggedIn = true;
            updateMenu();
        };
        
        const logout = () => {
            isLoggedIn = false;
            updateMenu();
        };
        
        const updateMenu = () => {
            const loginItem = document.getElementById('login');
            const logoutItem = document.getElementById('logout');
        
            if (isLoggedIn) {
                loginItem.style.display = 'none';
                logoutItem.style.display = 'block';
            } else {
                loginItem.style.display = 'block';
                logoutItem.style.display = 'none';
            }
        };
        
        // Örnek: Giriş yapıldıktan sonra çağrılır
        login();});
        </script>
</body>
</html>