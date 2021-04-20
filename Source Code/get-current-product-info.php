<?php
  session_start();
  include 'connect.php';
  $productId =$_POST['id'];
  $sql = "SELECT * FROM products WHERE id=$productId";
  $result = $conn ->query($sql) or  die($conn->error);
  $IdRow = $result->fetch_assoc();
  if ($IdRow)
  {
    $resArr =  array('name' =>$IdRow['name'],'price' => $IdRow['price'], 'description' => $IdRow['description'],'size' => $IdRow['size'],'rate' =>$IdRow['rate']);
    echo json_encode($resArr);

  }
?>
