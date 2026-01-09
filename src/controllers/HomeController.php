<?php
class HomeController
{
    public function showHome()
    {
        $username = $_SESSION['username'];
        require 'views/home.php';
    }
}
?>