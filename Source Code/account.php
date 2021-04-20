<?php
  session_start();
  if(isset($_SESSION['username']))
  {
    header('location:index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | Đăng ký - Red Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <script language="javascript" type="text/javascript" src="script/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="script/show-menu.js"></script>
  <div id="menu-navbar"></div>

  <!--account-page -->
  <div class="account-page">
      <div class="container">
          <div class="row">
              <div class="col-2">
                  <img src="Img/image1.png" alt="">
              </div>
              <div class="col-2">
                  <div class="form-container">
                      <div class="form-btn">
                          <span onclick="login()">Đăng nhập</span>
                          <span onclick="register()">Đăng ký</span>
                          <hr id="Indicator">
                      </div>
                      <form id="LoginForm">
                          <div id="login-name-login-error-container" style="text-align:left; color:red;"></div>
                          <input type="text" placeholder="Tên đăng nhập" id="login-name-login">
                          <div id="password-login-error-container" style="text-align:left; color:red"></div>
                          <input type="password" placeholder="Mật khẩu" id="password-login">
                          <button type="button" onclick="LogIn()" class="btn">Đăng nhập</button>
                          <a href="">Quên mật khẩu</a>
                      </form>

                      <form id="RegisterForm">
                          <div id="login-name-register-error-container" style="text-align:left"></div>
                          <input type="text" onfocusout='CheckLoginName()' placeholder="Tên đăng nhập" id="login-name-register">
                          <div id="email-register-error-container" style="text-align:left"></div>
                          <input type="email" onfocusout='CheckEmail()'  placeholder="Email" id='email-register'>
                          <div id="password-register-error-container" style="text-align:left"></div>
                          <input type="password" onfocusout='CheckPassword()' placeholder="Mật khẩu" id='password-register'>
                          <button type="button" onclick="SendRegisterInfo()" class="btn">Đăng ký</button>
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


  <!-- js for toggle Form -->
  <script>
      var LoginForm = document.getElementById("LoginForm");
      var RegisterForm = document.getElementById("RegisterForm");
      var Indicator = document.getElementById("Indicator");

      function register(){
          RegisterForm.style.transform = "translateX(0px)";
          LoginForm.style.transform = "translateX(0px)";
          Indicator.style.transform = "translateX(100px)"
      }

      function login(){
          RegisterForm.style.transform = "translateX(300px)"
          LoginForm.style.transform = "translateX(300px)"
          Indicator.style.transform = "translateX(0px)"
      }

  </script>

  <!-- js for checking the login name, password, and email -->
  <script>
    isLoginValid = 0;
    isEmailValid = 0;
    isPasswordValid = 0;
    async function CheckLoginName()
    {
      loginerrContainer = document.getElementById('login-name-register-error-container');
      loginNameContainer = document.getElementById('login-name-register');
      loginName = loginNameContainer.value;
      loginStringLength = loginName.length;
      if(loginStringLength < 4 || loginStringLength > 20)
      {
        loginerrContainer.style.color = 'red';
        loginerrContainer.innerHTML = 'Tên đăng nhập phải bao gồm 4-20 ký tự, và chỉ chứa ký tự chữ cái và số';
        isLoginValid = 0;
        return;
      }
      loginRegex = new RegExp("[a-zA-z0-9]+$");
      if(loginRegex.test(loginName))
      {
        loginerrContainer.innerHTML ='Đang kiểm tra...';
        await $.ajax(
          {
              url: 'validate-login-reg.php',
              type: 'GET',
              data:{log:loginName},
              dataType: 'text',
              contentType: 'application/json; charset=utf-8',
              success: function (response)
              {
                console.log(response);
                isValid = response;
                if (isValid == 0)
                {
                  loginerrContainer.style.color = 'red';
                  loginerrContainer.innerHTML = 'Tên đăng nhập đã tồn tại, vui lòng nhập tên khác';
                  isLoginValid = 0;
                }
                else
                {
                  loginerrContainer.style.color = 'green';
                  loginerrContainer.innerHTML = 'Tên đăng nhập được chấp nhận';
                  isLoginValid = 1;
                }
              }
          });

      }
      else
      {
        loginerrContainer.style.color = 'red';
        loginerrContainer.innerHTML = 'Tên đăng nhập phải bao gồm 4-20 ký tự, và chỉ chứa ký tự chữ cái và số';
        isLoginValid = 0;
        return;
      }
    }

    async function CheckEmail()
    {
      emailErrContainer = document.getElementById('email-register-error-container');
      emailNameContainer = document.getElementById('email-register');
      emailName = emailNameContainer.value;
      emailRegex = new RegExp("[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?")
      if(emailRegex.test(emailName))
      {
        emailErrContainer.innerHTML ='Đang kiểm tra...';
        await $.ajax(
          {
              url: 'validate-email-reg.php',
              type: 'GET',
              data:{email:emailName},
              dataType: 'text',
              contentType: 'application/json; charset=utf-8',
              success: function (response)
              {
                isValid = response;
                if (isValid == 0)
                {
                  emailErrContainer.style.color = 'red';
                  emailErrContainer.innerHTML = 'Email đã tồn tại, vui lòng nhập địa chỉ khác';
                  isEmailValid = 0;
                }
                else
                {
                  emailErrContainer.style.color = 'green';
                  emailErrContainer.innerHTML = 'Email được chấp nhận';
                  isEmailValid = 1;
                }
              }
          });

      }
      else
      {
        emailErrContainer.style.color = 'red';
        emailErrContainer.innerHTML = 'Địa chỉ email không hợp lệ';
        isEmailValid = 0;
        return;
      }
    }

    function CheckPassword()
    {
      passwordErrContainer = document.getElementById('password-register-error-container');
      passwordContainer = document.getElementById('password-register');
      password = passwordContainer.value;
      passwordLength = password.length;
      if(passwordLength < 8 || passwordLength > 30)
      {
        passwordErrContainer.style.color = 'red';
        passwordErrContainer.innerHTML = 'Mật khẩu phải bào gồm 8-30 ký tự, bao gồm cả chữ và số, và không chứa ký tự đặc biệt';
        isPasswordValid = 0;
        return;
      }
      passwordRegex = new RegExp("^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$");
      if(!passwordRegex.test(password))
      {
        passwordErrContainer.style.color = 'red';
        passwordErrContainer.innerHTML = 'Mật khẩu phải bào gồm 8-30 ký tự, bao gồm cả chữ và số, và không chứa ký tự đặc biệt';
        isPasswordValid = 0;
        return;
      }
      else
      {
        passwordErrContainer.style.color = 'green';
        passwordErrContainer.innerHTML ='Mật khẩu được chấp nhận';
        isPasswordValid = 1;
        return;
      }
    }

  </script>

  <!-- js for sending the register info to the server -->
  <script>
    async function SendRegisterInfo()
    {
      var validArr = [];
      CheckEmail();
      CheckLoginName();
      CheckPassword();
      validArr.push(isLoginValid);
      validArr.push(isEmailValid);
      validArr.push(isPasswordValid);
      if (validArr.includes(0))
      {
        return;
      }
      else
      {
        loginName = document.getElementById('login-name-register').value;
        emailName = document.getElementById('email-register').value;
        password =  document.getElementById('password-register').value;
        await $.ajax(
          {
              type: 'POST',
              url: 'insert-reg.php',
              data:{log:loginName,email:emailName,pass:password},
              cache:false,
          });
        await $.ajax(
          {
              type: 'POST',
              url: 'login.php',
              data:{loginName:loginName,password:password},
              cache:false,
          });
          window.location.href = 'index.php';
      }
    }



  </script>

  <!-- js for checking the login information and for logging in  -->
  <script>
    async function LogIn()
    {
      loginErrContainer = document.getElementById('login-name-login-error-container');
      passwordErrContainer = document.getElementById('password-login-error-container');
      loginName = $('#login-name-login').val();
      password = $('#password-login').val();
      loginErrContainer.value = 'Vui lòng nhập tên đăng nhập';
      if(loginName == '')
      {
        loginErrContainer.innerHTML = 'Vui lòng nhập tên đăng nhập';
        return;
      }
      else
      {
        loginErrContainer.innerHTML = '';
      }
      if(password == '')
      {
        passwordErrContainer.innerHTML = 'Vui lòng nhập mật khẩu';
        return;
      }
      else
      {
        passwordErrContainer.innerHTML = '';
      }
      await $.ajax(
        {
            type: 'POST',
            url: 'login.php',
            data:{loginName:loginName,password:password},
            cache:false,
            success:function(response)
            {
              if(response == 0)
              {
                loginErrContainer.innerHTML = 'Sai tên đăng nhập hoặc mật khẩu';
              }
              else
              {
                alert("Đăng nhập thành công");
                window.location.href = 'index.php';
              }
            }
        });
    }

  </script>
</body>
</html>
