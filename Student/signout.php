<?php
  session_start();
  $_SESSION["loggedInS"] = false;
  session_destroy();
  
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  
  header("Location: ../index.php");
  exit;
?>
