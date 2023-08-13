<?php
/* session_start();
session_destroy(); */
?>

<?php
session_start();
include('../../admincp/config/config.php');

if (isset($_SESSION['dangky']) || isset($_SESSION['dangnhap'])) {

    $idkhachhang = $_SESSION['id_khachhang'];
    $id = $_GET['cong'];
    $sql =  "SELECT * FROM tbl_giohangchitiet where id_sanpham = '" . $id . "' AND id_khachhang = '" . $idkhachhang . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    if (isset($_GET['cong'])) {
        if ($row > 0) {
            $check = true;
            $sql_update = "UPDATE tbl_giohangchitiet SET soluong = '" . ($row['soluong'] + 1) . "'   WHERE id_sanpham = '" . $row['id_sanpham'] . "'  AND id_khachhang = '" . $idkhachhang . "'";
            $query_update = mysqli_query($mysqli, $sql_update);
        }
        header('Location:../../index.php?quanly=giohang');
    }
} else {
    if (isset($_GET['cong'])) {
        $id = $_GET['cong'];
        foreach ($_SESSION['cart'] as $cart_item) {
            if ($cart_item['id'] != $id) {
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'], 'tentacgia' => $cart_item['tentacgia']
                );
                $_SESSION['cart'] = $product;
            } else {
                $tangsoluong = $cart_item['soluong'] + 1;
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $tangsoluong, 'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'], 'tentacgia' => $cart_item['tentacgia']
                );
            }
            $_SESSION['cart'] = $product;
        }
        /* echo '<pre>';
        print_r($product);
        echo '</pre>'; */
        header('Location:../../index.php?quanly=giohang');
    }
}

if (isset($_SESSION['dangky']) || isset($_SESSION['dangnhap'])) {

    $idkhachhang = $_SESSION['id_khachhang'];
    $id = $_GET['tru'];
    $sql =  "SELECT * FROM tbl_giohangchitiet where id_sanpham = '" . $id . "' AND id_khachhang = '" . $idkhachhang . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    if (isset($_GET['tru'])) {
        if ($row > 0) {
            $check = true;
            $giamsoluong = $row['soluong'] - 1;
            if ($giamsoluong > 1) {
                $sql_update = "UPDATE tbl_giohangchitiet SET soluong = '" . $giamsoluong  . "'   WHERE id_sanpham = '" . $row['id_sanpham'] . "'  AND id_khachhang = '" . $idkhachhang . "'";
                $query_update = mysqli_query($mysqli, $sql_update);
            } else {
                $sql_delete = "DELETE FROM tbl_giohangchitiet  WHERE id_sanpham = '" . $row['id_sanpham'] . "'  AND id_khachhang = '" . $idkhachhang . "'";
                $query_delete = mysqli_query($mysqli, $sql_delete);
            }
        }
        header('Location:../../index.php?quanly=giohang');
    }
} else {
    if (isset($_GET['tru'])) {
        $id = $_GET['tru'];
        foreach ($_SESSION['cart'] as $cart_item) {
            if ($cart_item['id'] != $id) {
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'], 'tentacgia' => $cart_item['tentacgia']
                );
                $_SESSION['cart'] = $product;
            } else {
                $giamsoluong = $cart_item['soluong'] - 1;
                if ($cart_item['soluong'] > 1) {
                    $product[] = array(
                        'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $giamsoluong, 'giasp' => $cart_item['giasp'],
                        'hinhanh' => $cart_item['hinhanh'], 'tentacgia' => $cart_item['tentacgia']
                    );
                }
            }
            $_SESSION['cart'] = $product;
        }
        /* echo '<pre>';
        print_r($product);
        echo '</pre>'; */
        header('Location:../../index.php?quanly=giohang');
    }
}

if (isset($_SESSION['dangky']) || isset($_SESSION['dangnhap'])) {
    $idkhachhang = $_SESSION['id_khachhang'];
    $id = $_GET['xoa'];
    $sql =  "SELECT * FROM tbl_giohangchitiet where id_sanpham = '" . $id . "' AND id_khachhang = '" . $idkhachhang . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    if (isset($_GET['xoa'])) {
        if ($row > 0) {
            $sql_delete = "DELETE FROM tbl_giohangchitiet  WHERE id_sanpham = '" . $row['id_sanpham'] . "'  AND id_khachhang = '" . $idkhachhang . "'";
            $query_delete = mysqli_query($mysqli, $sql_delete);
        }
        header('Location:../../index.php?quanly=giohang');
    }
} else {
    if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
        $id = $_GET['xoa'];
        foreach ($_SESSION['cart'] as $cart_item) {
            if ($cart_item['id'] != $id) {
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'], 'tentacgia' => $cart_item['tentacgia']
                );
            }

            $_SESSION['cart'] = $product;
            header('Location:../../index.php?quanly=giohang');
        }
    }
}

if (isset($_SESSION['dangky']) || isset($_SESSION['dangnhap'])) {
    $idkhachhang = $_SESSION['id_khachhang'];
    $sql =  "SELECT * FROM tbl_giohangchitiet WHERE  id_khachhang = '" . $idkhachhang . "' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
        if ($row > 0) {
            $sql_delete = "DELETE FROM tbl_giohangchitiet  WHERE  id_khachhang = '" . $idkhachhang . "'";
            $query_delete = mysqli_query($mysqli, $sql_delete);
            
        }
        unset($_SESSION['cart']);
        
        header('Location:../../index.php?quanly=giohang');
    }
} else {
    if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
        unset($_SESSION['cart']);
        header('Location:../../index.php?quanly=giohang');
    }
}

if (isset($_SESSION['dangky']) || isset($_SESSION['dangnhap'])) {
    if (isset($_POST['themgiohang'])) {
        $idsanpham  = $_GET['idsanpham'];

        $soluong = 1;
        $idkhachhang = $_SESSION['id_khachhang'];
        /* $_SESSION['user_id'] = $idkhachhang; */
        $sql = "SELECT * FROM tbl_giohang WHERE id_khachhang = '" . $idkhachhang . "'";
        $query = mysqli_query($mysqli, $sql);
        $row1 = mysqli_num_rows($query);

        $sql =  "SELECT * FROM tbl_giohangchitiet where id_sanpham = '" . $idsanpham . "' AND id_khachhang = '" . $idkhachhang . "' LIMIT 1";
        $query2 = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query2);
        $row2 = mysqli_num_rows($query2);

        if ($row1 > 0) {
            if ($row2 > 0) {
                $check = true;
                $sql_update = "UPDATE tbl_giohangchitiet SET soluong = '" . ($row['soluong'] + 1) . "'   WHERE id_sanpham = '" . $row['id_sanpham'] . "'  AND id_khachhang = '" . $idkhachhang . "'";
                $query_update = mysqli_query($mysqli, $sql_update);
            } else {
                $sqlct = "INSERT INTO tbl_giohangchitiet(id_khachhang, id_sanpham, soluong) VALUE('" . $idkhachhang . "', '" . $idsanpham . "', '" . $soluong . "')";
                mysqli_query($mysqli, $sqlct);
            }
        } else {
            $sql = "INSERT INTO tbl_giohang(id_khachhang) VALUE('" . $idkhachhang . "')";
            $sqlct = "INSERT INTO tbl_giohangchitiet(id_khachhang, id_sanpham, soluong) VALUE('" . $idkhachhang . "', '" . $idsanpham . "', '" . $soluong . "')";
            mysqli_query($mysqli, $sql);
            mysqli_query($mysqli, $sqlct);
        }

        /* $sqlht = "SELECT tbl_sanpham.*
                  FROM tbl_sanpham
                  JOIN tbl_giohangchitiet ON tbl_sanpham.id_sanpham = tbl_giohangchitiet.id_sanpham
                  WHERE tbl_giohangchitiet.id_khachhang = '" . $idkhachhang . "' ";


        $queryht = mysqli_query($mysqli, $sqlht);
        if ($queryht) {

            while ($row = mysqli_fetch_array($queryht)) {
                $sql = "SELECT * FROM tbl_giohangchitiet WHERE id_sanpham = '" . $row['id_sanpham'] . "' AND id_khachhang = '" . $idkhachhang . "' ";
                $result = mysqli_query($mysqli, $sql);
                if ($result) {
                    $row_soluong = mysqli_fetch_assoc($result);
                    $soluong = $row_soluong['soluong'];

                    
                } else {
                    $soluong = 1;
                }

                $check = false;
                $new_products[] = array(
                    'tensanpham' => $row['tensanpham'], 'id' => $row['id_sanpham'], 'soluong' => $soluong, 'giasp' => $row['giasp'],
                    'hinhanh' => $row['hinhanh'], 'masp' => $row['masp']
                );
            }
            if ($check == false) {
                $_SESSION['cart'] = $new_products;
            } */



        /* echo '<pre>';
            print_r($new_products);
            echo '</pre>';
            echo '<pre>';
            print_r($products);
            echo '</pre>'; */
        header('Location:../../index.php?quanly=giohang');
    }
} else {
    if (isset($_POST['themgiohang'])) {
        /*  session_destroy(); */
        $id = $_GET['idsanpham'];
        $soluong = 1;
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '" . $id . "' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
        if ($row) {
            $new_product = array(array(
                'tensanpham' => $row['tensanpham'], 'id' => $id, 'soluong' => $soluong, 'giasp' => $row['giasp'],
                'hinhanh' => $row['hinhanh'], 'tentacgia' =>  $row['tentacgia']
            ));

            if (isset($_SESSION['cart'])) {
                $check = false;
                foreach ($_SESSION['cart'] as $cart_item) {
                    if ($cart_item['id'] == $id) {
                        $product[] = array(
                            'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'] + 1, 'giasp' => $cart_item['giasp'],
                            'hinhanh' => $cart_item['hinhanh'], 'tentacgia' => $cart_item['tentacgia']
                        );
                        $check = true;
                    } else {
                        $product[] = array(
                            'tensanpham' => $cart_item['tensanpham'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'], 'giasp' => $cart_item['giasp'],
                            'hinhanh' => $cart_item['hinhanh'], 'tentacgia' => $cart_item['tentacgia']
                        );
                    }
                }
                if ($check == false) {
                    $_SESSION['cart'] = array_merge($product, $new_product);
                } else {
                    $_SESSION['cart'] = $product;
                }
            } else {
                $_SESSION['cart'] = $new_product;
            }
        }

        /* print_r($new_product);
        print_r($product); */
        /* echo '<pre>';
        print_r($product);
        echo '</pre>';

        echo '<pre>';
        print_r($new_product);
        echo '</pre>'; */
        header('Location:../../index.php?quanly=giohang');
    }
}
