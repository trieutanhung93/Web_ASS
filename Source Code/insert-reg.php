<?php
  session_start();
  include 'connect.php';
  $name = $_POST['log'];
  $email = $_POST['email'];
  $password = $_POST['pass'];
  $sql = "INSERT INTO `accounts` (`email`, `name`, `password`) VALUES ('$email', '$name', '$password')";
  $result = $conn ->query($sql) or  die($conn->error);
  $sql = "SELECT * FROM `accounts` WHERE `name`='$name'";
  $result = $conn ->query($sql) or  die($conn->error);
  $IdRow = $result->fetch_assoc();
  $Id = $IdRow['Id'];
  $sql = "INSERT INTO `user accounts` (`Id`) VALUES ('$Id')";
  $result = $conn ->query($sql) or  die($conn->error);
?>
