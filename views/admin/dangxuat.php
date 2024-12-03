<?php
session_start();

if (isset($_SESSION["user"])) {
    unset($_SESSION["user"]);
    // echo "Đăng xuất thành công!";
}
header("location: dangnhap.php");
exit;
