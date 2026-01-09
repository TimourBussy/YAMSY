<?php
session_start();

require_once 'controllers/AuthController.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/GameController.php';

$action = $_GET['action'] ?? 'home';

$authController = new AuthController();
$homeController = new HomeController();
$gameController = new GameController();

if (in_array($action, ['login', 'signup', 'doLogin', 'doSignup'])) {
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
        $authController->logout();
        break;

    case 'game':
        $_SESSION['nb_players'] = $_POST['nbPlayers'] ?? 1;
        $_SESSION['players'] = $_POST['players'] ?? [];

        header('Location: ?action=play');
        exit;

    case 'play':
        $gameController->showGame();
        break;

    case 'game_setup':
        $gameController->showGameSetup();
        break;

    case 'home':
    default:
        $homeController->showHome();
        break;
}
?>