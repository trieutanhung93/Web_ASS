<?php
  include 'connect.php';
  $name = $_GET['log'];
  $sql = "SELECT * FROM `accounts` WHERE `name`='$name'";
  $result = $conn ->query($sql) or  die($conn->error);
  $IdRow = $result->fetch_assoc();
  $isValid = 1;
  if ($IdRow)
  {
    $isValid = 0;
  }
  echo $isValid;
?>
