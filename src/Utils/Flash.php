<?php

namespace App\Utils;

class Flash
{
    /**
     * salva mensagens com status de ações (criar, atualizar, erro...) em $_SESSION[flash][key]
     * * as únicas key usadas são 'error' e 'sucess'
    */
    public static function set(string $key, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['Flash'][$key] = $message;
    }
    
    /**
     * recupera uma mensagem contida em uma key e libera esse espaço em $_SESSION
    */
    public static function get(string $key): ?string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['Flash'][$key])) {
            return null;
        }

        $message = $_SESSION['Flash'][$key];
        unset($_SESSION['Flash'][$key]);
        return $message;
    }

    /**
     * recupera todas as mensagens e libera o espaço em $_SESSION
     * * isso significa tanto 'error' quanto 'success' 
    */
    public static function all()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $flashes = $_SESSION['Flash'] ?? [];
        unset($_SESSION['Flash']);
        return $flashes;
    }
}
