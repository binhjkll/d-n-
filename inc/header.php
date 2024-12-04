<style>
    /* Tạo hiệu ứng hover cho các phần tử trong menu dropdown */
    .dropdown-item {
        color: #000000 !important;
        /* Màu chữ mặc định */
        transition: background-color 0.3s, color 0.3s;
        /* Hiệu ứng chuyển màu */
    }

    /* Khi hover vào các phần tử trong dropdown */
    .dropdown-item:hover {
        background-color: #000;
        /* Nền đen khi hover */
        color: #fff !important;
        /* Chữ trắng khi hover */
    }
</style>

<?php
// session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $phone = $_SESSION['phone'];  // Lấy thông tin người dùng từ session
    $address = $_SESSION['address'];
    $email = $_SESSION['email'];
    // $ngaymua= $_SESSION['ngaymua']; // Lấy thông tin người dùng từ session
}
?>
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Cầu Giấy, Hà Nội</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">tuttph49773@gmail.com</a></small>
            </div>
            <div class="top-link pe-2">
                <?php
                if (isset($_SESSION['username'])) {
                ?>
                    <!-- Hiển thị khi đã đăng nhập -->
                    <a class="text-white mx-2">
                        Xin chào, <?php echo $username ?>
                    </a>
                    <a class="text-white mx-2">|</a>
                    <a href="?act=dangxuat" class="text-white"><small class="text-white mx-2">Đăng Xuất</small></a>
                <?php
                } else {
                ?>
                    <a href="?act=register" class="text-white"><small class="text-white mx-2">Đăng Ký</small></a> /
                    <a href="?act=login" class="text-white"><small class="text-white mx-2">Đăng Nhập</small></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="?act=trangchu" class="navbar-brand">
                <h1 class="text-primary display-6">Clothes</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="?act=trangchu" class="nav-item nav-link active">Home</a>
                    <a href="?act=shophtml" class="nav-item nav-link">Shop</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="?act=cart" class="dropdown-item">Cart</a>
                            <a href="?act=userpro" class="dropdown-item">Purchased order</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link">Contact</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <!-- Tìm kiếm -->
                    <form action="index.php" method="GET" class="d-flex justify-content-center me-4" style="margin-bottom: 0px !important;">
                        <div class="input-group" style="max-width: 500px;">
                            <input type="hidden" name="act" value="shophtml">
                            <input type="search" class="form-control search-input" name="keyword" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
                            <button type="submit" class="btn btn-primary search-button" data-bs-toggle="modal" data-bs-target="#searchModal">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <!-- end tìm kiếm -->
                    <?php
                    $cartCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
                    ?>
                    <a href="index.php?act=cart" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>

                    </a>
                    <a href="?act=userpro" class="my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>