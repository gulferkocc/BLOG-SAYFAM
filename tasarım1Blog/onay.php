<?php
    include 'db.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>onay</title>
    <style>
        body{
            background-color:blue;
        }
        a{
            font-size:20px;
          color:black;
        }
    </style>
</head>
<body>

    <!-- <form method="get" action="onay.php">
        <input type="hidden" name="key" value="<?php echo $confirmationKey; ?>">
        <button type="submit">Hesabınızı Onaylayın</button>
    </form> -->
    <form action="http://www.example.com/onay.php" method="GET">
    <input type="hidden" name="key" value="652672d97ce71d2b26fa552e950b6212
">
    <button type="submit">Hesabınızı Onaylayın</button>
</form>



<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['key'])) {
    $confirmationKey = $_GET['key'];

    // Onay anahtarını kontrol et
    $query = "SELECT * FROM kayit_onay WHERE onay_anahtari = '$confirmationKey'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Onay anahtarı geçerli, kullanıcıyı veritabanına kaydet
      

        // Kullanıcıyı kaydet
        $sql = "INSERT INTO kayit (kullanici_adi, eposta, sifre) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Kullanıcı başarıyla kaydedildi, onaylanmış kullanıcıyı kayıt onay tablosundan sil
            $deleteQuery = "DELETE FROM kayit_onay WHERE onay_anahtari = '$confirmationKey'";
            $conn->query($deleteQuery);

            echo '<p style="margin:0; margin-left:12px;">Hesabınız başarıyla onaylandı!</p><br/>';
        } else {
            echo "Hata oluştu: " . $conn->error;
        }
    } 
}
?>


</body>
</html>