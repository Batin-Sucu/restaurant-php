<html>
  <head>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <?php include "nav.php"; ?>
    <div class="flex flex-col py-4">
      <form action="ara.php" class="mx-auto flex flex-col gap-2">
        <input type="text" name="q" placeholder="kebab... lahmacun..." class="border rounded p-1 w-96">
        <button class="border rounded px-12 hover:bg-neutral-200">Ara</button>
      </form>
      <div class="">
        <?php
          require_once "db.php";

          if(!isset($_GET['q']) || empty($_GET['q']))
            return;

          $q = $_GET['q'];
          $resturantlar = $db->query("SELECT * FROM restaurant WHERE isim LIKE '%$q%'");
        ?>
        <?php if($resturantlar->rowCount() == 0) { ?>
          <p>Aradığınız restoran bulunamadı.</p>
        <?php } else { ?>
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
          <?php }} ?>
        </div>
      </div>
    </div>
  </body>
</html>
