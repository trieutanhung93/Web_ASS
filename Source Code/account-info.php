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
    <title>Thông tin tài khoản - BK Store</title>
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
                    <div class="contact-container account-info-container">
                        <div id="contact" style="text-align:left;">
                          <div id="user-infos-container"></div>
                          <button name="button" type="submit" onclick="LoadChangeAccountPage()" id="contact-submit">Đổi thông tin</button>
                          <button name="button" type="submit" onclick="LoadChangePasswordPage()" id="change-password-button">Đổi mật khẩu</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Load the current user information -->
    <script>
      async function LoadCurrentUserInfo()
      {
        infoArray = null;
        userId = <?php echo $_SESSION['Id']; ?>;
        await $.ajax(
          {
              type: 'POST',
              data:{Id:userId},
              url: 'get-current-user-account-info.php',
              success: function(response)
              {
                // console.log(response);
                infoArray = JSON.parse(response);
                infoContainer = document.getElementById("user-infos-container");
                // console.log(infoArray.FirstName);
                // console.log(infoArray.LastName);
                // console.log(infoArray.Phone);
                FirstName = infoArray.FirstName;
                LastName = infoArray.LastName;
                Phone = infoArray.Phone;
                Email = infoArray.Email;
                CreationDate = infoArray.CreationDate;
                if(infoArray.FirstName == null)
                {
                  FirstName = "[Không tồn tại]";
                }
                if(infoArray.LastName == null)
                {
                  LastName = "[Không tồn tại]";
                }
                if(infoArray.Phone == null)
                {
                  Phone = "[Không tồn tại]"
                }
                infoContainer.innerHTML += '<h3>'+ 'Thông tin cá nhân ' + '</h3>';
                infoContainer.innerHTML += '<div>' +'Họ: '+ LastName +'</div>';
                infoContainer.innerHTML += '<div>' +'Tên: '+ FirstName +'</div>';
                infoContainer.innerHTML += '<div>' +'Số điện thoại: '+ Phone +'</div>';
                infoContainer.innerHTML += '<div>' +'Email: '+ Email +'</div>';
                infoContainer.innerHTML += '<div>' +'Ngày tạo tài khoản: '+ CreationDate +'</div>';
              }
          });
        // infoContainer = $('#user-infos-container');

        // infoContainer.innerHTML += ;
      }
      LoadCurrentUserInfo();
    </script>

    <!-- Load change-account-info page  -->
    <script type="text/javascript">
      function LoadChangeAccountPage()
      {
        window.location.href = 'change-account-info-page.php';
      }
    </script>

    <script type="text/javascript">
      function LoadChangePasswordPage()
      {
        window.location.href = 'change-password-page.php';
      }
    </script>

    <!-- footer -->
    <div id="footer-bar">
      <script type="text/javascript" src="script/load-footer.js"></script>
    </div>


</body>
</html>
