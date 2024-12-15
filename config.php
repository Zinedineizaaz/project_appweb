<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tiket_pesawat');

class Database {
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost" . DB_HOST . ";dbname=tiket_pesawat" . DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
?>
