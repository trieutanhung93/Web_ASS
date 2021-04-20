<?php
  session_start();
  include 'connect.php';
  $productName = $_POST['productName'];
  $productPrice = $_POST['productPrice'];
  $productDes = $_POST['productDes'];
  // $productImages =$_POST['productImages'];
  $sql = "INSERT INTO `products` (`name`, `description`, `price`) VALUES ('$productName', '$productDes', '$productPrice')";
  $result = $conn ->query($sql) or  die($conn->error);

  // $sql = "SELECT `ProductId`,MAX(`Creation Date`) AS MC_D FROM `products`";
  // $result = $conn ->query($sql) or  die($conn->error);
  // $IdRow = $result->fetch_assoc();
  // $newId = $IdRow['ProductId'];
  // $productImages = $_POST['productImages'];
  // $sql = "INSERT INTO `products-images` (`ProductId`, `Image`) VALUES ('$productName', '$productDes', '$productPrice')";

  // if (empty($_FILES['product-images']['name']))
  // {
  //   echo "empty";
  //   header( "Location: products.html" );
  // }

?>
