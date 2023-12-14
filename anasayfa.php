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
    <div class="flex container mx-auto gap-6 my-4 flex-wrap">
      <?php foreach($resturantlar as $restaurant) { ?>
        <a href=<?php echo "restaurant.php?id=".$restaurant["restaurant_id"] ?>>
          <div class="border rounded p-2 hover:bg-neutral-200">
            <img width="200px" height="200px" src="<?php echo $restaurant["foto"] ?>">
            <div class="relative">
              <p class="font-bold block text-center"><?php echo $restaurant["isim"] ?> (<?php echo $restaurant["puan"] ?> Puan)</p>
              <p><?php echo $restaurant["adres"] ?></p>
            </div>
          </div>
        </a>
      <?php } ?>
    </div>
  </body>
</html>