<?php

namespace App\Utils;

class Render
{
    public static function load(string $view, array $args = [])
    {
        extract($args);

        // pega o conteúdo da view usando um buffer e limpa ele
        ob_start();
        require __DIR__ . "/../Views/{$view}.php";
        $content = ob_get_clean(); 

        // Inclui o layout base
        require __DIR__ . "/../Views/layout.php";
    }
}