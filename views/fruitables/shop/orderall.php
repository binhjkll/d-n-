<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quần áo đông Nam Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    /* Sử dụng Bootstrap để thay đổi màu nền và chữ khi hover */
    /* Nút chính */
    .btn-aa {
        background-color: #28a745;
        /* Màu nền xanh lá */
        color: white;
        /* Màu chữ trắng */
        border: none;
        /* Không có viền */
        padding: 12px 24px;
        /* Khoảng cách bên trong */
        font-size: 16px;
        /* Cỡ chữ */
        font-weight: bold;
        /* Làm đậm chữ */
        border-radius: 8px;
        /* Bo góc */
        cursor: pointer;
        /* Đổi con trỏ thành hình tay */
        transition: all 0.3s ease;
        /* Hiệu ứng khi di chuột */
    }

    /* Hiệu ứng khi di chuột vào nút */
    .btn-aa:hover {
        background-color: #218838;
        /* Màu khi di chuột vào */
        transform: translateY(-3px);
        /* Đẩy nút lên một chút */
    }

    /* Hiệu ứng khi nhấn nút */
    .btn-aa:active {
        background-color: #1e7e34;
        /* Màu khi nhấn */
        transform: translateY(0);
        /* Về vị trí ban đầu khi nhấn */
    }

    /* Hiệu ứng focus khi tab vào nút */
    .btn-aa:focus {
        outline: none;
        /* Xóa đường viền focus */
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.5);
        /* Tạo hiệu ứng viền xanh khi focus */
    }
</style>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <?php
    require "inc/header.php";
    ?>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="" method="post" onsubmit="return validateForm()">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="form-item">
                            <label class="form-label my-3">Số điện thoại<sup>*</sup></label>
                            <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $phone ?>">
                            <span id="phone-error" style="color: red;"></span> <!-- Hiển thị lỗi số điện thoại -->
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Địa chỉ <sup>*</sup></label>
                            <input type="text" name="address" class="form-control" id="address" value="<?php echo $address ?>">
                            <span id="address-error" style="color: red;"></span> <!-- Hiển thị lỗi địa chỉ -->
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng cộng</th>
                                        <th></th>
                                        <th scope="col">Size</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $orderTotal = 0; // Biến lưu tổng tiền đơn hàng
                                    foreach ($cartItems as $item):
                                        $itemTotal = $item->quantity * $item->price; // Tính tổng tiền mỗi sản phẩm
                                        $orderTotal += $itemTotal; // Cộng vào tổng tiền đơn hàng
                                    ?>
                                        <tr>
                                            <td>
                                                <div class=" align-items-center mt-1">
                                                    <img src="<?php echo ($item->product_img); ?>" alt="Product" style="width: 90px;">
                                                </div>

                                            </td>
                                            <td class="py-5"><?php echo ($item->product_name); ?></td>
                                            <td class="py-5">$<?php echo number_format((float)$item->price); ?></td>
                                            <td class="py-5"><?php echo ($item->quantity); ?></td>
                                            <td class="py-5">$<?php echo number_format($itemTotal); ?></td>
                                            <td></td>
                                            <td colspan="2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="size[<?php echo $item->variant_id; ?>]" id="size1_<?php echo $item->variant_id; ?>" value="S">
                                                    <label class="form-check-label" for="size1_<?php echo $item->variant_id; ?>">S</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="size[<?php echo $item->variant_id; ?>]" id="size2_<?php echo $item->variant_id; ?>" value="M">
                                                    <label class="form-check-label" for="size2_<?php echo $item->variant_id; ?>">M</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="size[<?php echo $item->variant_id; ?>]" id="size3_<?php echo $item->variant_id; ?>" value="XL">
                                                    <label class="form-check-label" for="size3_<?php echo $item->variant_id; ?>">XL</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="size[<?php echo $item->variant_id; ?>]" id="size4_<?php echo $item->variant_id; ?>" value="XXL">
                                                    <label class="form-check-label" for="size4_<?php echo $item->variant_id; ?>">XXL</label>
                                                </div>
                                                <span id="size-error-<?php echo $item->variant_id; ?>" style="color: red;"></span> <!-- Hiển thị lỗi size -->
                                            </td>
                                        </tr>
                                        <input type="hidden" name="variant_id[]" value="<?php echo ($item->variant_id); ?>">
                                        <input type="hidden" name="quantity[]" value="<?php echo ($item->quantity); ?>">
                                        <input type="hidden" name="price[]" value="<?php echo ($item->price); ?>">
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding-right: 0;"><strong> Tổng tiền đơn hàng:</strong></td>
                                        <td colspan="3" class="text-start" style="padding-left: 0;">$<?php echo number_format($orderTotal); ?></td>
                                    </tr>

                                    <input type="hidden" name="delivery_status" value="Đang chuẩn bị">
                                    <input type="hidden" name="total_amount" value="<?php echo $orderTotal; ?>">
                                </tbody>
                            </table>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_status" id="payment1" value="thanh toán khi nhận hàng">
                                <label class="form-check-label" for="payment1">Thanh toán khi nhận hàng</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_status" id="payment2" value="thanh toán trực tiếp">
                                <label class="form-check-label" for="payment2">Thanh toán trực tiếp</label>
                            </div>
                            <span id="payment-status-error" style="color: red;"></span> <!-- Hiển thị lỗi phương thức thanh toán -->
                        </div>
                        <div class=" f-4 text-center align-items-center justify-content-center pt-5">
                            <button type="submit" name="btn_submit" class="btn-aa">Mua</button>
                        </div>

                    </div>
                </div>
            </form>

            <script>
                function validateForm() {
                    let isValid = true;

                    // Reset previous errors
                    document.getElementById("phone-error").innerText = "";
                    document.getElementById("address-error").innerText = "";
                    document.getElementById("payment-status-error").innerText = "";

                    // Validate phone
                    let phone = document.getElementById("phone").value;
                    let phoneRegex = /^[0-9]{10}$/; // Kiểm tra số điện thoại 10 chữ số
                    if (!phone || !phoneRegex.test(phone)) {
                        document.getElementById("phone-error").innerText = "Vui lòng nhập số điện thoại hợp lệ.";
                        isValid = false;
                    }

                    // Validate address
                    let address = document.getElementById("address").value;
                    if (!address) {
                        document.getElementById("address-error").innerText = "Vui lòng nhập địa chỉ.";
                        isValid = false;
                    }

                    // Validate size selection for each product
                    let sizeErrors = false;
                    document.querySelectorAll('input[name^="size"]').forEach(function(input) {
                        let productId = input.name.split('[')[1].split(']')[0];
                        let selectedSize = document.querySelector(`input[name="size[${productId}]"]:checked`);
                        if (!selectedSize) {
                            document.getElementById(`size-error-${productId}`).innerText = "***";
                            sizeErrors = true;
                        } else {
                            document.getElementById(`size-error-${productId}`).innerText = "";
                        }
                    });

                    if (sizeErrors) {
                        isValid = false;
                    }

                    // Validate payment method selection
                    let paymentStatus = document.querySelector('input[name="payment_status"]:checked');
                    if (!paymentStatus) {
                        document.getElementById("payment-status-error").innerText = "Vui lòng chọn phương thức thanh toán.";
                        isValid = false;
                    }

                    return isValid;
                }
            </script>


        </div>
    </div>
    <!-- Checkout Page End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Clothes</h1>
                            <!-- <p class="text-secondary mb-0">Fresh products</p> -->
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>