<form action="" method="post">

    <input type="text" name="username">
    <input type="password" name="password">
    <button type="submit" name="btn_submit">Đăng nhập</button>

</form>


<?php
session_start();

if (isset($_POST["btn_submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $isLoginSuccessful = false; // Biến cờ để kiểm tra đăng nhập thành công

    foreach ($login as $value) {
        if ($username == $value->username && $password == $value->password) {
            $isLoginSuccessful = true;
            break; // Thoát khỏi vòng lặp khi đăng nhập thành công
        }
    }

    // Kiểm tra biến cờ sau vòng lặp
    if ($isLoginSuccessful) {
        
        echo "Đăng nhập thành công!";
        header('location:index.php');
        $_SESSION["username"] = $username;
        // include_once "views/da.php";
    } else {
        echo "Tài khoản hoặc mật khẩu của bạn sai!";
    }
    
}

?>
