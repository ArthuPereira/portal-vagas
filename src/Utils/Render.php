<?php

namespace App\Utils;

class Render
{
    public static function load(string $view, array $args = [])
    {
        extract($args);

        require_once __DIR__ . "/../Views/{$view}.php";
    }
}