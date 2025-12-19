<?php
session_start();

require_once 'controllers/AuthController.php';
require_once 'controllers/GameController.php';

$action = $_GET['action'] ?? 'default';

$publicActions = ['login', 'register', 'doLogin', 'doRegister'];

if (in_array($action, $publicActions)) {
    $authController = new AuthController();
    $authController->$action();

    switch ($action) {
        case 'login':
            $authController->showLogin();
            break;
        case 'doLogin':
            $authController->login();
            break;
    }
    exit;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ?action=login');
    exit;
}

$gameController = new GameController();

switch ($action) {
    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;
    default: $gameController->showGame();
}
?>