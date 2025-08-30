<?php

namespace App\Http;

use App\Http\Route;
use App\Controllers\HomeController;
use App\Repositories\CompanyRepository;

Route::add('/', HomeController::class, 'index', CompanyRepository::class);