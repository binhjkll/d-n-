<?php
require_once 'env.php';
class ConnectDatabase
{
    //    Các thuộc tính tạo sẵn theo base
    public $pdo;
    public $sql;
    public $sta;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";dbcharset=" . DBCHARSET,
                DBUSER,
                DBPASS
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //   Các phương thức tạo sẵn theo base
    public function setQuery($sql)
    {
        $this->sql = $sql;
    }
    // hàm này sẽ làm hàm chạy câu truy vấn
    public function execute($options = array())
    {
        try {
            // Chuẩn bị câu truy vấn SQL
            $this->sta = $this->pdo->prepare($this->sql);

            // Nếu có options (các giá trị để bind)
            if ($options) {
                // Lặp qua từng option
                for ($i = 0; $i < count($options); $i++) {
                    // Bind tham số ở index $i+1 với giá trị tương ứng trong mảng $options
                    $this->sta->bindParam($i + 1, $options[$i]);
                }
            }

            // Thực thi câu truy vấn đã chuẩn bị
            $this->sta->execute();

            // Trả về câu truy vấn đã chuẩn bị
            return $this->sta;
        } catch (PDOException $e) {
            // Xử lý ngoại lệ PDOException
            // Ở đây có thể log lỗi, thông báo cho người dùng hoặc thực hiện các hành động khác
            // Ví dụ:
            echo "Lỗi khi thực thi truy vấn: " . $e->getMessage();
            // hoặc
            // throw $e; // Chuyển ngoại lệ để xử lý ở nơi khác nếu cần
        }
    }
    //    Truy vấn
    public function loadData($options = array(), $getAllData = true)
    {
        try {
            // Nếu không có options được cung cấp
            if (!$options) {
                // Thực thi truy vấn mặc định
                if (!$result = $this->execute())
                    return false;
            } else {
                // Nếu có options, thực thi truy vấn với các options đã cho
                if (!$result = $this->execute($options))
                    return false;
            }
            if ($getAllData == true) {
                // Trả về tất cả các hàng từ kết quả truy vấn dưới dạng một mảng các đối tượng
                return $result->fetchAll(PDO::FETCH_OBJ);
            } else {
                return $result->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            // Xử lý ngoại lệ PDOException
            // Có thể log lỗi, thông báo cho người dùng hoặc thực hiện các hành động khác
            // Ví dụ:
            echo "Lỗi truy vấn: " . $e->getMessage();
            // hoặc
            // throw $e; // Chuyển ngoại lệ để xử lý ở nơi khác nếu cần
        }
    }
    public function lastInsertId()
    {
        try {
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Lỗi khi lấy ID vừa chèn vào: " . $e->getMessage();
        }
    }
    public function loadSingle($params = [])
    {
        try {
            // Chuẩn bị truy vấn SQL
            $stmt = $this->pdo->prepare($this->sql);
            // Thực thi truy vấn với tham số
            $stmt->execute($params);

            // Trả về bản ghi đầu tiên dưới dạng mảng kết hợp, hoặc null nếu không có kết quả
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            // Ghi log lỗi và ném ra Exception thay vì die
            error_log("Lỗi truy vấn: " . $e->getMessage()); // Ghi log lỗi vào file
            throw new Exception("Đã xảy ra lỗi khi truy vấn cơ sở dữ liệu."); // Ném exception để xử lý tại nơi gọi
        }
    }
    public function loadRow($params = [])
    {
        try {
            // Chuẩn bị câu lệnh truy vấn
            $stmt = $this->pdo->prepare($this->sql);

            // Gắn các tham số vào câu truy vấn
            $stmt->execute($params);

            // Lấy một dòng dữ liệu từ kết quả
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Database error: " . $e->getMessage();
            return false;
        }
    }



}
