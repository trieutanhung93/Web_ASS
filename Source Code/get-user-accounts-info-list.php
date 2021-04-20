<?php
  session_start();
  include 'connect.php';
  $sql = "SELECT * FROM `user accounts`,`accounts` WHERE `user accounts`.`Id`=`accounts`.`Id`";
  $result = $conn ->query($sql) or  die($conn->error);
  $resArr = array();
  while($IdRow = mysqli_fetch_assoc($result))
  {
    $curArr =  array('Id' => $IdRow['Id'],
    'Creation Date' => $IdRow['Creation Date'],
    'FirstName' =>$IdRow['First Name'],
    'LastName' => $IdRow['Last Name'],
    'Phone' => $IdRow['Phone'],
    'Email' => $IdRow['Email']);
    array_push($resArr,$curArr);
  }
  echo json_encode($resArr);
?>
