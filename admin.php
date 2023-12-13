<?php
  include "nav.php";
  require_once "session.php";
  require_once "db.php";

  if(empty($_SESSION['id'])) {
    header("Location: giris.php");
    return;
  }

  $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $_SESSION['id'])->fetch();
  if($kullanici['tur'] != 'admin') {
    header("Location: anasayfa.php");
    return;
  }

  $restaurantlar = $db->query("SELECT * FROM restaurant INNER JOIN kullanicilar ON restaurant.sahip = kullanicilar.id");

  if(isset($_POST['restoranKayit'])){
    $sahip = $_POST['sahip'];
    $isim = $_POST['isim'];
    $iletisim = $_POST['iletisim'];
    $adres = $_POST['adres'];

    $db->query("INSERT INTO restaurant (isim, iletisim, adres, sahip) VALUES ('$isim', '$iletisim', '$adres', $sahip)");
    header("Location: admin.php");
  }

  if(isset($_POST['sil'])){
    $id = $_POST['id'];
    $sil= $db->exec("DELETE FROM restaurant WHERE restaurant_id='$id'");
    header("Location: admin.php");
  }
?>

<html>
  <body>
    <form method="POST">
        <label for="sahip" >Sahibi:</label><input name="sahip" type="text"> <br>
        <label for="isim" >İş Yeri İsmi:</label><input name="isim" type="text"><br>
        <label for="iletisim" >İletişim:</label><input name="iletisim" type="text"><br>
        <label for="adres" >Adres:</label><textarea name="adres"></textarea> <br>
        <button name="restoranKayit">Kayıt</button>
    </form>
    <hr>
    <table border="1">
      <tr>
          <td>
              Resturant Adı
          </td>
          <td>
              İletişim
          </td>
          <td>
              Adres
          </td>
          <td>
              Sahip Adı
          </td>
          <td>
              Sahip Id
          </td>
          <td>
              İşlemler
          </td>
      </tr>
      <?php foreach($restaurantlar as $rest =>$key) { ?>
        <tr>
            <td>
              <?php echo $key['isim'] ?>
            </td>
            <td>
              <?php echo $key['iletisim'] ?>
            </td>
            <td>
              <?php echo $key['adres'] ?>
            </td>
            <td>
              <?php echo $key['kullanici_adi'] ?>
            </td>
            <td>
              <?php echo $key['id'] ?>
            </td>
            <td>
              <form method="POST" >
                <input type="hidden" name="id" value="<?php echo $key['restaurant_id'] ?>">    
                <button name="sil">Sil</button>
              </form>
            </td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>