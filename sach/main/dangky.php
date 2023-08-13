<?php
$errorsignup = array('email' => " ", 'usernamesignup' => " ", 'password' => "", 'confirm_password' => "");
$usernamesignup = "";
$emailsignup = "";
$passwordsignup = "";
$confirm_password = "";
$alertMessage = "";
$checkinput = true;
$row = "";
if (isset($_POST['dangky'])) {
    $usernamesignup = $_POST['usernamesignup'];
    $errorsignup['usernamesignup'] = kiemtra($usernamesignup, 'username', '<p>Phải bắt đầu bằng 1 chữ cái</p>');
    $emailsignup = $_POST['emailsignup'];
    $errorsignup['email'] = kiemtra($emailsignup, 'email', '<p>Giá trị này không hợp lệ</p>');
    $passwordsignup = $_POST['passwordsignup'];
    $errorsignup['password'] = kiemtra($passwordsignup, 'password', '<p>Mật khẩu phải có ít nhất 1 chữ số, 1 chữ hoa, 1 kí tự đăc biệt</p>');
    $confirm_password = $_POST['confirm_password'];
    $errorsignup['confirm_password'] = kiemtra($confirm_password, 'password', '<p>Mật khẩu phải có ít nhất 1 chữ số, 1 chữ hoa, 1 kí tự đăc biệt</p>');
    if ($passwordsignup == $confirm_password && $checkinput == true) {
        $sql = "INSERT INTO tbl_dangky(tenkhachhang, email, password) VALUE('" . $usernamesignup . "','" . $emailsignup . "','" . $passwordsignup . "')";
        $row = mysqli_query($mysqli, $sql);
        if ($row) {
            $_SESSION['dangky'] = $usernamesignup;
            $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);
            unset($_SESSION['cart']);
            header("Location:index.php");
        }
    } else {
        $errorsignup['confirm_password'] = '<p>Mật khẩu không trùng khớp hoặc không hợp lệ</p>';
    }

    /* if ($checkinput == true) {
        echo $alertMessage;
      } */
}

$strUsername = creatInput('field', '<input type="text" name="usernamesignup" value="' . $usernamesignup . '" placeholder="User name"   />', $errorsignup['usernamesignup']);
$strEmailsignup = creatInput('field', '<input type="text" name="emailsignup" value="' . $emailsignup . '" placeholder="Email Address"  />', $errorsignup['email']);
$strPasswordsignup = creatInput('field', '<input type="password" name="passwordsignup" value="' . $passwordsignup . '" placeholder="Password"  />', $errorsignup['password']);
$strconfirm_password = creatInput('field', '<input type="password" name="confirm_password" value="' . $confirm_password . '" placeholder="Confirm password"  />', $errorsignup['confirm_password']);
?>
<div class="dangnhap">
  <div class="wrapper">
    <div class="title-text">
      <div class="title login">Login Form</div>
    </div>
    <div class="form-container">
      <div class="form-inner">
      <form action="#"  class="signup" method="post">
          <?php
          echo $strUsername . $strEmailsignup . $strPasswordsignup . $strconfirm_password;
          ?>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" name="dangky" value="Signup">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>