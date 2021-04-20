<?php
  session_start();
  if(!isset($_SESSION['username']))
  {
    header('location:account.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên lạc - BK Store</title>
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
                        <form id="contact" method="post">
                            <h3>Đơn liên hệ Red Store</h3>
                            <h4>Liên hệ chúng tôi nếu bạn cần thêu chữ lên sản phẩm</h4>
                            <fieldset>
                              <input placeholder="Họ tên" type="text" tabindex="1" required autofocus>
                            </fieldset>
                            <fieldset>
                              <input placeholder="Địa chỉ email" type="email" tabindex="2" required>
                            </fieldset>
                            <fieldset>
                              <input placeholder="Số điện thoại (không bắt buộc)" type="tel" tabindex="3" required>
                            </fieldset>
                            <fieldset>
                              <input placeholder="Website của bạn (không bắt buộc)" type="url" tabindex="4" required>
                            </fieldset>
                            <fieldset>
                              <textarea placeholder="Nhập nội dung tin nhắn...." tabindex="5" required></textarea>
                            </fieldset>
                            <fieldset>
                              <button name="submit" type="submit" id="contact-submit" data-submit="...Đang gửi">Submit</button>
                            </fieldset>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div id="footer-bar">
      <script type="text/javascript" src="script/load-footer.js"></script>
    </div>


</body>
</html>
