<?php
session_start();

require_once 'controllers/AuthController.php';
require_once 'controllers/GameController.php';

$action = $_GET['action'] ?? 'default';

$publicActions = ['login', 'signup', 'doLogin', 'doSignup'];

if (in_array($action, $publicActions)) {
    $authController = new AuthController();
    switch ($action) {
        case 'login':
            $authController->showLogin('login');
            break;
        
        case 'signup':
            $authController->showLogin('signup');
            break;
        
        case 'doLogin':
            $authController->login();
            break;
        
        case 'doSignup':
            $authController->signup();
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