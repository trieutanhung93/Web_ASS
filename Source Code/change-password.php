<?php
  session_start();
  include 'connect.php';
  $userId = $_POST['Id'];
  $newPassword = $_POST['password'];

  $sql = "UPDATE `accounts` SET `password` = '$newPassword' WHERE `Id` = '$userId'";
  $result = $conn ->query($sql) or  die($conn->error);
  echo $result;

?>
