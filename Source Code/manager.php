<?php
  session_start();
  if(!isset($_SESSION['username']))
  {
    header('location:account.php');
  }
  if($_SESSION['IsManager'] == 0)
  {
    header('location:account.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý - BK Store</title>
    <link rel="stylesheet" href="style.css">
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
                    <img src="Img/image1.png" alt="">
                </div>
                <div class="col-2">
                    <div class="contact-container">
                        <div id="contact">
                            <h3>Danh sách chức năng quản lý</h3>
                            <button name="submit" onclick="GotoUserAccountInfoPage()" type="button">Xem thông tin người dùng</button>
                            <button name="submit" onclick="GotoUpdateProductPage()" type="button">Thao tác trên sản phẩm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to load the page of the list of user -->
    <script>
      function GotoUserAccountInfoPage()
      {
        window.location.href = 'manager-user-account-info-page.php';
      }
      function GotoUpdateProductPage()
      {
        window.location.href = 'update-product.php';
      }
    </script>

    <!-- Scritp to load the add product page -->
    <!-- <script>
      function GotoAddProductsPage()
      {
        window.location.href = 'manager-add-products-page.php';
      }
    </script> -->
    <!-- footer -->
    <div id="footer-bar">
      <script type="text/javascript" src="script/load-footer.js"></script>
    </div>


</body>
</html>
