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
        $topSoloScores = $this->gameModel->getTopSoloScores();
        $topMultiplayerWinners = $this->gameModel->getTopMultiplayerWinners();
        require 'views/home.php';
    }
}
