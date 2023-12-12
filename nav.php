<?php 
  require_once "session.php";
  require_once "db.php";
?>

<div class="nav">
  <a href="anasayfa.php">Ana sayfa</a>
  <a href="ara.php">Ara</a>
  <?php if(!empty($_SESSION['id'])) { ?>
    <?php $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $_SESSION['id'])->fetch() ?>
    <form method="post" action="cikis.php">
      <button name="cikis">Cikis yap</button>
    </form>
    <p>Hoşgeldin, <?php echo $kullanici['kullanici_adi']?></p>
    <?php if($kullanici['tur'] == 'yonetici') { ?>
      <a href="yonetim.php">Restoran Yonetim</a>
    <?php } ?>
  <?php } else { ?>
    <a href="giris.php">Giris</a>
    <a href="kayitol.php">Kayıt</a>
  <?php } ?>
</div>