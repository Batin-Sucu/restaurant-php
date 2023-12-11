<html>
  <body>
    <?php include "nav.php"; ?>
    <form method="post">
      <input type="text" name="kullanici_adi">
      <input type="text" name="sifre">
      <button>Kayit ol</button>
    </form>
  </body>
</html>

<?php
  require_once "db.php";
  require_once "session.php";

  if($_SERVER['REQUEST_METHOD'] != "POST")
    return;
  
  $kullanici_adi = $_POST['kullanici_adi'];
  $sifre = $_POST['sifre'];

  $kullanici = $db->exec("INSERT INTO kullanicilar (kullanici_adi, sifre, tur) VALUES ('$kullanici_adi', '$sifre', 'musteri')");
  
  if(!$kullanici)
  {
    echo "Kayıt olma başarısız.";
    return;
  }

  $kullaniciId = $db->lastInsertId();
  $_SESSION["id"] = $kullaniciId;
?>