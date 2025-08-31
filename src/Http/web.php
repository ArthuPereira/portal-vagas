<?php

namespace App\Http;

use App\Http\Route;
use App\Controllers\HomeController;
use App\Controllers\CompanyController;
use App\Repositories\CompanyRepository;

Route::add('/', HomeController::class, 'index', CompanyRepository::class);
Route::add('/company/{id}', CompanyController::class, 'show', CompanyRepository::class);