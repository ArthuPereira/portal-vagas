<?php

namespace App\Core;

use App\Controllers\NotFoundController;

class Core
{
    public static function dispatch(array $routes)
    {
        $url = '/';

        isset($_GET['url']) && $url .= $_GET['url'];

        $url !== '/' && $url = rtrim($url, '/');

        foreach($routes as $route) {
            if ($route['url'] === $url) {
                $controllerName = $route['controller'];
                $method = $route['method'];

                if (!class_exists($controllerName)) {
                    die("erro: classe não existe");
                }

                $controller = new $controllerName();
                if (!method_exists($controller, $method)) {
                    die("erro: método não existe na classe");
                }

                $controller->$method();
                return;
            }
        }

        $notFound = new NotFoundController();
        $notFound->index();
    }
}