<html>
  <body>
    <?php include "nav.php"; ?>
    <form method="post">
      <input type="text" name="kullanici_adi">
      <input type="password" name="sifre">
      <button name="giris">Giris yap</button>
    </form>
  </body>
</html>

<?php 
  require_once "db.php";
  require_once "session.php";

  if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST["giris"]))
    return;
  
  $kullanici_adi=$_POST["kullanici_adi"];
  $sifre=$_POST["sifre"];

  $kullanici=$db->query("SELECT * FROM kullanicilar WHERE kullanici_adi ='$kullanici_adi'")->fetch();
  if($kullanici['id'] == "")
  {
      echo "Kullanıcı Bulunamadı";
      return;
  }
  
  if($kullanici_adi == $kullanici['kullanici_adi'] and $sifre == $kullanici['sifre'])
  {
      $_SESSION["id"] = $kullanici['id'];
      header("Location: anasayfa.php");
  }
?>