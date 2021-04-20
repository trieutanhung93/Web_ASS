<?php
  session_start();
  include 'connect.php';
  $name = $_POST['loginName'];
  $password = $_POST['password'];

// Checks if there is a password and name combination
  $sql = "SELECT * FROM `accounts` WHERE `name`='$name' AND `password`='$password'";
  $result = $conn ->query($sql) or  die($conn->error);
  $IdRow = $result->fetch_assoc();
  $isValid = 0;
  if ($IdRow)
  {
    $isValid = 1;
    $_SESSION['username'] = $name;
    $_SESSION['Id'] = $IdRow['Id'];
    $_SESSION['IsManager'] = $IdRow['IsManager'];
  }
  echo $isValid;
?>
