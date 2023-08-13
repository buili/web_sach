<?php
function checkInput($value, $type = 'email')
{
    switch ($type) {
        case 'email':
            $patten = '#^[a-z0-9_\.]{4,30}@[a-z0-9\.]{2,}$#';
            break;
        case 'username':
            $patten = '#^[a-zA-Z][a-zA-Z0-9_\.\s]{4,30}$#';
            break;
        case 'password':
            $patten = '#^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{4,}$#';
            break;
    }
    $flag = preg_match($patten, $value);
    return $flag;
}

function kiemtra(&$value, $type = 'email', $chuthich)
{
    global $checkinput;
    $error = "";
    if (trim($value) == "") {
        $checkinput = false;
        $error = '<p>Giá trị này không được rỗng</p>';
    } else {
        if (strlen($value) <= 4) {
            $checkinput = false;
            $error = '<p>Tên phải dài hơn 4 kí tự</p>';
        } else {
            if (checkInput($value, $type) == false) {
                $checkinput = false;
                $error = $chuthich;
                $value = '';
            }
        }
    }
    return $error;
    /* return array('page' => $page, 'begin' => $begin); */
}

function creatInput($class = 'field', $input, $error)
{
    $bien = '<div class="' . $class . '">
                ' . $input . $error . '
            </div>';

    return $bien;
}
/* include_once("../admincp/config/config.php"); */
function listindex($query_result)
{
    $output = '<ul class="list_index">';
    while ($row = mysqli_fetch_array($query_result)) {
        $output .= '
        <li class="index_li">
            
            <a  href="index.php?quanly=sanpham&id=' . $row['id_sanpham'] . '" style="text-decoration: none;">
                <img class="img" src="../../images/'.$row['hinhanh'].'" width="100%" alt="">
                
            </a>
        
            <p class="title_product">Tên sản phẩm: ' . $row['tensanpham'] . '</p>
            <p class="price_product">Giá: ' . number_format($row['giasp'], 0, ',', '.') . 'vnđ' . '</p>
            <a href="" style="text-decoration: none;">
                <p class="danhmuc_index">Tác giả: ' . $row['tentacgia'] . '</p>
            </a>
        </li>';
    }
    $output .= '</ul>';
    return $output;
}

function btn_them($loai)
{
    $output = '<a href="index.php?quanly=hienthithem&loai=' . $loai . '" class="btn_them">Xem thêm</a>';
    /* $output .= '</ul>'; */
    return $output;
}

function btn_doc()
{
    $output = '<a href="" class="btn_doc">Đọc ngay</a>';
    /* $output .= '</ul>'; */
    return $output;
}

function sql_tieubieu($loai, $begin = null, $limit = null)
{

    $limitClause = '';
    if ($limit !== null && $begin !== null) {
        $limitClause = "LIMIT $begin, $limit";
    }
    global $mysqli;
    $sql =  "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
    AND tbl_sanpham.loai = $loai ORDER BY tbl_sanpham.id_sanpham ASC $limitClause";
    $query = mysqli_query($mysqli, $sql);

    return $query;
}


function trang()
{
    if (isset($_GET['trang'])) {
        $page = $_GET['trang'];
    } else {
        $page = 1;
    }

    if ($page == '' || $page == 1) {
        $begin = 0;
    } else {
        $begin = ($page * 12) - 12;
    }
    return array('page' => $page, 'begin' => $begin);
}

function phantrang($query, $url, $get)
{
    global $mysqli;
    /*   $sql_trang = $sql;
    $query_trang = mysqli_query($mysqli, $sql_trang); */
    $row_count = mysqli_num_rows($query);
    $trang = ceil($row_count / 12);
    $maxPages = 3;
    $page = isset($_GET['trang']) ? intval($_GET['trang']) : 1;
    $startPage = max(min($page - floor($maxPages / 2), $trang - $maxPages + 1), 1);
    $endPage = min($startPage + $maxPages - 1, $trang);

?>
    <p>Trang hiện tại: <?php echo $page ?>/<?php echo $trang ?></p>
    <ul class="list_trang">
        <?php
        if ($startPage > 1) {
            echo '<li><a href="index.php?quanly=' . $url . '' . $get . '&trang=1">1</a></li>';
            echo '<li><span>...</span></li>';
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            echo '<li ';
            if ($i == $page) {
                echo 'style="background:brown;"';
            }
            echo '><a href="index.php?quanly=' . $url . '' . $get . '&trang=' . $i . '">' . $i . '</a></li>';
        }

        if ($endPage < $trang) {
            echo '<li><span>...</span></li>';
            echo '<li><a href="index.php?quanly=' . $url . '' . $get . '&trang=' . $trang . '">' . $trang . '</a></li>';
        }
        ?>
    </ul>
<?php
}
?>