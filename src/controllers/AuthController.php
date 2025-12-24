<?php
class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showLogin() {
        $mode = $_GET['mode'] ?? 'login';
    
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
    
        require 'views/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=login');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->login($username, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header('Location: index.php');
            exit;
        } else {
            $_SESSION['error'] = 'Invalid username or password.';
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=signup');
            exit;
        }
    
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
    
        if (!$username || !$password) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: index.php?action=signup');
            exit;
        }
    
        $userId = $this->userModel->create($username, $password);
    
        if ($userId) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['error'] = 'Username already exists';
            header('Location: index.php?action=signup');
            exit;
        }
    }

    public function logout() {
        session_destroy();

        header('Location: index.php?action=login');
        exit;
    }
}
