<?php
  session_start();
  include 'connect.php';
  $userId = $_SESSION['Id'];
  $oldPassword = $_POST['password'];
  $sql = "SELECT * FROM `accounts` WHERE `Id`='$userId' AND `Password` = '$oldPassword'";
  $result = $conn ->query($sql) or  die($conn->error);
  $IdRow = $result->fetch_assoc();
  $isValid = 0;
  if ($IdRow)
  {
    $isValid = 1;
  }
  echo $isValid;
?>
