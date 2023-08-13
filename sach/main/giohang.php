<!-- <?php
        /* session_start();
session_destroy(); */
        ?> -->
<style>
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: solid;
        border-width: 1px;
    }

    th:nth-child(1) {
        width: 15%;
    }

    th:nth-child(2) {
        width: 30%;
    }

    th:nth-child(3) {
        width: 10%;
    }

    th:nth-child(6) {
        width: 5%;
    }

    table {
        width: 100%;
        text-align: center;
        border-collapse: collapse;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .noidung img {
        height: 130px;
        width: 100px;
        padding: 10px;
        /* float: left; */
    }

    .bang {
        width: 80%;
        /* Đặt chiều rộng của bảng */
        margin: 0 auto;
    }


    .gioithieu {

        position: relative;
        border: none;
    }

    .p1 {
        position: absolute;
        top: 0;
        left: 10px;
    }

    .p2 {
        position: absolute;
        bottom: 0;
        left: 10px;

    }

    .bang a i {
        color: black;
        /* padding: 5px; */
    }

    a i:hover {
        color: red;
    }
</style>
<div class="list_index">
    <div class="bang">
        <table>
            <tr>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá </th>
                <th>Thành tiền</th>
                <th>Xóa</th>
            </tr>
            <?php

            /*  $idsanpham  = $_GET['idsanpham'];
            $sql =  "SELECT * FROM tbl_giohangchitiet where id_sanpham = '" . $idsanpham . "' AND id_khachhang = '" . $idkhachhang . "' LIMIT 1"; 
            $query = mysqli_query($mysqli, $sql);
            $row = mysqli_num_rows($query); */
            if (isset($_SESSION['dangky']) || isset($_SESSION['dangnhap'])) {
                $idkhachhang = $_SESSION['id_khachhang'];
                $sqlht = "SELECT tbl_sanpham.*
                          FROM tbl_sanpham
                          JOIN tbl_giohangchitiet ON tbl_sanpham.id_sanpham = tbl_giohangchitiet.id_sanpham
                          WHERE tbl_giohangchitiet.id_khachhang = '" . $idkhachhang . "' ";

                $queryht = mysqli_query($mysqli, $sqlht);
                if ($queryht) {
                    $new_products = array();
                    while ($row = mysqli_fetch_array($queryht)) {

                        $sql = "SELECT * FROM tbl_giohangchitiet WHERE id_sanpham = '" . $row['id_sanpham'] . "' AND id_khachhang = '" . $idkhachhang . "' ";
                        $result = mysqli_query($mysqli, $sql);
                        if ($result) {
                            $row_soluong = mysqli_fetch_assoc($result);
                            $soluong = $row_soluong['soluong'];
                        } else {
                            $soluong = 1;
                        }


                        $new_products[] = array(
                            'tensanpham' => $row['tensanpham'], 'id' => $row['id_sanpham'], 'soluong' => $soluong, 'giasp' => $row['giasp'],
                            'hinhanh' => $row['hinhanh'], 'tentacgia' => $row['tentacgia']
                        );
                    }
                    $_SESSION['cart'] = $new_products;
                }
            }

            if (isset($_SESSION['cart'])){
                $tongtien = 0;
                foreach ($_SESSION['cart'] as $cart_item) {
                    $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                    $tongtien += $thanhtien;
            ?>
                    <tr>
                        <td class="noidung">
                            <img src="../../images/<?php echo $cart_item['hinhanh'] ?>" alt="">
                            <!-- <p><?php echo $cart_item['hinhanh'] ?></p> -->
                        </td>
                        <td class="gioithieu">
                            <p class="p1"><?php echo $cart_item['tensanpham'] ?></p>
                            <p class="p2"><?php echo $cart_item['tentacgia'] ?></p>
                        </td>
                        <td><a href="sach/main/themgiohang.php?cong=<?php echo $cart_item['id'] ?>"><i class="fa-solid fa-square-plus"></i></a>
                            <?php echo $cart_item['soluong'] ?>
                            <a href="sach/main/themgiohang.php?tru=<?php echo $cart_item['id'] ?>"><i class="fa-solid fa-square-minus"></i></i></a>
                        </td>
                        <td><?php echo number_format($cart_item['giasp'], 0, ',', '.') . 'vnđ' ?></td>
                        <td><?php echo number_format($thanhtien, 0, ',', '.') . 'vnđ' ?></td>
                        <td><a href="sach/main/themgiohang.php?xoa=<?php echo $cart_item['id'] ?>"><i class="fa-solid fa-trash-can"></i></a></td>
                    </tr>
                <?php
                }

                ?>

                
                    <tr>
                        <td colspan="6">
                            <p style="float:left;">Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . 'vnđ' ?></p>
                            <p style="float:right;"><a href="sach/main/themgiohang.php?xoatatca=1">Xóa tất cả</a></p>
                        </td>
                    </tr>
                


            <?php
            } else {

            ?>
                <tr>
                    <td colspan="6">
                        <p>Hiện tại giỏ hàng trống</p>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>