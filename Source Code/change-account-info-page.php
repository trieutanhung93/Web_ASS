<?php
  session_start();
  if(!isset($_SESSION['username']))
  {
    header('location:index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi thông tin cá nhân - BK Store</title>
    <link rel="stylesheet" href="style.css">
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
                    <div class="contact-container">
                        <form id="contact" style="text-align:left;">
                            <h3>Thay đổi thông tin cá nhân</h3>
                            <div>Để trống nếu như không có thay đổi</div>
                            <br>
                              Họ: <input placeholder="Nhập họ của bạn"  tabindex="1" id="user-lastname">
                              Tên: <input placeholder="Nhập tên của bạn" tabindex="2" id="user-firstname">
                              Số điện thoại:<input placeholder="Nhập số điện thoại của bạn" type="number"  tabindex="3" id="user-phone">
                              <button type="button" onclick="ChangeInformation()" id="change-info-button">Xác nhận đổi thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- script for sending the changed information -->
    <script>
      async function ChangeInformation()
      {
        userId = <?php echo $_SESSION['Id']; ?>;
        userFirstname = document.getElementById('user-firstname').value;
        userLastname = document.getElementById('user-lastname').value;
        userPhone = document.getElementById('user-phone').value;
        await $.ajax(
          {
            url: 'change-account-info.php',
            type: 'POST',
            data:{Id:userId,firstname:userFirstname,lastname:userLastname,phone:userPhone},
            success: function(response)
            {
              // console.log(response);
              window.location.href  = "account-info.php";
            }
          });
      }
    </script>

    <!-- footer -->
    <div id="footer-bar">
      <script type="text/javascript" src="script/load-footer.js"></script>
    </div>


</body>
</html>
