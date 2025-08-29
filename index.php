<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Http/web.php';

use App\Core\Core;
use App\Http\Route;


Core::dispatch(Route::getRoutes());