<?php
require_once 'models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLogin()
    {
        $mode = $_GET['action'] ?? 'login';

        $error = $_SESSION['error'] ?? null;
        $success = $_SESSION['success'] ?? null;

        unset($_SESSION['error']);
        unset($_SESSION['success']);

        require 'views/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=login');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: index.php?action=login');
            exit;
        }

        $user = $this->userModel->login($username, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            if (isset($_POST['rememberMe'])) {
                setcookie('remember_token', bin2hex(random_bytes(32)), time() + (30 * 24 * 3600), '/', '', false, true);
            }

            header('Location: index.php?action=home');
            exit;
        } else {
            $_SESSION['error'] = 'Invalid username or password.';
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=signup');
            exit;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: index.php?action=signup');
            exit;
        }

        if (strlen($username) < 3) {
            $_SESSION['error'] = 'Username must be at least 3 characters long.';
            header('Location: index.php?action=signup');
            exit;
        }

        if (strlen($username) > 50) {
            $_SESSION['error'] = 'Username must be less than 50 characters.';
            header('Location: index.php?action=signup');
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Password must be at least 6 characters long.';
            header('Location: index.php?action=signup');
            exit;
        }

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $_SESSION['error'] = 'Username can only contain letters, numbers and underscores.';
            header('Location: index.php?action=signup');
            exit;
        }

        $userId = $this->userModel->create($username, $password);

        if ($userId) {
            $_SESSION['success'] = 'Account created successfully! Please log in.';

            header('Location: index.php?action=login');
            exit;
        } else {
            $_SESSION['error'] = 'Username already exists.';
            header('Location: index.php?action=signup');
            exit;
        }
    }

    public function logout()
    {
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/', '', false, true);
        }

        session_destroy();

        header('Location: index.php?action=login');
        exit;
    }
}