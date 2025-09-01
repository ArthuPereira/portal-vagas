<?php

namespace App\Utils;

class Flash
{
    public static function set(string $key, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['Flash'][$key] = $message;
    }
    
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
