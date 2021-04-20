<?php
  session_start();
  include 'connect.php';
  $userId = $_POST['Id'];
  $sql = "DELETE FROM `accounts` WHERE `Id` = $userId";
  $result = $conn ->query($sql) or  die($conn->error);

?>
