<?php

// Inicia sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carregamento simples de variáveis do arquivo .env se existir
if (file_exists(__DIR__ . '/.env')) {
    $envLines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($envLines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        if (str_contains($line, '=')) {
            [$key, $val] = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val, " \t\n\r\0\x0B\"'");
            if (getenv($key) === false) {
                putenv("{$key}={$val}");
                $_ENV[$key] = $val;
            }
        }
    }
}

// Definição da constante BASE_URL (vazia por padrão em raiz, ou customizável via env)
if (!defined('BASE_URL')) {
    $envBase = getenv('BASE_URL');
    if ($envBase !== false) {
        define('BASE_URL', rtrim($envBase, '/'));
    } else {
        $scriptDir = trim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');
        define('BASE_URL', $scriptDir ? '/' . $scriptDir : '');
    }
}

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Http/web.php';

use App\Core\Core;
use App\Http\Route;

Core::dispatch(Route::getRoutes());