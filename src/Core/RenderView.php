<?php

namespace App\Core;

class RenderView
{
    public static function loadView(string $view, array $args = [], bool $withLayout = true)
    {
        extract($args);

        $viewsPath = __DIR__ . '/../Views/';

        if ($withLayout) {
            require $viewsPath . 'layout/header.php';
        }

        require $viewsPath . "{$view}.php";

        if ($withLayout) {
            require $viewsPath . 'layout/footer.php';
        }
    }

    public static function partial(string $view, array $args = [])
    {
        extract($args);

        require __DIR__ . "/../Views/{$view}.php";
    }
}