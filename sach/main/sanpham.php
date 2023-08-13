<?php

$sql_chitiet = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
    AND tbl_sanpham.id_sanpham = '$_GET[id]' LIMIT 1";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);


while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
    $_SESSION['id_sanpham'] = $_GET['id'];
?>
    
    <div class="wrapper_chitiet">
        <div class="hinhanh_sanpham">
            <img class="ha_sp" src="../../images/<?php echo $row_chitiet['hinhanh'] ?>" alt="">
        </div>
        <form method="post" action="sach/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>">
            <div class="chitiet_sanpham">
                <h4 style="margin: 0;">Tên sản phẩm: <?php echo $row_chitiet['tensanpham'] ?></h4>
                <p>Mã sp: <?php echo $row_chitiet['masp'] ?></p>
                <p>Giá sp: <?php echo number_format($row_chitiet['giasp'], 0, ',', '.') . 'vnđ' ?></p>
                <p>Số lượng sp: <?php echo $row_chitiet['soluong'] ?></p>
                <p>Danh mục sp: <?php echo $row_chitiet['tendanhmuc'] ?></p>
                <a href="" style="text-decoration: none;">
                    <p class="chitiet_tacgia">Tác giả: <?php echo $row_chitiet['tentacgia'] ?></p>
                </a>
                <p><input class="themgiohang" type="submit" value="Thêm giỏ hàng" name="themgiohang"></p>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="tomtat">
            <p>Giới Thiệu: <?php echo $row_chitiet['tomtat'] ?></p>
            <?php
                echo btn_doc(0);
            ?>
        </div>
        <h6><a class="tieude" href="">Sách Cùng Tác Giả </a></h6>


        <?php
        $sql_tg = "SELECT * FROM tbl_sanpham WHERE tentacgia = '" . $row_chitiet['tentacgia'] . "' LIMIT 6";
        $query_tg = mysqli_query($mysqli, $sql_tg);
        $ht = listindex($query_tg);

        $row = mysqli_num_rows($query_tg);
        if ($row >= 6) {
            $ht .=  btn_them(3);
        } else {/*   <div class="btn_them" style="visibility: hidden;"></div>*/
            $ht .= '<div class="btn_them" style="display:none;">Xem thêm</div>';
        }
        echo $ht;
        ?>

        <h6><a class="tieude" href="">Có Thể Bạn Quan Tâm </a></h6>
        <?php
        $sql_qt = "SELECT *FROM tbl_sanpham  LIMIT 6";
        $query_qt = mysqli_query($mysqli, $sql_qt);
        $ht = listindex($query_qt);
        $ht .=  btn_them(4);
        echo $ht;
        ?>
    </div>
<?php
}
?>