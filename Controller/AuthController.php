<?php
require_once 'Models/User.php';

class AuthController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function login() {
        session_start();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
    
            // Validasi input kosong
            if (empty($username) || empty($password)) {
                $error = "Username and Password are required.";
                include 'views/login.php';
                return;
            }
    
            // Login user
            $user = $this->user->login($username, $password);
            if ($user) {
                $_SESSION['user'] = $user['username'];
                if (isset($_POST['remember_me'])) {
                    setcookie('user', $user['username'], time() + (7 * 24 * 60 * 60), "/"); // 7 days
                }
                header('Location: index.php');
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        }
        include 'Views/login.php';
    }
    

    public function signup() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $email = trim($_POST['email']);
    
            // Validasi input kosong
            if (empty($username) || empty($password) || empty($email)) {
                $error = "All fields are required.";
                include 'Views/register.php';
                return;
            }
    
            // Validasi format email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
                include 'Views/register.php';
                return;
            }
    
            // Validasi panjang password
            if (strlen($password) < 6) {
                $error = "Password must be at least 6 characters.";
                include 'Views/register.php';
                return;
            }
    
            // Validasi apakah username atau email sudah digunakan
            try {
                $result = $this->user->create($username, $password, $email);
                if ($result) {
                    header('Location: index.php?route=login');
                    exit;
                } else {
                    $error = "Username or email is already taken.";
                }
            } catch (Exception $e) {
                $error = "Error occurred: " . $e->getMessage();
            }
        }
        include 'Views/register.php';
    }
    

    public function logout() {
        session_start();
        session_destroy();
        if (isset($_COOKIE['user'])) {
            setcookie('user', '', time() - 3600, "/"); // Expire the cookie
        }
    
        // Redirect ke homepage
        header('Location: homepage.php');
        exit;
    }
    
}
?>
