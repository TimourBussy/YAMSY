<?php
require_once 'models/User.php';

class GameController
{
    private $game;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['game'])) {
            $_SESSION['game'] = new Game();
        }

        $this->game = $_SESSION['game'];
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
        $game = $this->game;
        include 'views/game.php';
    }
}
