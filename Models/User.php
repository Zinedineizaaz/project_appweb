<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db->conn;
    }

    public function register($username, $password, $email) {
        // Validasi jika username sudah terdaftar
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            return false; // Username sudah ada
        }
    
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $email]);
        return true;
    }
    

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }
}

?>
