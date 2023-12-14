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
  <head>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <form method="POST" class="mx-auto flex flex-col w-fit mt-4 gap-2">
      <label for="isim" >İş Yeri İsmi:</label><input name="isim" type="text" class="border rounded p-1 w-96"><br>
      <label for="iletisim" >İletişim:</label><input name="iletisim" type="text" class="border rounded p-1 w-96"><br>
      <label for="adres" >Adres:</label><textarea name="adres" class="border rounded p-1 w-96"></textarea> <br>
      <button name="restoranKayit" class="border rounded px-12 hover:bg-neutral-200">Kayıt</button>
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