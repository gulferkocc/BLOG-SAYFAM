<?php
    include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot-password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #fff;
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
            height: 50px;
            color: #fff;
        }
        .form-group {
            margin-bottom: 15px;
            width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
    
        .form-group input[type="email"] {
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
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="login-form">
            <form method="post" action="">
                <h2>Şifremi Unuttum</h2>
                <div class="form-group">
                    <label for="email"style="color: #fff;">Emailinizi Giriniz</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit" name="send">Gönder</button>
            </form>
            <?php
                if(isset($_POST['send'])) {
                    $email = $_POST['email'];
                    // Rastgele bir şifre oluşturma fonksiyonu
                    function generatePassword($length = 8) {
                        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                        $password = '';
                        for ($i = 0; $i < $length; $i++) {
                            $password .= $chars[rand(0, strlen($chars) - 1)];
                        }
                        return $password;
                    }
                    // Yeni şifre oluştur
                    $password = generatePassword(); // Varsayılan uzunluk 8 karakter
                    // Veritabanına e-posta ve şifreyi ekle
                    $sql = "INSERT INTO parola_unutunca (email, password) VALUES ('$email', '$password')";
                    if ($conn->query($sql) === TRUE) {
                        echo '<p style="margin:0; margin-left:12px; color:white;">** Yeni şifreniz e-posta adresinize gönderilmiştir.</p><br/>';
                    } else {
                        echo "Hata oluştu: " . $conn->error;
                    }
                    $conn->close();
                }
            ?>
        </div>
    </div>
</body>
</html>
