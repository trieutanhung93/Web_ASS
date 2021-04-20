<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm - BK Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <script language="javascript" type="text/javascript" src="script/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="script/show-menu.js"></script>
  <div id="menu-navbar"></div>

    <div class="row slider-bar">
        <!--image slider start-->
        <div class="slider">
            <div class="slides">
            <!--radio buttons start-->
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">
            <input type="radio" name="radio-btn" id="radio4">
            <!--radio buttons end-->
            <!--slide images start-->
            <div class="slide first">
                <a href=""><img src="https://salt.tikicdn.com/ts/banner/ce/3a/e5/56e08c331c0db5e1d5c99be9c9497f7c.jpg" alt=""></a>
            </div>
            <div class="slide">
                <a href=""><img src="https://salt.tikicdn.com/ts/banner/5e/19/8e/f468020b7a030cae1ca9f3ef053d9cdf.png" alt=""></a>
            </div>
            <div class="slide">
                <a href=""><img  src="//vn-test-11.slatic.net/skyline/i8/76659b58659f44a785f8d94749eaf114-1360-480.jpg_desktop.jpg" alt=""></a>
            </div>
            <div class="slide">
                <a href=""><img  src="//vn-test-11.slatic.net/skyline/i8/528aa354a88e4790bbb22335a1faabe2-1360-480.jpg_desktop.jpg" alt=""></a>
            </div>
            <!--slide images end-->
            <!--automatic navigation start-->
            <div class="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
                <div class="auto-btn4"></div>
            </div>
            <!--automatic navigation end-->
            </div>
            <!--manual navigation start-->
            <div class="navigation-manual">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
            <label for="radio4" class="manual-btn"></label>
            </div>
            <!--manual navigation end-->
        </div>
        <!--image slider end-->
        <script type="text/javascript">
            var counter = 1;
            setInterval(function(){
              document.getElementById('radio' + counter).checked = true;
              counter++;
              if(counter > 4){
                counter = 1;
              }
            }, 5000);
            </script>
    </div>

    <!-- Features products -->
    <div class="small-container">

        <div class="search">
            <hr>
            <form class="form-inline  active-cyan-2" method="get">
                <ul>
                    <li><button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button></li>
                    <li><input type="text" name="search" placeholder="Search" aria-label="Search"></li>
                </ul>
            </form>
        </div>
        <?php
            $search = (isset($_GET["search"]))?$_GET["search"]:"";
            if($search != ""){
                echo "<h2>Search with name :".$search."</h2>";
            }
            $option = (isset($_GET["option"]))?$_GET["option"]:"default";
            if($option != "default"){
                echo "<h2>Sort with name :".$option."</h2>";
            }
        ?>
        <form action="" method="get">
        <div class="row row-2">
            <h2>Tất cả sán phẩm</h2>
            <select name="option">
                <option value="default">Mặc định</option>
                <option value="sort_min">Giá từ thấp tới cao</option>
                <option value="sort_max">Giá từ cao xuống thấp</option>
                <option value="rating">Sắp xếp theo đánh giá</option>
            </select>
            <span><input type="submit" value="sort" style="display:inline"></span>
        </div>
        </form>

            <?php

                include 'connect.php';
                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $option = (isset($_GET["option"]))?$_GET["option"]:"default";
                if(isset($_GET["page"])){
                    $page=$_GET["page"];
                }
                else{
                    $page = 0;
                }
                if($page==""|| $page ==1){
                    $page1 = 0;
                }
                else{
                    $page1 = 16*$page-16;
                }
                if($option == "default"){
                    $sql_product = "SELECT *
                                    FROM products
                                    inner join products_images on products_images.product_id = products.id
                                    group by products.id limit $page1,16";
                }elseif($option =="sort_min"){
                    $sql_product = "SELECT *
                                    FROM products
                                    inner join products_images on products_images.product_id = products.id
                                    group by products.id order by price ASC limit $page1,16";
                }
                elseif($option =="sort_max"){
                    $sql_product = "SELECT *
                                    FROM products
                                    inner join products_images on products_images.product_id = products.id
                                    group by products.id order by price DESC limit $page1,16";
                }
                else{
                    $sql_product = "SELECT *
                                    FROM products
                                    inner join products_images on products_images.product_id = products.id
                                    group by products.id order by rate DESC limit $page1,16";
                }
                if($search !=""){
                    $temp ="WHERE name REGEXP '$search' ";

                    $sql_product = substr_replace($sql_product, $temp, 202, 0);
                }
                $result_product = mysqli_query($conn,$sql_product);
                $count_row = 0;
                $count_row_end = 0;
                $end_row = mysqli_num_rows($result_product);
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
                    $count_row_end++;
                    if($count_row == 4 || $count_row_end == $end_row){
                        echo "</div>";
                        $count_row = 0;
                    }

                }
                echo "<div class=\"row\">";
                echo "<div class=\"page-btn\">
                    <span onclick = \"document.location='products.php?page=1&option=".$option."'\">1</span>
                    <span onclick = \"document.location='products.php?page=2&option=".$option."'\">2</span>
                    <span onclick = \"document.location='products.php?page=3&option=".$option."'\">3</span>
                    <span onclick = \"document.location='products.php?page=4&option=".$option."'\">4</span>
                    <span>&#8594;</span>
                    </div>";
                echo "</div>";
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
