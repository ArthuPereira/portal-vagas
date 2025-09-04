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
            // regex que dá match com as rotas cadastradas
            $pattern = preg_replace(
                '/\{[a-zA-Z_][a-zA-Z0-9_]*\}/',
                '(?!update$|create$)([a-zA-Z0-9_-]+)',
                $route['url']
            );
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); // pega somente os grupos de captura tirados da url

                $controllerName = $route['controller'];
                $method = $route['method'];
                $repositoryName = $route['repository'];

                if (!class_exists($controllerName)) {
                    die("erro: classe não existe");
                }

                if (!class_exists($repositoryName)) {
                    die("erro: repositório não existe");
                }
                $repository = new $repositoryName();

                $controller = new $controllerName($repository);
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
