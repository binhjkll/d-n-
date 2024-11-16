<?php
require "models/ConnectDatabase.php";
class Book
{
    public $connect;
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


    // public function getid($product_id)
    // {
    //     $sql = "SELECT * FROM `products` WHERE product_id=?";
    //     $this->connect->setQuery($sql);
    //     return $this->connect->loadData([$product_id], false);
    // }
    // public function getvid($variant_id)
    // {
    //     $sql = "SELECT * FROM `product_variants` WHERE variant_id=?";
    //     $this->connect->setQuery($sql);
    //     return $this->connect->loadData([$variant_id], false);
    // }




    public function delete($product_id)
    {
        $sql = "DELETE FROM `products` WHERE product_id=?";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$product_id], false);
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

    // Hàm thêm biến thể với product_id
    public function addvariants($product_id, $price, $stock_quantity, $product_img)
    {
        $sql = "INSERT INTO `product_variants` (product_id, price, stock_quantity, product_img) VALUES (?, ?, ?,?)";
        $this->connect->setQuery($sql);
        return $this->connect->loadData([$product_id, $price, $stock_quantity, $product_img]);
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
}
