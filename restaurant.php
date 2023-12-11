<?php
  require_once "db.php";
  require_once "session.php";

  if(!isset($_GET['id']) || empty($_GET['id']))
  {
    header("Location: anasayfa.php");
    return;
  }
  
  $id = $_GET['id'];
  $restaurant = $db->query("SELECT * FROM restaurant WHERE id = $id")->fetch();
  $yorumlar = $db->query("SELECT * FROM yorumlar INNER JOIN kullanicilar ON yorumlar.kullanici_id = kullanicilar.id WHERE restaurant_id = $id")->fetchAll();
?>

<html>
  <body>
      <p><?php echo $restaurant['id']; ?></p>
      <p><?php echo $restaurant['isim']; ?></p>
      <p><?php echo $restaurant['iletisim']; ?></p>
      <p><?php echo $restaurant['adres']; ?></p>
      <p><?php echo $restaurant['puan']; ?></p>
      <hr>
      <?php if(isset($_SESSION['id']) && $_SESSION['id'] != "") { ?>
        <form method="post">
          <textarea name="yorum" cols="30" rows="10"><?php echo $yorumlar[array_search($_SESSION['id'], array_column($yorumlar, 'kullanici_id'))]['yorum']; ?></textarea>
          <button name="yap">Yorum yap</button>
        </form>
      <?php } ?> 
      <hr>
      <?php foreach($yorumlar as $yorum) { ?>
        <p><?php echo $yorum['kullanici_adi'] ?>:</p>
        <p><?php echo $yorum['yorum']; ?></p>
        <hr>
      <?php } ?>
  </body>
</html>

<?php
  require_once "db.php";

  if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['yap']))
    return;

  $yorum = $_POST['yorum'];
  $kullaniciId = $_SESSION['id'];

  $db->exec("INSERT INTO yorumlar (yorum, kullanici_id, restaurant_id) VALUES ('$yorum', '$kullaniciId', '$id') ON DUPLICATE KEY UPDATE yorum = '$yorum'");
  header("Location: restaurant.php?id=$id");
?>