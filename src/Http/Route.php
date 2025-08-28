<?php

namespace App\Http;

class Route
{
    protected static array $routes = [
        [
            'url' => '/',
            'controller' => 'HomeController',
            'method' => 'index'
        ]
    ];

    
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    // todo métodos para criar as rotas
}