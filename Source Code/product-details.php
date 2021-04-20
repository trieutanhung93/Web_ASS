<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm - BK Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/zoom.css">
    <script src='script/jquery-1.8.3.min.js'></script>
	<script src='script/jquery.elevatezoom.js'></script>
</head>
<body>

    <!-- <script language="javascript" type="text/javascript" src="script/jquery-1.9.1.min.js"></script> -->
  <script type="text/javascript" src="script/show-menu.js"></script>
  <div id="menu-navbar"></div>
    <form method="post">
    <!-- single product details -->
    <div class="small-container single-product">

        <div class="row">
                <?php
                include 'connect.php';
                if(isset($_GET["id"])){
                    $id = $_GET["id"];
                }
                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = mysqli_query($conn,"SELECT id,name,quantity,price,description,size FROM products WHERE products.id = $id");
                $sql_img = "SELECT id_img,product_id,filename FROM products_images";
                $result_img = mysqli_query($conn,$sql_img);

                $product = mysqli_fetch_assoc($sql);

                $size = explode(",",$product["size"]);
                $description = explode(",",$product["description"]);

                $list_product = array();
                while($row_img = mysqli_fetch_assoc($result_img)){
                    if($product["id"] == $row_img["product_id"]){
                        array_push($list_product,$row_img["filename"]);
                    }
                }

                // <img src=\"Img/gallery-1.jpg\" alt=\"\" class=\"productImg\">
                echo "
                    <div class=\"col-2\">


                    <img id=\"zoom_01\" src=".$list_product[0]." data-zoom-image=".$list_product[0]."  class=\"productImg\"/>
                    <div class=\"small-img-row\">
                    ";
                for($i=0;$i<count($list_product);$i++){
                    echo "<div class=\"small-img-col\">
                        <img src=".$list_product[$i]." class=\"small-img\" alt=\"\">
                        </div>";
                }
                echo "</div>";
                echo "</div>";

                echo "<div class=\"col-2\">";
                // echo "<p>Trang chủ / Áo thun</p>";
                echo "<h1>".$product["name"]."</h1>";
                echo "<h4>".$product["price"]."vnd</h4>";
                echo "<select name=\"option_size\">
                    <option>Chọn kích thước</option>";
                    for($i =0 ;$i<count($size);$i++){
                        echo "<option>".$size[$i]."</option>";
                    }
                echo "</select>";
                echo "<input type=\"number\" id =\"quantity\" name=\"quantity\" value=\"1\" min=\"1\">
                     <input type=\"submit\" value=\"Thêm vào giỏ hàng \" class=\"btn\" name=\"submit\" style=\"width:200px;\">";

                echo "<h3>Chi tiết sản phẩm <i class=\"fa fa-indent\"></i></h3>
                <br>";
                echo "<div><ul style=\"list-style-type:circle\">";
                    for($i =0 ;$i<count($description);$i++){
                        echo "<li>".$description[$i]."</li>";
                    }
                echo "</ul></div>";
                echo "</div>";
                session_start();
                $size = (isset($_POST["option_size"]))?$_POST["option_size"]:"";
                //Add mysql data Cart to database
                if(isset($_POST["submit"]) && $size !="" ){
                    if($size == "Chọn kích thước"){
                        echo '<script language="javascript">';
                        echo 'alert("Chọn kích thước trước khi đặt hàng")';
                        echo '</script>';
                    }
                    else{
                    $size = $_POST["option_size"];
                    $quantity = (int)$_POST["quantity"];
                    $name =$product["name"];
                    $price = (int)$product["price"];
                    $userid = (int)$_SESSION["Id"];
                    $img = $list_product[0];
                    $product_id = $product["id"];

                    $check_exits = mysqli_query($conn,"SELECT * FROM carts WHERE productId =$product_id AND size =$size AND userid= $userid");
                    if(mysqli_num_rows($check_exits) == 0) {
                        $sql_cart = "INSERT INTO carts(userid,price,quantity,size,name,image_product,productId) VALUES ($userid,$price,$quantity,'$size','$name','$img',$product_id)";
                        if ($conn->query($sql_cart) === TRUE) {
                            echo "New record created successfully";
                                } else {
                            echo "Error: ";
                        }
                    } else {
                        $quantity_up = mysqli_fetch_assoc($check_exits);
                        $pre_quantity = $quantity_up["quantity"];
                        $last_quantity = $pre_quantity + $quantity;
                        $sql_up = "UPDATE carts SET quantity = $last_quantity WHERE productId =$product_id AND size =$size";
                        $result_up = mysqli_query($conn,$sql_up);
                   }

                    header("Location: product-details.php?id=".$id."");
                }
                }

                ?>
        </div>
    </div>
    </form>
    <!-- title -->
    <div class="small-container">
        <div class="row row-2">
            <h2>Sản phẩm liên quan</h2>
            <p> <a href="./products.php">Xem thêm</a> </p>
        </div>
    </div>


    <!-- products -->
    <div class="small-container">
    <?php
        $sql_product = "SELECT *
                                    FROM products
                                    inner join products_images on products_images.product_id = products.id
                                    group by products.id order by RAND() limit 4";
        $result_product = mysqli_query($conn,$sql_product);
        $count_row = 0;
        while($row_product = mysqli_fetch_assoc($result_product)){
            if($count_row == 0){
                echo "<div class=\"row\">";
            }
            echo "<div class=\"col-4\">
                    <a href=\".\product-details.php?id=" . $row_product["id"] ."\"><img src=".$row_product["filename"]." alt=\"\"></a>
                    <h4>".$row_product["name"]."</h4>
                    <div class=\"rating\">";
                    for($i=0;$i<5;$i++){
                        if(($row_product["rate"]-($i)) == 0.5){
                            echo "<i class=\"fa fa-star-half-o\" aria-hidden=\"true\"></i>";

                        }
                        elseif($row_product["rate"]<$i+1){
                            echo "<i class=\"fa fa-star-o\" aria-hidden=\"true\"></i>";
                        }
                        else{
                            echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
                        }

                    }
            echo    "</div>
                    <p>".$row_product["price"]."</p>
                </div>";
            $count_row++;

            if($count_row == 4){
                echo "</div>";
                $count_row = 0;
            }
        }

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

    <!-- js for product gallery -->
    <script>
        function changeZoomImg(src1,src2){
            src1 = src2;
            $("#zoom_01").attr('data-zoom-image', src2);
            var square = document.getElementsByClassName("zoomWindow");
            square[0].style.backgroundImage = "url("+src2+")";
        }
        var productImg = document.getElementsByClassName("productImg");
        var showImg = document.getElementById("showImg");
        var smallImg = document.getElementsByClassName("small-img")
        smallImg[0].onclick = function(){
            productImg[0].src = smallImg[0].src;
            $("#zoom_01").attr('data-zoom-image', smallImg[0].src);
            var square = document.getElementsByClassName("zoomWindow");
            square[0].style.backgroundImage = "url("+smallImg[0].src+")";
        }
        smallImg[0].onmouseover = function(){
            productImg[0].src = smallImg[0].src;
            changeZoomImg(productImg[0].src,smallImg[0].src);
        }
        smallImg[1].onclick = function(){
            changeZoomImg(productImg[0].src,smallImg[1].src);
        }
        smallImg[1].onmouseover = function(){
            productImg[0].src = smallImg[1].src;
            changeZoomImg(productImg[0].src,smallImg[1].src);
        }

        smallImg[2].onclick = function(){
            changeZoomImg(productImg[0].src,smallImg[2].src);
        }
        smallImg[2].onmouseover = function(){
            productImg[0].src = smallImg[2].src;
            changeZoomImg(productImg[0].src,smallImg[2].src);
        }

        smallImg[3].onclick = function(){
            changeZoomImg(productImg[0].src,smallImg[3].src);
        }
        smallImg[3].onmouseover = function(){
            productImg[0].src = smallImg[3].src;
            changeZoomImg(productImg[0].src,smallImg[3].src);
        }

    </script>
    <script type="text/javascript">
        if($(window).width() > 769){
            $('#zoom_01').elevateZoom({
                scrollZoom: true});
        }
        else{
            $('#zoom_01').elevateZoom({
                zoomType: "lens",
                lensShape: "round",
                lensSize: 200});
        }

    </script>



</body>
</html>
