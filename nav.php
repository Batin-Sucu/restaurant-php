<?php 
  require_once "session.php";
  require_once "db.php";
?>

<div class="flex border-b items-center py-2 px-4 gap-8 text-2xl tracking-tighter">
  <a href="anasayfa.php" class="">Ana sayfa</a>
  <a href="ara.php" class="">Ara</a>
  
  <span class="ml-auto"></span>
  <?php if(!empty($_SESSION['id'])) { ?>
    <?php $kullanici = $db->query("SELECT * FROM kullanicilar WHERE id = " . $_SESSION['id'])->fetch() ?>
    <?php if($kullanici['tur'] == 'yonetici') { ?>
      <a href="yonetim.php">Restoran Yonetim</a>
    <?php } ?>
    <?php if($kullanici['tur'] == 'admin') { ?>
      <a href="admin.php">Admin Yonetim</a>
    <?php } ?>
    <p>Hoşgeldin, <?php echo $kullanici['kullanici_adi']?></p>
    <form method="post" action="cikis.php" class="contents">
      <button class="" name="cikis">Cikis yap</button>
    </form>
  <?php } else { ?>
    <a href="giris.php">Giris</a>
    <a href="kayitol.php">Kayıt</a>
  <?php } ?>
</div>