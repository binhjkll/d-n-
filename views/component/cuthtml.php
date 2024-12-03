<<<<<<< HEAD
<style>
    .navbar-nav li a {
        color: #333;
        background-color: transparent;
        transition: all 0.3s ease;
    }
=======
        <!-- Left Panel -->
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="?act=list"><i class="menu-icon fa fa-laptop"></i>Quản lý sản phẩm</a>
                        </li>
                        <li>
                            <a href="?act=danhmuc"><i class="menu-icon fa fa-cube"></i>Quản lý danh mục</a>
                        </li>
                        <li>
                        </li>
                        <li>
                            <a href="?act=listuser"><i class="menu-icon fa fa-users"></i>Quản lý người dùng</a>
                        </li>
                        <li>
                            <a href="?act=quanlyorder"><i class="menu-icon fa fa-truck"></i>Quản lý đơn hàng</a>
                        </li>
                        <li>
                            <a href="?act=binhluan"><i class="menu-icon fa fa-comments"></i>Quản lý bình luận</a>
                        </li>
                        <li>
                            <a href="?act=banner_manager"><i class="menu-icon fa fa-cube"></i>Quản lý banner</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
>>>>>>> 0eaa651cb4380c0d2a7fae9ac8a67251b663ea01

    .navbar-nav li.active a {
        color: #fff;
        background-color: #007bff;
        /* Màu xanh bạn muốn */
        font-weight: bold;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuItems = document.querySelectorAll(".navbar-nav li a");

        // Lấy URL hiện tại
        const currentURL = window.location.href;

        menuItems.forEach(item => {
            // Kiểm tra nếu href của mục menu khớp với URL hiện tại
            if (currentURL.includes(item.getAttribute("href"))) {
                // Thêm lớp active vào mục phù hợp
                item.parentElement.classList.add("active");
            } else {
                // Loại bỏ lớp active nếu không khớp
                item.parentElement.classList.remove("active");
            }
        });
    });                       
</script>


<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="?act=list"><i class="menu-icon fa fa-laptop"></i>Quản lý sản phẩm</a>
                </li>

                <li>
                    <a href="?act=danhmuc"><i class="menu-icon fa fa-cube"></i>Quản lý danh mục</a>
                </li>
                <li>
                    <a href="?act=listuser"><i class="menu-icon fa fa-users"></i>Quản lý người dùng</a>
                </li>
                <li>
                    <a href="?act=quanlyorder"><i class="menu-icon fa fa-truck"></i>Quản lý đơn hàng</a>
                </li>
                <li>
                    <a href="comment-management.html"><i class="menu-icon fa fa-comments"></i>Quản lý bình luận</a>
                </li>
            </ul>

        </div>
    </nav>
</aside>

<!-- /#left-panel -->
<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];  // Lấy thông tin người dùng từ session
}
?>
<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="?act=list"><img src="image/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="image/logo2.png" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="header-left">
                    <div class="top-link pe-2">
                        <?php
                        if (isset($_SESSION['username'])) {
                        ?>
                            <!-- Hiển thị khi đã đăng nhập -->
                            <a class="text-white mx-2">
                                Xin chào, <?php echo $username ?>
                            </a>
                            <a class="text-white mx-2">|</a>
                            <a href="?act=dangxuat"><small>Đăng Xuất</small></a>
                        <?php
                        } else {
                        ?>
                            <a href="?act=register"><small>Đăng Ký</small></a> /
                            <a href="?act=login"><small>Đăng Nhập</small></a>
                        <?php } ?>
                    </div>

                </div>
            </div>
    </header>