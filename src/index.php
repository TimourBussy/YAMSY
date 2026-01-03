<?php
session_start();

require_once 'controllers/AuthController.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/GameController.php';

$action = $_GET['action'] ?? 'home';

if (in_array($action, ['login', 'signup', 'doLogin', 'doSignup'])) {
    $authController = new AuthController();
    switch ($action) {
        case 'login':
        case 'signup':
            $authController->showLogin();
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

switch ($action) {
    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;
    
    case 'game':
        $gameController = new GameController();
        $gameController->showGame();
        break;
    
    case 'home':
    default:
        $homeController = new HomeController();
        $homeController->showHome();
        break;
}
?>