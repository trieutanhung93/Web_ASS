
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
    <title>Đổi mật khẩu - BK Store</title>
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
                            <h3>Thay đổi mật khẩu</h3>
                            <br>
                              <div id="old-password-error-container" style="text-align:left"></div>
                              Mật khẩu cũ: <input type="password" onfocusout="CheckOldPassword()" placeholder="Nhập mật khẩu cũ của bạn"  tabindex="1" id="old-password" required>
                              <div id="new-password-error-container" style="text-align:left"></div>
                              Mật khẩu mới: <input type="password" onfocusout="CheckNewPassword()" placeholder="Nhập mật khẩu mới của bạn" tabindex="2" id="new-password" required>
                              <button type="button" onclick="ChangePassword()" id="change-info-button">Xác nhận đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- script to change the password -->
    <script type="text/javascript">
      isOldPasswordValid = 0;
      isNewPasswordValid = 0;
      async function CheckOldPassword()
      {
        oldPasswordErrContainer = document.getElementById('old-password-error-container');
        oldPassword = document.getElementById("old-password").value;
        await $.ajax(
          {
              type: 'POST',
              data: {password:oldPassword},
              url: 'check-password.php',
              success: function(response)
              {
                if(response == 1)
                {
                  oldPasswordErrContainer.style.color = 'green';
                  oldPasswordErrContainer.innerHTML = 'Mật khẩu chính xác';
                  isOldPasswordValid = 1;
                }
                else
                {
                  oldPasswordErrContainer.style.color = 'red';
                  oldPasswordErrContainer.innerHTML = 'Sai mật khẩu, vui lòng thử lại';
                  isOldPasswordValid = 0;
                }
              }
          });
      }



      async function CheckNewPassword()
      {
        newPasswordErrContainer = document.getElementById('new-password-error-container');
        newPassword = document.getElementById("new-password").value;
        newPasswordLength = newPassword.length;

        if(newPasswordLength < 8 || newPasswordLength > 30)
        {
          newPasswordErrContainer.style.color = 'red';
          newPasswordErrContainer.innerHTML = 'Mật khẩu phải bào gồm 8-30 ký tự, bao gồm cả chữ và số, và không chứa ký tự đặc biệt';
          isNewPasswordValid = 0;
          return;
        }
        passwordRegex = new RegExp("^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$");
        if(!passwordRegex.test(newPassword))
        {
          newPasswordErrContainer.style.color = 'red';
          newPasswordErrContainer.innerHTML = 'Mật khẩu phải bào gồm 8-30 ký tự, bao gồm cả chữ và số, và không chứa ký tự đặc biệt';
          isNewPasswordValid = 0;
          return;
        }
        else
        {
          newPasswordErrContainer.style.color = 'green';
          newPasswordErrContainer.innerHTML ='Mật khẩu được chấp nhận';
          isNewPasswordValid = 1;
          return;
        }



      }

      async function ChangePassword()
      {
        CheckOldPassword();
        CheckNewPassword();
        if(isOldPasswordValid == 0 || isNewPasswordValid == 0)
        {
          // console.log(isOldPasswordValid);
          // console.log(isNewPasswordValid);
          return;
        }
        userId = <?php echo $_SESSION['Id'];?>;
        newPassword = document.getElementById("new-password").value;
        await $.ajax(
          {
            url: 'change-password.php',
            type: 'POST',
            data:{Id:userId,password:newPassword},
            success: function(response)
            {
            }
          });
          alert("Bạn đã thay đổi mật khẩu thành công");
          window.location.href  = "account-info.php";
      }
    </script>

    <!-- footer -->
    <div id="footer-bar">
      <script type="text/javascript" src="script/load-footer.js"></script>
    </div>


</body>
</html>
