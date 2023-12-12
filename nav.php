<?php 
  require_once "session.php";
  require_once "db.php";
?>

<div class="nav">
  <a href="anasayfa.php">Ana sayfa</a>
  <a href="ara.php">Ara</a>
  <?php if(!empty($_SESSION['id'])) { ?>
    <form method="post" action="cikis.php">
      <button name="cikis">Cikis yap</button>
    </form>
    <p>Hoşgeldin, <?php echo $db->query("SELECT * FROM kullanicilar WHERE id = " . $_SESSION['id'])->fetch()['kullanici_adi']?></p>
  <?php } else { ?>
    <a href="giris.php">Giris</a>
    <a href="kayitol.php">Kayıt</a>
  <?php } ?>
</div>