<?php
class HomeController
{
    private $gameModel;

    public function __construct($pdo)
    {
        require_once 'models/Game.php';
        $this->gameModel = new Game($pdo);
    }

    public function showHome()
    {
        $username = $_SESSION['username'];
        $userId = $_SESSION['user_id'] ?? null;
        $topSoloScores = $this->gameModel->getTopSoloScores($userId);
        $topMultiplayerWinners = $this->gameModel->getTopMultiplayerWinners($userId);
        require 'views/home.php';
    }
}
