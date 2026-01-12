<?php
require_once 'config/database.php';

class User
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function create($username, $password)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO users (username, password)
                                        VALUES (:username, :password)");

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));

            $stmt->execute();

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error creating user: " . $e->getMessage());
            return false;
        }
    }

    public function login($username, $password)
    {
        $stmt = $this->db->prepare("SELECT id, username, password
                                    FROM users
                                    WHERE username = :username");

        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }

        return false;
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT id, username
                                    FROM users
                                    WHERE id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }
}
