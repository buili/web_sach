<?php

if(isset($_POST['timkiem'])){
    $tukhoa = $_POST['tukhoa'];
}
$sql_pro = "SELECT * FROM  tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
    AND tbl_sanpham.tensanpham LIKE '%".$tukhoa."%'";
$query_pro = mysqli_query($mysqli, $sql_pro);

?>
<h3>Từ khóa tìm kiếm: <?php echo $_POST['tukhoa']; ?></h3>
<?php
$timkiem = listindex($query_pro);
echo $timkiem;