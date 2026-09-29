<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private static ?PDO $connection = null;
    
    /**
     * OBS: 
     * Esses métodos extras são pra evitar de criar uma instância do banco pra cada repository, não é problema real do nosso caso,
     * é mais eu querendo botar em prática design pattern que eu andei estudando por aí.
     */

    private string $host;
    private string $database;
    private string $user;
    private string $password;
    private string $port;

    private function __construct()
    {
        $this->host = getenv('DB_HOST') ?: 'db';
        $this->database = getenv('DB_DATABASE') ?: (getenv('DB_NAME') ?: 'curriculos_db');
        $this->user = getenv('DB_USER') ?: 'curriculos_user';
        $this->password = getenv('DB_PASSWORD') !== false ? (string) getenv('DB_PASSWORD') : 'curriculos_pass';
        $this->port = getenv('DB_PORT') ?: '5432';

        $maxRetries = 10;
        $retryDelay = 2;

        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                self::$connection = new PDO(
                    "pgsql:host={$this->host};port={$this->port};dbname={$this->database}",
                    $this->user,
                    $this->password
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return;
            } catch (PDOException $e) {
                if ($attempt === $maxRetries) {
                    die("Erro na conexão com o banco de dados: " . $e->getMessage());
                }
                sleep($retryDelay);
            }
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
        return self::$connection;
    }
}
