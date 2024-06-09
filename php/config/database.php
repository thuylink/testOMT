<?php
class Database {
    private $servername = "localhost"; 
    private $username = "root"; 
    private $password = ""; 
    private $dbname = "kids_test"; 
    public $conn;

    // Hàm khởi tạo
    public function __construct() {
        $this->conn = $this->getConnection();
    }

    // Phương thức thiết lập kết nối CSDL
    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Lỗi kết nối: " . $e->getMessage();
        }
        
        return $this->conn;
    }
}