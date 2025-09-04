<?php

namespace App\Http;

use App\Http\Route;
use App\Controllers\HomeController;
use App\Controllers\CompanyController;
use App\Controllers\ResumeController;
use App\Controllers\VacancyController;
use App\Repositories\CompanyRepository;
use App\Repositories\ResumeRepository;
use App\Repositories\VacancyRepository;

Route::add('/', HomeController::class, 'index', CompanyRepository::class);

// por conta de como o regex do core funciona as rotas mais abrangentes devem ficar mais pro final
// motivo: elas vão dar match e vão pegar tudo como id, aí no lugar de iniciar com um número inicia com "form"

Route::add('/company/form', CompanyController::class, 'form', CompanyRepository::class);
Route::add('/company/create', CompanyController::class, 'create', CompanyRepository::class);
Route::add('/company/update/{id}', CompanyController::class, 'update', CompanyRepository::class);
Route::add('/company/{id}', CompanyController::class, 'show', CompanyRepository::class);

Route::add('/vacancy/create/{id}', VacancyController::class, 'create', VacancyRepository::class);
Route::add('/vacancy/{id}', VacancyController::class, 'show', VacancyRepository::class);

Route::add('/resume/create/{id}', ResumeController::class, 'create', ResumeRepository::class);
Route::add('/resume/{id}', ResumeController::class, 'show', ResumeRepository::class);