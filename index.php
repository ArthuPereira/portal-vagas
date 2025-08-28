<?php

use App\Core\Core;
use App\Http\Route;

require __DIR__ . '/vendor/autoload.php';

Core::dispatch(Route::getRoutes());
