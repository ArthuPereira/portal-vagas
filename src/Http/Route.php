<?php

namespace App\Http;

class Route
{
    protected static array $routes = [];

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function add(string $url, string $controller, string $method, string $repository)
    {
        self::$routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method,
            'repository' => $repository
        ];
    }
}