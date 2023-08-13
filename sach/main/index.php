<?php

    $query_moi = sql_tieubieu(0,0, 6);
    /* $query_moi = mysqli_query($mysqli, $sql_moi);
 */
    $query_sapphathanh = sql_tieubieu(1,0, 6);
    /* $query_sapphathanh = mysqli_query($mysqli, $sql_sapphathanh); */

    $query_banchay = sql_tieubieu(2,0, 6);
    /* $query_banchay = mysqli_query($mysqli, $sql_banchay); */

    $sql = "SELECT *FROM tbl_sanpham WHERE noibat = 0 LIMIT 5";
    $query = mysqli_query($mysqli, $sql);
    

?>

<div class="tieubieu">
    <ul class="list_tieubieu">
    <?php
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <li>
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                <img src="../../images/<?php echo $row['hinhanh'] ?>" alt="">
            </a>
        </li>
    <?php
    }
    ?>
    </ul>
    
</div>

<div class="maincontent_index">
    <!-- <h6><a class="tieude" href="">Sách Mới </a></h6> -->
    <h6 class="tieude">Sách Mới</h6>
    <?php
    $spmoi = listindex($query_moi);
    $spmoi .=  btn_them(0);
    echo $spmoi;
    ?>
    <h6 class="tieude">Sắp Phát Hành</h6>
    <?php
    $spmoi = listindex($query_sapphathanh);
    $spmoi .=  btn_them(1);
    echo $spmoi;
    ?>
    <h6 class="tieude">Sách Bán Chạy</h6>
    <?php
    $spmoi = listindex($query_banchay);
    $spmoi .=  btn_them(2);
    echo $spmoi;
    ?>
</div>
