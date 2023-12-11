<html>
  <body>
    <?php include "nav.php"; ?>
    <form action="ara.php">
      <input type="text" name="q" placeholder="Ara">
      <button>Ara</button>
    </form>
  </body>
</html>

<?php
  require_once "db.php";

  if(!isset($_GET['q']) || empty($_GET['q']))
  {
    return;
  }

  $q = $_GET['q'];
  $resturantlar = $db->query("SELECT * FROM restaurant WHERE isim LIKE '%$q%'");
  
  if($resturantlar->rowCount() == 0)
  {
    echo "Aradığınız restoran bulunamadı.";
    return;
  }
  else 
  {
    foreach($resturantlar as $restaurant)
    {
      echo "<div>";
      echo "<p>$restaurant[id]</p>";
      echo "<p>$restaurant[isim]</p>";
      echo "<p>$restaurant[iletisim]</p>";
      echo "<p>$restaurant[adres]</p>";
      echo "<p>$restaurant[puan]</p>";
      echo "<a href=\"restaurant.php?id=$restaurant[id]\">Git</a>";
      echo "</div>";
    }
  }
 
?>