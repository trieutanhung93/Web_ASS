<?php
  session_start();
  include 'connect.php';
  $userId = $_POST['Id'];
  // echo json_encode($_POST);
  if($_POST['firstname'] != '')
  {
    $firstname = $_POST['firstname'];
    $sql = "UPDATE `user accounts` SET `first name` = '$firstname' WHERE `Id` = '$userId'";
    $result = $conn ->query($sql) or  die($conn->error);
  }
  if($_POST['lastname'] != '')
  {
    $lastname = $_POST['lastname'];
    $sql = "UPDATE `user accounts` SET `last name` = '$lastname' WHERE `Id` = '$userId'";
    $result = $conn ->query($sql) or  die($conn->error);
  }
  if($_POST['phone'] != '')
  {
    $phone = $_POST['phone'];
    $sql = "UPDATE `user accounts` SET `phone` = '$phone' WHERE `Id` = '$userId'";
    $result = $conn ->query($sql) or  die($conn->error);
  }
?>
