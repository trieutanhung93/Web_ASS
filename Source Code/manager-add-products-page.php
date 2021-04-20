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
    <title>Thêm sản phẩm - BK Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

  <script language="javascript" type="text/javascript" src="script/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="script/show-menu.js"></script>
  <div id="menu-navbar"></div>

    <!-- add-products-page -->
    <div class="contact-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <div class="contact-container user-accounts-list-container">
                        <div action="add-products.php" id="contact" method="post" enctype="multipart/form-data" style="text-align:left;">
                          <h3>Thêm thông tin sản phẩm</h3>
                          <br>
                            Tên sản phẩm: <input placeholder="Nhập tên sản phẩm" type="text" name="product-name"  tabindex="1" id="product-name">
                            Đơn giá: <input placeholder="Nhập đơn giá sản phẩm" type="number" name="product-price" tabindex="2" id="product-price">
                            <br>
                            Miêu tả:<textarea placeholder="Nhập miêu tả sản phẩm" type="text" name="product-description"  tabindex="3" id="product-description"></textarea>
                            <!-- Hình ảnh:
                            <input type="file" name="product-images[]" id='product-images' value="" multiple accept='image/*'> -->
                            <button type="submit" onclick="AddProducts()" id="change-info-button">Xác nhận thêm sản phẩm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to add products -->
    <script type="text/javascript">
      async function AddProducts()
      {
        productName = document.getElementById('product-name').value;
        productPrice = document.getElementById('product-price').value;
        productDes = document.getElementById('product-description').value;
        // productImages =  document.getElementById('product-images').files;
        // console.log(productImages[0]);
        await $.ajax(
        {
          url: 'add-products.php',
          type: 'POST',
          data:{productName:productName,productPrice:productPrice,productDes:productDes},
          success: function(response)
          {
            console.log(response);
          }
        });
      }
    </script>


</body>
</html>
