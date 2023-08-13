<div class="sidebar">
    <h4 style="text-align: center; font-size:90%; text-transform: uppercase; margin-top: 5px;">Danh mục nổi bật</h4>
    <ul class="list_sidebar">
    <?php
    $sql_noibat = "SELECT *FROM tbl_danhmuc WHERE noibat = 1 ORDER BY id_danhmuc ASC LIMIT 5" ;
    $query_noibat = mysqli_query($mysqli, $sql_noibat);
    while ($row = mysqli_fetch_array($query_noibat)) {
    ?>
        <li style="text-transform: uppercase;"><a href="index.php?quanly=danhmucsanpham&id=<?php echo $row['id_danhmuc'] ?>">
        <?php echo $row['tendanhmuc'] ?></a></li>
    <?php
    }
    ?>
     </ul>
</div>