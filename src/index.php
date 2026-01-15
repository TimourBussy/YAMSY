<?php
session_start();

require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/GameController.php';

$database = new Database();
$pdo = $database->connect();

register_shutdown_function(function () {
    global $database, $pdo;
    unset($database, $pdo);
});

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
        $nbPlayers = (int) ($_POST['nbPlayers'] ?? 1);
        $rawPlayers = $_POST['players'] ?? [];
        $players = [];

        if (empty($_POST)) {
            $players = [$_SESSION['username'] ?? 'Player 1'];
            $nbPlayers = 1;
        } else {
            for ($i = 1; $i <= $nbPlayers; $i++) {
                $name = trim($rawPlayers[$i - 1] ?? '');

                if ($name === '') {
                    $name = ($i === 1) ? ($_SESSION['username'] ?? "Player 1") : "Player {$i}";
                }

                $players[] = $name;
            }
        }

        $_SESSION['nb_players'] = $nbPlayers;
        $_SESSION['players'] = $players;
        $_SESSION['current_player'] = 0;

        header('Location: ?action=play');
        exit;

    case 'play':
        $gameController = new GameController($pdo);
        $gameController->showGame();
        break;

    case 'save_game':
        $gameController = new GameController($pdo);
        $gameController->saveGame();
        break;

    case 'game_setup':
        $gameController = new GameController($pdo);
        $gameController->showGameSetup();
        break;

    case 'home':
    default:
        $homeController = new HomeController($pdo);
        $homeController->showHome();
        break;
}
