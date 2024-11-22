<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký / Đăng nhập</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f5f5dc;
      /* Màu nền be nhạt */
      display: flex;
      flex-direction: column;
      align-items: center;
      color: #000;
      /* Màu chữ đen */
    }

    /* Header styles */
    .topbar {
      width: 100%;
      padding: 10px 0;
      background-color: #000;
      /* Màu nền đen */
      color: #fff;
      /* Chữ màu trắng */
      height: 20px;
      border-radius: 15px;
    }

    .topbar a {
      text-decoration: none;
      color: #d2b48c;
      /* Màu be tối */
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
    }

    .top-info,
    .top-link {
      font-size: 14px;
    }

    .d-flex {
      display: flex;
    }

    .justify-content-between {
      justify-content: space-between;
    }

    /* Form container */
    .form-container {
      margin: 30px auto;
      background: #fff;
      /* Màu nền trắng */
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 700px;
      box-sizing: border-box;
      margin-top: 50px;
    }

    h2 {
      text-align: center;
      color: #000;
      /* Tiêu đề màu đen */
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 4px;
      background-color: #000;
      /* Màu nền nút đen */
      color: #fff;
      /* Màu chữ trắng */
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #333;
      /* Màu nút đen nhạt khi hover */
    }

    .switch {
      text-align: center;
      margin-top: 10px;
    }

    .switch a {
      color: #d2b48c;
      /* Màu liên kết be tối */
      text-decoration: none;
    }

    .switch a:hover {
      text-decoration: underline;
    }

    /* Footer styles */
    .footer-item h4 {
      color: #000;
      /* Tiêu đề footer màu đen */
    }

    .footer-item p,
    .footer-item a {
      color: #000;
      /* Nội dung footer màu đen */
    }

    .footer-item a:hover {
      color: #d2b48c;
      /* Màu be tối khi hover */
    }
  </style>
</head>

<?php if (isset($error_message)): ?>
  <div class="error-message">
    <script>
      alert('<?php echo $error_message; ?>')
    </script>
    
  </div>
<?php endif; ?>



<body>
  <!-- Header -->
  <div class="container topbar">
    <div class="d-flex justify-content-between">
      <div class="top-info ps-2">
        <small class="me-3"><i class="fas fa-map-marker-alt me-2" style="margin-left:10px"></i><a href="#" style="margin:10px">Cầu Giấy, Hà Nội</a></small>
        <small class="me-3"><i class="fas fa-envelope me-2" style="margin-left:10px"></i><a href="#" style="margin:10px">tuttph49773@gmail.com</a></small>
      </div>
      <div class="top-link pe-2">
        <a href="#"><small class="mx-2" style="margin:10px">Chính sách bảo mật</small>/</a>
        <a href="#"><small class="mx-2" style="margin:10px">Điều khoản sử dụng</small>/</a>
        <a href="#"><small class="ms-2" style="margin:10px">Bán hàng và hoàn tiền</small></a>
      </div>
    </div>
  </div>
  <h1>Clothes</h1>
  <!-- Form -->
  <div class="form-container" id="form-container">
    <h2>Đăng ký</h2>
    <form action="" method="post" id="login-form">
      <div class="form-group">
        <label for="name">Tên tài khoản</label>
        <input type="text" name="username">
      </div>
      <div class="form-group">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password">
      </div>
      <div class="form-group">
        <label for="password">Email</label>
        <input type="email" name="email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="password">Số điện thoại</label>
        <input type="text" name="phone" placeholder="Phone">
      </div>
      <button type="submit" name="btn_submit">Đăng ký</button>
    </form>

    <div class="switch">
      <p>Đã có tài khoản? <a href="?act=login">Đăng nhập</a></p>
    </div>

  </div>

  <!-- Footer -->



</body>

</html>