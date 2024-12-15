<?php
class AuthController extends Controller {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            // Validasi form
            if (empty($username) || empty($password)) {
                $error = "Username and Password are required.";
                $this->loadView('login', ['error' => $error]);
                return;
            }
            
            // Cek login menggunakan model User
            $userModel = $this->loadModel('User');
            if ($userModel->login($username, $password)) {
                header('Location: /homepage');
            } else {
                $error = "Invalid username or password.";
                $this->loadView('login', ['error' => $error]);
            }
        } else {
            $this->loadView('login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $password_confirm = trim($_POST['password_confirm']);
            $email = trim($_POST['email']);
            
            // Validasi form
            if (empty($username) || empty($password) || empty($password_confirm) || empty($email)) {
                $error = "All fields are required.";
                $this->loadView('register', ['error' => $error]);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
                $this->loadView('register', ['error' => $error]);
                return;
            }

            if ($password !== $password_confirm) {
                $error = "Passwords do not match.";
                $this->loadView('register', ['error' => $error]);
                return;
            }

            // Enkripsi password dan simpan user
            $userModel = $this->loadModel('User');
            $userModel->register($username, $password, $email);
            header('Location: /login');
        } else {
            $this->loadView('register');
        }
    }
}
?>
