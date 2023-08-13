<?php

$error = array('email' => " ", 'password' => "");
$email = "";
$password = "";
$alertMessage = "";
$checkinput = true;
$row = "";
if (isset($_POST['dangnhap'])) {

  $email = $_POST['email'];
  $error['email'] = kiemtra($email, 'email', '<p>Giá trị này không hợp lệ</p>');
  $password = $_POST['password'];
  $error['password'] = kiemtra($password, 'password', '<p>Mật khẩu phải có ít nhất 1 chữ số, 1 chữ hoa, 1 kí tự đăc biệt</p>');

  $sql = "SELECT * FROM tbl_dangky WHERE email = '" . $email . "' AND password = '" . $password . "' LIMIT 1";
  $row = mysqli_query($mysqli, $sql);
  $count = mysqli_num_rows($row);
  if ($count > 0 && $checkinput == true) {

    $row_data = mysqli_fetch_array($row);
    $_SESSION['dangnhap'] = $row_data['tenkhachhang'];
    $_SESSION['id_khachhang'] = $row_data['id_dangky'];
    unset($_SESSION['cart']);
    header("Location:index.php");
  } else {
    $alertMessage = '<script>alert("Mật khẩu hoặc Email sai, vui lòng nhập lại!");</script>';
  }

  if ($checkinput == true) {
    echo $alertMessage;
  }
}

$strEmail = creatInput('field', '<input type="text" name="email" value="' . $email . '" placeholder="Email Address"  />', $error['email']);
$strPassword = creatInput('field', '<input type="password" name="password" value="' . $password . '" placeholder="Password"  />', $error['password']);

?>


<div class="dangnhap">
  <div class="wrapper">
    <div class="title-text">
      <div class="title login">Login Form</div>
    </div>
    <div class="form-container">
      <div class="form-inner">
        <form action="#" class="login" method="post">
          <?php
          echo $strEmail . $strPassword;
          ?>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" name="dangnhap" value="Login">
          </div>
          <div class="field">
            <a style="text-decoration: none" href="index.php?quanly=dangky">
              <span >Đăng ký</span>
            </a>
          </div>
        </form>


      </div>
    </div>
  </div>
</div>