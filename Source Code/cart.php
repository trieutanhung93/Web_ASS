<?php
  session_start();
  if(!isset($_SESSION['username']))
  {
    header('location:account.php');
  }
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  include 'connect.php';
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  if (isset($_GET["removeid"])){
    $id = $_GET["removeid"];
    $sql = "DELETE FROM carts WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
      echo '<script language="javascript">';
      echo 'alert("Successfully Deleted!")';
      echo '</script>';
    } else {
      echo '<script language="javascript">';
      echo 'alert("UnSuccessfully Deleted!")';
      echo '</script>';
    }

    $conn->close();
  }
  if(isset($_GET["subid"])){
    $subid = $_GET["subid"];
    $quantity = $_GET["quantity"]-1;
    $sql_sub = "UPDATE carts SET quantity = $quantity WHERE id =$subid";
    $result_down = mysqli_query($conn,$sql_sub);
  }
  if(isset($_GET["addid"])){
    $addid = $_GET["addid"];
    $quantity = $_GET["quantity"]+1;
    $sql_add = "UPDATE carts SET quantity = $quantity WHERE id =$addid";
    $result_up = mysqli_query($conn,$sql_add);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem giỏ hàng - BK Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <script language="javascript" type="text/javascript" src="script/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="script/show-menu.js"></script>
  <div id="menu-navbar"></div>


    <!-- cart items details -->
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
            </tr>

            <?php
                include 'connect.php';
                $id = 1;
                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $userid = $_SESSION["Id"];
                $sql_cart = "SELECT * FROM carts";
                $result_cart = mysqli_query($conn,$sql_cart);
                $total =0;
                while($row_cart = mysqli_fetch_assoc($result_cart)){
                    if($userid == $row_cart["userid"]){
                        $total += $row_cart["quantity"]*$row_cart["price"];
                        echo "<tr>
                                <td>
                                <div class=\"cart-info\">
                                    <img src=".$row_cart["image_product"]." alt=\"\">
                                    <div>
                                        <p>".$row_cart["name"]."</p>
                                        <small>Đơn giá: ".$row_cart["price"]."</small>
                                        <br>
                                        <small>Size: ".$row_cart["size"]."</small>
                                        <br>
                                        <button type=\"button\" class=\"remove\" onclick=\"document.location='cart.php?removeid=" . $row_cart["id"] . "'\">Remove</button>
                                    </div>
                                </div>
                            </td>
                            <td>";
                            echo "<button type=\"button\" name=\"sub\" id=\"sub\"";
                            if($row_cart["quantity"]<=1){
                                echo ' disabled=disabled>';
                            }
                            else{
                                echo "onclick=\"document.location='cart.php?subid=" . $row_cart["id"] ."&quantity=".$row_cart["quantity"]."'\">";
                            }
                            echo "-</button>
                            <input type=\"text\" id =\"quantity\" name=\"quantity\" value=".$row_cart["quantity"]." min=\"1\">
                            <button type=\"button\" name=\"add\" id=\"add\" onclick=\"document.location='cart.php?addid=" . $row_cart["id"] ."&quantity=".$row_cart["quantity"]."'\">+</button>
                            </td>
                            <td>".$row_cart["quantity"]*$row_cart["price"]."</td>
                            </tr>";
                    }
                }

                echo "</table>
                    <div class=\"total-price\">
                        <table>
                            <tr>
                                <td>Tổng tiền</td>
                                <td>".$total."</td>
                            </tr>
                        </table>
                    </div>";

            ?>

    </div>

    <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Tải ứng dụng</h3>
                    <p>Tải ứng dụng cho điện thoại Android và iOS</p>
                    <div class="app-logo">
                        <img src="Img/app-store.png" alt="">
                        <img src="Img/play-store.png" alt="">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="Img/logo-white.png" alt="">
                    <p>Tải ứng dụng cho điện thoại Android và iOS</p>
                </div>
                <div class="footer-col-3" style="margin-right: 25px;">
                    <h3>Link hữu ích</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Bolg post</li>
                        <li>Return policy</li>
                        <li>Join affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4" style="margin-right: 25px;">
                    <h3>Liên hệ</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                        <li>Twitter</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright 2020 - Easy Tutorials</p>
        </div>
    </div>

    <!-- js for toggle menu -->
    <script>
        var MenuItems =document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px"

        function menutoggle(){
            if(MenuItems.style.maxHeight=="0px"){
                MenuItems.style.maxHeight="200px"
            }
            else{
                MenuItems.style.maxHeight="0px"
            }
        }

    </script>

</body>
</html>
