<?php
  session_start();
  if(!isset($_SESSION['username']))
  {
    header('location:index.php');
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
    <title>Thông tin người dùng - BK Store</title>
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

    <!-- current-account-page -->
    <div class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="Img/image1.png" alt="">
                </div>
                <div class="col-2">
                    <div class="contact-container account-info-container">
                        <div id="contact" style="text-align:left;">
                          <div id="user-infos-container"></div>
                          <?php 
                          
                          echo "<button name=\"submit_update\" onclick=\"modalUpdate()\" type=\"button\">Chỉnh sửa</button>
                          
                          <button name=\"submit_delete\" onclick=\"document.location='see-update-product-info-page.php?removeid=" . $_GET["id"] ."&id=". $_GET["id"] ."'\" type=\"button\">Xóa</button>
                          ";

                          ?>
                          <script>
                              function modalUpdate(){
                                        document.getElementById('update').style.display='block';
                                        }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    include 'connect.php';
    $productId =$_GET['id'];
    if(isset($_GET["removeid"])){
        $sql = mysqli_query($conn,"DELETE FROM products WHERE id = $productId");
        $sql_img = mysqli_query($conn,"DELETE FROM products_images WHERE products_images.product_id = $productId");
    }
    else{
    $sql = mysqli_query($conn,"SELECT * FROM products WHERE products.id = $productId");
    $sql_img = "SELECT * FROM products_images WHERE products_images.product_id = $productId";
    $result_img = mysqli_query($conn,$sql_img);

    $product = mysqli_fetch_assoc($sql);
                
    $size = $product["size"];
    $description = $product["description"];
    $quantity = $product["quantity"];
    $price = $product["price"];
    $name = $product["name"];
    $rate = $product["rate"];
    
    $list_id_image = array();
    $list_image = array();
    while($row_img = mysqli_fetch_assoc($result_img)){
        if($product["id"] == $row_img["product_id"]){ 
                array_push($list_image,$row_img["filename"]);
                array_push($list_id_image,$row_img["id_img"]);
                }
            }
    
    
    echo  " <div id=\"update\" class=\"modal\">
            <form class=\"modal-content animate\">
                <div class=\"imgcontainer\">
                <span onclick=\"document.getElementById('update').style.display='none'\" class=\"close\" title=\"Close Modal\">&times;</span>
                
                <div class=\"container\">
                <input name=\"id\" value=".$productId.">
                <label for=\"name\"><b>Tên</b></label>
                <input id=\"name\" type=\"text\" value=".$name." name=\"name\" >

                <label for=\"quantity\"><b>Số lượng</b></label>
                <input id=\"quantity\" type=\"text\" value=".$quantity." name=\"quantity\" >

                <label for=\"price\"><b>Giá</b></label>
                <input id=\"price\" type=\"text\" value=".$price." name=\"price\" >

                <label for=\"size\"><b>Size</b></label>
                <input id=\"size\" type=\"text\" value=".$size." name=\"size\" >

                <label for=\"description\"><b>Description</b></label>
                <input id=\"description\" type=\"text\" value='".$description."' name=\"description\" >


                <label for=\"rate\"><b>Rate</b></label>
                <input id=\"rate\" type=\"text\" value=".$rate." name=\"rate\" >
                
                <label for=\"img1\"><b>Ảnh 1</b></label>
                <input id=\"img1\" type=\"text\" value=".$list_image[0]." name=\"img1\" >

                <label for=\"img2\"><b>Ảnh 2</b></label>
                <input id=\"img2\" type=\"text\" value=".$list_image[1]." name=\"img2\" >

                <label for=\"img3\"><b>Ảnh 3</b></label>
                <input id=\"img3\" type=\"text\" value=".$list_image[2]." name=\"img3\" >

                <label for=\"img4\"><b>Ảnh 4</b></label>
                <input id=\"img4\" type=\"text\" value=".$list_image[3]." name=\"img4\">

                <button type=\"submit\" name=\"submit\" onclick=\"document.location='see-update-product-info-page.php?id=" .$productId. "&updateid=".$productId."'\">Update</button>

                </div>
                <div class=\"container\" style=\"background-color:#f1f1f1\">
                <button type=\"button\" onclick=\"document.getElementById('update').style.display='none'\" class=\"cancelbtn\">Cancel</button>
                </div>
            </form>
        </div>";

        if(isset($_GET["submit"])){
            $size_update = (isset($_GET["size"]))?$_GET["size"]:$size;

            $description_update = (isset($_GET["description"]))?$_GET["description"]:$description;
            $quantity_update = (int)(isset($_GET["quantity"]))?$_GET["quantity"]:$quantity;
            $price_update = (int)(isset($_GET["price"]))?$_GET["price"]:$size;
            $name_update = (isset($_GET["name"]))?$_GET["name"]:$name;
            $rate_update = (float)(isset($_GET["rate"]))?$_GET["rate"]:$rate;
            $img1_update = (isset($_GET["img1"]))?$_GET["img1"]:$list_image[0];
            $img2_update = (isset($_GET["img2"]))?$_GET["img2"]:$list_image[1];
            $img3_update = (isset($_GET["img3"]))?$_GET["img3"]:$list_image[2];
            $img4_update = (isset($_GET["img4"]))?$_GET["img4"]:$list_image[3];
            $list_image_update = array($img1_update,$img2_update,$img3_update,$img4_update);
            $sql_update = "UPDATE products SET name = '$name_update', size='$size_update', quantity=$quantity_update,
                        price =$price_update, description ='$description_update', rate=$rate_update
                        WHERE id =$productId";
            for($i=0;$i<4;$i++){
                $sql_update_img ="UPDATE products_images SET filename= $list_image_update[$i] where id_img = $list_id_image[$i]";
                $result_up = mysqli_query($conn,$sql_update_img);
            }
            if(mysqli_query($conn,$sql_update)===TRUE){
                echo "Record updated successfully";
            }
            else{
                echo "Failed";
            }
        }
    }
    ?>
    <!-- Load the current user information -->
    <script>
      async function LoadCurrentUserInfo()
      {
        infoArray = null;
        productId = <?php echo $_GET['id']; ?>;
        await $.ajax(
          {
              type: 'POST',
              data: {id:productId},
              url: 'get-current-product-info.php',
              success: function(response)
              {
                console.log(response);
                infoArray = JSON.parse(response);
                infoContainer = document.getElementById("user-infos-container");
                // console.log(infoArray.FirstName);
                // console.log(infoArray.LastName);
                // console.log(infoArray.Phone);
                name = infoArray.name;
                price = infoArray.price;
                description = infoArray.description;
                size = infoArray.size;
                rate = infoArray.rate;
                infoContainer.innerHTML += '<h3>'+ '<b>Thông tin sản phẩm</b>' + '</h3>';
                infoContainer.innerHTML += '<div>' +'<b>Tên</b>: '+ name +'</div>';
                infoContainer.innerHTML += '<div>' +'<b>Giá</b>: '+ price +'</div>';
                infoContainer.innerHTML += '<div>' +'<b>Size</b>: '+ size +'</div>';
                infoContainer.innerHTML += '<div>' +'<b>Mô tả</b>: '+ description +'</div>';
                infoContainer.innerHTML += '<div>' +'<b>Đánh giá</b>: '+ rate +'</div>';
              }
          });
        // infoContainer = $('#user-infos-container');

        // infoContainer.innerHTML += ;
      }
      LoadCurrentUserInfo();
    </script>

    <!-- Go back to the user list page -->
    <script>
      function GotoUserListPage()
      {
        window.location.href = 'manager-user-account-info-page.php';
      }
    </script>

    <!-- Delete the user's account -->
    <script type="text/javascript">
      async  function DeleteUser()
      {
        userId = <?php echo $_GET['Id']; ?>;
        if(confirm('Bạn không thể hoàn tác sau khi xóa người dùng này.\n Bạn có muốn tiếp tục?'))
        {
          await $.ajax(
            {
                type: 'POST',
                data:{Id:userId},
                url: 'delete-user.php',
                success: function(response)
                {
                  console.log(response);
                  window.location.href = 'manager-user-account-info-page.php';
                }
            });
        }
      }
    </script>
</body>
</html>
