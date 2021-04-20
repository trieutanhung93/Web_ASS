<?php
  $isLoggedIn = 0;
  if(isset($_SESSION['username']))
  {
    $isLoggedIn = 1;
  }
  echo $isLoggedIn;
?>
