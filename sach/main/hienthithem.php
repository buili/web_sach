<?php
if (isset($_SESSION['id_sanpham'])) {
    $id = $_SESSION['id_sanpham'];
} else {
    echo 'Khong co';
}
$loai = $_GET['loai'];
switch ($loai) {
    case '0':
        $tieude = "SÁCH MỚI";
        break;
    case '1':
        $tieude = "SẮP PHÁT HÀNH";
        break;
    case '2':
        $tieude = "SÁCH BÁN CHẠY";
        break;
    case '3':
        $tieude = "SÁCH CÙNG TÁC GIẢ";
        break;
    case '4':
        $tieude = "SẢN PHẨM";
        break;
    default:
        $tieude = '';
        break;
}

?>

<h3><?php echo $tieude ?></h3>
<?php
$result = trang();
$page = $result['page'];
$begin = $result['begin'];

if ($_GET['loai'] == 3) {

    $sql = "SELECT *FROM tbl_sanpham WHERE tentacgia = (
            SELECT tentacgia FROM tbl_sanpham WHERE id_sanpham = $id ) LIMIT $begin,12";
    $sql = mysqli_query($mysqli, $sql);
} elseif ($_GET['loai'] == 4) {
    $sql = "SELECT *FROM tbl_sanpham LIMIT $begin,12";
    $sql = mysqli_query($mysqli, $sql);
} else {
    $sql = sql_tieubieu($_GET['loai'], $begin, 12);
}

$hienthi = listindex($sql);
echo $hienthi;
if ($_GET['loai'] == 3) {
    $sql = "SELECT *FROM tbl_sanpham WHERE tentacgia = (
            SELECT tentacgia FROM tbl_sanpham WHERE id_sanpham = $id )";
    $sql_phantrang = mysqli_query($mysqli, $sql);
    $phantrang = phantrang($sql_phantrang, "hienthithem&loai=",  $_GET['loai']);
    /*  unset($_SESSION['id_sanpham']); */
} elseif ($_GET['loai'] == 4) {
    $sql = "SELECT *FROM tbl_sanpham";
    $sql_phantrang = mysqli_query($mysqli, $sql);
    $phantrang = phantrang($sql_phantrang, 'hienthithem&loai=',  $_GET['loai']);
} else {
    $sql_phantrang = sql_tieubieu($_GET['loai']);
    $phantrang = phantrang($sql_phantrang, 'hienthithem&loai=',  $_GET['loai']);
}
/* $phantrang = phantrang($sql_phantrang, 'hienthithem&loai=',  $_GET['loai']); */
