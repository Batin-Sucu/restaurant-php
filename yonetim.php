<?php
  include "nav.php";
  require_once "session.php";
  require_once "db.php";

  if(empty($_SESSION['id'])) {
    header("Location: giris.php");
    return;
  }

  $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $_SESSION['id'])->fetch();
  
  if($kullanici['tur'] != 'yonetici') {
    header("Location: anasayfa.php");
    return;
  }
?>

<html>
    <body>
        <form method="POST">
            <label for="isim" >İş Yeri İsmi:</label><input name="isim" type="text"><br>
            <label for="iletisim" >İletişim:</label><input name="iletisim" type="text"><br>
            <label for="adres" >Adres:</label><textarea name="adres"></textarea> <br>
            <button name="restoranKayit">Kayıt</button>
        </form>
    </body>
</html>

<?php
    if(!isset($_POST['restoranKayit'])) {
        return;
    }

    $isim = $_POST['isim'];
    $iletisim = $_POST['iletisim'];
    $adres = $_POST['adres'];

    $db->query("INSERT INTO restaurant (isim, iletisim, adres, sahip) VALUES ('$isim', '$iletisim', '$adres', " . $_SESSION['id'] . ")");
?>