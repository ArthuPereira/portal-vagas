<?php

namespace App\Http;

use App\Http\Route;
use App\Controllers\HomeController;


Route::add('/', HomeController::class, 'index');