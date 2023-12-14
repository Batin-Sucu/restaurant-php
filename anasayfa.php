<?php
  include "nav.php";
  require_once "db.php";

  $resturantlar = $db->query("SELECT * FROM restaurant");
?>

<html>
  <head>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <div>
      <?php foreach($resturantlar as $restaurant) { ?>
        <p><?php echo $restaurant["restaurant_id"] ?></p>
        <p><?php echo $restaurant["isim"] ?></p>
        <p><?php echo $restaurant["iletisim"] ?></p>
        <p><?php echo $restaurant["adres"] ?></p>
        <p><?php echo $restaurant["puan"] ?></p>
        <a href=<?php echo "restaurant.php?id=".$restaurant["restaurant_id"] ?>>Git</a>
      <?php } ?>
    </div>
  </body>
</html>