<?php

spl_autoload_register(function ($class) {
    $prefix = 'App\\';

    $base_dir = __DIR__ . '/src/';

    $relative_class = substr($class, strlen($prefix));

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    } else {
        echo "Arquivo não encontrado: $file\n";
    }
});