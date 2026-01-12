<?php
session_start();

require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/GameController.php';

$action = $_GET['action'] ?? 'home';

$authController = new AuthController();
$homeController = new HomeController($pdo);
$gameController = new GameController($pdo);

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
        $nbPlayers = (int) ($_POST['nbPlayers'] ?? 1);
        $rawPlayers = $_POST['players'] ?? [];
        $players = [];

        for ($i = 1; $i <= $nbPlayers; $i++) {
            $name = trim($rawPlayers[$i - 1] ?? '');

            if ($name === '') {
                $name = ($i === 1) ? ($_SESSION['username'] ?? "Player 1") : "Player {$i}";
            }

            $players[] = $name;
        }

        $_SESSION['nb_players'] = $nbPlayers;
        $_SESSION['players'] = $players;
        $_SESSION['current_player'] = 0;

        header('Location: ?action=play');
        exit;

    case 'play':
        $gameController->showGame();
        break;

    case 'save_game':
        $gameController->saveGame();
        break;

    case 'game_setup':
        $gameController->showGameSetup();
        break;

    case 'home':
    default:
        $homeController->showHome();
        break;
}
