<?php

namespace App\Controllers;

use App\Repositories\CompanyRepository;
use App\Utils\Render;

class HomeController
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    
    public function index()
    {
        Render::load("home", [
            "title" => "Título",
            "message" => "Isso foi um exemplo base do projeto",
            "companies" => $this->recentlyAdded()
        ]);
    }
    
    public function recentlyAdded()
    {
        $recentlyAdded = $this->companyRepository->getCompanies();
        return $recentlyAdded;
    }
}
