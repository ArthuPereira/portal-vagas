<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private static ?PDO $connection = null;

    private function __construct(
        private string $host = "localhost",
        private string $database = "espaco_emprego",
        private string $user = "root",
        private string $password = "1234",
    ) {
        try {
            self::$connection = new PDO(
                "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4",
                $this->user,
                $this->password
            );
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance == null) {
            return self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
