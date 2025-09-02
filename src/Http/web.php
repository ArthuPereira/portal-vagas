<?php

namespace App\Http;

use App\Http\Route;
use App\Controllers\HomeController;
use App\Controllers\CompanyController;
use App\Repositories\CompanyRepository;

Route::add('/', HomeController::class, 'index', CompanyRepository::class);

// * por enquanto não vou mudar o regex do core, então rotas dinâmica TEM que vir depois das estáticas pra não acabar engolindo elas
Route::add('/company/form', CompanyController::class, 'form', CompanyRepository::class);
Route::add('/company/create', CompanyController::class, 'create', CompanyRepository::class);
Route::add('/company/update/{id}', CompanyController::class, 'update', CompanyRepository::class);
Route::add('/company/{id}', CompanyController::class, 'show', CompanyRepository::class);