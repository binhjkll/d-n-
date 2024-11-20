<?php
require "models/ConnectDatabase.php";
class Book
{
    public $connect;
    public function getDM(){
        $sql = "SELECT * FROM `categories` ORDER BY category_id ASC";
        $this->connect->setQuery($sql);
        return $this->connect->loadData();
    }
    public function __construct()
    {
        $this->connect = new ConnectDatabase();
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
    public function addDM($category_id, $name){
        $sql = "INSERT INTO `categories`(category_id, name) VALUES (?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$category_id, $name]);
    }
    public function getIdDM($category_id){
        $sql = "SELECT * FROM `categories` WHERE category_id=?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$category_id],false);
    }
    public function editDM($name, $category_id){
        $sql = "UPDATE `categories` SET `name`=? WHERE `category_id`=?";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$name, $category_id], false);
    }
    public function deleteDM($category_id) {
        $sql = "DELETE FROM `categories` WHERE `category_id` = ?";
        $this->connect->setQuery($sql);
        return $this->connect->execute([$category_id], false); // Thực thi câu lệnh DELETE
    }
    

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

    public function addReview($product_id, $user_id, $rating, $comment_text) {
        $sql = "INSERT INTO `reviews` (product_id, user_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())";
        try {
            $this->connect->setQuery($sql);
            return $this->connect->loadData([$product_id, $user_id, $rating, $comment_text]);
        } catch (Exception $e) {
            error_log("SQL Error: " . $e->getMessage());
            return false;
        }
    }
}