
<?php
$errorsignup = array('email' => " ",  'password' => "", 'matkhaumoi' => "");

$emailsignup = "";
$matkhaucu = "";
$matkhaumoi = "";
$alertMessage = "";
$checkinput = true;
$row = "";
if (isset($_POST['dangky'])) {
    $emailsignup = $_POST['emailsignup'];
    $errorsignup['email'] = kiemtra($emailsignup, 'email', '<p>Giá trị này không hợp lệ</p>');
    $matkhaucu = $_POST['matkhaucu'];
    $errorsignup['password'] = kiemtra($matkhaucu, 'password', '<p>Mật khẩu phải có ít nhất 1 chữ số, 1 chữ hoa, 1 kí tự đăc biệt</p>');
    $matkhaumoi = $_POST['matkhaumoi'];
    $errorsignup['matkhaumoi'] = kiemtra($matkhaumoi, 'password', '<p>Mật khẩu phải có ít nhất 1 chữ số, 1 chữ hoa, 1 kí tự đăc biệt</p>');
    $sql = "SELECT * FROM tbl_dangky WHERE email = '" . $emailsignup . "' AND password = '" . $matkhaucu . "' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);
    if ($count > 0  && $checkinput == true) {
        $sql_update = "UPDATE tbl_dangky SET password='" . $matkhaumoi . "' WHERE email = '" . $emailsignup . "'";
        $row_update = mysqli_query($mysqli, $sql_update);
        echo '<script>alert("Mật khẩu đã được thay đổi.")</script>';
    } else {
        echo '<script>alert("Tài khoản hoặc Mật khẩu không đúng, vui lòng nhập lại.")</script>';
    }
}

$strEmailsignup = creatInput('field', '<input type="text" name="emailsignup" value="' . $emailsignup . '" placeholder="Email Address"  />', $errorsignup['email']);
$strmatkhaucu = creatInput('field', '<input type="password" name="matkhaucu" value="' . $matkhaucu . '" placeholder="Mật khẩu cũ"  />', $errorsignup['password']);
$strmatkhaumoi = creatInput('field', '<input type="password" name="matkhaumoi" value="' . $matkhaumoi . '" placeholder="Mật khẩu mới"  />', $errorsignup['matkhaumoi']);
?>
<div class="dangnhap">
    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Thay đổi mật khẩu</div>
        </div>
        <div class="form-container">
            <div class="form-inner">
                <form action="#" class="signup" method="post">
                    <?php
                    echo  $strEmailsignup . $strmatkhaucu . $strmatkhaumoi;
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