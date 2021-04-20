<?php
  session_start();
  if(!isset($_SESSION['username']))
  {
    header('location:account.php');
  }
  if($_SESSION['IsManager'] == 0)
  {
    header('location:index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm - BK Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <script language="javascript" type="text/javascript" src="script/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="script/show-menu.js"></script>
  <div id="menu-navbar"></div>

    <!-- contact-page -->
    <div class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <div class="contact-container user-accounts-list-container">
                        <div id="contact">
                            <h3>Danh sách các sản phẩm</h3>
                            <h4>Nhấn vào sản phẩm để xem thông tin cụ thể hoặc xóa</h4>
                            <?php
                                echo "<button name=\"submit_update\" onclick=\"modalUpdate()\" type=\"button\">Add</button>";
                            ?>
                            <script>
                              function modalUpdate(){
                                        // window.location.href = 'update-product.php?add=true';
                                        document.getElementById('update').style.display='block';
                                        }
                            </script>
                            <div id="product-info-list" style="margin-left:5px;margin-right:5px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

      include 'connect.php';

      echo
          "
          <div id=\"update\" class=\"modal\">
              <form class=\"modal-content animate\">
                  <div class=\"imgcontainer\">
                  <span onclick=\"document.getElementById('update').style.display='none'\" class=\"close\" title=\"Close Modal\">&times;</span>

                  <label for=\"name\"><b>Tên</b></label>
                  <input id=\"name\" type=\"text\" required name=\"name\">

                  <label for=\"quantity\"><b>Số lượng</b></label>
                  <input id=\"quantity\" type=\"text\" required name=\"quantity\" >

                  <label for=\"price\"><b>Giá</b></label>
                  <input id=\"price\" type=\"text\" required name=\"price\" >

                  <label for=\"size\"><b>Size</b></label>
                  <input id=\"size\" type=\"text\" required name=\"size\" >

                  <label for=\"description\"><b>Description</b></label>
                  <input id=\"description\" type=\"text\" required name=\"description\" >


                  <label for=\"rate\"><b>Rate</b></label>
                  <input id=\"rate\" type=\"text\" required name=\"rate\" >

                  <label for=\"img1\"><b>Ảnh 1</b></label>
                  <input id=\"img1\" type=\"text\" required name=\"img1\" >

                  <label for=\"img2\"><b>Ảnh 2</b></label>
                  <input id=\"img2\" type=\"text\" required name=\"img2\" >

                  <label for=\"img3\"><b>Ảnh 3</b></label>
                  <input id=\"img3\" type=\"text\" required name=\"img3\" >

                  <label for=\"img4\"><b>Ảnh 4</b></label>
                  <input id=\"img4\" type=\"text\" required name=\"img4\">

                  <button type=\"submit\" name=\"submit\" onclick=\"document.location='see-update-product-info-page.php?add=true'\">Add</button>

                  </div>
                  <div class=\"container\" style=\"background-color:#f1f1f1\">
                  <button type=\"button\" onclick=\"document.getElementById('update').style.display='none'\" class=\"cancelbtn\">Cancel</button>
                  </div>
              </form>
          </div>";
          if(isset($_GET["submit"])){
            $size = $_GET["size"];
            $description = $_GET["description"];
            $quantity = (int)$_GET["quantity"];
            $price = (int)$_GET["price"];
            $name = $_GET["name"];
            $rate = (float)$_GET["rate"];
            $img1 = $_GET["img1"];
            $img2 = $_GET["img2"];
            $img3 = $_GET["img3"];
            $img4 = $_GET["img4"];

            $list_img = array($img1,$img2,$img3,$img4);

            $sql_product = "INSERT INTO products (name, quantity, price, description,size,rate) VALUES ('$name',$quantity,$price,'$description','$size',$rate)";
            if ($conn->query($sql_product) === TRUE) {
              $last_id = mysqli_insert_id($conn);
              // echo "New record created successfully";
                  } else {
              echo "Error: ";
            }
            for($x=0;$x<4;$x++){
                $result = "INSERT INTO products_images (product_id,filename) VALUES ($last_id,'$list_img[$x]')";
                if ($conn->query($result) !== TRUE) {
                  echo "Error: ";
                }
            }
            header("Location: update-product");


          }
    ?>
    <!-- Script to load the page of the list of user -->
    <script>
      listContainer = document.getElementById('product-info-list');
      async function LoadProductsInfoList()
      {
        await $.ajax(
          {
              type: 'GET',
              url: 'get-product-info-list.php',
              success: function(response)
              {
                dataArray = $.parseJSON(response);
                dataArray.forEach(PrintProductInfo);
              }
          });
      }

      function PrintProductInfo(item)
      {
        listContainer.innerHTML += '<a href="see-update-product-info-page.php?id='+ item['id'] +'">Xem thông tin </a>|| '
        listContainer.innerHTML += 'id:' + item['id'] +'; Tên sản phẩm: ';
        listContainer.innerHTML += item['name'] + ' Giá: ' + item['price'] + '; ';
        listContainer.innerHTML += '<hr>';
      }
      LoadProductsInfoList();
    </script>

    <!-- footer -->
    <div id="footer-bar">
      <script type="text/javascript" src="script/load-footer.js"></script>
    </div>


</body>
</html>
