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

<body>

    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div> -->
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
        <h1 class="text-center text-white display-6">Purchased order</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="?act=trangchu">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Purchased order</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Purchased order</h1>
            <!-- <form action="" method="post"> -->
            <table class="table table-bordered table-hover table-striped table-sm rounded" style="overflow: hidden;">
                <thead class="thead-dark text-center" style="background-color: #f8f9fa; color: #333; border-radius: 8px;">
                    <tr>
                        <th class="text-center align-middle" style="font-weight: bold;">Order ID</th>
                        <th class="text-center align-middle" style="font-weight: bold;">Total Amount</th>
                        <th class="text-center align-middle" style="font-weight: bold;">Payment Status</th>
                        <th class="text-center align-middle" style="font-weight: bold;">Delivery Status</th>
                        <th class="text-center align-middle" style="font-weight: bold;">Created At</th>
                        <th class="text-center align-middle" style="font-weight: bold;">Name</th>
                        <th class="text-center align-middle" style="font-weight: bold;">Address</th>
                        <th class="text-center align-middle" style="font-weight: bold;">Phone</th>
                        <th class="text-center align-middle" style="font-weight: bold;">Email</th>
                        <th class="text-center align-middle" style="font-weight: bold;" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listbook as $value): ?>
                        <!-- Modal -->
                        <div class="modal fade" id="cancelModal<?php echo $value->order_id; ?>" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="?act=huyorder">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelModalLabel">Xác nhận huỷ đơn hàng</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có chắc chắn muốn huỷ đơn hàng <strong>#<?php echo $value->order_id; ?></strong> không?</p>
                                            <div class="mb-3">
                                                <label for="cancelReason<?php echo $value->order_id; ?>" class="form-label">Lý do huỷ:</label>
                                                <select class="form-select" id="cancelReason<?php echo $value->order_id; ?>" name="cancel_reason" required onchange="toggleOtherReason(<?php echo $value->order_id; ?>)">
                                                    <option value="">-- Chọn lý do --</option>
                                                    <option value="Đặt nhầm">Đặt nhầm</option>
                                                    <option value="Thay đổi ý định">Thay đổi ý định</option>
                                                    <option value="Không cần nữa">Không cần nữa</option>
                                                    <option value="Tôi muốn đổi thông tin, địa chỉ đặt hàng">Tôi muốn đổi thông tin, địa chỉ đặt hàng</option>
                                                    <option value="Lý do khác">Lý do khác</option>
                                                </select>
                                            </div>
                                            <!-- Textarea for "Lý do khác" -->
                                            <div class="mb-3" id="otherReason<?php echo $value->order_id; ?>" style="display: none;">
                                                <label for="otherReasonInput<?php echo $value->order_id; ?>" class="form-label">Nhập lý do:</label>
                                                <textarea class="form-control" id="otherReasonInput<?php echo $value->order_id; ?>" name="other_reason" rows="3"></textarea>
                                            </div>
                                            <input type="hidden" name="order_id" value="<?php echo $value->order_id; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-danger" name="btn_submit">Xác nhận huỷ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <tr>
                            <td class="text-center align-middle"><?php echo $value->order_id; ?></td>
                            <td class="text-center align-middle">$<?php echo number_format($value->total_amount, 2); ?></td>
                            <td class="text-center align-middle"><?php echo $value->payment_status; ?></td>
                            <td class="text-center align-middle"><?php echo $value->delivery_status; ?></td>
                            <td class="text-center align-middle"><?php echo $value->created_at; ?></td>
                            <td class="text-center align-middle"><?php echo $value->name; ?></td>
                            <td class="text-center align-middle"><?php echo $value->address; ?></td>
                            <td class="text-center align-middle">0<?php echo $value->phone; ?></td>
                            <td class="text-center align-middle"><?php echo $value->email; ?></td>
                            <td class="text-center align-middle">
                                <a href="?act=chitietpro&pid=<?php echo $value->order_id; ?>" class="btn btn-dark btn-sm">Chi tiết</a>
                            </td>
                            <td class="text-center align-middle">
                                <?php if ($value->delivery_status == 'Đang chuẩn bị') { ?>
                                    <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $value->order_id; ?>">
                                        Huỷ
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- </form> -->

            <script>
                function toggleOtherReason(orderId) {
                    const selectElement = document.getElementById(`cancelReason${orderId}`);
                    const otherReasonDiv = document.getElementById(`otherReason${orderId}`);
                    if (selectElement.value === "Lý do khác") {
                        otherReasonDiv.style.display = "block";
                    } else {
                        otherReasonDiv.style.display = "none";
                    }
                }
                document.querySelector('form').addEventListener('submit', function(event) {
                    console.log('Form is being submitted', new FormData(this)); // Kiểm tra dữ liệu trước khi gửi đi
                });
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