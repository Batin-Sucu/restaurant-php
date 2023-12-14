<?php
  include "nav.php";
  require_once "db.php";
  require_once "session.php";

  if(!isset($_GET['id']) || empty($_GET['id']))
  {
    header("Location: anasayfa.php");
    return;
  }
  
  $id = $_GET['id'];
  $restaurant = $db->query("SELECT * FROM restaurant WHERE restaurant_id = $id")->fetch();
  $yorumlar = $db->query("SELECT * FROM yorumlar INNER JOIN kullanicilar ON yorumlar.kullanici_id = kullanicilar.id WHERE restaurant_id = $id")->fetchAll();
?>

<html>
  <head>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <div class="container mx-auto">
      <p><?php echo $restaurant['restaurant_id']; ?></p>
      <p><?php echo $restaurant['isim']; ?></p>
      <p><?php echo $restaurant['iletisim']; ?></p>
      <p><?php echo $restaurant['adres']; ?></p>
      <p><?php echo $restaurant['puan']; ?></p>
      <div class="w-[720px] mx-auto">
        <?php if(isset($_SESSION['id']) && $_SESSION['id'] != "") { ?>
          <form method="post" class="flex flex-col gap-2 py-2">
            <textarea name="yorum" cols="20" rows="5" class="border text-sm"><?php if(sizeof($yorumlar) > 0) echo $yorumlar[array_search($_SESSION['id'], array_column($yorumlar, 'kullanici_id'))]['yorum']; ?></textarea>
            <button name="yap" class="border rounded px-12 hover:bg-neutral-200">Yorum yap</button>
          </form>
        <?php } ?> 
        <p class="text-center text-2xl mt-24 mb-4">Diğerleri ne düşünüyor??</p>
        <?php foreach($yorumlar as $yorum) { ?>
          <div>
            <p class="text-neutral-500 inline"><?php echo $yorum['kullanici_adi'] ?>:</p>
            <p class="inline"><?php echo $yorum['yorum']; ?></p>
          </div>
        <?php } ?>
      </div>
    </div>
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