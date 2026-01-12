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

        // Debug logging
        error_log("Save game called with data: " . json_encode($data));

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
            error_log("Attempting to save multiplayer game");
            error_log("Game model exists: " . ($this->gameModel ? 'yes' : 'no'));
            error_log("Players: " . json_encode($data['players'] ?? []));
            error_log("Scores: " . json_encode($data['scores'] ?? []));

            if ($this->gameModel) {
                try {
                    $result = $this->gameModel->saveMultiplayerGame($data['players'] ?? [], $data['scores'] ?? []);
                    error_log("Save result: " . ($result ? 'success' : 'failure'));
                    echo json_encode(['success' => $result]);
                } catch (Exception $e) {
                    error_log("Error saving multiplayer game: " . $e->getMessage());
                    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Game model not initialized']);
            }
        }
    }
}
