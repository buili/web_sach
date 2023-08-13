<?php
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    unset($_SESSION['dangky']);
    unset($_SESSION['dangnhap']);
    unset($_SESSION['cart']);
}
?>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="index.php?quanly=tintuc">Giới thiệu</a></li>
                <li class="nav-item"><a class="nav-link" href="#lien-he">Liên hệ</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Danh mục sản phẩm
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                        ?>
                            <li><a class="dropdown-item" href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="index.php?quanly=giohang">
                        <i class="fa-solid fa-cart-shopping fa-bounce" style="color: #ffffff;"></i>
                        <span class="ms-1">Giỏ hàng</span>
                    </a>
                </li>
                <?php
                if (isset($_SESSION['dangky']) || isset($_SESSION['dangnhap'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="index.php?dangxuat=1">
                            <i class="fa-solid fa-user" style="color: #fafafa;"></i>
                            <span class="ms-1">Đăng xuất</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="index.php?quanly=thaydoimatkhau">Thay đổi mật khẩu</a></li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="index.php?quanly=dangnhap">
                            <i class="fa-solid fa-user" style="color: #fafafa;"></i>
                            <span class="ms-1">Tài khoản</span>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
            <form class="d-flex" role="search" action="index.php?quanly=timkiem" method="POST">
                <input class="form-control me-2" type="search" name="tukhoa" placeholder="Tìm kiếm.." aria-label="Search">
                <button class="btn btn-outline-success" name="timkiem" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>