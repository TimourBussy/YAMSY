<?php
require_once 'models/Game.php';
class GameController {
    private $game;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['game'])) {
            $_SESSION['game'] = new Game();
        }
        
        $this->game = $_SESSION['game'];
    }

    public function showWelcome() {
        $game = $this->game;
        include 'views/game.php';
    }

    public function showGame() {
        $game = $this->game;
        include 'views/game.php';
    }
}
