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