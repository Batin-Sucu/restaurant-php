<?php
  require_once "db.php";

  $resturantlar = $db->query("SELECT * FROM restaurant");
  
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
  
?>