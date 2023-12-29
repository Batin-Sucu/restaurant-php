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
    <form method="POST" class="mx-auto flex flex-col w-fit mt-4 gap-2" enctype="multipart/form-data">
      <label for="isim" >İş Yeri İsmi:</label><input name="isim" type="text" class="border rounded p-1 w-96"><br>
      <label for="iletisim" >İletişim:</label><input name="iletisim" type="text" class="border rounded p-1 w-96"><br>
      <label for="resim" >Görsel:</label><input name="resim" type="file" class="border rounded p-1 w-96"><br>
      <label for="cocukPark" >Çocuk Parkı</label><input type="checkbox" name="cocukPark" value="1"><br>
      <label for="adres" >Adres:</label><textarea name="adres" class="border rounded p-1 w-96"></textarea> <br>
      <button name="restoranKayit" class="border rounded px-12 hover:bg-neutral-200">Kayıt</button> 
    </form>
  </body>
</html>

<?php
    if(!isset($_POST['restoranKayit'])) {
        return;
    }

    if(!isset($_POST['cocukPark'])){
      $cocukParkC=0;
    }
    else{
      $cocukParkC=$_POST['cocukPark'];
    }

    $isim = $_POST['isim'];
    $iletisim = $_POST['iletisim'];
    $adres = $_POST['adres'];
    $file = $_FILES['resim'];
    $fileName = $file['name'];
    $filePath = "./files/".md5(time()).$fileName;
    move_uploaded_file($file['tmp_name'], $filePath);
    $db->query("INSERT INTO restaurant (isim, iletisim, adres, sahip, foto,cocuk_parki) VALUES ('$isim', '$iletisim', '$adres', {$_SESSION['id']},'$filePath' ,$cocukParkC)");
?>  