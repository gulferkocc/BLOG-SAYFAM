<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Benim Harika Blogum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1d896aecf2.js" crossorigin="anonymous"></script>
   
   
   <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        section {
            padding: 40px 0;
            background-color: #eb0fa1;
            color: #fff;
        }
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 45px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
           
        }
        footer2 {
            background:#141414;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
           
        }
        h1{font-weight: bold;}
       .icon{text-align: center;}
    </style>
</head>
<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">BLOG SAYFAM</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link" href="blogs.php">Bloglar</a>
              <a class="nav-link" href="kayit.php">Kayıt</a>
              <a class="nav-link" href="giriş.php">Giriş</a>
              <?php
    session_start();
    if(isset($_SESSION['id'])) {
        // Eğer kullanıcı oturum açtıysa, diğer sayfalara erişim izni ver
        echo '<p><a href="blogs.php">Profil Sayfası</a></p>';
        echo '<p><a href="blogList.php">Ayarlar Sayfası</a></p>';
        echo '<p><a href="logout.php">Çıkış Yap</a></p>';
    } else {
     
    }
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
      // Kullanıcı giriş yapmışsa çıkış butonunu göster
      echo '<a class="nav-link" href="logout.php">Çıkış Yap</a>';
  }
    ?>
            </div>
          </div>
        </div>
      </nav></nav>
    
     <section >
      <div class="icon">
      <h1 class="masthead-heading text-uppercase mb-0" >Merhaba!</h1>
      <br/>
          <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
          <br/>
      <p class="masthead-subheading font-weight-light mb-0">Her bir yazı, farklı bir bakış açısını ve deneyimi yansıtıyor.<br/> Siz de bu yolculukta bize katılın, yeni şeyler keşfedin ve tartışmaya dahil olun. <br/>Hep birlikte, bu blog sayfasını daha da zenginleştirebiliriz!"

      </p>

</div>
</section> 
      <footer>
<h2>HAKKIMDA</h2>
<p>Merhaba! Ben Gülfer, bilgisayar mühendisliği son sınıf öğrencisiyim ve burada bilgi birikimimi ve deneyimlerimi paylaşmak için bu bloğu oluşturdum.<br/> Bilecik Şeyh Edebali Üniversitesi Bilgisayar Mühendisliği bölümünde öğrenim görmekteyim ve özellikle yapay zeka, veri bilimi ve yazılım geliştirme konularına ilgi duymaktayım.<br/> Bu blogda, gezi rehberi, öğrenme kaynakları ve kişisel deneyimlerimi paylaşarak bilgi paylaşımına katkı sağlamayı amaçlıyorum.<br/> Kod yazmayı, teknolojiyi keşfetmeyi ve yeni bilgi alanlarında derinleşmeyi seviyorum.<br/> Eğer bilgisayar dünyasına dair merak ettiklerinizi öğrenmek veya benimle iletişime geçmek isterseniz, lütfen bana [3247041@gmail.com] adresinden ulaşın. <br/>Burada sizinle bilgi ve deneyimlerimi paylaşmayı heyecanla bekliyorum!</p>

      </footer>


      <footer2>
    
        <p>&copy; 2023 Blog Sayfam</p>
    </footer>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

