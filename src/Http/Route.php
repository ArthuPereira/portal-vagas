<?php

namespace App\Http;

class Route
{
    protected static array $routes = [];

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    // todo métodos para criar as rotas
    public static function add(string $url, string $controller, string $method)
    {
        self::$routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method
        ];
    }
}