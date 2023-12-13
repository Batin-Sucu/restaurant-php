<html>
  <body>
    <?php include "nav.php"; ?>
    <form action="ara.php">
      <input type="text" name="q" placeholder="Ara">
      <button>Ara</button>
    </form>
    <hr>
    <?php
      require_once "db.php";

      if(!isset($_GET['q']) || empty($_GET['q']))
      {
        return;
      }

      $q = $_GET['q'];
      $resturantlar = $db->query("SELECT * FROM restaurant WHERE isim LIKE '%$q%'");
    ?>
    <?php if($resturantlar->rowCount() == 0) { ?>
      <p>Aradığınız restoran bulunamadı.</p>
    <?php } else { ?>
    <?php foreach($resturantlar as $restaurant) { ?>
        <p><?php echo $restaurant["restaurant_id"] ?></p>
        <p><?php echo $restaurant["isim"] ?></p>
        <p><?php echo $restaurant["iletisim"] ?></p>
        <p><?php echo $restaurant["adres"] ?></p>
        <p><?php echo $restaurant["puan"] ?></p>
        <a href=<?php echo "restaurant.php?id=".$restaurant["restaurant_id"] ?>>Git</a>
      <?php }} ?>
  </body>
</html>
