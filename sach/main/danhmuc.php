
<?php
   /*  if(isset($_GET['trang'])){
        $page = $_GET['trang'];
    }else{
        $page = 1;
    }

    if ($page == '' || $page == 1) {
        $begin = 0;
    } else {
        $begin = ($page * 12) - 12;
    } */
$result = trang(); 
$page = $result['page']; 
$begin = $result['begin']; 

$sql_pro = "SELECT * FROM  tbl_sanpham WHERE tbl_sanpham.id_danhmuc = '$_GET[id]' ORDER BY id_sanpham ASC LIMIT $begin,12";
$query_pro = mysqli_query($mysqli, $sql_pro);
$row = mysqli_num_rows($query_pro);

//get tên danh mục
$sql_cate = "SELECT *FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc = '$_GET[id]' LIMIT 1";
$query_cate = mysqli_query($mysqli, $sql_cate);
$row_title = mysqli_fetch_array($query_cate);

?>

<h3>Danh mục sản phẩm: <?php echo $row_title['tendanhmuc'] ?></h3>

<?php
$danhmuc = listindex($query_pro);
echo $danhmuc;

$sql = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc = '$_GET[id]'"; 
$query = mysqli_query($mysqli, $sql);
$phantrang = phantrang($query,'danhmucsanpham&id=', $_GET['id']);

/* $sql_trang = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc = '$_GET[id]'";
$query_trang = mysqli_query($mysqli, $sql_trang);
$row_count = mysqli_num_rows($query_trang);
$trang = ceil($row_count / 12);
$maxPages = 3;

// Xác định trang hiện tại
$page = isset($_GET['trang']) ? intval($_GET['trang']) : 1;

// Tính toán trang bắt đầu và trang kết thúc
$startPage = max(min($page - floor($maxPages / 2), $trang - $maxPages + 1), 1);
$endPage = min($startPage + $maxPages - 1, $trang);

// In kết quả
?>
<p>Trang hiện tại: <?php echo $page ?>/<?php echo $trang ?></p>
<ul class="list_trang">
    <?php
    if ($startPage > 1) {
        // Hiển thị dấu 3 chấm ở đầu nếu cần
        echo '<li><a href="index.php?quanly=danhmucsanpham&id=' . $_GET['id'] . '&trang=1">1</a></li>';
        echo '<li><span>...</span></li>';
    }

    for ($i = $startPage; $i <= $endPage; $i++) {
        // Hiển thị các trang từ startPage đến endPage
        echo '<li ';
        if ($i == $page) {
            echo 'style="background:brown;"';
        }
        echo '><a href="index.php?quanly=danhmucsanpham&id=' . $_GET['id'] . '&trang=' . $i . '">' . $i . '</a></li>';
    }

    if ($endPage < $trang) {
        // Hiển thị dấu 3 chấm ở cuối nếu cần
        echo '<li><span>...</span></li>';
        echo '<li><a href="index.php?quanly=danhmucsanpham&id=' . $_GET['id'] . '&trang=' . $trang . '">' . $trang . '</a></li>';
    }
    ?>
</ul>
 */