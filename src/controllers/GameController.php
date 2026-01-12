<?php
require_once 'models/User.php';
require_once 'models/Game.php';

class GameController
{
    private $game;
    private $gameModel;

    public function __construct($pdo = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['game'])) {
            $_SESSION['game'] = new Game($pdo);
        }

        $this->game = $_SESSION['game'];
        if ($pdo) {
            $this->gameModel = new Game($pdo);
        }
    }

    public function showGameSetup()
    {
        $game = $this->game;
        include 'views/game_setup.php';
    }

    public function showGame()
    {
        $nbPlayers = $_SESSION['nb_players'] ?? 1;
        $players = $_SESSION['players'] ?? [];

        $currentIndex = $_SESSION['current_player'] ?? 0;
        $currentPlayer = $players[$currentIndex] ?? $_SESSION['username'] ?? 'Player 1';

        $game = $this->game;
        include 'views/game.php';
    }

    public function saveGame()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['mode'])) {
            echo json_encode(['success' => false, 'message' => 'Missing mode']);
            return;
        }

        if (($data['mode'] ?? 'solo') === 'solo') {
            $userId = $_SESSION['user_id'] ?? null;

            if ($userId && $this->gameModel) {
                $result = $this->gameModel->saveSoloGame($userId, (int)($data['score'] ?? 0));
                echo json_encode(['success' => $result]);
            } else {
                echo json_encode(['success' => false, 'error' => 'User not logged in']);
            }
        } else {
            if ($this->gameModel) {
                $result = $this->gameModel->saveMultiplayerGame($data['players'] ?? [], $data['scores'] ?? []);
                echo json_encode(['success' => $result]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Game model not initialized']);
            }
        }
    }
}
