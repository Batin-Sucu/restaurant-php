<?php
  require_once "db.php";

  if(!isset($_GET['id']) || empty($_GET['id']))
  {
    header("Location: anasayfa.php");
    return;
  }
  
  $id = $_GET['id'];
  $restaurant = $db->query("SELECT * FROM restaurant WHERE id = $id")->fetch(PDO::FETCH_ASSOC);
  echo "<p>$restaurant[id]</p>";
  echo "<p>$restaurant[isim]</p>";
  echo "<p>$restaurant[iletisim]</p>";
  echo "<p>$restaurant[adres]</p>";
  echo "<p>$restaurant[puan]</p>";
?>