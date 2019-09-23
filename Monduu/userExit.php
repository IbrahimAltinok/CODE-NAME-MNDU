<?php
// kullanıcı çıkışını başlat
  session_start();
  session_destroy();
  header("location:index.php");
?>
