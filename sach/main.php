<div class="main">
    <div class="row">
        <!-- <p style="height: 600px;"></p> -->
        <?php
        include("function/function.php");


        ?>
        <!-- <div class="maincontent"> -->
        <?php
        if (isset($_GET['quanly'])) {
            $tam = $_GET['quanly'];
        } else {
            $tam = '';
        }
        if ($tam == 'danhmucsanpham') {
            include("main/danhmuc.php");
        } elseif ($tam == 'sanpham') {
            include("main/sanpham.php");
        }elseif ($tam == 'dangnhap') {
            include("main/dangnhap.php");
        }elseif ($tam == 'dangky') {
            include("main/dangky.php");
        }elseif ($tam == 'giohang') {
            include("main/giohang.php");
        }elseif ($tam == 'timkiem') {
            include("main/timkiem.php");
         }elseif ($tam == 'hienthithem') {
            include("main/hienthithem.php");
         }elseif ($tam == 'thaydoimatkhau') {
            include("main/thaydoimatkhau.php");
         } else {
            include("sidebar/sidebar.php");
            include("main/index.php");
        }
        ?>
        <!-- </div> -->
    </div>