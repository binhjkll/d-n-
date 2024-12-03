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
    <form action="" method="post" id="registrationForm">
      <div class="form-group">
        <label for="name">Tên tài khoản</label>
        <input type="text" name="username" id="username">
        <span id="usernameError" style="color: red;"></span>
      </div>
      <div class="form-group">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password" id="password">
        <span id="passwordError" style="color: red;"></span>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <span id="emailError" style="color: red;"></span>
      </div>
      <div class="form-group">
        <label for="phone">Số điện thoại</label>
        <input type="text" name="phone" id="phone">
        <span id="phoneError" style="color: red;"></span>
      </div>
      <div class="form-group">
        <label for="address">Địa chỉ</label>
        <input type="text" name="address" id="address" placeholder="Có thể để trống">
        <span id="addressError" style="color: red;"></span>
      </div>
      <button type="submit" name="btn_submit">Đăng ký</button>
    </form>

    <script>
      document.getElementById("registrationForm").addEventListener("submit", function(event) {
        let isValid = true;

        // Xóa thông báo lỗi cũ
        document.getElementById("usernameError").textContent = "";
        document.getElementById("passwordError").textContent = "";
        document.getElementById("emailError").textContent = "";
        document.getElementById("phoneError").textContent = "";
        document.getElementById("addressError").textContent = "";

        // Kiểm tra tên tài khoản
        if (document.getElementById("username").value === "") {
          document.getElementById("usernameError").textContent = "Tên tài khoản không được để trống.";
          isValid = false;
        }

        // Kiểm tra mật khẩu
        if (document.getElementById("password").value === "") {
          document.getElementById("passwordError").textContent = "Mật khẩu không được để trống.";
          isValid = false;
        }

        // Kiểm tra email
        let email = document.getElementById("email").value;
        let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(email)) {
          document.getElementById("emailError").textContent = "Email không hợp lệ.";
          isValid = false;
        }

        // Kiểm tra số điện thoại
        let phone = document.getElementById("phone").value;
        let phoneRegex = /^[0-9]{10}$/;
        if (!phoneRegex.test(phone)) {
          document.getElementById("phoneError").textContent = "Số điện thoại không hợp lệ. (10 chữ số)";
          isValid = false;
        }

        // Kiểm tra địa chỉ (có thể để trống)
        let address = document.getElementById("address").value;
        if (address.length > 0 && address.length < 5) {
          document.getElementById("addressError").textContent = "Địa chỉ quá ngắn.";
          isValid = false;
        }

        // Nếu có lỗi, ngừng gửi form
        if (!isValid) {
          event.preventDefault();
        }
      });
    </script>


    <div class="switch">
      <p>Đã có tài khoản? <a href="?act=login">Đăng nhập</a></p>
    </div>

  </div>

  <!-- Footer -->



</body>

</html>