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
    <title>Danh sách người dùng - BK Store</title>
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
                    <div class="contact-container user-accounts-list-container">
                        <div id="contact">
                            <h3>Danh sách các người dùng</h3>
                            <h4>Nhấn vào các tài khoản để xem thông tin cụ thể hoặc xóa</h4>
                            <div id="user-accounts-info-list" style="margin-left:5px;margin-right:5px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to load the page of the list of user -->
    <script>
      listContainer = document.getElementById('user-accounts-info-list');
      async function LoadUsersInfoList()
      {
        await $.ajax(
          {
              type: 'GET',
              url: 'get-user-accounts-info-list.php',
              success: function(response)
              {
                dataArray = $.parseJSON(response);
                dataArray.forEach(PrintUserInfo);



              }
          });
      }

      function PrintUserInfo(item)
      {
        listContainer.innerHTML += '<a href="see-user-account-info-page.php?Id='+ item['Id'] +'">Xem thông tin </a>|| '
        listContainer.innerHTML += 'Id:' + item['Id'] +'; Họ tên: ';
        listContainer.innerHTML += item['LastName'] + ' ' + item['FirstName'] + '; ';
        listContainer.innerHTML += '<hr>';
      }
      LoadUsersInfoList();
    </script>

    <!-- footer -->
    <div id="footer-bar">
      <script type="text/javascript" src="script/load-footer.js"></script>
    </div>


</body>
</html>
