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
            $pattern = preg_replace('/\{[a-zA-Z_][a-zA-Z0-9_]*\}/', '([a-zA-Z0-9_-]+)', $route['url']);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $controllerName = $route['controller'];
                $method = $route['method'];
                $repositoryName = $route['repository'] ?? null;

                if (!class_exists($controllerName)) {
                    die("erro: classe não existe");
                }

                $repository = null;
                if ($repositoryName && class_exists($repositoryName)) {
                    $repository = new $repositoryName();
                }

                $controller = $repository ? new $controllerName($repository) : new $controllerName();
                if (!method_exists($controller, $method)) {
                    die("erro: método não existe na classe");
                }

                $controller->$method(...$matches);
                return;
            }
        }

        $notFound = new NotFoundController();
        $notFound->index();
    }
}