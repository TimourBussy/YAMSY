<?php
class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showLogin() {
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        require 'views/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Location: index.php?action=login');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'Please provide both username and password.';
            header('Location: index.php?action=login');
            exit;
        }

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

    public function logout() {
        session_destroy();

        header('Location: index.php?action=login');
        exit;
    }
}
