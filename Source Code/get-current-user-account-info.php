<?php
  session_start();
  include 'connect.php';
  $userId =$_POST['Id'];
  $sql = "SELECT * FROM `user accounts`,`accounts` WHERE `user accounts`.`Id`='$userId' AND `user accounts`.`Id` = `accounts`.`Id`";
  $result = $conn ->query($sql) or  die($conn->error);
  $IdRow = $result->fetch_assoc();
  if ($IdRow)
  {
    $resArr =  array('FirstName' =>$IdRow['First Name'],'LastName' => $IdRow['Last Name'], 'Phone' => $IdRow['Phone'],'Email' => $IdRow['Email'],'CreationDate' =>$IdRow['Creation Date']);
    echo json_encode($resArr);

  }
?>
