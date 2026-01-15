<?php
class Database
{
    private $host;
    private $db_name = 'yamsy_db';
    private $username = 'admin';
    private $password = 'idf1986';
    private $pdo = null;

    public function __construct()
    {
        $this->host = (gethostbyname('db') !== 'db') ? 'db' : 'localhost';
    }

    public function connect()
    {
        if ($this->pdo !== null) return $this->pdo;

        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);

            return $this->pdo;
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }
}
