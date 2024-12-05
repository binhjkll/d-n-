<?php
require "models/ConnectDatabase.php";
class Book
{
    public $connect;
    public function __construct()
    {
        $this->connect = new ConnectDatabase();
    }
    public function getDM()
    {
        $sql = "SELECT * FROM `categories` ORDER BY category_id ASC";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function getall()
    {
        $sql = "SELECT 
                products.product_id,
                products.name AS name,
                products.description,
                categories.name AS category_name,
                product_variants.variant_id,
                product_variants.price,
                product_variants.stock_quantity,
                product_variants.product_img
            FROM products
            JOIN categories ON products.category_id = categories.category_id
            JOIN product_variants ON products.product_id = product_variants.product_id";

        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function getProductsByCategory($category_id)
    {
        $sql = "SELECT 
                    products.product_id,
                    products.name AS name,
                    products.description,
                    categories.name AS category_name,
                    product_variants.variant_id,
                    product_variants.price,
                    product_variants.stock_quantity,
                    product_variants.product_img
                FROM products
                JOIN categories ON products.category_id = categories.category_id
                JOIN product_variants ON products.product_id = product_variants.product_id
                WHERE products.category_id = ?";

        $this->connect->setQuery($sql);
        return $this->connect->loadData([$category_id]); // Truyền tham số vào câu truy vấn
    }
    ///sp gợi ý
    public function getRandomProducts()
    {
        $sql = "SELECT 
                    products.product_id,
                    products.name AS name,
                    products.description,
                    categories.name AS category_name,
                    product_variants.variant_id,
                    product_variants.price,
                    product_variants.stock_quantity,
                    product_variants.product_img
                FROM products
                JOIN categories ON products.category_id = categories.category_id
                JOIN product_variants ON products.product_id = product_variants.product_id
                ORDER BY RAND()
                LIMIT 6";

        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    //endsp

    public function searchProducts($keyword)
    {
        $sql = "SELECT 
                    products.product_id,
                    products.name AS name,
                    products.description,
                    categories.name AS category_name,
                    product_variants.variant_id,
                    product_variants.price,
                    product_variants.stock_quantity,
                    product_variants.product_img
                FROM products
                JOIN categories ON products.category_id = categories.category_id
                JOIN product_variants ON products.product_id = product_variants.product_id
                WHERE products.name LIKE ? OR categories.name LIKE ? OR products.description LIKE ?";

        $this->connect->setQuery($sql);
        $searchTerm = '%' . $keyword . '%';
        return $this->connect->loadData([$searchTerm, $searchTerm, $searchTerm]); // Truyền tham số tìm kiếm
    }

    public function getProductById($productId)
    {
        $sql = "SELECT 
                    products.product_id,
                    products.name AS name,
                    products.description,
                    categories.name AS category_name,
                    product_variants.variant_id,
                    product_variants.price,
                    product_variants.stock_quantity,
                    product_variants.product_img
                FROM products
                JOIN categories ON products.category_id = categories.category_id
                JOIN product_variants ON products.product_id = product_variants.product_id
                WHERE products.product_id = ?";
        $this->connect->setQuery($sql);
        $result = $this->connect->loadData([$productId]);
        $result = json_decode(json_encode($result), true); // Chuyển đổi object sang array nếu cần

        // Nếu không có sản phẩm, trả về false
        if (!$result) {
            return false;
        }

        // Xử lý dữ liệu: gom các variant thành danh sách
        $product = [
            'product_id' => $result[0]['product_id'],
            'name' => $result[0]['name'],
            'description' => $result[0]['description'],
            'category_name' => $result[0]['category_name'],
            'variants' => []
        ];

        foreach ($result as $row) {
            $product['variants'][] = [
                'variant_id' => $row['variant_id'],
                'price' => $row['price'],
                'stock_quantity' => $row['stock_quantity'],
                'product_img' => $row['product_img']
            ];
        }

        return $product;
    }
    //Giỏ hangg
    public function addToCart($userId, $productId, $quantity, $variantId)
    {
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $checkSql = "SELECT * FROM cart_items WHERE user_id = ? AND product_id = ? AND variant_id = ?";
        $this->connect->setQuery($checkSql);
        $existingItem = $this->connect->loadSingle([$userId, $productId, $variantId]);

        if ($existingItem) {
            // Cập nhật số lượng nếu sản phẩm đã tồn tại
            $newQuantity = $existingItem['quantity'] + $quantity;
            $updateSql = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
            $this->connect->setQuery($updateSql);
            $this->connect->execute([$newQuantity, $existingItem['cart_item_id']]);
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $insertSql = "INSERT INTO cart_items (user_id, product_id, variant_id, quantity, added_at) VALUES (?, ?, ?, ?, NOW())";
            $this->connect->setQuery($insertSql);
            $this->connect->execute([$userId, $productId, $variantId, $quantity]);
        }
    }




    public function getCartItems($userId)
    {
        $sql = "SELECT 
            cart_items.variant_id,
        cart_items.product_id,
                    cart_items.cart_item_id,
                    cart_items.quantity,
                    products.name AS product_name,
                    products.description,
                    product_variants.price,
                    product_variants.product_img,
                    (cart_items.quantity * product_variants.price) AS total_price
                FROM cart_items
                JOIN product_variants ON cart_items.variant_id = product_variants.variant_id
                JOIN products ON product_variants.product_id = products.product_id
                WHERE cart_items.user_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$userId]); // Load toàn bộ dữ liệu
    }

    public function clearCart($userId)
    {
        $sql = "DELETE FROM cart_items WHERE user_id = ?";
        $this->connect->setQuery($sql);
        $this->connect->execute([$userId]);
    }
    public function removeCartItem($cartItemId)
    {
        $sql = "DELETE FROM cart_items WHERE cart_item_id = ?";
        $this->connect->setQuery($sql);
        $this->connect->execute([$cartItemId]);
    }
    public function updateCartItemQuantity($cartItemId, $quantity)
    {
        // Kiểm tra nếu số lượng nhỏ hơn 1 thì không thực hiện
        if ($quantity < 1) {
            return false;
        }

        $sql = "UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$quantity, $cartItemId]);
    }
    //end


    public function delete($product_id)
    {
        $sql = "DELETE FROM `products` WHERE product_id=?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$product_id], false);
    }
    public function deletev($variant_id)
    {
        $sql = "DELETE FROM `product_variants` WHERE variant_id=?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$variant_id], false);
    }
    public function register($user_id, $username, $password, $email, $phone, $address, $role)
    {
        $sql = "INSERT INTO `users` VALUES (?,?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$user_id, $username, $password, $email, $phone, $address, $role]);
    }
    public function isExistingUser($username, $email, $phone)
    {
        $sql = "SELECT COUNT(*) as count FROM `users` WHERE `username` = ? OR `email` = ? OR `phone` = ?";
        $this->connect->setQuery($sql);
        $result = $this->connect->loadRow([$username, $email, $phone]);
        return $result['count'] > 0;
    }

    public function login()
    {
        $sql = "SELECT * FROM `users`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    // Hàm thêm sản phẩm, trả về product_id vừa tạo
    public function add($name, $description, $category_id)
    {
        $sql = "INSERT INTO `products` (name, description, category_id) VALUES (?,?,?)";
        $this->connect->setQuery($sql);
        $this->connect->loadData([$name, $description, $category_id]);

        // Lấy product_id vừa được thêm
        return $this->connect->lastInsertId(); // Phương thức này trả về product_id vừa thêm
    }

    //Them-Sua-Xoa danhmuc
    public function addDM($category_id, $name)
    {
        $sql = "INSERT INTO `categories`(category_id, name) VALUES (?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$category_id, $name]);
    }
    public function getIdDM($category_id)
    {
        $sql = "SELECT * FROM `categories` WHERE category_id=?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$category_id], false);
    }
    public function editDM($name, $category_id)
    {
        $sql = "UPDATE `categories` SET `name`=? WHERE `category_id`=?";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$name, $category_id], false);
    }
    public function deleteDM($category_id)
    {
        $sql = "DELETE FROM `categories` WHERE `category_id` = ?";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$category_id], false);
    }
    //end Them-Sua-Xoa danhmuc


    // Hàm thêm biến thể với product_id
    public function addvariants($product_id, $variants)
    {
        $sql = "INSERT INTO `product_variants` (product_id, price, stock_quantity, product_img) VALUES (?, ?, ?, ?)";

        foreach ($variants as $variant) {
            // Lấy giá trị từ mảng biến thể
            $price = $variant['price'];
            $stock_quantity = $variant['stock_quantity'];
            $product_img = $variant['product_img'];

            // Thêm từng biến thể vào bảng `product_variants`
            $this->connect->setQuery($sql);
            $this->connect->loadData([$product_id, $price, $stock_quantity, $product_img]);
        }
        return true; // Trả về true nếu thêm tất cả biến thể thành công
    }

    // ---------------------------------------------------------------------------------------
    // sửa
    // Cập nhật các thuộc tính của biến thể sản phẩm
    public function updatevariants($variant_id, $product_id, $price, $stock_quantity, $product_img)
    {
        $sql = "UPDATE `product_variants` 
            SET `product_id` = ?, `price` = ?, `stock_quantity` = ?, `product_img` = ? 
            WHERE `variant_id` = ?";

        $this->connect->setQuery($sql);
        $result = $this->connect->loadData([$product_id, $price, $stock_quantity, $product_img, $variant_id]);
        if ($result) {
            return $variant_id;
        }
        return false;
    }
    public function update($variant_id, $name, $description, $category_id)
    {
        $sql = "SELECT `product_id` FROM `product_variants` WHERE `variant_id` = ?";
        $this->connect->setQuery($sql);
        $product = $this->connect->loadSingle([$variant_id]);

        if ($product) {
            $product_id = $product['product_id'];
            $updateSql = "UPDATE `products` 
                      SET `name` = ?, `description` = ?, `category_id` = ? 
                      WHERE `product_id` = ?";
            $this->connect->setQuery($updateSql);
            $result = $this->connect->loadData([$name, $description, $category_id, $product_id]);
            if ($result) {
                return $product_id;
            }
        }

        return false;
    }



    public function getid($product_id)
    {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $this->connect->setQuery($sql);
        $result = $this->connect->loadSingle([$product_id]);

        // Kiểm tra xem kết quả có hợp lệ không
        if (!$result) {
            echo "Không tìm thấy sản phẩm với ID: $product_id";
        }

        return $result;
    }

    public function getvid($variant_id)
    {
        $sql = "SELECT * FROM product_variants WHERE variant_id = ?";
        $this->connect->setQuery($sql);
        $result = $this->connect->loadSingle([$variant_id]);

        // Kiểm tra xem kết quả có hợp lệ không
        if (!$result) {
            echo "Không tìm thấy biến thể với ID: $variant_id";
        }

        return $result;
    }
    public function getcid($cart_item_id)
    {
        $sql = "SELECT * FROM cart_items WHERE cart_item_id = ?";
        $this->connect->setQuery($sql);
        $result = $this->connect->loadSingle([$cart_item_id]);

        // Kiểm tra xem kết quả có hợp lệ không
        if (!$result) {
            echo "Không tìm thấy biến thể với ID: $cart_item_id";
        }

        return $result;
    }


    // Hàm thêm biến thể với product_id

    // ----------------------------------------------------------------------------------------------------

    public function categories()
    {
        $sql = "SELECT * FROM `categories`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function xem()
    {
        $sql = "SELECT * FROM `products`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function addReview($product_id, $user_id, $rating, $comment_text)
    {
        $sql = "INSERT INTO `reviews` (product_id, user_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())";
        try {
            $this->connect->setQuery($sql);
            return $this->connect->loadData([$product_id, $user_id, $rating, $comment_text]);
        } catch (Exception $e) {
            error_log("SQL Error: " . $e->getMessage());
            return false;
        }
    }

    public function checkout($order_id, $user_id, $product_id, $quantity, $added_at, $discount_id)
    {
        $sql = "INSERT INTO `orders`(`order_id`, `user_id`, `product_id`, `quantity`, `added_at`, `discount_id`) VALUES (?,?,?,?,?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$order_id, $user_id, $product_id, $quantity, $added_at, $discount_id]);
    }

    public function getIdBook($cart_items_id)
    {
        $sql = "SELECT * FROM `cart_items` WHERE cart_items_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$cart_items_id], false);
    }

    // public function addOrder(){
    //         $sql = "INSERT INTO `order_items`(`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES (?,?,?,?,?)";
    //             $this->connect->setQuery($sql);
    //             $this->connect->loadData();

    // }
    // //------------------------------------------------------------------
    //     public function add($name, $description, $category_id)
    //     {
    //         $sql = "INSERT INTO `products` (name, description, category_id) VALUES (?,?,?)";
    //         $this->connect->setQuery($sql);
    //         $this->connect->loadData([$name, $description, $category_id]);

    //         // Lấy product_id vừa được thêm
    //         return $this->connect->lastInsertId(); // Phương thức này trả về product_id vừa thêm
    //     }
    //     public function addvariants($product_id, $variants)
    //     {
    //         $sql = "INSERT INTO `product_variants` (product_id, price, stock_quantity, product_img) VALUES (?, ?, ?, ?)";

    //         foreach ($variants as $variant) {
    //             // Lấy giá trị từ mảng biến thể
    //             $price = $variant['price'];
    //             $stock_quantity = $variant['stock_quantity'];
    //             $product_img = $variant['product_img'];

    //             // Thêm từng biến thể vào bảng `product_variants`
    //             $this->connect->setQuery($sql);
    //             $this->connect->loadData([$product_id, $price, $stock_quantity, $product_img]);
    //         }
    //         return true; // Trả về true nếu thêm tất cả biến thể thành công
    //     }
    public function addOrder($user_id, $total_amount, $payment_status, $delivery_status, $created_at, $phone, $address)
    {
        $sql = "INSERT INTO `orders` (user_id, total_amount, payment_status, delivery_status, created_at,phone, address)
            VALUES (?, ?, ?, ?, ?,?,?)";

        $this->connect->setQuery($sql);
        $this->connect->loadData([$user_id, $total_amount, $payment_status, $delivery_status, $created_at, $phone, $address]);

        // Lấy order_id của đơn hàng vừa thêm
        return $this->connect->lastInsertId(); // Trả về order_id
    }

    // Thêm chi tiết đơn hàng vào bảng `order_items`
    public function addOrderItems($order_id, $variant_id, $quantity, $price)
    {
        // SQL để chèn dữ liệu vào bảng `order_items`
        $sql = "INSERT INTO `order_items` (order_id, variant_id, quantity, price)
        VALUES (?, ?, ?, ?)";

        // Thực thi câu truy vấn chèn dữ liệu
        $this->connect->setQuery($sql);
        $this->connect->loadData([$order_id, $variant_id, $quantity, $price]);

        return true;
    }
    public function getorder()
    {
        $sql = "SELECT * FROM `orders`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    // public function updateorder($delivery_status)
    // {
    //     $sql = "UPDATE `orders` SET `delivery_status`=? WHERE `order_id`=?";
    //     $this->connect->setQuery($sql);
    //     return $this->connect->loadData([$delivery_status], false);
    // }
    public function getuser()
    {
        $sql = "SELECT * FROM `users`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function bannerShow(){
        $sql = "SELECT * FROM `product_variants`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function banner_Show(){
        $sql = "SELECT * FROM `banners`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function banner_manager(){
        $sql = "SELECT * FROM `banners`";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }

    public function add_banner($banner_id,$name, $link, $Show_is, $image) {
        $insertSql = "INSERT INTO banners (name, link, Show_Is, image) VALUES (?, ?, ?, ?)";
            $this->connect->setQuery($insertSql);
            $this->connect->execute([$name, $link, $Show_is, $image]);

        return $this->connect->loadData([$banner_id,$name, $link,  $Show_is, $image]); // Thực thi với tham số
    }

    public function update_banner($name, $link, $Show_is, $image,$banner_id)
    {
        $updateSql = "UPDATE `categories` SET `name`=?,`link`=?,`Show_Is`=?,`image`=? WHERE `banner_id`=?";

        $this->connect->setQuery($updateSql);
        return $this->connect->loadData([$name, $link,  $Show_is, $image, $banner_id], false);

        // $updateSql = "UPDATE `products` 
        //               SET `name` = ?, `description` = ?, `category_id` = ? 
        //               WHERE `product_id` = ?";
        //     $this->connect->setQuery($updateSql);
        //     $result = $this->connect->loadData([$name, $description, $category_id, $product_id]);
        //     if ($result) {
        //         return $product_id;
    }
    
    public function getIdBanner($banner_id){
        $sql = "SELECT * FROM `banners` WHERE banner_id = ?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$banner_id], false);
    }
    
    public function delete_banner($banner_id){
        $sql = "DELETE FROM `banners` WHERE `banner_id`=?";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$banner_id], false);

      
    }

    public function update_banner_show_status($banner_id, $show_is_value)
    {
        // Chuẩn bị câu lệnh SQL để cập nhật trạng thái show_is
        $this->sql = "UPDATE banners SET show_is = ? WHERE banner_id = ?";
    
        // Gọi hàm execute và truyền các tham số
        return $this->execute(array($show_is_value, $banner_id));
    }
}
