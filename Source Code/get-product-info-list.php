<?php
  session_start();
  include 'connect.php';
  $sql = "SELECT * FROM products";
  $result = $conn ->query($sql) or  die($conn->error);
  $resArr = array();
  while($IdRow = mysqli_fetch_assoc($result))
  {
    $curArr =  array('id' => $IdRow['id'],
    'name' => $IdRow['name'],
    'price' =>$IdRow['price']);
    array_push($resArr,$curArr);
  }
  echo json_encode($resArr);
?>
