<?php
  session_start();
  $isLoggedIn = 0;
  if(isset($_SESSION['username']))
  {
    $isLoggedIn = 1;
    $isManager = $_SESSION['IsManager'];
  }
?>

<div class="container">
    <div class="navbar">
        <div class="log">
            <a href="index.php"><img src="Img/logo.png" alt="" width="125"></a>
        </div>
        <nav>
            <ul id="MenuItems">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="products.php">Sản phẩm</a></li>
                    <li><a href="about.php">Giới thiệu</a></li>

                <?php
                  if($isLoggedIn == 1)
                  {
                    if($isManager == false)
                    {
                      echo '<li><a href="contact.php">Liên lạc</a></li>';
                      echo '<li><a href="account-info.php">Thông tin cá nhân</a></li>';
                    }
                    else
                    {
                      echo '<li><a href="manager.php">Chức năng quản lý</a></li>';
                      echo '<li><a href="change-password-page.php">Đổi mật khẩu</a></li>';
                    }

                    echo '<li><a href="logout.php">Đăng xuất</a></li>';
                  }
                  else
                  {
                    echo '<li><a href="account.php">Đăng nhập/Đăng ký</a></li>';

                  }
                ?>
            </ul>
        </nav>
        <a href="cart.php"><img src="Img/cart.png" alt="" width="30" height="30"></a>
        <img src="Img/menu.png" class="menu-icon" alt="" onclick="menutoggle()">
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
