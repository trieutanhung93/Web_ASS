<?php
  include 'connect.php';
  $email = $_GET['email'];
  $sql = "SELECT * FROM `accounts` WHERE `email`='$email'";
  $result = $conn ->query($sql) or  die($conn->error);
  $IdRow = $result->fetch_assoc();
  $isValid = 1;
  if ($IdRow)
  {
    $isValid = 0;
  }
  echo $isValid;
?>
