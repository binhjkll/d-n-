<?php
session_start(); // Bắt đầu session để kiểm tra thông tin đăng nhập

class Bookcc
{


    public function danhmuc()
    {
        $mDm = new Book();
        $danhmuc = $mDm->getDM();
        include_once "views/admin/danhmuc.php";
    }

    //Phần giao diện
    public function shophtml()
    {
        $mBook = new Book();
        $shophtml = $mBook->getDM();

        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $itemsPerPage = 9; // Số sản phẩm trên mỗi trang
        $start = ($currentPage - 1) * $itemsPerPage;

        if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
            // Kiểm tra từ khóa tìm kiếm
            $keyword = trim($_GET['keyword']);
            $listpro = $mBook->searchProductsPaginated($keyword, $start, $itemsPerPage); // Lấy từ khóa tìm kiếm
            $totalProducts = $mBook->countSearchResults($keyword);
        } elseif (isset($_GET['category_id'])) {
            // Lấy sản phẩm theo danh mục
            $category_id = intval($_GET['category_id']); // Lấy ID danh mục
            $listpro = $mBook->getProductsByCategoryPaginated($category_id, $start, $itemsPerPage);
            $totalProducts = $mBook->countProductsByCategory($category_id);
        } else {
            // Nếu không có tìm kiếm hoặc danh mục, lấy tất cả sản phẩm
            $listpro = $mBook->getProductsPaginated($start, $itemsPerPage);
            $totalProducts = $mBook->countProducts();
        }
        $listpro = array_filter($listpro, function ($product) use (&$uniqueProducts) {
            static $seen = [];
            if (in_array($product->product_id, $seen)) {
                return false;
            }
            $seen[] = $product->product_id;
            return true;
        });

        $totalPages = ceil($totalProducts / $itemsPerPage);


        // Load view hiển thị sản phẩm
        require_once "views/fruitables/shop/shop.php";
    }

    public function trangchu()
    {
        $mBook = new Book();
        $shophtml = $mBook->getDM();
        $latestProducts = $mBook->getRandomProducts(6);

        if (isset($_GET['category_id'])) {
            $category_id = intval($_GET['category_id']); // Lấy ID danh mục
            $listpro = $mBook->getProductsByCategory($category_id); // Lấy sản phẩm theo danh mục
        } else {
            $listpro = $mBook->getall(); // Nếu không có danh mục, lấy tất cả sản phẩm
        }
        // Loại bỏ các sản phẩm trùng product_id
        $uniqueProducts = [];
        foreach ($listpro as $product) {
            if (!isset($uniqueProducts[$product->product_id])) {
                $uniqueProducts[$product->product_id] = $product;
            }
        }
        $latestProducts = array_values($uniqueProducts);

        require_once "views/fruitables/shop/trangchu.php";
    }
    public function productDetail()
    {
        $mBook = new Book();
        $shophtml = $mBook->getDM();
        // Lấy `product_id` từ URL
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $variantId = isset($_GET['variant_id']) ? intval($_GET['variant_id']) : 0;

        // Lấy chi tiết sản phẩm từ Model
        $product = $mBook->getProductById($productId);

        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            echo "Sản phẩm không tồn tại.";
            exit;
        }

        // bình luận
        if(isset($_POST["gui"])){
            $comment = $_POST["noidung"] ;
            $product_id = $_POST["product_id"];
            $user_id = $_POST["user_id"];
            $created_at = date("Y-m-d");
            $mBook = new Book();
            $mBook -> insert_binhluan(null, $product_id, $user_id, $comment, $created_at );
            
        }

        $mBook = new Book();
        $listbluan = $mBook ->  binhluan_theo_idsp($_GET['id']);

        $user = $mBook -> users();

        // Nếu variant_id được truyền, lấy thông tin variant tương ứng
        if ($variantId > 0) {
            foreach ($product['variants'] as $variant) {
                if ($variant['variant_id'] == $variantId) {
                    $product['selected_variant'] = $variant;
                    break;
                }
            }
        } else {
            // Nếu không có variant_id, chọn mặc định variant đầu tiên
            $product['selected_variant'] = $product['variants'][0];
        }

        // Gọi view chi tiết sản phẩm
        require_once "views/fruitables/shop/shop-detail.php";
    }
    //end giao diện

    public function listbook()
    {
        $mBook = new Book();
        $listbook = $mBook->getall();
        include_once "views/admin/list.php";
    }
    //Phần giỏ hàng
    public function addToCart()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?act=login"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
            exit;
        }

        $userId = $_SESSION['user_id']; // Lấy user_id từ session
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $variantId = isset($_GET['variant_id']) ? intval($_GET['variant_id']) : 0; // Lấy variant_id từ URL (nếu cần)
        $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

        $mBook = new Book();

        $mBook->addToCart($userId, $productId, $quantity, $variantId);
        if (isset($_GET['redirect']) && $_GET['redirect'] === 'cart') {
            header("Location: index.php?act=cart");
            exit;
        } else {
            header("Location: index.php?act=shophtml");
            exit;
        }
        exit;
    }

    public function cart()
    {
        session_start(); // Bắt đầu session để kiểm tra thông tin đăng nhập

        if (!isset($_SESSION['username'])) {
            // Nếu người dùng chưa đăng nhập, hiển thị thông báo và chuyển hướng
            $_SESSION['error_message'] = "Bạn cần đăng nhập để xem giỏ hàng.";
            header("Location: ?act=login"); // Chuyển hướng đến trang đăng nhập
            exit;
        }
        $userId = $_SESSION['user_id']; // Lấy user_id từ session
        $mBook = new Book();
        $cartItems = $mBook->getCartItems($userId);

        include_once __DIR__ . "/../views/fruitables/shop/cart.php";
        // include_once __DIR__ . "/../views/fruitables/shop/orderall.php";
    }

    public function clearCart()
    {
        session_start(); // Bắt đầu session để kiểm tra thông tin đăng nhập

        $userId = $_SESSION['user_id']; // Lấy user_id từ session
        $mBook = new Book();
        $mBook->clearCart($userId);
        header("Location: index.php?act=cart");
        exit;
    }
    public function removeFromCart()
    {
        $cartItemId = isset($_GET['cart_item_id']) ? intval($_GET['cart_item_id']) : 0;
        if ($cartItemId > 0) {
            $mBook = new Book();
            $mBook->removeCartItem($cartItemId);
        }
        header("Location: index.php?act=cart");
        exit;
    }
    public function updateCartQuantity()
    {
        $cartItemId = isset($_GET['cart_item_id']) ? intval($_GET['cart_item_id']) : 0;
        $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 0;

        if ($cartItemId > 0 && $quantity > 0) {
            $mBook = new Book();
            $mBook->updateCartItemQuantity($cartItemId, $quantity);
        }

        header("Location: index.php?act=cart");
        exit;
    }
    //end giỏ hàng

    public function listuser()
    {
        $mBook = new Book();
        $login = $mBook->login();
        include_once "views/admin/user.php";
    }

    public function deletebook()
    {
        if (isset($_GET['id'])) {
            // $product_id = $_GET['product_id'];
            // $variant_id = $_GET['variant_id'];
            $product_id = $_GET['id'];
            $variant_id = $_GET['vid'];
            $mBook = new Book();
            $delteBook = $mBook->deletev($variant_id);
            $delteBook = $mBook->delete($product_id);

            if (!$delteBook) {
                header('location:index.php');
            }
        }
    }


    public function register()
    {
        if (isset($_POST['btn_submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $mBook = new Book();

            // Kiểm tra xem username, email hoặc phone đã tồn tại chưa
            if ($mBook->isExistingUser($username, $email, $phone)) {
                $error_message = "Tài khoản, email hoặc sđt đã tồn tại";

                include_once "views/admin/dangli.php";
                die; // Dừng lại để không thực hiện đăng ký
            }

            // Thực hiện đăng ký nếu không trùng lặp
            $addBook = $mBook->register(
                null,
                $username,
                $password,
                $email,
                $phone,
                $address,
                $role
            );

            if (!$addBook) {
                // Nếu thêm thành công, chuyển hướng tới trang đăng nhập
                $ddd = "Đăng ký thành công";
                header('Location: ?act=login');
                exit;
            }
        } else {
            include_once "views/admin/dangli.php";
        }
    }

    public function login()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $mBook = new Book();
        $login = $mBook->login();

        if (!$login) {
            header('location:index.php');
        }
        include_once "views/admin/dangnhap.php";
    }
    public function dangxuat()
    {
        session_start();

        if (isset($_SESSION["username"])) {
            unset($_SESSION["username"]);
        }
        header('location: ?act=login');
    }
    public function quenmk(){

        $mBook = new Book();
        $login = $mBook->login();
        if (isset($_POST["btn_submit"])) {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $isUserFound = false; // Biến cờ để kiểm tra người dùng hợp lệ

            // Duyệt qua danh sách người dùng (giả sử $login chứa danh sách người dùng từ database)
            foreach ($login as $value) {
                if ($username == $value->username && $email == $value->email) {
                    $isUserFound = true;

                    // Gọi hàm cập nhật mật khẩu
                    $aa=$mBook->doimatkhau($username, $email, $password);
                    break;
                }
            }

            if ($isUserFound) {
                echo "<script>alert('Đổi mật khẩu thành công!');</script>";
                header('location:?act=login');
                exit;
            } else {
                echo "<script>alert('Tên tài khoản hoặc email không đúng!');</script>";
            }
        }
        include_once "views/admin/quenmk.php";

    }


    public function binh()
    {
        if (isset($_POST['btn_submit'])) {
            // Dữ liệu sản phẩm chính
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            // Khởi tạo đối tượng
            $book = new Book();

            // Thêm sản phẩm chính vào bảng `products` và lấy `product_id` vừa tạo
            $product_id = $book->add($name, $description, $category_id);

            // Nếu thêm sản phẩm thành công
            if ($product_id) {
                // Dữ liệu các biến thể
                $variants = [];
                if (isset($_POST['variant']) && is_array($_POST['variant'])) {
                    foreach ($_POST['variant'] as $key => $variant) {
                        // Xử lý upload ảnh cho từng biến thể
                        $target_dir = "images/";
                        $name_img = time() . '_' . $_FILES['variant']['name'][$key]['product_img'];
                        $product_img = $target_dir . $name_img;

                        move_uploaded_file(
                            $_FILES['variant']['tmp_name'][$key]['product_img'],
                            $product_img
                        );

                        // Thêm biến thể vào mảng
                        $variants[] = [
                            'price' => $variant['price'],
                            'stock_quantity' => $variant['stock_quantity'],
                            'product_img' => $product_img
                        ];
                    }
                }

                // Gọi hàm thêm biến thể
                $book->addvariants($product_id, $variants);

                // Chuyển hướng sau khi thêm thành công
                header('Location: index.php');
                exit;
            }
        }

        // Lấy danh mục sản phẩm
        $mBook = new Book();
        $ccc = $mBook->categories();

        // Gọi giao diện
        include_once "views/admin/binh.php";
    }
    public function addDM()
    {
        if (isset($_POST['btn_submit'])) {
            $name = $_POST['name'];

            $mBook = new Book();
            $addDM = $mBook->addDM(null, $name);
            header('Location: index.php?act=danhmuc');
            exit();
        }
        include_once "views/admin/add-category.php";
    }
    public function editDM()
    {
        if (isset($_GET['category_id'])) {
            $mBook = new Book();

            // Lấy thông tin danh mục theo category_id
            $category = $mBook->getIdDM($_GET['category_id']);

            if (!$category) {
                echo "Danh mục không tồn tại!";
                exit();
            }

            // Xử lý form submit
            if (isset($_POST['submit'])) {
                $name = $_POST['name'] ?? '';

                // Kiểm tra nếu `name` không được nhập
                if (empty($name)) {
                    $error = "Tên danh mục không được để trống!";
                } else {
                    // Thực hiện cập nhật danh mục
                    $editDM = $mBook->editDM($name, $_GET['category_id']);
                    if ($editDM) {
                        // Chuyển hướng nếu cập nhật thành công
                        header('Location: index.php?act=danhmuc');
                        exit();
                    } else {
                        $error = "Cập nhật danh mục thất bại!";
                    }
                }
            }

            // Hiển thị view với thông tin danh mục
            include_once 'views/admin/edit-category.php';
        } else {
            echo "Thiếu ID danh mục để chỉnh sửa!";
            exit();
        }
    }

    public function deleteDM()
    {
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            $mBook = new Book();

            // Gọi hàm xóa danh mục
            $result = $mBook->deleteDM($category_id);

            // Kiểm tra kết quả và chuyển hướng
            if ($result) {
                header('Location: index.php?act=danhmuc'); // Thành công, quay về danh sách
                exit(); // Đảm bảo dừng thực thi
            } else {
                echo "Lỗi: Không thể xóa danh mục. Vui lòng thử lại!";
            }
        } else {
            echo "Lỗi: Không tìm thấy ID danh mục.";
        }
    }





    public function editbook()
    {
        // Lấy product_id và variant_id từ URL
        $product_id = $_GET['id'];
        $variant_id = $_GET['vid'];

        // Lấy thông tin sản phẩm và biến thể từ CSDL
        $mBook = new Book();
        $idBook = $mBook->getid($product_id); // Lấy thông tin sản phẩm
        $iddBook = $mBook->getvid($variant_id); // Lấy thông tin biến thể
        $ccc = $mBook->categories(); // Lấy danh sách danh mục

        // Kiểm tra xem thông tin sản phẩm và biến thể có hợp lệ không
        if (!$idBook || !$iddBook) {
            echo "Không tìm thấy sản phẩm hoặc biến thể với ID: $product_id và $variant_id.";
            return; // Dừng thực thi nếu không có thông tin hợp lệ
        }

        if (isset($_POST['btn_submit'])) {
            // Lấy thông tin từ form
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $stock_quantity = $_POST['stock_quantity'];

            // Xử lý ảnh sản phẩm
            $product_img = $iddBook['product_img']; // Mặc định giữ ảnh cũ nếu không có ảnh mới

            if (!empty($_FILES['product_img']['name'])) {
                $target_dir = "images/";
                $name_img = time() . '_' . basename($_FILES['product_img']['name']);
                $product_img = $target_dir . $name_img;

                // Kiểm tra loại file trước khi tải lên
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                if (in_array($_FILES['product_img']['type'], $allowed_types)) {
                    move_uploaded_file($_FILES['product_img']['tmp_name'], $product_img);
                } else {
                    echo "Chỉ chấp nhận các định dạng ảnh JPEG, PNG, GIF.";
                    exit;
                }
            }

            // Cập nhật bảng product_variants
            $updateVariant = $mBook->updatevariants(
                $variant_id,
                $product_id,
                $price,
                $stock_quantity,
                $product_img
            );

            // Cập nhật bảng products
            $updateProduct = $mBook->update(
                $variant_id,
                $name,
                $description,
                $category_id
            );

            // Kiểm tra kết quả cập nhật
            if (!$updateVariant && !$updateProduct) {
                header('Location: index.php');
                exit;
            } else {
                echo "Đã xảy ra lỗi khi cập nhật sản phẩm.";
            }
        }

        // Kiểm tra và truyền dữ liệu vào view
        if (isset($idBook, $iddBook, $ccc)) {
            $data = [
                'idBook' => $idBook,       // Thông tin sản phẩm
                'iddBook' => $iddBook,     // Thông tin biến thể
                'categories' => $ccc       // Danh sách danh mục
            ];
            extract($data); // Tách biến để sử dụng trực tiếp trong view
            include_once "views/admin/edit.php";
        }
    }

    public function binhluan(){
        $mBook = new Book();
        $list = $mBook->all_binhluan();
        require_once "../d-n-/views/admin/binhluan.php";
    }

    public function deleteBinhluan(){
        if(isset($_GET['review_id'])){
            $review_id = $_GET['review_id'];
            $mBook = new Book();
            $deleteBL = $mBook->deleteBluan($review_id);



            if(!$deleteBL){
                header("Location: ?act=binhluan");
            }
        }
    }



    public function checkout()
    {
        $product_id = $_GET['id'];
        $variant_id = $_GET['vid'];
        $cart_item_id = $_GET['cid'];


        $mBook = new Book();
        $aa = $mBook->getid($product_id);
        $bb = $mBook->getvid($variant_id);

        $cc = $mBook->getcid($cart_item_id);
        // include_once "views/fruitables/shop/order.php";
    }
    public function orders()
    {
        date_default_timezone_set('Asia/Bangkok');
        $product_id = $_GET['id'];
        $variant_id = $_GET['vid'];
        $cart_item_id = $_GET['cid'];

        $mBook = new Book();
        $aa = $mBook->getid($product_id);
        $bb = $mBook->getvid($variant_id);

        $cc = $mBook->getcid($cart_item_id);

        if (isset($_POST['btn_submit'])) {
            if (isset($_SESSION['user_id'])) {  // Kiểm tra xem user_id có tồn tại trong session không

                // Lấy dữ liệu từ form và session
                $user_id = $_SESSION['user_id'];  // Lấy user_id từ session
                $total_amount = $_POST['total_amount'];
                $payment_status = $_POST['payment_status'];
                $delivery_status = $_POST['delivery_status'];
                $created_at = date('Y-m-d H:i:s');
                $variant_id = $_POST['variant_id'];
                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $size = $_POST['size'];

                // Tạo một đối tượng của lớp Book
                $mBook = new Book();

                // Thêm đơn hàng và lấy order_id
                $order_id = $mBook->addOrder(
                    $user_id,
                    $total_amount,
                    $payment_status,
                    $delivery_status,
                    $created_at,
                    $phone,
                    $address

                );

                // Thêm các mục trong đơn hàng (order items)
                $mBook->addOrderItems($order_id, $variant_id, $quantity, $price, $size);

                $cartItemId = isset($_GET['cart_item_id']) ? intval($_GET['cart_item_id']) : 0;
                if ($cartItemId > 0) {
                    $mBook = new Book();
                    $mBook->removeCartItem($cartItemId);
                }
                // Hiển thị thông báo thành công
                header('Location: ?act=trangchu');
            } else {
                var_dump($_SESSION);  // In ra nội dung session để kiểm tra

                echo "User is not logged in.";
            }
        }

        // Hiển thị view (nếu cần)
        include_once "views/fruitables/shop/order.php";
    }

    public function quanlyorder()
    {
        $mBook = new Book();
        $listbook = $mBook->getorder();
        include_once "views/admin/quanlyorder.php";
    }

    public function userpro()
    {
        $user_id = $_SESSION['user_id'];
        $mBook = new Book();
        $listbook = $mBook->getorders($user_id);

        // $listbook = $mBook->getOrdersWithItems($userId);
        include_once "views/fruitables/user.php";
    }
    public function chitietpro()
    {
        $orderId = $_GET['pid'];
        $mBook = new Book(); // Giả sử "Book" là model bạn đã định nghĩa
        $listbook = $mBook->getOrderItemsWithVariants($orderId); // Gọi hàm model mới
        include_once "views/fruitables/chitietpro.php"; // Gửi dữ liệu sang view
    }

    public function ordersall()
    {
        $userId = $_SESSION['user_id']; // Lấy user_id từ session
        $mBook = new Book();
        $cartItems = $mBook->getCartItems($userId);
        date_default_timezone_set('Asia/Bangkok');

        if (isset($_POST['btn_submit'])) {
            if (isset($_SESSION['user_id'])) {
                // echo '<pre>';
                // print_r($_POST);
                // echo '</pre>';
                // die();

                // Lấy dữ liệu từ form
                $user_id = $_SESSION['user_id'];
                $total_amount = $_POST['total_amount'];
                $payment_status = $_POST['payment_status'] ?? 'thanh toán khi nhận hàng';
                $delivery_status = $_POST['delivery_status'];
                $created_at = date('Y-m-d H:i:s');
                $variant_ids = $_POST['variant_id'];
                $quantities = $_POST['quantity'];
                $prices = $_POST['price'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $sizes = $_POST['size']; // Mảng size theo variant_id

                // Thêm đơn hàng và lấy order_id
                $order_id = $mBook->addOrder(
                    $user_id,
                    $total_amount,
                    $payment_status,
                    $delivery_status,
                    $created_at,
                    $phone,
                    $address
                );

                // Thêm từng sản phẩm vào bảng order_items
                for ($i = 0; $i < count($variant_ids); $i++) {
                    $variant_id = $variant_ids[$i];
                    $selected_size = isset($sizes[$variant_id]) ? $sizes[$variant_id] : 'S'; // Mặc định 'S'

                    $mBook->addOrderItems(
                        $order_id,
                        $variant_id,
                        $quantities[$i],
                        $prices[$i],
                        $selected_size
                    );
                }

                // Xóa giỏ hàng
                $mBook->clearCart($userId);

                // Chuyển hướng về trang chủ
                header('Location: ?act=trangchu');
            } else {
                echo "User is not logged in.";
            }
        }

        include_once __DIR__ . "/../views/fruitables/shop/orderall.php";
    }
}
